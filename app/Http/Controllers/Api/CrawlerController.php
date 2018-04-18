<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Storage;
use File;
use Symfony\Component\DomCrawler\Crawler;
use paslandau\PageRank\Import\CsvImporter;
use paslandau\PageRank\Calculation\PageRank;
use paslandau\PageRank\Calculation\ResultFormatter;
use App\Search;
use App\SearchComment;
use App\EmotionalDictionary;
use App\VietnameseStopword;

class CrawlerController extends Controller
{
    const CountNode = 100; // Tổng số nút sẽ duyệt qua
    const BaseUrlWiki = "https://vi.wikipedia.org";

    private $goutteClient;
    private $guzzleClient;
    private $f;
    private $fResult;

    public $crawledUrls = array(); // Chứa Info của tất cả những trang đã crawler
    public $linkedPages = array(); // Chứa tất cả hyperlink wiki vn của trang hiện tại
    public $urls = array(); // Chứa tất cả những url đã tìm ra
    public $url;

    public $categoriesLink = array();
    public $searches = array();

    public $index = 0;

    public function __construct()
    {
        $this->goutteClient = new Client();
        $this->guzzleClient = new GuzzleClient(array(
            'timeout' => 15000,
        ));
        $this->goutteClient->setClient($this->guzzleClient);
    }

    // Hàm lấy ra tất cả hyperlinks từ url đưa vào
    public function getUrlsWiki($url)
    {
        $crawler = $this->goutteClient->request('GET', $url);

        $pageTitle = $crawler->filter('h1#firstHeading')->html();

        $crawlerUrl = array(
            'title' => $pageTitle
        );

        $this->crawledUrls[$url] = $crawlerUrl;

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

    // Hàm lấy ra tất cả hyperlinks từ url đưa vào
    public function getUrlsWikiLinked($url)
    {
        $crawler = $this->goutteClient->request('GET', $url);

        $pageTitle = $crawler->filter('h1#firstHeading')->html();

        $crawlerUrl = array(
            'title' => $pageTitle
        );

        $this->crawledUrls[$url] = $crawlerUrl;
        $this->linkedPages = array();
        $this->url = $url;

        try {
            if ($crawler->filter('body')->filter('a')->count() > 0) {
                $crawler->filter('body')->filter('a')->each(function ($node) {
                    $link = $node->selectlink($node->text())->link();
                    $linkUrl = $link->getUri();
                    if (!strpos($linkUrl, "#") && strpos($linkUrl, self::BaseUrlWiki) === 0) {
                        if(in_array($linkUrl, $this->urls)) {
                            fputcsv($this->f, [$this->url, $linkUrl]);
                            if(!in_array($linkUrl, $this->linkedPages)) {
                                $this->linkedPages[] = $linkUrl;
                            }
                        }
                    }
                });
            }
        } catch (\InvalidArgumentException $e) {
            //
        }
    }
    
    // Tính toán pagerank từ file csv có cấu trúc định sẵn
    public function getPageRank()
    {
        $hasHeader = true;
        $sourceColumn = "linkFrom";
        $destinationColumn = "linkTo";
        $encoding = "utf-8";
        $delimiter = ",";
        $csvImporter = new CsvImporter($hasHeader, $sourceColumn, $destinationColumn, $encoding, $delimiter);
        $pathToFile = public_path() . "/count-node-100000.csv";

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
     * Lấy dữ liệu về các Url từ startUrl
     * @param  Crawler $crawler
     * @param  string  $startUrl
     * @return [type]            [description]
     */
    public function getDataTypeUrl(Crawler $crawler, $startUrl)
    {
        $title = $crawler->filter('h1#firstHeading')->html();

        $this->urls[] = $startUrl;
        $this->f = fopen("count-node-100.csv", "a+");

        fputcsv($this->f, ["linkFrom", "linkTo"]);

        $this->getUrlsWiki($startUrl);

        // Mở rộng đồ thì đến khi số đỉnh lớn hơn CountNode thì dừng lại
        while ((count($this->urls) < self::CountNode) || (count($this->urls) > count($this->crawledUrls))) {
            $nextUrl = $this->urls[array_rand($this->urls)];

            while ((empty($nextUrl)) || (array_key_exists($nextUrl, $this->crawledUrls))) {
                $nextUrl = $this->urls[array_rand($this->urls)];
            }

            $crawler = $this->goutteClient->request('GET', $nextUrl);

            $pageTitle = $crawler->filter('h1#firstHeading')->html();

            $crawlerUrl = array(
                'title' => $pageTitle
            );
            $this->crawledUrls[$nextUrl] = $crawlerUrl;

            $this->getUrlsWiki($nextUrl);
        }

        // Khi số nút của đồ thị lớn hơn CountNode thì sẽ crawler dữ liệu các url tìm thấy nhưng chưa duyệt qua

        if(count($this->urls) > count($this->crawledUrls))
        {
            $AllUrls = $this->urls;
            foreach ($AllUrls as $url) {
                if (!array_key_exists($url, $this->crawledUrls)) {
                    $this->getUrlsWikiLinked($url);
                }
            }
        }

        fclose($this->f);

        $this->fResult = fopen("report.txt", "a+");

        fwrite($this->fResult, $title . "    " . count($this->urls) . "\n");
        fwrite($this->fResult, "Pagerank    Title\n");
        
        $resultArray = $this->getPageRank();

        foreach ($resultArray as $key => $value)
        {
            $titlePage = $this->crawledUrls[$key]['title'];
            fwrite($this->fResult, $value . "    " . $titlePage . "\n");
            // $titlePage = "";
            // if (array_key_exists($key, $this->crawledUrls)) {
            //     $titlePage = $this->crawledUrls[$key]['title'];
            // } else {
            //     $crawler = $this->goutteClient->request('GET', $key);
            //     $titlePage = $crawler->filter('h1#firstHeading')->html();
            // }
            
            // $result .= $value . "    " . $titlePage . "</br>";
        }

        fclose($this->fResult);
    }

    /**
     * Lấy dữ liệu về các Comment từ startUrl
     * @param  Crawler $crawler  [description]
     * @param  [type]  $startUrl [description]
     * @return [type]            [description]
     */
    public function getDataTypeComment(Crawler $crawler, $startUrl)
    {
        $this->searches = array();
        try {
            if($crawler->filter('nav.categories > ul')->filter('li.parent')->filter('a')->count() > 0)
            {
                // Mảng categoriesLink chứa các link category của trang news.zing.vn
                $this->categoriesLink = array();
                $crawler->filter('nav.categories > ul')->filter('li.parent')->filter('a')->each(function($node) {
                    $this->categoriesLink[] = $node->attr('href');
                });

                // Lấy 20 link category đầu tiên của mảng
                // array_splice($this->categoriesLink, 20);

                foreach ($this->categoriesLink as $categoryLink => $value) {
                    // Vào từng category của trang news.zing.vn
                    $crawler = $this->goutteClient->request('GET', $value);

                    // Lấy ra link các bài viết trong từng category
                    if($crawler->filter('section.cate_sidebar')->filter('section.mostread')->filter('article')->filter('p.title')->filter('a')->count() > 0)
                    {
                        $crawler->filter('section.cate_sidebar')->filter('section.mostread')->filter('article')->filter('p.title')->filter('a')->each(function($node) {
                            $crawler = $this->goutteClient->request('GET', $node->attr('href'));

                            $user = Auth::user();
                            $search = new Search;

                            $search->type = 'comment';
                            $search->entrypoint = 'https://news.zing.vn' . $node->attr('href');
                            $search->user_id = $user->id;
                            $search->finished = 0;

                            $search->save();

                            $finished = 0;


                            // Lấy ra id của bài viết
                            $articleId = $crawler->filter("article")->attr('article-id');

                            $res = $this->guzzleClient->request('GET', 'https://api.news.zing.vn/api/comment.aspx?action=get&id=' . $articleId)->getBody();

                            $comments = json_decode($res->getContents())->comments;

                            for ($i=0; $i < count($comments); $i++) {
                                $contentComment = $comments[$i]->Comment;

                                if(strlen($contentComment) > 50) {
                                    $comment = new SearchComment;

                                    $comment->comment = $contentComment;

                                    $comment->user()->associate(Auth::user()->id);
                                    $comment->search()->associate($search);

                                    $comment->save();
                                }
                            }

                            $search->finished = 1;
                            $search->save();

                            $this->searches[] = $search;
                        });
                    }
                }
            }
        } catch(\InvalidArgumentException $e) {
            Log::debug($e->getMessage());
        } catch(\Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    /**
     * Tiền xử lý comment
     * @param  string $comment
     * @return array [Mảng các từ key trong comment sau giai đoạn tiền xử lý]
     */
    public function pretreatmentComment($comment)
    {
        // Tách câu
        $sentences = explode('.', $comment);

        $segments = array();
        
        // Tách dấu câu
        foreach ($sentences as $key => $sentence) {
            if(!empty($sentence)) {
                $array = explode(',', $sentence);
                $segments = array_merge($segments, $array);
            }
        }

        $arr = array();

        foreach ($segments as $key => $segment) {
            try {
                if(strlen($segment) > 0 & preg_match('/[a-z]|[A-Z]/', $segment)) {
                    // Thực hiện tách từ bằng việc gọi đến API viết bằng java sử dụng vn_tokenizer
                    $res = $this->guzzleClient->request('GET', 'http://localhost:8080/rest_glassfish_vn_tokenizer_war_exploded/api/v2/vn_tokenizer/' . trim($segment));
                    $contents = $res->getBody()->getContents();
                    if($contents !== "[]")
                    {
                        $content = explode(',', $contents);

                        foreach ($content as $key => $value) {
                            // Lấy ra loại từ
                            $lem = substr(explode('}', explode(';', $value)[2])[0], 5);

                            // Lấy từng từ đã tách
                            $word = explode(';', $value)[1];

                            // Loại bỏ chữ số
                            if(in_array($lem, ['CAPITAL', 'WORD'])) { // Kiểm tra xem từ đó có phải WORD không?
                                $word = strtolower($word);

                                $arrWord = explode('_', $word);
                                $word = implode(' ', $arrWord);

                                // Chuyển thành chữ thường
                                $arr[] = $word;           
                            }
                        }
                    }
                }
            } catch(ClientException $e) {

            } catch(Exception $e) {

            }
            
        }

        return $arr;
    }

    /**
     * Loại bỏ từ dừng trong mảng các từ tham số đưa vào
     * @param  array $comments [ Mảng chứ danh sách từ key trong comment ]
     * @return array
     */
    public function stopwordsDelete($words)
    {
        $result = array();
        foreach ($words as $word) {
            $stopword = VietnameseStopword::where('word', $word)->first();
            if(is_null($stopword))
            {   
                $result[] = $word; // Nếu từ không phải từ dừng thì thêm vào mảng kq trả về
            }
        }
        return $result;
    }


    /**
     * Tính điểm của comment
     * @param  [array] $words [ Danh sách các từ key trong comment ]
     * @return [int]        [ Điểm đánh gía comment ]
     */
    public function scoreComment($words)
    {
        $scorePos = 0;
        $scoreNeg = 0;

        foreach ($words as $word) {
            $emotionalDictionary = EmotionalDictionary::where('vietnamese', $word)->first();
            if(!is_null($emotionalDictionary)) {
                $scorePos += $emotionalDictionary->positive;
                $scoreNeg += $emotionalDictionary->negative;
            }
        }
        $score = [
            "positive" => $scorePos,
            "negative" => $scoreNeg
        ];
        return $score;
    }

    /**
     * Đánh gía các comment
     * @return [type] [description]
     */
    public function evaluateComment()
    {
        $this->index = 0;
        echo  "ID Postive_score Negative_score Content</br>";
        SearchComment::chunk(200, function ($comments) {
            foreach ($comments as $comment) {
                if(strlen($comment->comment) > 150) {
                    $this->index++;
                    echo $this->index . " ";
                    $words = $this->pretreatmentComment(trim($comment->comment));
                    $words = $this->stopwordsDelete($words);
                    $score = $this->scoreComment($words);
                    echo $score['positive'] . " ";
                    echo $score['negative'] . " ";
                    echo $comment->comment . "</br>";
                }
                if($this->index == 1000) {
                    dd();
                }
            }
        });
    }

    /**
     * Hàm lấy dữ liệu từ Url đưa vào
     * @param  Request $request
     * @return Response [Array crawled urls]
     */
    public function getUrlData(Request $request)
    {
        // https://vi.wikipedia.org/wiki/Qu%E1%BA%A7n_%C4%91%E1%BA%A3o_Sunda_Nh%E1%BB%8F
        $startUrl = $request->entrypoint;
        $crawler = $this->goutteClient->request('GET', $startUrl);

        switch ($request->type) {
            case 'url':
            $this->getDataTypeUrl($crawler, $startUrl);
            break;

            case 'email':
                # code...
            break;

            case 'comment':
            $this->getDataTypeComment($crawler, $startUrl);
            break;
            
            default:
                # code...
            break;
        }
        
        return response()->json([
            'searches' => $this->searches
        ]);
    }
}

