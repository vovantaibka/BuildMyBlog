<?php

namespace App\Http\Controllers\File;

use App\EmotionalDictionary;
use App\Http\Controllers\Controller;
use Excel;

class ExcelProcessing extends Controller
{
    /**
     * Import từ điển cảm xúc vào DB.
     *
     * @return string [State]
     */
    public function importEmotionalDictionaryToDB()
    {
        Excel::filter('chunk')->load('Assignment02/VnEmoLex.xlsx')->chunk(250, function ($results) {
            foreach ($results as $row) {
                $word = new EmotionalDictionary();
                $word->english = $row->english;
                $word->vietnamese = $row->vietnamese;
                $word->positive = $row->positive;
                $word->negative = $row->negative;
                $word->anger = $row->anger_tuc_gian;
                $word->anticipation = $row->anticipation_hi_vong;
                $word->disgust = $row->disgust_chan_ghet;
                $word->fear = $row->fear_so_hai;
                $word->joy = $row->joy_thich_thu;
                $word->sadness = $row->sadness_buon_ba;
                $word->surprise = $row->surprise_ngac_nhien;
                $word->trust = $row->trust_tin_tuong;
                $word->total = $row->total;
                $word->save();
            }
        });

        return 'Success';
    }
}
