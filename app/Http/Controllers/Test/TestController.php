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
        //         $crawler = $thí->goutteClient->request('GET', $key);
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
}
