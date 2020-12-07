<?php


namespace App\Http;


use App\Models\RedditImage;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class RedditCrawler extends \Spatie\Crawler\CrawlObservers\CrawlObserver
{
    private $pages = [];

    public function willCrawl(UriInterface $uri)
    {
        RedditImage::truncate();

        echo "Now crawling: " . (string)$uri . PHP_EOL;

    }

    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null)
    {
        $path = $url->getPath();
        $doc = new \DOMDocument();
        @$doc->loadHTML($response->getBody());
        $imgs = $doc->getElementsByTagName("img");

        foreach ($imgs as $imgElement) {
            $src = $imgElement->getAttribute('src');
            $find_png = strpos($src, ".png");
            $extension_position = $find_png ? $find_png : strpos($src, ".jpg");
            $slash_position = stripos($src, "http");
            $img = substr($src, $slash_position, $extension_position + 4);
            $path_info= pathinfo($src);
            if($this->url_exists($img)){

                RedditImage::create([
                    'url' => $img,
                    'title' => $path_info['filename'],
                ]);
            }
        }

//        exit;
    }

    /**
     * Called when the crawler had a problem crawling the given url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \GuzzleHttp\Exception\RequestException $requestException
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null)
    {
        echo 'failed';
    }

    public function finishedCrawling()
    {
        //

    }

    function url_exists($url)
    {
        $hdrs = @get_headers($url);

        echo @$hdrs[1] . "\n";

        return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/', $hdrs[0]) : false;
    }

}
