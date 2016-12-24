<?php

use App\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuggestTopicsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function can_suggest_a_topic()
    {
        $topic = [
            'title' => "Is Foo a good thing?",
            'description' => "A little about foo"
        ];

        $this->post("/api/v1/topic/suggest", $topic);

        $this->assertResponseStatus(201);
        $this->assertNotNull(Topic::first());
        $this->assertEquals('Is Foo a good thing?', Topic::first()->title);
        $this->assertEquals('A little about foo', Topic::first()->description);
    }

    /** @test */
    function successful_topic_creation_returns_id()
    {
        $topic = [
            'title' => "Is Foo a good thing?",
            'description' => "A little about foo"
        ];

        $this->post("/api/v1/topic/suggest", $topic);

        $this->seeJsonSubset([
            'id' => 1,
            'message' => 'Topic Successfully Suggested'
        ]);
    }

    /** @test */
    function cannot_suggest_if_title_is_empty()
    {
        $topic = [
            'title' => "",
            'description' => ""
        ];

        $this->json("post", "/api/v1/topic/suggest", $topic);

        $this->assertResponseStatus(422);
    }
}
