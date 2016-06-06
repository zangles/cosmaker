<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = [
        'cosplay_id','name','cost'  
    ];

    public function cosplay()
    {
        return $this->belongsTo(Cosplay::class);
    }
}
