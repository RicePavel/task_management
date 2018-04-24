<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $primaryKey = "document_id";
    
    public $timestamps = false;
}
