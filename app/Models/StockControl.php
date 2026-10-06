<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $product_id
 * @property double $old_quantity
 * @property double $new_quantity
 * @property double $sold_quantity
 * @property double $price
 * @property string $description
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class StockControl extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'old_quantity',
        'new_quantity',
        'sold_quantity',
        'price',
        'total',
        'user_id',
        'description'
    ];

    protected $casts = [
        'old_quantity' => 'decimal:2',
        'new_quantity' => 'decimal:2',
        'sold_quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accesseurs pour formater les données
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 0, ',', ' ') . ' F';
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', ' ') . ' F';
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    // Scopes pour les requêtes
    public function scopeByPeriod($query, $dateFrom, $dateTo)
    {
        return $query->whereBetween('created_at', [
            $dateFrom . ' 00:00:00',
            $dateTo . ' 23:59:59'
        ]);
    }

    public function scopeByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->whereHas('product', function($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });
    }

    public function scopeWithSales($query)
    {
        return $query->where('sold_quantity', '>', 0);
    }
}
