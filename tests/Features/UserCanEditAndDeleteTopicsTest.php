<?php
use App\Topic;
use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanEditAndDeleteTopicsTest extends TestCase
{
	use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    function user_can_edit_topics_they_have_suggested()
    {
        $topic = factory(Topic::class)->create([
        	'user_id' => 1,
        	'title' => 'Some Old Title',
        	'description' => 'Some Old Description'
    	]);

        $this->json('patch', '/api/v1/topic/' . $topic->id . '/update?api_token=' . $this->apiGateway->getValidTestUserToken(), [
        	'title' => 'Some New Title',
        	'description' => 'Some New Description'
    	]);

        $this->assertResponseStatus(200);
    	$this->assertEquals('Some New Title', $topic->fresh()->title);
    	$this->assertEquals('Some New Description', $topic->fresh()->description);
    }

    /** @test */
    function user_cannot_edit_topics_they_have_not_suggested()
    {
        $topic = factory(Topic::class)->create([
        	'user_id' => 2,
        	'title' => 'Some Old Title',
        	'description' => 'Some Old Description'
    	]);

        $this->json('patch', '/api/v1/topic/' . $topic->id . '/update?api_token=' . $this->apiGateway->getValidTestUserToken(), [
        	'title' => 'Some New Title',
        	'description' => 'Some New Description'
    	]);

        $this->assertResponseStatus(422);
    	$this->assertEquals('Some Old Title', $topic->fresh()->title);
    	$this->assertEquals('Some Old Description', $topic->fresh()->description);
    	$this->seeJson([
    		'message' => 'You cannot edit topics you did not create.'
		]);
    }
}