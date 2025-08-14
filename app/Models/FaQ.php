<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaQ extends Model
{
    /** @use HasFactory<\Database\Factories\FaQFactory> */
    use HasFactory;

    protected $table = 'faq';
    protected $guarded = ['id'];



}
