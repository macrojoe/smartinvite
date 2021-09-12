<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuestStatus;

class GuestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $status = new GuestStatus;
        $status->id = 0;
        $status->name = 'Cancelado';
        $status->save();

        $status->id = 0;
        $status->save();

        $status = new GuestStatus;
        $status->id = 1;
        $status->name = 'Confirmado';
        $status->save();

        $status = new GuestStatus;
        $status->id = 2;
        $status->name = 'Pendiente';
        $status->save();
    }
}
