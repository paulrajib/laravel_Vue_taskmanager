<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'role_id' 	=> '1',
        	'name' 		=> 'Super Admin',
        	'username' 	=> 'admin',
        	'email'		=> 'admin@blog.com',
        	'password'	=> bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
        	'role_id' 	=> '2',
        	'name' 		=> 'Super Author',
        	'username' 	=> 'author',
        	'email'		=> 'author@blog.com',
        	'password'	=> bcrypt('rootauthor'),
        ]);
    }
}
