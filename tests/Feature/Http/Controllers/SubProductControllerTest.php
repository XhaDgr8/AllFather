<?php

namespace Tests\Feature\Http\Controllers;

use App\CreatedBy;
use App\SubProduct;
use App\UpdatedBy;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubProductController
 */
class SubProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $subProducts = factory(SubProduct::class, 3)->create();

        $response = $this->get(route('sub-product.index'));

        $response->assertOk();
        $response->assertViewIs('subProduct.index');
        $response->assertViewHas('subProducts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('sub-product.create'));

        $response->assertOk();
        $response->assertViewIs('subProduct.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubProductController::class,
            'store',
            \App\Http\Requests\SubProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $created_by = factory(CreatedBy::class)->create();
        $updated_by = factory(UpdatedBy::class)->create();

        $response = $this->post(route('sub-product.store'), [
            'user_id' => $user->id,
            'created_by' => $created_by->id,
            'updated_by' => $updated_by->id,
        ]);

        $subProducts = SubProduct::query()
            ->where('user_id', $user->id)
            ->where('created_by', $created_by->id)
            ->where('updated_by', $updated_by->id)
            ->get();
        $this->assertCount(1, $subProducts);
        $subProduct = $subProducts->first();

        $response->assertRedirect(route('subProduct.index'));
        $response->assertSessionHas('subProduct.id', $subProduct->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $subProduct = factory(SubProduct::class)->create();

        $response = $this->get(route('sub-product.show', $subProduct));

        $response->assertOk();
        $response->assertViewIs('subProduct.show');
        $response->assertViewHas('subProduct');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $subProduct = factory(SubProduct::class)->create();

        $response = $this->get(route('sub-product.edit', $subProduct));

        $response->assertOk();
        $response->assertViewIs('subProduct.edit');
        $response->assertViewHas('subProduct');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubProductController::class,
            'update',
            \App\Http\Requests\SubProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $subProduct = factory(SubProduct::class)->create();
        $user = factory(User::class)->create();
        $created_by = factory(CreatedBy::class)->create();
        $updated_by = factory(UpdatedBy::class)->create();

        $response = $this->put(route('sub-product.update', $subProduct), [
            'user_id' => $user->id,
            'created_by' => $created_by->id,
            'updated_by' => $updated_by->id,
        ]);

        $subProduct->refresh();

        $response->assertRedirect(route('subProduct.index'));
        $response->assertSessionHas('subProduct.id', $subProduct->id);

        $this->assertEquals($user->id, $subProduct->user_id);
        $this->assertEquals($created_by->id, $subProduct->created_by);
        $this->assertEquals($updated_by->id, $subProduct->updated_by);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $subProduct = factory(SubProduct::class)->create();

        $response = $this->delete(route('sub-product.destroy', $subProduct));

        $response->assertRedirect(route('subProduct.index'));

        $this->assertDeleted($subProduct);
    }
}
