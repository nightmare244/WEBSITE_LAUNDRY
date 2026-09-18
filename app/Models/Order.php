<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'order_code', 'customer_name', 'whatsapp_number', 'weight',
        'total_price', 'status', 'estimated_ready_at',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
            'total_price' => 'integer',
            'estimated_ready_at' => 'datetime',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return config("laundry.statuses.{$this->status}", ucfirst($this->status));
    }

    public function getProgressPercentAttribute(): int
    {
        return (array_search($this->status, array_keys(config('laundry.statuses')), true) / 4) * 100;
    }
}
