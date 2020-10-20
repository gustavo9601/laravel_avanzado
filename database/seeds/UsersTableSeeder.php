<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'test',
            'email' => 'test1@gmail.com',
            'password' => bcrypt('123'),
        ]);
        $user2 = User::create([
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => bcrypt('123'),
        ]);
       $user3 = User::create([
            'name' => 'test3',
            'email' => 'test3@gmail.com',
            'password' => bcrypt('123'),
        ]);

        $role1 = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Full permisos'
        ]);
        $role2 = Role::create([
            'name' => 'student',
            'display_name' => 'Estudiante',
            'description' => 'Maso menos'
        ]);
        $role3 = Role::create([
            'name' => 'moderator',
            'display_name' => 'Moderador',
            'description' => 'Maso menos full'
        ]);

       // Realiza la asociacion a travez de la realcion roles de user se le pasa el role
       $user1->roles()->save($role1);
       $user2->roles()->save($role2);
       $user3->roles()->save($role3);
    }
}
