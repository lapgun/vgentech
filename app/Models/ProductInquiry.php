<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductInquiry extends Model
{
    protected $fillable = [
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_company',
        'message',
        'ip_address',
        'is_processed',
        'processed_at'
    ];

    protected $casts = [
        'is_processed' => 'boolean',
        'processed_at' => 'datetime'
    ];

    /**
     * Get the product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope for unprocessed inquiries
     */
    public function scopeUnprocessed($query)
    {
        return $query->where('is_processed', false);
    }

    /**
     * Mark as processed
     */
    public function markAsProcessed()
    {
        $this->update([
            'is_processed' => true,
            'processed_at' => now()
        ]);
    }
}
