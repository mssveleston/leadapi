<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verticals extends Model
{
    use HasFactory;
    protected $table = 'verticals';
    protected $fillable = [
        'campaign_id',
        'buyer_id',
    ];
}
