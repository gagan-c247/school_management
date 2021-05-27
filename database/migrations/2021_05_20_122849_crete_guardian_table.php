<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreteGuardianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('relationship');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('pincode');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardians');
    }
}
