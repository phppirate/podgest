<?php

use App\Api\ApiGateway;
use App\Api\FakeApiGateway;
use App\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCanEditAndDeleteTopicsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->apiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $this->apiGateway);
    }

    /** @test */
    public function admin_can_edit_topics()
    {
        $topic = factory(Topic::class)->create([
            'user_id'     => 45,
            'title'       => 'Some Old Title',
            'description' => 'Some Old Description',
        ]);

        $this->json('patch', '/api/v1/topic/'.$topic->id.'?api_token='.$this->apiGateway->getValidTestAdminToken(), [
            'title'       => 'Some New Title',
            'description' => 'Some New Description',
        ]);

        $this->assertResponseStatus(200);
        $this->assertEquals('Some New Title', $topic->fresh()->title);
        $this->assertEquals('Some New Description', $topic->fresh()->description);
    }

    /** @test */
    public function admin_can_delete_topics()
    {
        $topic = factory(Topic::class)->create([
            'user_id'     => 45,
            'title'       => 'Some Old Title',
            'description' => 'Some Old Description',
        ]);

        $this->json('delete', '/api/v1/topic/'.$topic->id.'?api_token='.$this->apiGateway->getValidTestAdminToken());

        $this->assertResponseStatus(200);
        $this->assertNull($topic->fresh());
        $this->seeJson([
            'message' => 'Topic successfully deleted.',
        ]);
    }
}
