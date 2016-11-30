<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

	protected $table = "customer";
	
	protected $fillable = array(
		// list fields that can be edited
		'name',
		'phone'
	);
	
}