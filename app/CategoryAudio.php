<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAudio extends Model
{    
    /**
     * The connection name for the model
     * 
     * @var string
     */
    protected $connection = 'mysql_2';

    protected $table = 'categories';
    
    public function audios()
    {
        return $this->hasMany('App\Audio', 'category_id');
    }
}
