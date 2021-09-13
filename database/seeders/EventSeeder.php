<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $event = new Event;
        $event->name = 'Prueba Inicial';
        $event->url = "https://undiaespecial.digital/luly-pablo/luly-pablo-opcion-dos/";
        $event->date = "2021-11-21 11:00:00";
        $event->comments = "Lorem ipsum";
        $event->event_status_id = 1;
        $event->user_id = 1;
        $event->save();

        $event = new Event;
        $event->name = 'Evento 2';
        $event->url = "https://undiaespecial.digital/luly-pablo/luly-pablo-opcion-dos/";
        $event->date = "2021-10-21 11:00:00";
        $event->comments = "Lorem ipsum";
        $event->event_status_id = 1;
        $event->user_id = 1;
        $event->save();
    }
}
