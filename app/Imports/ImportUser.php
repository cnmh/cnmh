<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
class ImportUser implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $headingRow = null;

    public function model(array $row)
    {
        $user = User::firstOrNew(['email' => $row[1]]);
        
        $user->name = $row[0];
        $user->password = Hash::make($row[2]);
        $user->save();
        return $user;
    }
    public function startRow():int{
        return 2;
    }
}
