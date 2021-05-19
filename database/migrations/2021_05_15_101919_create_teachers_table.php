<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('slug')->nullable();
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('mobile')->nullable();
            $table->string('altmobile')->nullable();   
            $table->enum('status',['1','0'])->default('1')->comment('1->active,0->unactive');
            $table->enum('gender',['male','female']);
            $table->string('about')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
