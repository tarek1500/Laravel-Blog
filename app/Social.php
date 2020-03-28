<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	protected $fillable = ['driver', 'token', 'user_id'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}