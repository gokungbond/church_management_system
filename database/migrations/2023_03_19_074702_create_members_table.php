<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_id', 45)->nullable();
            $table->string('last_name', 45);
            $table->string('first_name', 45);
            $table->string('middle_name', 45)->nullable();
            $table->string('full_name', 100);
            $table->date('dob');
            $table->string('address', 150);
            $table->foreignId('family_id')->nullable()->constrained('families')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('church_id')->contrained('churches')->onUpdate('cascade')->onDelete('restrict');
            $table->string('member_category')->nullable();
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
        Schema::dropIfExists('members');
    }
}
