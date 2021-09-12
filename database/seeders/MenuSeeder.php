<?php

namespace Database\Seeders;
use App\Models\Menu;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menu = new Menu();
        $menu->name = "Vegano";
        $menu->event_id = 1;
        $menu->save();

        $menu = new Menu();
        $menu->name = "Gourmet";
        $menu->event_id = 1;
        $menu->save();
    }
}
