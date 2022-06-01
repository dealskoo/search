<?php

namespace Dealskoo\Search\Tests\Feature;

use Dealskoo\Admin\Facades\AdminMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Search\Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu()
    {
        $childs = AdminMenu::findBy('title', 'admin::admin.settings')->getChilds();
        $menu = collect($childs)->where('title', 'search::search.searches');
        $this->assertNotNull($menu);
    }
}
