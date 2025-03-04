<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function todoItems()
    {
        return $this->hasMany(TodoItem::class);
    }
}
