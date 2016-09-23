<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //TO TELL ELOUET TO USE WHAT TABLE
    protected $table  = "user";
        
    protected $fillable = array(
        // list fields that can be edited
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'flag_active',
        'recover_hash',
        'active_hash',
        'remember_identifier',
        'remember_token',
        'flag_expire',
        'flag_delete',
    );
}