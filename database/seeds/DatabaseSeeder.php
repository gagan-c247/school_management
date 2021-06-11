<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use App\Student;
use App\Teacher;
use App\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /*******************************************/
        /***************Create Admin***************/
        /*****************************************/
        DB::table('users')->delete();
        $adminUser = new User();
        $adminUser->name = 'Admin';
        $adminUser->email = 'iAmAdmin@chapter247.com';
        $adminUser->password = Hash::make('123456789');
        $adminUser->mobile = '9981225697';
        $adminUser->dob = '1998-10-12';
        $adminUser->address = 'Shikhar Central';
        $adminUser->city = 'Indore';
        $adminUser->pincode = '452016';
        $adminUser->status = 1;
        $adminUser->save();

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        /*******************************************/
        /******Create Permission & Roles***********/
        /*************and ASSIGN ROLES************/
        Permission::create(['name' => 'student-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'student-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'student-section', 'guard_name' => 'web']);
        Permission::create(['name' => 'student-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'student-destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'student-view', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-all', 'guard_name' => 'web']);
        Permission::create(['name' => 'teacher-section', 'guard_name' => 'web']);
        Permission::create(['name' => 'teacher-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'teacher-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'teacher-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'teacher-destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'course-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'course-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'course-section', 'guard_name' => 'web']);
        Permission::create(['name' => 'course-destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'course-list', 'guard_name' => 'web']);
        
        
        //create roles and assign existing permissions
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        // //assign role
        $adminUser->assignRole('admin');

        /********************************************/
        /***************Course Entry****************/
        /******************************************/
        // Course Entry
        DB::table('courses')->delete();
        $courses = ['12th','11th','10th','9th','8th','7th',
                    '6th','5th','4th','3rd','2nd','1st',
                    'KG 2nd','KG 1st'];
        $descriptions = ['high secoundry','high secoundry',
                        'high school','high school',
                        'middle school','middle school','middle school',
                        'primary school','primary school','primary school',
                        'primary school','primary school','primary school','primary school'];
        for($i=0;$i<=13;$i++){
            $type = 'class';
            $name = $courses[$i];
            $description = $descriptions[$i];
            Course::create(['name'=>$name,
                            'type'=>$type, 
                            'description'=>$description]);
        }
       
        /******************************************/
        /***************Teacher Entry**************/
        /******************************************/
        //Student Entry
        DB::table('students')->delete();
        $student = new Student();
        $student->class_id = '1';
        $student->name = 'Student';
        $student->email = 'student@chapter247.com';
        $student->username = '2112th0001';
        $student->password= Hash::make('123456789');
        $student->dob = '1998-10-12';
        $student->city = 'Indore';
        $student->country = 'india';
        $student->pincode = '452016';
        $student->mobile = '9981225697';
        $student->gender = 'boy';
        $student->status = '1';
        $student->about = 'First Testing Entry of Student';        
        $student->save();

        /******************************************/
        /***************Student Entry**************/
        /******************************************/
        DB::table('teachers')->delete();
        $teacher = new Teacher();
        $teacher->name = 'teacher';
        $teacher->email = 'teacher@chapter247.com';
        $teacher->username = '21principal0001';
        $teacher->designation = 'principal';
        $teacher->password = Hash::make('123456789');
        $teacher->dob = '1998-10-12';
        $teacher->address = 'Shikhar Central';
        $teacher->city = 'indore';
        $teacher->country = 'india';
        $teacher->pincode = '452016';
        $teacher->mobile = '9981225697';
        $teacher->gender = 'female';
        $teacher->status = '1';
        $teacher->save();
    }
}
