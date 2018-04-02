<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Task extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'content', 'deadline'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields)
    {
        $task = new static;
        $task->fill($fields);
        $task->user_id = Auth::user()->id;
        $task->save();

        return $task;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function makeComplete()
    {
        $this->status = 1;
        $this->save();
    }

    public function makeActive()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus()
    {
        if ($this->status === 0) {
            $this->makeComplete();
        } else {
            $this->makeActive();
        }
    }

    public static function send($fields)
    {
        $task = new static;
        $task->fill($fields);
        $task->save();

        return $task;
    }


    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->deadline)->format('F d, Y');
    }

    public function getDiffDates()
    {
        $dt = Carbon::now();
        return $dt->diffForHumans($this->deadline);
    }

}
