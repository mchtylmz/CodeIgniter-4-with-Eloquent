<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
	use SoftDeletes;
  protected $dates = ['deleted_at'];

	protected $fillable = [
		'first_name', 'last_name', 'phone', 'email', 'role', 'image', 'app_key', 'password', 'reset_token', 'last_seen', 'deleted_at'
	];

	public function scopePopular($query)
    {
        return $query->where('deleted_at', '!=', NULL);
    }

		public function phone()
    {
        return $this->hasOne('App\Models\Phones');
    }

		public function visit()
    {
        return $this->belongsTo('App\Models\Phones');
    }

		public function offer()
    {
        return $this->belongsTo('App\Models\Phones');
    }
}
