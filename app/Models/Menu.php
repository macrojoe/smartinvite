<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'menus';
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
        return '<a class="btn btn-xs btn-success" href="'.backpack_url('guest').'?menu_id='.$this->id.'" data-toggle="tooltip" title=""><i class="las la-user-tie"></i> Invitados</a>';
    }
    public function countGuest(){
        return $this->guest->sum('tickets');
    }
    public function countConfirmedGuest(){
        return $this->guest->where('guest_status_id','1')->sum('confirmed_tickets');
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function guest(){
        return $this->hasMany('App\Models\Guest');
    }

    public function event(){
        return $this->belongsTo('App\Models\Event');
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
