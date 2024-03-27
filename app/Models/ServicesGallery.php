<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicesGallery extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function services_categories(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

}
