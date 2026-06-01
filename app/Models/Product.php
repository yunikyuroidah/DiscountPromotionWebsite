<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'weight_grams',
        'price',
        'discount_percent',
        'discount_valid_until',
        'image',
        'description',
        'is_active',
    ];

    protected $hidden = [
        'image',
    ];

    protected $casts = [
        'discount_valid_until' => 'date',
        'is_active' => 'boolean',
        'price' => 'integer',
        'discount_percent' => 'integer',
        'weight_grams' => 'integer',
    ];

    public function getIsDiscountActiveAttribute(): bool
    {
        if ($this->discount_percent <= 0) {
            return false;
        }

        if (!$this->discount_valid_until) {
            return false;
        }

        return Carbon::parse($this->discount_valid_until)->endOfDay()->isFuture();
    }

    public function getDiscountedPriceAttribute(): int
    {
        if (!$this->is_discount_active) {
            return $this->price;
        }

        $discounted = $this->price * (100 - $this->discount_percent) / 100;

        return (int) round($discounted);
    }
}
