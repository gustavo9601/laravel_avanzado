<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;

class CreateMessageTest extends DuskTestCase
{

    // use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     */
    public function a_user_can_sed_messages()
    {
        // Creando usuario fake
        $user = factory(User::class)->create();

        // Autenticando al usuario
        $this->actingAs($user);

        $this->browse(function (Browser $browser) use ($user){

            $browser->visit('/laravel/laravel_avanzado/public/login/')   // Visitar la pagina
                ->assertSee('Address')
                  // ->type('text', 'Mensaje desde el navegador')  // ->type('name input', 'value default')
            ;
        });
    }
}
