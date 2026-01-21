<?php

namespace App\Imports;

use App\Models\Admin;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class AdminSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $insertData = [];

        foreach ($rows as $row) {
            $validator = Validator::make($row->toArray(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) continue;

            $insertData[] = [
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'address' => $row['address'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bulk Insert
        if (!empty($insertData)) {
            Admin::insert($insertData);
        }
    }
}
