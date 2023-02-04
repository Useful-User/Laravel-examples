<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteSource extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
        'url',
        'resource',
        'priority',
        'availability',
    ];

    /**
     * Get the Quote Requests associated with this Quote Source.
     */
    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }
}
