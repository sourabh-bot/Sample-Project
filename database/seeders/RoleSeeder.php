<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            [
                'name'=>'Student',
                'description'=> 'Student'
            ],
            [
                'name'=>'Teacher',
                'description'=> 'Teacher'
            ]
        ];

        $role = new Role;
        $role->truncate();
        
        foreach($roles as $item):
            $role->create($item);
        endforeach;

    }
}
