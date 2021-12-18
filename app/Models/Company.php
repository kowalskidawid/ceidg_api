<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'name', 'zip_code', 'county', 'municipality', 'city', 'street', 'pkd_codes', 'source'
    ];
}
