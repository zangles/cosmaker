<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CosplayPart extends Model
{
    const STATUS_PLANNED = "planeado";
    const STATUS_IN_PROGRESS = "en progreso";
    const STATUS_FINISHED = "terminado";

    protected $fillable =[
        'cosplay_id','name','progress','description','status'
    ];

    public function cosplay()
    {
        return $this->belongsTo(Cosplay::class);
    }
}
