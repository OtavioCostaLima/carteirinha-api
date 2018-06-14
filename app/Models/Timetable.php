<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
     protected $connection = 'tenant';
  protected $fillable = ['class_id', 'discipline_id', 'teacher_id'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Classs::class);
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Discipline::class);
    }
}
