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
        // Skip the first row (heading)
        $rows = $rows->slice(1);

        foreach ($rows as $row) {
            $tuteur = Tuteur::create([
                'etat_civil_id' => 1,
                'nom' => 'John',
                'prenom' => 'Doe',
                'sexe' => 'Male',
                'telephone' => '123456789',
                'email' => 'john.doe@example.com',
                'adresse' => '123 Main St',
                'cin' => 'ABC123',
                'remarques' => 'Some remarks',
            ]);
            

            if (!is_null($tuteur->id)) {
                $this->parent->setTuteurId($tuteur->id);
            }
        }
    }
}
