<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class OutsourcingAdvantagesItem extends Model
{
    use Translatable;

    protected $table = 'outsourcing_advantages_items';
    protected $translatable = ['text'];
}
