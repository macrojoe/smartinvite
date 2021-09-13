<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Guest;
use App\Http\Controllers\Controller;


class GuestController extends \App\Http\Controllers\Controller
{
    //
    public function show(Event $event, Guest $guest, $code){
        if($guest->code == $code){
            return view('guest',compact('event','guest','code'));
        }
        else{
            abort(500);
        }
    }
}
