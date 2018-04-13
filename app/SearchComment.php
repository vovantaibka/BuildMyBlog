<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchComment extends Model
{
	/**
	 * The connection name for the model
	 * 
	 * @var string
	 */
    protected $connection = 'mysql_3';
    
	/**
	 * Lấy ra user đã lấy ra comment
	 * @return [type] [description]
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Lấy ra search của comment đấy
	 * @return [type] [description]
	 */
    public function search()
    {
    	return $this->belongsTo('App\Search');
    }
}
