<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Guest extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use Sluggable;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'guests';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
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
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::created(function ($guest){
            //
            $guest->code = \Str::random(6);
            $guest->save();
        });
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function status(){
        return $this->belongsTo('App\Models\GuestStatus','guest_status_id');
    }

    public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }

    public function table(){
        return $this->belongsTo('App\Models\Table');
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
    public function getUrlAttribute(){
        return  url("/i/".$this->event->slug.'/'.$this->slug.'/'.$this->code);
    }

    public function urlButton(){
        return '<a class="btn btn-xs btn-success" href="'.$this->url.'" data-toggle="tooltip" title=""><i class="las la-internet"></i> Ir a URL</a>';
    }
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
