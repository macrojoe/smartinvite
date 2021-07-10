<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Artisan;


class TestingController extends Controller
{
    //
    public function storageLink() {

        Artisan::call('storage:link');
        
        return 'Ya fue creado el directorio';
    }

    public function migrate() {

        Artisan::call('migrate');
        
        return 'Ya se crearon las migraciones';
    }

	public function optimize() {
		Artisan::call('config:cache');
        return "Config cache OK";
	}
}
