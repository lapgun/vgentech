<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'position',
        'description',
        'requirements',
        'benefits',
        'location',
        'salary_range',
        'job_type',
        'quantity',
        'deadline',
        'is_active',
        'view_count',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
        'view_count' => 'integer',
        'quantity' => 'integer'
    ];

    /**
     * Scope for active jobs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($q) {
                        $q->whereNull('deadline')
                          ->orWhere('deadline', '>=', now());
                    });
    }
}
