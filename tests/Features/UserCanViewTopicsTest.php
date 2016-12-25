<?php
use App\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanViewTopicsTest extends TestCase
{
	use DatabaseMigrations;
    /** @test */
    function user_can_view_topics()
    {
    	$this->disableExceptionHandling();
        // arrange
        $topic = factory(Topic::class)->create();
        // act
        $this->json('get', '/api/v1/topic');
        // assert
        $this->seeJson($topic->toArray());
    }
    /** @test */
    function user_can_view_single_topic()
    {
    	$this->disableExceptionHandling();
        // arrange
        $topic = factory(Topic::class)->create();
        // act
        $this->json('get', '/api/v1/topic/' . $topic->id);
        // assert
        $this->seeJson($topic->toArray());
    }
}