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
            $table->string('event_id', 10)->nullable();
            $table->string('name');
            $table->text('description');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->foreignId('church_id')->nullable()->constrained('churches')->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('is_regular_event');
            $table->string('day', 40)->nullable();
            $table->timestamps();
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
