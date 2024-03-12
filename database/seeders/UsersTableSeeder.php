<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use DB;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
            
            'admin_email' => 'nhuthanh221202@gmail.com',
            'admin_password' => md5('12345'),
            'admin_name' => 'Thanh Tran',
            'admin_phone' => '0219301923'
            
        ]);
        $author = Admin::create([
            
            'admin_email' => 'nhuthanh2212@gmail.com',
            'admin_password' => md5('12345'),
            'admin_name' => ' Tran Thanh ',
            'admin_phone' => '0219301923'
            
        ]);
        $user = Admin::create([
            
            'admin_email' => 'nhuthanh22@gmail.com',
            'admin_password' => md5('12345'),
            'admin_name' => ' Nhu Thanh',
            'admin_phone' => '0219301923'
            
        ]);
        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
     
    }
}
