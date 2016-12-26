<?php
use App\Topic;
use App\Exceptions\InvalidTopicStatusException;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicTest extends TestCase
{
    /** @test */
    function topic_can_validate_status()
    {
        $this->assertTrue(Topic::validateStatus('accepted'));
        $this->assertTrue(Topic::validateStatus('rejected'));
        $this->assertTrue(Topic::validateStatus('old'));
        try{
        	Topic::validateStatus('foobar');
        } catch (InvalidTopicStatusException $e){
        	return;
        }
        $this->fail("Topic::validateStatus() returned true when InvalidTopicStatusException should have been thrown.");
    }
}