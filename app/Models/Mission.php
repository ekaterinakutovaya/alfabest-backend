<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Mission extends Model
{
    use Translatable;

    protected $translatable = ['title', 'text', 'moto'];
}
