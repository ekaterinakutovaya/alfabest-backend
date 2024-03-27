<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class AboutCompanyContent extends Model
{
    use Translatable;

    protected $translatable = ['title', 'home_page_text', 'about_company_page_text'];
}
