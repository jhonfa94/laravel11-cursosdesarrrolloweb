<?php

namespace App\Models;

use NumberFormatter;
use App\Traits\HasSlug;
use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wine extends Model
{
    use HasSlug;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'year',
        'price',
        'stock',
        'image',
    ];


    // protected $cast = [];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(): Attribute
    {
        // image_url
        return Attribute::make(
            get: fn () => UploadService::url($this->image),
        );
    }

    public function formattedPrice(): Attribute
    {
        // formatted_price
        $formatter = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);

        return Attribute::make(
            get: fn () => $formatter->formatCurrency($this->price, 'EUR'),
        );
    }
}
