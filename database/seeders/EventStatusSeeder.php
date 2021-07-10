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
        $status->name = 'Cancelado';
        $status->save();

        $status = new EventStatus;
        $status->name = 'Confirmado';
        $status->save();
    }
}
