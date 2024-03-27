<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TCG\Voyager\Traits\Translatable;

class ServiceCategory extends Model
{
    use Translatable;

    protected $translatable = ['title'];

    public function services_pages(): BelongsToMany
    {
        return $this->belongsToMany(ServicesPage::class);
    }
    public function services_galleries(): BelongsToMany
    {
        return $this->belongsToMany(ServicesGallery::class);
    }
}
