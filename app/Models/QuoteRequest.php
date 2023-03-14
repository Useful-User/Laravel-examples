<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'external_id',
        'quote_request_status_id',
        'token',
    ];

    /**
     * Get Quote Request status.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(QuoteRequestStatus::class, 'quote_request_status_id');
    }

    /**
     * Get the Quote Source of the Quote Request.
     */
    public function quoteSource(): BelongsTo
    {
        return $this->belongsTo(QuoteSource::class);
    }
}
