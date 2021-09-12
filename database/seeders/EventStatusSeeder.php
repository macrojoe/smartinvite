<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventStatus;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $status = new EventStatus;
        $status->id = 0;
        $status->name = 'Cancelado';
        $status->save();

        $status->id = 0;
        $status->save();

        $status = new EventStatus;
        $status->id = 1;
        $status->name = 'Confirmado';
        $status->save();
    }
}
