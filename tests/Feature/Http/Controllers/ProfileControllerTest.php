<?php

namespace Tests\Feature\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProfileController
 */
class ProfileControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $profiles = factory(Profile::class, 3)->create();

        $response = $this->get(route('profile.index'));

        $response->assertOk();
        $response->assertViewIs('profile.index');
        $response->assertViewHas('profiles');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('profile.create'));

        $response->assertOk();
        $response->assertViewIs('profile.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProfileController::class,
            'store',
            \App\Http\Requests\ProfileStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('profile.store'), [
            'user_id' => $user->id,
        ]);

        $profiles = Profile::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $profiles);
        $profile = $profiles->first();

        $response->assertRedirect(route('profile.index'));
        $response->assertSessionHas('profile.id', $profile->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $profile = factory(Profile::class)->create();

        $response = $this->get(route('profile.show', $profile));

        $response->assertOk();
        $response->assertViewIs('profile.show');
        $response->assertViewHas('profile');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $profile = factory(Profile::class)->create();

        $response = $this->get(route('profile.edit', $profile));

        $response->assertOk();
        $response->assertViewIs('profile.edit');
        $response->assertViewHas('profile');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProfileController::class,
            'update',
            \App\Http\Requests\ProfileUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $profile = factory(Profile::class)->create();
        $user = factory(User::class)->create();

        $response = $this->put(route('profile.update', $profile), [
            'user_id' => $user->id,
        ]);

        $profile->refresh();

        $response->assertRedirect(route('profile.index'));
        $response->assertSessionHas('profile.id', $profile->id);

        $this->assertEquals($user->id, $profile->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $profile = factory(Profile::class)->create();

        $response = $this->delete(route('profile.destroy', $profile));

        $response->assertRedirect(route('profile.index'));

        $this->assertDeleted($profile);
    }
}
