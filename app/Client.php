<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    public $timestamps = false;
    
    protected $primaryKey = "client_id";
    
    protected $fillable = ['client_id', 'fio', 'email', 'phone', 'status'];
}
