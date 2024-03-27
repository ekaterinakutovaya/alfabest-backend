<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TCG\Voyager\Traits\Translatable;

class ServicesPage extends Model
{
    use Translatable;

    protected $translatable = ['title', 'text'];

    public function services_categories(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
