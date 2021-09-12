<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $table = new Table();
        $table->name = "Mesa de los novios";
        $table->event_id = 1;
        $table->save();

        $table = new Table();
        $table->name = "Mesa 1";
        $table->event_id = 1;
        $table->save();
    }
}
