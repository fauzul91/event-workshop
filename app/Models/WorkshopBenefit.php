<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkshopBenefit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'workshop_id'
    ];
    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
}
