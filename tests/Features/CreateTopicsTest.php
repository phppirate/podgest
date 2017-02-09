<?php

use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use App\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTopicsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    public function cannot_create_topic_without_valid_api_token()
    {
        // Arrange
        $topic = [];
        // Act
        $this->json('post', '/api/v1/topic', $topic);

        // Assert
        $this->assertResponseStatus(401);
    }

    /** @test */
    public function admin_can_create_a_topic()
    {
        $topic = [
            'title'       => 'Is Foo a good thing?',
            'description' => 'A little about foo',
        ];

        $this->json('post', '/api/v1/topic?api_token='.$this->apiGateway->getValidTestAdminToken(), $topic);

        $this->assertResponseStatus(201)
            ->assertEquals('approved', Topic::first()->status);
    }

    /** @test */
    public function admin_cannot_create_topic_with_empty_title()
    {
        // Arrange
        $topic = [
            'title' => '',
        ];
        // Act
        $this->json('post', '/api/v1/topic?api_token='.$this->apiGateway->getValidTestAdminToken(), $topic);
        // Assert
        $this->assertResponseStatus(422);
    }

    /** @test */
    public function successful_topic_creation_returns_id()
    {
        $topic = [
            'title'       => 'Is Foo a good thing?',
            'description' => 'A little about foo',
        ];

        $this->json('post', '/api/v1/topic?api_token='.$this->apiGateway->getValidTestAdminToken(), $topic);

        $this->seeJsonSubset([
            'id'      => 1,
            'message' => 'Topic Successfully Created',
        ]);
    }
}
