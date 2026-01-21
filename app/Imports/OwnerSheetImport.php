<?php

namespace App\Imports;

use App\Models\Owner;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class OwnerSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $insertData = [];

        foreach ($rows as $row) {
            $validator = Validator::make($row->toArray(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:owners,email',
                'phone' => 'required|string|max:20',
                'age' => 'nullable|integer|min:0',
            ]);

            if ($validator->fails()) continue;

            $insertData[] = [
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'age' => $row['age'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($insertData)) {
            Owner::insert($insertData);
        }
    }
}
