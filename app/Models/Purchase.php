<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Purchase extends Model
{
    use Translatable;

    protected $translatable = ['title', 'text'];
}
