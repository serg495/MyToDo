<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'start_date', 'finish_date'];

    public static function addEvent($fields)
    {
        $event = new static;
        $event->fill($fields);
        $event->save();

        return $event;
    }
}
