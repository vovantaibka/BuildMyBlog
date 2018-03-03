<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

require 'simple_html_dom.php';

class CrawlerController extends Controller
{
    public $crawled_urls = array();
    public $found_urls = array();

    function rel2abs($rel, $base)
    {
        if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
        if ($rel[0] == '#' || $rel[0] == '?') {
            return $base . $rel;
        }
        extract(parse_url($base));
        $path = preg_replace('#/[^/]*$#', '', $path);
        if ($rel[0] == '/') $path = '';
        $abs = "$host$path/$rel";
        $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
        for ($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {
        }
        $abs = str_replace("../", "", $abs);
        return $scheme . '://' . $abs;
    }

    function perfectUrl($u, $b)
    {
        $bp = parse_url($b);
        if (($bp['path'] != "/" && $bp['path'] != "") || $bp['path'] == '') {
            if ($bp['scheme'] == "") {
                $scheme = "http";
            } else {
                $scheme = $bp['scheme'];
            }
//            $b = $scheme . "://" . $bp['hw_objrec2array(object_record)st'] . "/";
        }
        if (substr($u, 0, 2) == "//") {
            $u = "http:" . $u;
        }
        if (substr($u, 0, 4) != "http") {
            if(isset($u) && !empty($u)) {
                $u = $this->rel2abs($u, $b);
            }
        }
        return $u;
    }

    public function crawlerUrlSite($u)
    {
        $urls = array();
        $uen = urlencode($u);
        if ((array_key_exists($uen, $this->crawled_urls) == 0 || $this->crawled_urls[$uen] < date("YmdHis", strtotime('-25 seconds', time())))) {
            $html = HtmlDomParser::file_get_html($u);
            $this->crawled_urls[$uen] = date("YmdHis");
            foreach ($html->find("a") as $li) {
                $url = $this->perfectUrl($li->href, $u);
                $enurl = urlencode($url);
                if ($url != '' && substr($url, 0, 4) != "mail" && substr($url, 0, 4) != "java" && array_key_exists($enurl, $this->found_urls) == 0) {
                    $this->found_urls[$enurl] = 1;
                    array_push($urls, $url);
                }
            }
        }
        return $urls;
    }

    public function getUrlData(Request $request)
    {
        $urls = array();
        $url = $request->url;
        if ($url == '') {
            $urls = null;
        } else {
            $f = fopen("url-crawled.html", "a+");
            fwrite($f, "<div><a href='$url'>$url</a> - " . date("Y-m-d H:i:s") . "</div>");
            fclose($f);
            $urls = $this->crawlerUrlSite($url);
        }
        return redirect()->route('admin.show', 'crawler');
    }
}
