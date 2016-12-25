<?php
use App\Episode;
use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCanEditAndDeleteEpisodesTest extends TestCase
{
	use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    function admin_can_edit_episodes()
    {
        $episode = factory(Episode::class)->create([
        	'number' => 1,
        	'title' => 'Some Old Title',
        	'description' => 'Some Old Description',
    	]);

    	$this->json('patch', '/api/v1/episode/' . $episode->id . '?api_token=' . $this->apiGateway->getValidTestAdminToken(), [
    		'number' => 2,
    		'title' => 'Some New Title',
    		'description' => 'Some New Description'
		]);

		$this->assertResponseStatus(200);
		$this->assertEquals(2, $episode->fresh()->number);
		$this->assertEquals('Some New Title', $episode->fresh()->title);
		$this->assertEquals('Some New Description', $episode->fresh()->description);
		$this->seeJson([
			'id' => 1,
			'message' => 'Episode successfully updated'
		]);
    }

    /** @test */
    function admin_can_delete_episodes()
    {
        $episode = factory(Episode::class)->create();

    	$this->json('delete', '/api/v1/episode/' . $episode->id . '?api_token=' . $this->apiGateway->getValidTestAdminToken());

		$this->assertResponseStatus(200);
		$this->assertNull($episode->fresh());
		$this->seeJson([
			'message' => 'Episode successfully deleted'
		]);
    }
}