<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Message;

class NotesTableSeeder extends Seeder
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


                $user->note()->create(['body' => 'Nota User  ' . $user->name]);


        }


        $messages = Message::all();
        foreach ($messages as $message){
            $message->note()->create(['body' => 'Nota Message  ' . $message->text]);

        }

    }
}
