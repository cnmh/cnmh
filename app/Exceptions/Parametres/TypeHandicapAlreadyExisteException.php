<?php

namespace App\Exceptions\Parametres;

use Exception;

class TypeHandicapAlreadyExisteException extends Exception
{
    public static function createTypeHandicap()
    {
        return new self(__('models/models/typeHandicaps.typehandicap_already_existe'));
    }
}