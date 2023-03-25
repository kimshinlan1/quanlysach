<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'id';

    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }

}
