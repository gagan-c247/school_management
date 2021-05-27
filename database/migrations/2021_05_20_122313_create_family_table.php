<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('father_name');
            $table->string('f_mobile');
            $table->string('f_email')->nullable();
            $table->string('mother_name');
            $table->string('m_mobile');
            $table->string('m_email')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('pincode');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('families');
    }
}
