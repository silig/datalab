<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 150)->create();
        User::create([
            'username' => 'Superadmin',
            'email' => 'estes@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '123456789',
            'user_access' => 'admin',
            'role_id' => 1,
            'active' => 'yes'
        ]);
    }
}
