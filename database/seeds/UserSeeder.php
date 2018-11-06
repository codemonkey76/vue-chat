<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'John Doe',
            'email' => 'john@example.org'
        ]);

        factory(User::class)->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.org'
        ]);
    }
}
