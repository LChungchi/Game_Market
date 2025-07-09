<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
	protected $fillable=[
		

		'publishers_name',
		'publishers_address',
		'dev_name',
		'dev_address'

	
	];
}
