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
        $status->name = 'Cancelado';
        $status->save();

        $status = new GuestStatus;
        $status->name = 'Confirmado';
        $status->save();

        $status = new GuestStatus;
        $status->name = 'Quizás';
        $status->save();
    }
}
