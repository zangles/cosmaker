<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    Const STATUS_COMPLETED = 'completed';
    Const STATUS_INCOMPLETED = 'incompleted';

    protected $fillable = [
        'cosplay_id','name','status'
    ];

    public function cosplay()
    {
        return $this->belongsTo(Cosplay::class)->orderBy('status');
    }
}
