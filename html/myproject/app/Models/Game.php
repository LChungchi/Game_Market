<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
	protected $fillable=[
		
		'genre',
		'rated',
		'gname',
		'platform_id',
		'publisher_id',
		'price',
		'information',
		'release',
		'new',
		'sale',
		'hit',
		'discount',
		'pic1',
		'pic2'
	
	];
}
