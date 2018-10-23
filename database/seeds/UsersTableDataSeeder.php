<?php

use Illuminate\Database\Seeder;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 3; $i++) { 
	    	DB::table('users')->insert([
	            'name' => str_random(8),
	            'email' => 'admin'.$i.'@mail.com',
	            'role_id' => 1,
	            'password' => bcrypt('123456')
	        ]);
    	}
		
		 for ($i=1; $i < 6; $i++) { 
	    	DB::table('users')->insert([
	            'name' => str_random(8),
	            'email' => 'usuario'.$i.'@mail.com',
	            'role_id' => 2,
	            'password' => bcrypt('123456')
	        ]);
    	}
    }
}
