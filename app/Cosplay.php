<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cosplay extends Model
{
    const PLANNED = 'planeado';
    const IN_PROGRESS = 'en progreso';
    const FINISHED = 'terminado';

    protected $fillable =[
        'name','status'
    ];
    
}
