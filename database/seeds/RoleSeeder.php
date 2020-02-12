<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_root = \App\Role::create([
            'name'      => 'root',
            'description'  => 'طراح سیستم',
            'state'     => '1',
        ]);

        $role_staff = \App\Role::create([
            'name'      => 'کارمند',
            'description'  => 'کارمند نظارت و دسترسی به سیستم',
            'state'     => '1',
        ]);

        $role_student = \App\Role::create([
            'name'      => 'دانشجو',
            'description'  => 'نقش دانشجویان در سیستم',
            'state'     => '1',
        ]);


        /*
        Fill role_permission table
         */
        $perm = \App\Permission::select('id')
                                ->get();

        $role_root->permissions()->attach($perm);
        $role_staff->permissions()->attach($perm);

        $role_student->permissions()->attach([
                    2, 40, 41, 42, 47, 48,
                    50, 51, 52, 54, 55
                ]);
    }
}
