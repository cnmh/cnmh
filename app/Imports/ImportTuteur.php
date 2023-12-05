<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Tuteur;

class ImportTuteur implements ToCollection
{
    protected $parent;

    public function __construct($parent)
    {
        $this->parent = $parent;
    }

    public function collection(Collection $rows)
    {
        $rows = $rows->slice(1);

        foreach ($rows as $row) {
            $tuteur = Tuteur::create([
                'etat_civil_id' => $row[0] ?? null,
                'nom' => $row[1] ?? null,
                'prenom' => $row[2] ?? null,
                'sexe' => $row[3] ?? null,
                'telephone' => $row[4] ?? null,
                'email' => $row[5] ?? null,
                'adresse' => $row[6] ?? null,
                'cin' => $row[7] ?? null,
                'remarques' => $row[8] ?? null,
            ]);


            if (!is_null($tuteur->id)) {
                $this->parent->setTuteurId($tuteur->id);
            }
        }
    }
}
