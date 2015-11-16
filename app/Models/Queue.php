<?php namespace App\Models;

use App\Models\Traits\ConcurrentUpdates;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property Collection jobs
 */
class Queue extends Model
{

    use ConcurrentUpdates;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'queues';

    /**
     *  Don't use timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'delay'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'user',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function setUserAttribute($value)
    {
        $this->attributes['user_id'] = $value->id;
    }

    public function setDelayAttribute($value)
    {
        if ($value == "")
            $value = 0;
        $this->attributes['delay'] = $value;
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function bots()
    {
        return $this->belongsToMany(Bot::class)->withTimestamps();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

}
