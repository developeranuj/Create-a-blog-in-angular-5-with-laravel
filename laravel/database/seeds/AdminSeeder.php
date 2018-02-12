<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newusers = new User();

            $password= 'admin';

            $hashedpassword = Hash::make($password);

            $newusers->fill([
                'name' => 'admin',
                'email'=> 'admin@gmail.com',
                'password'=> $hashedpassword  
            ]);
           
            $newusers->save();

    }
}