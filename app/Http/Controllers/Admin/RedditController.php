<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\RedditCrawler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Crawler\Crawler;

class RedditController extends Controller
{
    public function index()
    {
        $url = 'https://www.reddit.com/r/EarthPorn/';
        Crawler::create()
            ->setCrawlObserver(new RedditCrawler) // observer for watch crawling operation
            ->setMaximumCrawlCount(3)
            ->startCrawling($url);


        Session::flash('message', 'images crawled successfully !');

        return redirect('/dashboard');

    }
}

