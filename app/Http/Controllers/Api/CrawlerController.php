<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Storage;

class CrawlerController extends Controller
{
    const CountNode = 10; // Tổng số nút sẽ duyệt qua
    const BaseUrlWiki = "https://vi.wikipedia.org";

    private $goutteClient;
    private $guzzleClient;
    private $f;

    public $crawledUrls = array(); // Chứa Info của tất cả những trang đã crawler
    public $linkedPages = array(); // Chứa tất cả hyperlink wiki vn của trang hiện tại
    public $urls = array(); // Chứa tất cả những url đã tìm ra
    public $url;

    public function __construct()
    {
        $this->goutteClient = new Client();
        $this->guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $this->goutteClient->setClient($this->guzzleClient);
    }

    // Hàm lấy ra tất cả hyperlinks từ url đưa vào
    public function getUrlsWiki($url)
    {
        $crawler = $this->goutteClient->request('GET', $url);

        $this->linkedPages = array();
        $this->url = $url;

        try {
            if ($crawler->filter('div#bodyContent')->filter('a')->count() > 0) {
                $crawler->filter('div#bodyContent')->filter('a')->each(function ($node) {
                    $link = $node->selectlink($node->text())->link();
                    $linkUrl = $link->getUri();
                    if (!strpos($linkUrl, "#")) {
                        if (strpos($linkUrl, self::BaseUrlWiki) === 0) {
                            if (!in_array($linkUrl, $this->linkedPages)) {
                                $this->linkedPages[] = $linkUrl;
                                fputcsv($this->f, [$this->url, $linkUrl]);
                            }
                            if (!in_array($linkUrl, $this->urls)) {
                                $this->urls[] = $linkUrl;
                            }
                        }
                    }
                });
            }
        } catch (\InvalidArgumentException $e) {
            //
        }
    }

    public function getUrlsWikiLinked($url)
    {
        $crawler = $this->goutteClient->request('GET', $url);

        $this->linkedPages = array();
        $this->url = $url;

        try {
            if ($crawler->filter('div#bodyContent')->filter('a')->count() > 0) {
                $crawler->filter('div#bodyContent')->filter('a')->each(function ($node) {
                    $link = $node->selectlink($node->text())->link();
                    $linkUrl = $link->getUri();
                    if (!strpos($linkUrl, "#")) {
                        if (strpos($linkUrl, self::BaseUrlWiki) === 0) {
                            if (!in_array($linkUrl, $this->linkedPages) && (in_array($linkUrl, $this->urls))) {
                                $this->linkedPages[] = $linkUrl;
                                fputcsv($this->f, [$this->url, $linkUrl]);
                            }
                        }
                    }
                });
            }
        } catch (\InvalidArgumentException $e) {
            //
        }
    }

    public function getUrlData(Request $request)
    {
        $startUrl = $request->entrypoint;
        $crawler = $this->goutteClient->request('GET', $startUrl);

        $title = $crawler->filter('h1#firstHeading')->html();

        $crawlerStartUrl = array(
            'title' => $title,
            'impactFactor' => 1
        );

        $this->crawledUrls[$startUrl] = $crawlerStartUrl;

        $this->f = fopen("url-crawled.csv", "a+");
        fputcsv($this->f, ["linkFrom", "linkTo"]);

        $this->getUrlsWiki($startUrl);

        while (count($this->urls) < self::CountNode) {
            $nextUrl = $this->linkedPages[array_rand($this->linkedPages)];

            while ((empty($nextUrl)) && (!array_key_exists($nextUrl, $this->crawledUrls))) {
                $nextUrl = $this->linkedPages[array_rand($this->linkedPages)];
            }

            $crawler = $this->goutteClient->request('GET', $nextUrl);

            $pageTitle = $crawler->filter('h1#firstHeading')->html();

            if (array_key_exists($nextUrl, $this->crawledUrls)) {
                $this->crawledUrls[$nextUrl]['impactFactor']++;
            } else {
                $crawlerUrl = array(
                    'title' => $pageTitle,
                    'impactFactor' => 1
                );
                $this->crawledUrls[$nextUrl] = $crawlerUrl;
            }

            $this->getUrlsWiki($nextUrl);
        }

        $AllUrls = $this->urls;

        foreach ($AllUrls as $url) {
            if (!array_key_exists($url, $this->crawledUrls)) {
                $this->getUrlsWikiLinked($url);
            }
        }

        fclose($this->f);

        return response()->json(array(
            'data' => $this->crawledUrls
        ));;
    }
}
