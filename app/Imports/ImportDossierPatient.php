<?php

namespace App\Imports;

use App\Models\DossierPatient;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ImportDossierPatient
{
    public function insertDossierPatient($patientId, array $row)
    {
        $user = Auth::user();
        $userID = $user ? $user->id : null;

        if ($row[0] === 'Id') {
            return null;
        }

        $dossierPatient = DossierPatient::create([
            'patient_id' => $patientId, 
            'couverture_medical_id' => $row[2],
            'numero_dossier' => $row[3],
            'etat' => $row[4],
            'user_id' => $userID,
        ]);

        return $dossierPatient;
    }
}
