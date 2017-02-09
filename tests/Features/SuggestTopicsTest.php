<?php

use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use App\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SuggestTopicsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    public function can_suggest_a_topic()
    {
        $this->disableExceptionHandling();
        $topic = [
            'title'       => 'Is Foo a good thing?',
            'description' => 'A little about foo',
        ];

        $this->post('/api/v1/topic/suggest?api_token='.$this->apiGateway->getValidTestUserToken(), $topic);

        $this->assertResponseStatus(201);
        $this->assertNotNull(Topic::first());
        $this->assertEquals('Is Foo a good thing?', Topic::first()->title);
        $this->assertEquals('A little about foo', Topic::first()->description);
    }

    /** @test */
    public function successful_topic_creation_returns_id()
    {
        $topic = [
            'title'       => 'Is Foo a good thing?',
            'description' => 'A little about foo',
        ];

        $this->post('/api/v1/topic/suggest?api_token='.$this->apiGateway->getValidTestUserToken(), $topic);

        $this->seeJsonSubset([
            'id'      => 1,
            'message' => 'Topic Successfully Suggested',
        ]);
    }

    /** @test */
    public function cannot_suggest_if_title_is_empty()
    {
        $topic = [
            'title'       => '',
            'description' => '',
        ];

        $this->json('post', '/api/v1/topic/suggest?api_token='.$this->apiGateway->getValidTestUserToken(), $topic);

        $this->assertResponseStatus(422);
    }
}
