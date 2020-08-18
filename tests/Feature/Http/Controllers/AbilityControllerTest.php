<?php

namespace Tests\Feature\Http\Controllers;

use App\Ability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AbilityController
 */
class AbilityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $abilities = factory(Ability::class, 3)->create();

        $response = $this->get(route('ability.index'));

        $response->assertOk();
        $response->assertViewIs('ability.index');
        $response->assertViewHas('abilities');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('ability.create'));

        $response->assertOk();
        $response->assertViewIs('ability.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AbilityController::class,
            'store',
            \App\Http\Requests\AbilityStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('ability.store'), [
            'name' => $name,
        ]);

        $abilities = Ability::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $abilities);
        $ability = $abilities->first();

        $response->assertRedirect(route('ability.index'));
        $response->assertSessionHas('ability.id', $ability->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $ability = factory(Ability::class)->create();

        $response = $this->get(route('ability.show', $ability));

        $response->assertOk();
        $response->assertViewIs('ability.show');
        $response->assertViewHas('ability');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $ability = factory(Ability::class)->create();

        $response = $this->get(route('ability.edit', $ability));

        $response->assertOk();
        $response->assertViewIs('ability.edit');
        $response->assertViewHas('ability');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AbilityController::class,
            'update',
            \App\Http\Requests\AbilityUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ability = factory(Ability::class)->create();
        $name = $this->faker->name;

        $response = $this->put(route('ability.update', $ability), [
            'name' => $name,
        ]);

        $ability->refresh();

        $response->assertRedirect(route('ability.index'));
        $response->assertSessionHas('ability.id', $ability->id);

        $this->assertEquals($name, $ability->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $ability = factory(Ability::class)->create();

        $response = $this->delete(route('ability.destroy', $ability));

        $response->assertRedirect(route('ability.index'));

        $this->assertDeleted($ability);
    }
}
