<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
	protected $table = 'audios';

	/**
	 * The connection name for the model
	 * 
	 * @var string
	 */
    protected $connection = 'mysql_2';

    public function category()
    {
    	return $this->belongsTo('App\CategoryAudio');
    }
}
