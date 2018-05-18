<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\VietnameseStopword;
use File;

class TxtProcessing extends Controller
{
    public function importVietnameseStopwords()
    {
        if (File::exists('Assignment02/vietnamese-stopwords.txt')) {
            $stopwordsFile = file('Assignment02/vietnamese-stopwords.txt');
            foreach ($stopwordsFile as $line) {
                $vietnameseStopword = new VietnameseStopword();
                $vietnameseStopword->word = trim($line);
                $vietnameseStopword->save();
            }

            return 'Success';
        }
    }
}
