<?php

namespace Dealskoo\Search\Tests\Feature\Admin;

use Dealskoo\Admin\Models\Admin;
use Dealskoo\Search\Models\Search;
use Dealskoo\Search\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.searches.index'));
        $response->assertStatus(200);
    }

    public function test_table()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.searches.index'), ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJsonPath('recordsTotal', 0);
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $admin = Admin::factory()->isOwner()->create();
        $search = Search::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.searches.show', $search));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.searches.create'));
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $admin = Admin::factory()->isOwner()->create();
        $search = Search::factory()->make();
        $response = $this->actingAs($admin, 'admin')->post(route('admin.searches.store'), $search->only([
            'name',
            'country_id',
        ]));
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $admin = Admin::factory()->isOwner()->create();
        $search = Search::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.searches.edit', $search));
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $admin = Admin::factory()->isOwner()->create();
        $search = Search::factory()->create();
        $search1 = Search::factory()->make();
        $response = $this->actingAs($admin, 'admin')->put(route('admin.searches.update', $search), $search1->only([
            'name',
            'country_id',
        ]));
        $response->assertStatus(302);
    }

    public function test_destroy()
    {
        $admin = Admin::factory()->isOwner()->create();
        $search = Search::factory()->create();
        $response = $this->actingAs($admin, 'admin')->delete(route('admin.searches.destroy', $search));
        $response->assertStatus(200);
    }
}
