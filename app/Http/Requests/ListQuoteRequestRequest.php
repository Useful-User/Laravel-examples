<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListQuoteRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from' => 'date',
            'to' => 'date',
            'id' => 'integer',
            'quote_sources' => [
                'array',
                Rule::exists('quote_sources', 'id'),
            ],
            'external_id' => 'integer',
            'statuses' => [
                'array',
                Rule::exists('quote_request_statuses', 'name'),
            ],
            'per_page' => 'integer',
            'sort' => 'array:by,direction',
            'sort.by' => 'in:id,external_id,status,created_at,updated_at,quote_source_id',
            'sort.direction' => 'in:asc,desc',
        ];
    }
}
