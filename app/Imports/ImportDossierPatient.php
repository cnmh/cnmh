<?php

namespace App\Imports;

use App\Models\DossierPatient;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ImportDossierPatient implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = Auth::user();
        $userID = $user ? $user->id : null;

        if ($row[0] === 'Id') {
            return null;
        }

        $dateTime = Carbon::now();

        $dossierPatient = new DossierPatient([
            'id' => $row[0],
            'patient_id' => $row[1],
            'couverture_medical_id' => $row[2],
            'numero_dossier' => $row[3],
            'etat' => $row[4],
            'user_id' => $row[6],
        ]);

        $dossierPatient->date_enregsitrement = $dateTime;

        return $dossierPatient;
    }
}
