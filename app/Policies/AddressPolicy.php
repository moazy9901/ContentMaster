<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\Student;
use Illuminate\Auth\Access\Response;

class AddressPolicy
{
    public function update(Student $student, Address $address): bool
    {
         return $address->student_id === $student->id;
    }

    public function delete(Student $student, Address $address): bool
    {
        return $address->student_id === $student->id;
    }
}
