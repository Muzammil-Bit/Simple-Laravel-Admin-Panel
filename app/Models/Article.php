<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    const DRAFT = 1;
    const POSTED = 2;

    protected $fillable = ['heading', 'description', 'created_by', 'status'];
}
