<?php
use App\User;
use App\Episode;
use Carbon\Carbon;
use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
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
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    function user_can_view_aired_episodes()
    {
        // arrange
        $episode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('-1 week')
    	]);
        // act
        $this->json('get', '/api/v1/episode?api_token=' . $this->apiGateway->getValidTestUserToken());
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
        $this->json('get', '/api/v1/episode/' . $episode->id . '?api_token=' . $this->apiGateway->getValidTestUserToken());
        // assert
        $this->seeJson($episode->toArray());
    }

    /** @test */
    function user_connot_see_unaired_episodes()
    {
        // arrange
        $episode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('+1 week')
    	]);
        // act
        $this->json('get', '/api/v1/episode?api_token=' . $this->apiGateway->getValidTestUserToken());
        // assert
        $this->assertResponseStatus(200);
        $this->seeJson(['episodes' => []]);
    }
}