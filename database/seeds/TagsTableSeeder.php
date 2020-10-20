<?php

use Illuminate\Database\Seeder;

use App\User;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all();

        foreach ($users as $user){

            for ($i = 0; $i < 3; $i++){
                $user->tags()->create(['name' => 'Etiqueta ' . $i]);
            }

        }

    }
}
