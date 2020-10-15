<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Usuarios*/
        \App\User::create([
            'name' => 'test',
            'email' => 'test1@gmail.com',
            'password' => bcrypt('123'),
        ]);
        \App\User::create([
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => bcrypt('123'),
        ]);
        \App\User::create([
            'name' => 'test3',
            'email' => 'test3@gmail.com',
            'password' => bcrypt('123'),
        ]);

        /*Roles*/
        \App\Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Full permisos'
        ]);
        \App\Role::create([
            'name' => 'student',
            'display_name' => 'Estudiante',
            'description' => 'Maso menos'
        ]);
        \App\Role::create([
            'name' => 'moderator',
            'display_name' => 'Moderador',
            'description' => 'Maso menos full'
        ]);

        // Mensajes
     /*   \App\Message::create([
            'user_id' => 1,
            'name' => 'Gus mensage',
            'email' => 'ing.gus@sa.com',
            'phone' => '3222',
            'text' => 'Esto es una prueba',
        ]);*/

    }
}
