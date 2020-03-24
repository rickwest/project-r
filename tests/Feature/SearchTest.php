<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testUserCanSearchUsers()
    {
//        config(['scout.driver' => 'algolia']);
//
//        $term = 'foobar';
//
//        //Make some of the models that we want to search
//
//        do {
//            $results = $this->getJson("users/search?q={$term}")->json(['data']);
//        } while (empty($results));
//
//        $this->assertCount(1, $results);
//        // Clean up algolia index
//
//        User::latest()->take(4)->unsearchable();
    }
}
