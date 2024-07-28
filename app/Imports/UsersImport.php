<?php


namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'   => $row['name'],
            'email'  => $row['email'],
            'status' => $row['status'],
            'role'   => $row['role'],
            'password' => bcrypt('default_password'), // Default password
        ]);
    }
}
