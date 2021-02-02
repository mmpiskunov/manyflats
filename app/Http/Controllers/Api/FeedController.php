<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feed;

class FeedController extends Controller
{
    public function propertyLink(string $hash)
    {
        $link = Feed::where('feed_id', $hash)->first(['link']);

        return response()->json($link);
    }
}
