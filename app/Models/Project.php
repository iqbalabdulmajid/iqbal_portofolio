<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi manual
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'tech_stack',
        'link_github',
        'link_demo',
        'is_published',
    ];
}
