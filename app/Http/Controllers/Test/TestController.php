<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use paslandau\PageRank\Import\CsvImporter;
use paslandau\PageRank\Node;
use paslandau\PageRank\Graph;
use paslandau\PageRank\Edge;
use paslandau\PageRank\Calculation\PageRank;
use paslandau\PageRank\Calculation\ResultFormatter;
use File;
use Excel;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class TestController extends Controller
{
    private $goutteClient;
    private $guzzleClient;

    public function __construct()
    {
        $this->goutteClient = new Client();
        $this->guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $this->goutteClient->setClient($this->guzzleClient);
    }

    public function testGoogleMapApi()
    {
        return view('test.map');
    }

    public function testZoomImage()
    {
        return view('test.zoom');
    }

    public function testJQuery()
    {
        return view('test.jquery');
    }

    public function getPagerank()
    {
        $hasHeader = true;
        $sourceColumn = "linkFrom";
        $destinationColumn = "linkTo";
        $encoding = "utf-8";
        $delimiter = ",";
        $csvImporter = new CsvImporter($hasHeader, $sourceColumn, $destinationColumn, $encoding, $delimiter);
        $pathToFile = public_path() . "/count-node-10000-v2.csv";

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

//        var_dump($formatter->toArrayFormatter($result));

        $resultArray = $formatter->toArrayFormatter($result);
        echo count($resultArray);
        // $string = "";

        // foreach ($resultArray as $key => $value)
        // {
        //     try {
        //         $crawler = $this->goutteClient->request('GET', $key);
        //         $titlePage = $crawler->filter('h1#firstHeading')->html();
        //         echo $value . "    " . $titlePage . "</br>";
        //     } catch (\InvalidArgumentException $e) {

        //     }
        // }
    }

    public function getVueComponent()
    {
        return view('test.vue');
    }

    public function getRouterVue()
    {
        return view('test.routervuejs');
    }

    public function pretreatmentComment()
    {
        $comment = "Thực sự là mình rất sợ trà sữa trân châu. Hầu hết các cửa hàng toàn nhập nguyên liệu từ Trung Quốc với gía rất rẻ, vì mình có thằng bạn nó cùng làm quán trà sữa nó toàn lấy từ Trung Quốc. Thế mới có lãi cao vì thuê mặt bằng rất đắt đỏ rồi. Nên các bạn hãy cân nhắc có nên dùng trà sữa không nhé";
        
        // echo $comment . "</br>";

        // Tách câu
        $sentences = explode('.', $comment);

        // var_dump($sentences);
        // echo "</br>";

        $segments = array();
        
        // Tách dấu câu
        foreach ($sentences as $key => $sentence) {
            $array = explode(',', $sentence);
            $segments = array_merge($segments, $array);
        }

        $arr = array();

        foreach ($segments as $key => $segment) {
            // Thực hiện tách từ bằng việc gọi đến API viết bằng java sử dụng vn_tokenizer
            $res = $this->guzzleClient->request('GET', 'http://localhost:8080/rest_glassfish_vn_tokenizer_war_exploded/api/v2/vn_tokenizer/' . $segment);

            $contents = $res->getBody()->getContents();

            $content = explode(',', $contents);

            foreach ($content as $key => $value) {
                // Lấy từng từ đã tách
                $word = explode(';', $value)[1];

                // Loại bỏ chữ số
                if(!preg_match('/[0-9]/', $word)) {
                    // Chuyển thành chữ thường
                    $arr[] = strtolower($word);                     
                }

            }
        }

        // $arr = $this->stopwordsDelete($arr);
        $this->scoreComment($arr);
        
        return;
    }

    /**
     * Loại bỏ từ dừng trong mảng các từ đưa vào
     * @param  array $comments [description]
     * @return array
     */
    public function stopwordsDelete($comments)
    {
        try {
            $result = array();
            if (File::exists('Assignment02/vietnamese-stopwords.txt'))
            {
                $stopwords = array(); // Mảng chứa các từ dừng
                $stopwordsFile = File('Assignment02/vietnamese-stopwords.txt');
                foreach ($stopwordsFile as $line) {
                    $stopwords[] = trim($line);
                }

                foreach ($comments as $comment) {
                    if(!in_array($comment, $stopwords)) {
                        $result[] = $comment;
                    }
                }
            }
            return $result;
        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            Log::error("The file doesn't exist");
        }
    }


    /**
     * Tính toán điểm của đoạn comment
     * @param  array $comments [description]
     * @return int
     */
    public function scoreComment($comments)
    {
        $score = 0;
        Excel::load('Assignment02/Test.xlsx', function($reader) {
            $results = $reader->all();
            $results
            // foreach ($results as $result) {
            //     echo $result->english . "</br>";
            // }
        });
        return $score;
    }
}
