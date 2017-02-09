<?php

use App\Exceptions\InvalidTopicStatusException;
use App\Topic;

class TopicTest extends TestCase
{
    /** @test */
    public function topic_can_validate_status()
    {
        $this->assertTrue(Topic::validateStatus('accepted'));
        $this->assertTrue(Topic::validateStatus('rejected'));
        $this->assertTrue(Topic::validateStatus('old'));
        try {
            Topic::validateStatus('foobar');
        } catch (InvalidTopicStatusException $e) {
            return;
        }
        $this->fail('Topic::validateStatus() returned true when InvalidTopicStatusException should have been thrown.');
    }
}
