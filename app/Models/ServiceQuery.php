<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQuery extends Model
{
    use HasFactory;
    protected $fillable = ['services_id', 'full_name', 'phone_number'];
}
