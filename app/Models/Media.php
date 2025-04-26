<?php

namespace App\Models;

use App\Models\MyFile;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['my_file_id','file_name','type'];

    public function file(){
        return $this->belongsTo(MyFile::class);
    }
}
