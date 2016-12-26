<?php
use App\Episode;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EpisodeTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    function can_get_episodes_that_have_aired()
    {
        $airedEpisode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('-1 Week')
    	]);
        $unairedEpisode = factory(Episode::class)->create([
        	'air_date' => Carbon::parse('+1 Week')
    	]);

    	$episodes = Episode::aired()->get();

    	$this->assertTrue($episodes->contains($airedEpisode));
    	$this->assertFalse($episodes->contains($unairedEpisode));
    }
}