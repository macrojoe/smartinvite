<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->datetime('date');
            $table->text('comments')->nullable();
            $table->string('image')->nullable();

            $table->bigInteger('event_status_id')->unsigned()->nullable();
            $table->foreign('event_status_id')->references('id')->on('event_status')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
