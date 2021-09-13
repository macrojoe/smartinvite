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

    public function store(Event $event, Guest $guest, $code){
        if($guest->code == $code){
            //Save data
            $guest->fill(request()->guest);
            $guest->confirmed_at = now();
            $guest->save();

            if($guest->guest_status_id == 1){
                $guest->menu()->detach();
                foreach(request()->menu as $index => $menuOption){
                    if($index + 1 <= request()->guest['confirmed_tickets']){
                        $guest->menu()->attach([$menuOption => ['guest_number' => $index + 1]]);
                    }
                }
            }
            else{
                $guest->menu()->detach();
            }
            return view('thanks',compact('event','guest'));
        }
        else{
            abort(500);
        }
    }
}
