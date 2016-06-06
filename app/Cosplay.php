<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cosplay extends Model
{
    const PLANNED = 'planeado';
    const IN_PROGRESS = 'en progreso';
    const FINISHED = 'terminado';

    protected $fillable =[
        'name','status','description','budget','owner'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function parts()
    {
        return $this->hasMany(CosplayPart::class);
    }

    public function costs()
    {
        return $this->hasMany(Gasto::class);
    }

    public function getProgress()
    {
        $parts = $this->parts->all();
        $suma = 0;
        $k = 0;
        foreach ($parts as $k=>$part) {
            $suma += $part->progress;
        }
        return round($suma/($k+1),0);
    }
}
