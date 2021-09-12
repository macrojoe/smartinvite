<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Guest;

class GuestController extends Controller
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
