<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'long_description'
    ];

//    protected $guarded = ['secret'];

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }

    public static function getLatestTasks()
    {
        return self::latest();
    }

    public static function getCompletedTasks()
    {
        return self::getLatestTasks()->where('completed', true);
    }
}

