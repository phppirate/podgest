<?php
use App\Topic;
use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateTopicStatisTest extends TestCase
{
	use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    function nonadmin_cannot_update_topic_status()
    {
        // arrange
        $topic = factory(Topic::class)->create(['status' => null]);
        // act
        $this->json('patch', '/api/v1/topic/' . $topic->id, [
        	'status' => 'accepted'
    	]);
        // assert
        $this->assertResponseStatus(401);
        $this->assertNotEquals('accepted', $topic->fresh()->status);
    }

    /** @test */
    function admin_can_update_topic_status()
    {
        // arrange
        $topic = factory(Topic::class)->create(['status' => null]);
        // act
        $this->json('patch', '/api/v1/topic/' . $topic->id . '?api_token=' . $this->apiGateway->getValidTestToken(), [
        	'status' => 'accepted'
    	]);
        // assert
        $this->assertResponseStatus(200);
        $this->assertEquals('accepted', $topic->fresh()->status);
    }

    /** @test */
    function admin_can_only_use_valid_topic_statuses()
    {
        // arrange
        $topic = factory(Topic::class)->create(['status' => null]);
        // act
        $this->json('patch', '/api/v1/topic/' . $topic->id . '?api_token=' . $this->apiGateway->getValidTestToken(), [
        	'status' => 'foobar'
    	]);
        // assert
        $this->assertResponseStatus(422);
        $this->assertNotEquals('foobar', $topic->fresh()->status);
        $this->seeJsonSubset([
        	'errors' => [
	        	'status' => [
	        		'status is invalid'
	        	]
        	]
        ]);
    }
}