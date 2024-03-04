<?php

namespace App\Imports;

use App\Models\Employe;
use App\Models\Fonction;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportEmployes implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function model(array $row)
    {
        $date_naissance = date('Y-m-d', strtotime($row[5]));
        $date_embauche = date('Y-m-d', strtotime($row[7]));

        $fonction = Fonction::where('nom', $row[8])->first();

        if (!$fonction) {
            $fonction = Fonction::create([
                'nom' => $row[8]
            ]);
        }

        $existingEmployee = Employe::where('email', $row[2])->first();

        if ($existingEmployee) {
            return null;
        }

        return new Employe([
            'nom' => $row[0],
            'prenom' => $row[1],
            'email' => $row[2],
            'telephone' => $row[3],
            'adresse' => $row[4],
            'date_naissance' => $date_naissance,
            'cin' => $row[6],
            'date_embauche' => $date_embauche,
            'fonction_id' => $fonction->id,
        ]);
    }

    public function startRow(): int
    {
        return 2; 
    }
}
