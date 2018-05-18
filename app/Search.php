<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_3';

    /**
     * Lấy ra user đã tạo ra search.
     *
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Lấy ra tất cả comments của search.
     *
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany('App\SearchComment');
    }
}
