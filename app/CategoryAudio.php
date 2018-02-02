<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAudio extends Model
{    
    protected $table = 'categories';

    /**
     * The connection name for the model
     * 
     * @var string
     */
    protected $connection = 'mysql_2';
    
    public function audios()
    {
        return $this->hasMany('App\Audio');
    }
}
