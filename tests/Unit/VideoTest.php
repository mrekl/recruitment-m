<?php

namespace Tests\Unit;

use App\Models\Video;
use App\Services\VideoService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseMigrations;

    protected $videoService;

    public function setUp(): void
    {
        parent::setUp();

        $this->videoService = app(VideoService::class);

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * Check if on getting random videos, returns 3 videos
     */
    public function test_get_random(): void
    {
        $videos = $this->videoService->getRandomVideos(3);
        $this->assertCount(3, $videos);
    }

    public function test_get_starting_from_specified_letter(): void
    {
        $videos = $this->videoService->getVideosStartsFromLetter("w");
        $this->assertCount(4, $videos);

        foreach ($videos as $video) {
            $this->assertStringStartsWith('w', strtolower($video->title));
            $this->assertEquals(0, strlen($video->title) % 2);
        }
    }

    public function test_get_videos_with_title_longer_than_two_words(): void
    {
        $videos = $this->videoService->getVideosWithTitleLengthWords(2);
        $this->assertCount(57, $videos);
    }
}
