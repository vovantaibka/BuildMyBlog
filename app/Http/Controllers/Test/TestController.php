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

class TestController extends Controller
{
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

        var_dump($formatter->toArrayFormatter($result));
    }

    public function getVueComponent()
    {
        return view('test.vue');
    }
}
