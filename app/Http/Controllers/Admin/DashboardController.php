<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\RedditImagesFilter;
use App\Http\RedditCrawler;
use App\Models\RedditImage;
use Illuminate\Http\Request;
use Spatie\Crawler\Crawler;

class DashboardController extends Controller
{
    /**
     * @var RedditImagesFilter
     */
    private $filter;

    /**
     * DashboardController constructor.
     * @param RedditImagesFilter $filter
     */
    public function __construct(RedditImagesFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reddit_images = RedditImage::filter($this->filter)->paginate();

        return view('admin.dashboard', compact('reddit_images'));

    }


}
