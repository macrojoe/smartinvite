<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use Sluggable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'events';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function guestButton($crud = false){
        return '<a class="btn btn-xs btn-success" href="'.backpack_url('guest').'?event_id='.$this->id.'" data-toggle="tooltip" title=""><i class="las la-user-tie"></i> Invitados</a>';
    }

    public function menuButton($crud = false){
        return '<a class="btn btn-xs btn-success" href="'.backpack_url('menu').'?event_id='.$this->id.'" data-toggle="tooltip" title=""><i class="lab la-elementor"></i> Menu</a>';
    }

    public function tableButton($crud = false){
        return '<a class="btn btn-xs btn-success" href="'.backpack_url('table').'?event_id='.$this->id.'" data-toggle="tooltip" title=""><i class="las la-table"></i> Mesas</a>';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function countGuest(){
        return count($this->guests);
    }

    public function countConfirmedGuest(){
        return count($this->guests->where('guest_status_id','2'));
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function status(){
        return $this->belongsTo('App\Models\EventStatus','event_status_id');
    }

    public function guests(){
        return $this->hasMany('App\Models\Guest');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
