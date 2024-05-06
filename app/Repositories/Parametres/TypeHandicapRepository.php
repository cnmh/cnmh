<?php

namespace App\Repositories\Parametres;

use App\Models\TypeHandicap;
use App\Repositories\BaseRepository;
use App\Exceptions\Parametres\TypeHandicapAlreadyExisteException;


class TypeHandicapRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }
    
    public function get(){
        return TypeHandicap::all();
    }

    public function create(array $input): TypeHandicap 
    {
        $nom = $input['nom'];

        $existingTypeHandicap = TypeHandicap::where('nom', $nom)->exists();

        if ($existingTypeHandicap) {
            throw TypeHandicapAlreadyExisteException::createTypeHandicap();
        } else {
            return parent::create($input);
        }
    }

    public function model(): string
    {
        return TypeHandicap::class;
    }
}
