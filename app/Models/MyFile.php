<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class MyFile extends Model
{
    protected $fillable = ['title'];

    public function media(){
        return $this->hasMany(Media::class);
    }
}
