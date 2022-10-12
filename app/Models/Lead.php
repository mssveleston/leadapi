<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';
    protected $fillable = [
        'name',
        'campaign_id',
        'email',
        'phone',
        'dob',
        'credit_score',
        'health_conditions',
        'covid19_exposed',
        'existing_insurance'
    ];
}
