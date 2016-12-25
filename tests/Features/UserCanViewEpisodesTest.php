<?php
use App\Episode;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanViewEpisodesTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    function user_can_view_episodes()
    {
        // arrange
        $episode = factory(Episode::class)->create();
        // act
        $this->json('get', '/api/v1/episode');
        // assert
        $this->seeJson($episode->toArray());
    }

    /** @test */
    function user_can_view_single_episode()
    {
        // arrange
        $episode = factory(Episode::class)->create();
        // act
        $this->json('get', '/api/v1/episode/' . $episode->id);
        // assert
        $this->seeJson($episode->toArray());
    }
}