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
        factory(User::class)->create([
           'email' => 'user@shu.ac.uk',
           'password' => bcrypt('20E!xI&$Zx'),
        ]);

        factory(User::class)->create([
            'email' => 'user2@shu.ac.uk',
            'password' => bcrypt('20E!xI&$Zx'),
        ]);
    }
}
