<?php

namespace Dealskoo\Search\Tests\Feature;

use Dealskoo\Admin\Facades\PermissionManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Search\Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permissions()
    {
        $this->assertNotNull(PermissionManager::getPermission('searches.index'));
        $this->assertNotNull(PermissionManager::getPermission('searches.show'));
        $this->assertNotNull(PermissionManager::getPermission('searches.create'));
        $this->assertNotNull(PermissionManager::getPermission('searches.edit'));
        $this->assertNotNull(PermissionManager::getPermission('searches.destroy'));
    }
}
