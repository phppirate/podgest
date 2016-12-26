<?php
use App\Episode;
use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateEpisodesTest extends TestCase
{
	use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    function can_create_episodes()
    {
        // arrange
        $date = (string) Carbon\Carbon::parse('-1 week');
        $episode = [
        	'number' => 1,
        	'title' => 'Foo, bar and Baz',
        	'description' => 'What do these variable names really mean?',
        	'air_date' => $date
        ];
        // act
        $this->json('post', '/api/v1/episode?api_token=' . $this->apiGateway->getValidTestAdminToken(), $episode);
        // assert
        $this->assertResponseStatus(201);
        $this->assertEquals(1, Episode::first()->number);
        $this->assertEquals('Foo, bar and Baz', Episode::first()->title);
        $this->assertEquals('What do these variable names really mean?', Episode::first()->description);
        $this->assertEquals($date, Episode::first()->air_date);
        $this->seeJsonSubset([
        		'id' => 1,
        		'message' => "Episode Successfully Created"
    		]);
    }

    /** @test */
    function episode_cannot_be_created_without_a_title()
    {
        // arrange
        $date = (string) Carbon\Carbon::parse('-1 week');
        $episode = [
            'title' => '',
        ];
        // act
        $this->json('post', '/api/v1/episode?api_token=' . $this->apiGateway->getValidTestAdminToken(), $episode);
        // assert
        $this->assertResponseStatus(422)
            ->seeJsonSubset([
                'title' => ['The title field is required.']
            ]);
    }   
}