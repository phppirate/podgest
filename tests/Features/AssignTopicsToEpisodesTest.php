<?php
use App\Topic;
use App\Episode;
use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssignTopicsToEpisodesTest extends TestCase
{
	use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }
    
    /** @test */
    function admin_can_assign_topics_to_episodes()
    {
        // arrange
        $episode = factory(Episode::class)->create();
        $topic = factory(Topic::class)->create();
        // act
        $this->json('patch', '/api/v1/topic/' . $topic->id . "?api_token=" . $this->apiGateway->getValidTestToken(), ['episode_id' => $episode->id]);
        // assert
        $this->assertResponseStatus(200);
        $this->assertEquals(true, $episode->topics()->first()->id == $topic->id);
    }
}