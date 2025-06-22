<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Workshop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'thumbnail', 'venue_thumbnail', 'bg_map', 'address', 'about', 'price', 'is_open', 'has_started', 'time_at', 'category_id', 'workshop_instructor_id' 
    ];
    protected $casts = [
        'started_at' => 'date',
        'time_at' => 'datetime:H:1'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function instructor()
    {
        return $this->belongsTo(WorkshopInstructor::class, 'workshop_instructor_id');
    }

    public function benefits()
    {
        return $this->hasMany(WorkshopBenefit::class);
    }
    public function participans()
    {
        return $this->hasMany(WorkshopParticipant::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes('name') = $value;
        $this->attributes('slug') = Str::slug($value);
    }
}