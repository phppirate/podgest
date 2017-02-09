<?php

use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use App\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserCanViewTopicsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    public function user_can_view_topics()
    {
        $this->disableExceptionHandling();
        // arrange
        $topic = factory(Topic::class)->create();
        // act
        $this->json('get', '/api/v1/topic?api_token='.$this->apiGateway->getValidTestUserToken());
        // assert
        $this->seeJson($topic->toArray());
    }

    /** @test */
    public function user_can_view_single_topic()
    {
        $this->disableExceptionHandling();
        // arrange
        $topic = factory(Topic::class)->create();
        // act
        $this->json('get', '/api/v1/topic/'.$topic->id.'?api_token='.$this->apiGateway->getValidTestUserToken());
        // assert
        $this->seeJson($topic->toArray());
    }
}
