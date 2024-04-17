<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function getRandom(Request $request)
    {
        $length = $request->query('length', 3);
        $videos = $this->videoService->getRandomVideos(length: $length);

        return VideoResource::collection($videos);
    }

    public function startsFromLetter(Request $request)
    {
        $letter = $request->query('letter', 'w');
        $videos = $this->videoService->getVideosStartsFromLetter(letter: $letter);

        return VideoResource::collection($videos);
    }

    public function getLongerThanOneWordTitle(Request $request)
    {
        $words = $request->query('words', 2);
        $videos = $this->videoService->getVideosWithTitleLengthWords(words: $words);

        return VideoResource::collection($videos);
    }
}
