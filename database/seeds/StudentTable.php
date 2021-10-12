<?php

use Illuminate\Database\Seeder;

class StudentTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Student', 100)->make()->each(function($student) {
            $student->save();
        });
    }
}
