<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\Communication\FeedService;
use App\Services\Image\ImageCaptioningService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class FeedController extends Controller
{
    const MANYFLATS_PROJECT_NAME = 'manyflats.com';

    protected $feedService;
    protected $imageCaptioningService;

    public function __construct(FeedService $feedService, ImageCaptioningService $imageCaptioningService)
    {
        $this->feedService = $feedService;
        $this->imageCaptioningService = $imageCaptioningService;
    }

    /**
     * @param string $language
     * @param string $channel
     * @return \Illuminate\Http\Response
     */
    public function index(string $language, string $channel = '')
    {
        App::setLocale($language);
        $items = $this->feedService->getRandom($language, $channel);
        $lastDate = Carbon::now()->format("D, j M Y H:i:s O");
        $items = [$items];
        return response()
            ->view('feeds.feed', compact('items', 'lastDate'))
            ->header('Content-Type', 'text/xml');
    }

    /**
     * @param string $language
     * @return \Illuminate\Http\Response
     */
    public function verify(string $language)
    {
        $items = $this->feedService->verify($language);
        return response()
            ->view('feeds.verify', compact('items'))
            ->header('Content-Type', 'text/plain');
    }

    /**
     * @param string $language
     * @param int $id
     * @param int $width
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function propertyPicture(string $language, int $id, int $width = 0)
    {
        in_array($language, ['en', 'ru']) ?: abort(404);
        in_array($width, [0, 450, 800]) ?: abort(404);

        $key = 'properties:picture:' . $language . ':' . $id . ':' . $width;
        if (Cache::has($key)) {
            $image = Cache::get($key);
        } else {
            $property = Property::findOrFail($id);
            $data = [
                'language' => $language,
                'country'  => strtolower($property->country),
                'city'     => strtolower($property->city),
                'district' => strtolower($property->district),
                'address'  => trim($property->street . ' ' . $property->house),
                'profit'   => $property->profit,
                'payback'  => $property->payback,
                'project'  => self::MANYFLATS_PROJECT_NAME,
                'width'    => $width
            ];
            $image = $this->imageCaptioningService->propertyPicture($data);
            Cache::put($key, $image, now()->addDays(31));
        }
        return response($image)->header('Content-type', 'image/jpeg');
    }

    /**
     * @param string $language
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function demo(string $language, int $id)
    {
        in_array($language, ['en', 'ru']) ?: abort(404);
        $data = Property::get()
            ->random(1)
            ->toArray();

        $content = $this->feedService->demo($language, $data[0], $id);
        return response($content)->header('Content-type', 'text/html');
    }
}
