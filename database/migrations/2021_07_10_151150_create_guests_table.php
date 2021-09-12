<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('code')->nullable();
            $table->string('slug')->nullable();

            $table->text('comments')->nullable();
            $table->text('message')->nullable();

            $table->integer('tickets')->nullable();
            $table->integer('confirmed_tickets')->nullable();
            $table->datetime('confirmed_at')->nullable();
            

            $table->bigInteger('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            
            $table->bigInteger('guest_status_id')->unsigned()->nullable();
            $table->foreign('guest_status_id')->references('id')->on('guest_status')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('guests');
    }
}
