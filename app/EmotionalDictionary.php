<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmotionalDictionary extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'emotional_dictionaries';

    protected $table = 'emotional_dictionaries';
}
