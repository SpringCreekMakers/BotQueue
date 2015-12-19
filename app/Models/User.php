<?php namespace App\Models;

use App\Models\Traits\ConcurrentUpdates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

/**
 * App\Models\User
 *
 * @property int id
 * @property string username
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $dashboard_style
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $remember_token
 * @property integer $last_notification
 * @property string $thingiverse_token
 * @property boolean $is_admin
 * @property integer $version
 * @property-read mixed $registered
 * @property-read mixed $last_seen
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Queue[] $queues
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bot[] $bots
 */
class User extends Model implements AuthorizableContract,
    AuthenticatableContract, CanResetPasswordContract {

	use Authorizable, Authenticatable, CanResetPassword, ConcurrentUpdates;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username',
		'password',
		'email',
		'dashboard_style',
		'thingiverse_token'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'thingiverse_token',
        'remember_token',
		'dashboard_style',
		'last_notification',
		'email',
		'created_at',
		'updated_at',
		'activities', #todo Convert this into the url
		'queues', #todo Convert this into the url
	];

	protected $casts = [
		'is_admin' => 'boolean'
	];

	/**
	 * The attributes to add to the model's JSON form.
	 *
	 * @var array
	 */
	protected $appends = [
		'registered',
		'last_seen'
	];

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function getRegisteredAttribute()
	{
		return $this->created_at;
	}

	public function getLastSeenAttribute()
	{
		return $this->updated_at;
	}

	public function activities()
	{
		return $this->hasMany('App\Models\Activity');
	}

	public function queues()
	{
		return $this->hasMany('App\Models\Queue');
	}

	public function bots()
	{
		return $this->hasMany('App\Models\Bot');
	}
}
