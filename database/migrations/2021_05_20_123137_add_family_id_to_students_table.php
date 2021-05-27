<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFamilyIdToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('family_id')->after('file_id')->nullable();
            $table->unsignedBigInteger('guardian_id')->after('family_id')->nullable();
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['family_id']);
            $table->dropColumn('family_id');
            $table->dropForeign(['guardian_id']);
            $table->dropColumn('guardian_id');
        });
    }
}
