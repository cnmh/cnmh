<?php

namespace App\Repositories\EntretienSocial;

use App\Models\Tuteur;
use App\Repositories\BaseRepository;

class TuteurRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'etat_civil_id',
        'nom',
        'prenom',
        'sexe',
        'telephone',
        'email',
        'adresse',
        'cin',
        'remarques'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function get(){
        return Tuteur::all();
    }

    public function search($input){

        $tuteurs = Tuteur::join('etat_civils', 'tuteurs.etat_civil_id', '=', 'etat_civils.id')
            ->where('tuteurs.nom', 'like', '%' . $input . '%')
            ->orWhere('tuteurs.prenom', 'like', '%' . $input . '%')
            ->select('tuteurs.nom as tuteur_nom', 'etat_civils.id as etat_civil_id', 'tuteurs.prenom', 'tuteurs.adresse', 'tuteurs.telephone', 'tuteurs.email', 'etat_civils.nom as etat_civil_nom','tuteurs.id as id')
            ->paginate();
    }

    public function all(){
        return Tuteur::all();
    }

    public function model(): string
    {
        return Tuteur::class;
    }
}
