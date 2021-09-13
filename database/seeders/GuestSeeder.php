<?php

namespace Database\Seeders;
use App\Models\Guest;

use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $guest = new Guest;
        $guest->name = "Luis Martinez";
        $guest->phone = "+523335550017";
        $guest->email = "jose.marron@live.com";
        $guest->message = "Gracias por la invitación";
        $guest->comments = "Uso silla de ruedas";
        $guest->menu_id = 2;
        $guest->tickets = 2;
        $guest->confirmed_tickets = 2;
        $guest->confirmed_at = now();
        $guest->event_id = 1;
        $guest->table_id = 2;
        $guest->guest_status_id = 1;
        $guest->save();

        $guest = new Guest;
        $guest->name = "Adrian Quiroz";
        $guest->phone = "+523335550010";
        $guest->email = "jose.marron3@gmail.com";
        $guest->message = "Gracias por la invitación, pero no podré asistir";
        $guest->comments = "";
        $guest->tickets = 2;
        $guest->confirmed_tickets = 0;
        $guest->confirmed_at = now();
        $guest->event_id = 1;
        $guest->table_id = 1;
        $guest->guest_status_id = 0;
        $guest->save();

        $guest = new Guest;
        $guest->name = "Guadalupe Martinez";
        $guest->phone = "+523335550020";
        $guest->email = "joe@braigo.mx";
        $guest->message = "";
        $guest->comments = "";
        $guest->tickets = 2;
        $guest->confirmed_tickets = 0;
        $guest->event_id = 1;
        $guest->table_id = 1;
        $guest->guest_status_id = 2;
        $guest->save();

        $guest = new Guest;
        $guest->name = "Guadalupe Martinez";
        $guest->phone = "+523335550020";
        $guest->email = "guadalupe@hotmail";
        $guest->message = "";
        $guest->comments = "";
        $guest->tickets = 2;
        $guest->confirmed_tickets = 0;
        $guest->event_id = 2;
        $guest->table_id = 3;
        $guest->guest_status_id = 2;
        $guest->save();

    }
}
