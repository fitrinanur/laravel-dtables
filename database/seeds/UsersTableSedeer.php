<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123'),
        ]);
    }
}
