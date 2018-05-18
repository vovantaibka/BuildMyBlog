<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_2';

    protected $table = 'audios';

    public function category()
    {
        return $this->belongsTo('App\CategoryAudio');
    }
}
