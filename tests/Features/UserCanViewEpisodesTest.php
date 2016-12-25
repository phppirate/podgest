<?php
use App\User;
use App\Episode;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanViewEpisodesTest extends TestCase
{
	use DatabaseMigrations;
    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    function user_can_view_aired_episodes()
    {
        // arrange
        $episode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('-1 week')
    	]);
        // act
        $this->json('get', '/api/v1/episode?api_token=' . $this->user->api_token);
        // assert
        $this->seeJson($episode->toArray());
    }

    /** @test */
    function user_can_view_single_aired_episode()
    {
        // arrange
        $episode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('-1 week')
    	]);
        // act
        $this->json('get', '/api/v1/episode/' . $episode->id . '?api_token=' . $this->user->api_token);
        // assert
        $this->seeJson($episode->toArray());
    }

    /** @test */
    function user_connot_see_unaired_episodes()
    {
        $this->disableExceptionHandling();
        // arrange
        $episode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('+1 week')
    	]);
        // act
        $this->json('get', '/api/v1/episode?api_token=' . $this->user->api_token);
        // assert
        $this->assertResponseStatus(200);
        $this->seeJson(['episodes' => []]);
    }
}