<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\VietnameseStopword;

class TxtProcessing extends Controller
{
	public function importVietnameseStopwords()
	{
		if(File::exists('Assignment02/vietnamese-stopwords.txt'))
		{
			$stopwordsFile = File('Assignment02/vietnamese-stopwords.txt');
			foreach ($stopwordsFile as $line) {
				$vietnameseStopword = new VietnameseStopword();
				$vietnameseStopword->word = trim($line);
				$vietnameseStopword->save();
			}
			return "Success";
		}	
	}
}
