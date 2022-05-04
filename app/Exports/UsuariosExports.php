<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
//use Maatwebsite\Excel\Concerns\WithHeadings;

class UsuariosExports implements FromCollection//, WithHeadings
{
    // public function heading():array {
    //     return [
    //         'Id', 'Nombre', 'Email',
    //     ];
    // }

    public function collection()
    {
        $users = User::select('id', 'name','dir', 'email')->get();
        return $users;
    }
}