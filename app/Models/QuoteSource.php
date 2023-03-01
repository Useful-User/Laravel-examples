<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Requests\UpdateQuoteRequestRequest;
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


    /**
     * Get availability of Quote Source
     * 
     * @param  \App\Http\Requests\UpdateQuoteRequestRequest  $request
     * @return bool
     * 
     */
    public static function methodAvailable(UpdateQuoteRequestRequest $request)
    {
        return boolval(
            self::where('id', $request->quote_source_id)
                ->where('availability', 1)
                ->count()
        );
    }
}
