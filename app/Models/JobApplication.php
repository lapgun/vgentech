<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruitment_id',
        'name',
        'email',
        'phone',
        'cv_file',
        'cover_letter',
    ];

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }
}
