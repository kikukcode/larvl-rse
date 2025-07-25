<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_name',
        'research_title',
        'target_institution',
        'document_file',
        'status',
    ];
}
