<?php

use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use App\Episode;
use App\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
    public function admin_can_assign_topics_to_episodes()
    {
        // arrange
        $episode = factory(Episode::class)->create();
        $topic = factory(Topic::class)->create();
        // act
        $this->json('patch', '/api/v1/topic/'.$topic->id.'?api_token='.$this->apiGateway->getValidTestAdminToken(), ['episode_id' => $episode->id]);
        // assert
        $this->assertResponseStatus(200);
        $this->assertEquals(true, $episode->topics()->first()->id == $topic->id);
    }
}
