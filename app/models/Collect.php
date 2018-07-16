<?php
/**
* Report Model
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model{
	public $timestamps =false;
	protected $table = 'collect';
	protected $fillable = [
    	'web','query','basic'
    ];
}