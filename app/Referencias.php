<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{

    protected $fillable = [
        'cosplay_id','file_ext'
    ];
    
    public function cosplay()
    {
        return $this->belongsTo(Cosplay::class);
    }
    
    public function getFileName()
    {
        return $this->id . "." . $this->file_ext;
    }

    public function getRealFilePath()
    {
        return public_path().'\\img\\references\\'.$this->getFileName();
    }

    public function getRealThumbPath()
    {
        return public_path().'\\img\\references\\thumb_'.$this->getFileName();
    }


    public function getFilePath()
    {
        return '/img/references/'.$this->getFileName();
    }

    public function getFileThumbPath()
    {
        return '/img/references/thumb_'.$this->getFileName();
    }
}
