<?php

namespace App\Services;

use App\Models\Video;

class VideoService
{
    public function getRandomVideos($length)
    {
        return Video::inRandomOrder()->limit($length)->get();
    }

    public function getVideosStartsFromLetter($letter)
    {
        return Video::where('title', 'LIKE', $letter . '%')->get()->filter(function ($video) {
            return strlen($video->title) % 2 == 0;
        });
    }

    public function getVideosWithTitleLengthWords($words)
    {
        return Video::whereRaw('LENGTH(title) - LENGTH(REPLACE(title, " ", "")) >= ' . $words - 1)->get();
    }
}
