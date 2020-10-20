<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        $users = User::all();

        foreach ($users as $user) {
            // 10 Messajes para cada usuario
            for ($i = 0; $i < 50; $i++) {
                $user->messages()->create(
                    ['text' => 'mensaje de pruebas - ' . $i,
                        'created_at' => \Carbon\Carbon::now()->subDays(100)->addDay(($i + 1))]
                );
            }
        }

    }
}
