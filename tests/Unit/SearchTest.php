<?php

namespace Dealskoo\Search\Tests\Unit;

use Dealskoo\Search\Models\Search;
use Dealskoo\Search\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_country()
    {
        $search = Search::factory()->create();
        $this->assertNotNull($search->country);
    }
}
