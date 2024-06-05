<?php

namespace App\Traits;

trait MorphType
{
    protected static function bootMorphType()
    {
        static::creating(function ($model) {
            $class = class_basename(static::class);
            if($class === "ConsultationMedecin" || $class === "Consultation"){
                $model->type = "Médecin-général";
            }else{
                $classNameWithoutPrefix = str_replace("Consultation", "", $class);
                $model->type = $classNameWithoutPrefix;
            }
        });
    }
}