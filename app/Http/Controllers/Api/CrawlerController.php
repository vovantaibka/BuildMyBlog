<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Storage;
use paslandau\PageRank\Import\CsvImporter;
use paslandau\PageRank\Calculation\PageRank;
use paslandau\PageRank\Calculation\ResultFormatter;


class CrawlerController extends Controller
{
    const CountNode = 5; // Tổng số nút sẽ duyệt qua
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
            if ($crawler->filter('body')->filter('a')->count() > 0) {
                $crawler->filter('body')->filter('a')->each(function ($node) {
                    $link = $node->selectlink($node->text())->link();
                    $linkUrl = $link->getUri();
                    if (!strpos($linkUrl, "#") && strpos($linkUrl, self::BaseUrlWiki) === 0) {
                        fputcsv($this->f, [$this->url, $linkUrl]);
                        if (!in_array($linkUrl, $this->linkedPages)) {
                            $this->linkedPages[] = $linkUrl;
                        }
                        if (!in_array($linkUrl, $this->urls)) {
                            $this->urls[] = $linkUrl;
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
            if ($crawler->filter('body')->filter('a')->count() > 0) {
                $crawler->filter('body')->filter('a')->each(function ($node) {
                    $link = $node->selectlink($node->text())->link();
                    $linkUrl = $link->getUri();
                    if (!strpos($linkUrl, "#") && strpos($linkUrl, self::BaseUrlWiki) === 0) {
                        fputcsv($this->f, [$this->url, $linkUrl]);
                        if (!in_array($linkUrl, $this->linkedPages) && (in_array($linkUrl, $this->urls))) {
                            $this->linkedPages[] = $linkUrl;
                        }
                    }
                });
            }
        } catch (\InvalidArgumentException $e) {
            //
        }
    }

    /**
     * [getCrawlerUrl Crawl included title, hyperlinks]
     * @param  [String] $url [Page url]
     * @return [type]      [description]
     */
    public function getCrawlerUrl($url)
    {
        $crawler = $this->goutteClient->request('GET', $url);

        $pageTitle = $crawler->filter('h1#firstHeading')->html();

        $this->getUrlsWiki($url);

        if (!array_key_exists($url, $this->crawledUrls)) {
            $crawlerUrl = array(
                'title' => $pageTitle,
                'hyperlinks' => $this->linkedPages
            );
            $this->crawledUrls[$url] = $crawlerUrl;
        }
    }
    
    public function getPageRank()
    {
        $hasHeader = true;
        $sourceColumn = "linkFrom";
        $destinationColumn = "linkTo";
        $encoding = "utf-8";
        $delimiter = ",";
        $csvImporter = new CsvImporter($hasHeader, $sourceColumn, $destinationColumn, $encoding, $delimiter);
        $pathToFile = public_path() . "/url-crawled-v4.csv";

        $graph = $csvImporter->import($pathToFile);

        $dampingFactor = null;
        $maxRounds = null;
        $maxDistance = null;
        $collapseLinks = null;
        $pageRank = new PageRank($dampingFactor, $maxRounds, $maxDistance, $collapseLinks);

        // calculate the PageRank
        $keepAllRoundData = null;
        $result = $pageRank->calculatePagerank($graph, $keepAllRoundData);

        // print the result
        $formatter = new ResultFormatter(4);

        return $formatter->toArrayFormatter($result);
    }

    /**
     * [getUrlData description]
     * @param  Request $request [description]
     * @return [json]           [Array crawled urls]
     */
    public function getUrlData(Request $request)
    {
        $startUrl = $request->entrypoint;
        $crawler = $this->goutteClient->request('GET', $startUrl);

        $this->urls[] = $startUrl;

        $title = $crawler->filter('h1#firstHeading')->html();

        $crawlerStartUrl = array(
            'title' => $title
        );

        $this->crawledUrls[$startUrl] = $crawlerStartUrl;

        $this->f = fopen("url-crawled-v4.csv", "a+");

        fputcsv($this->f, ["linkFrom", "linkTo"]);

        $this->getUrlsWiki($startUrl);

        $hyperlinksStartUrl = $this->linkedPages;

        $this->crawledUrls[$startUrl]['hyperlinks'] = $hyperlinksStartUrl;
        
        $numberHyperlinksStartUrl = count($this->linkedPages);

        // foreach ($hyperlinksStartUrl as $hyperlink) {
        //     $this->getCrawlerUrl($hyperlink);

        //     $hyperlinksCurrentUrl = $this->linkedPages;

        //     foreach ($hyperlinksCurrentUrl as $hyperlink) {
        //         $this->getCrawlerUrl($hyperlink);
        //     }
        // }

        // Mở rộng đồ thì đến khi số đỉnh lớn hơn CountNode thì dừng lại
        while (count($this->urls) < self::CountNode) {
            $nextUrl = $this->linkedPages[array_rand($this->linkedPages)];

            while ((empty($nextUrl)) && (!array_key_exists($nextUrl, $this->crawledUrls))) {
                $nextUrl = $this->linkedPages[array_rand($this->linkedPages)];
            }

            $crawler = $this->goutteClient->request('GET', $nextUrl);

            $pageTitle = $crawler->filter('h1#firstHeading')->html();

            if (!array_key_exists($nextUrl, $this->crawledUrls)) {
                $crawlerUrl = array(
                    'title' => $pageTitle
                );
                $this->crawledUrls[$nextUrl] = $crawlerUrl;
            }

            $this->getUrlsWiki($nextUrl);
        }

        // Khi số nút của đồ thị lớn hơn CountNode thì sẽ crawler dữ liệu các url tìm thấy nhưng chưa duyệt qua
        // $AllUrls = $this->urls;

        // foreach ($AllUrls as $url) {
            // if (!array_key_exists($url, $this->crawledUrls)) {
                // $this->getUrlsWikiLinked($url);
            // }
        // }

        fclose($this->f);

        $result = $title . "    " . count($this->urls) . "</br>";
        $result .= "Pagerank    Title" . "</br>";

        $resultArray = $this->getPageRank();
        foreach ($resultArray as $key => $value)
        {
            $titlePage = "";
            if (array_key_exists($key, $this->crawledUrls)) {
                $titlePage = $this->crawledUrls[$key]['title'];
            } else {
                $crawler = $this->goutteClient->request('GET', $key);
                $titlePage = $crawler->filter('h1#firstHeading')->html();
            }
            $result .= $value . "    " . $titlePage . "    " . $key . "</br>";
        }
        
        return response()->json(array(
            'result' => $result
        ));;
    }
}
