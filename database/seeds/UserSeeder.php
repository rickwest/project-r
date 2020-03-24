<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
           'name' => 'rick',
           'email' => 'rickwestdev@gmail.com',
           'password' => bcrypt('rick1234'),
        ]);

        $user = factory(User::class)->create([
            'name' => 'mick',
            'email' => 'm.marriott@shu.ac.uk',
            'password' => bcrypt('mick1234'),
        ]);
    }
}
