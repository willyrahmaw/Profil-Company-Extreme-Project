<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'title')->ignore($this->route('product')),
            ],
            'category' => ['required', 'in:coil,cotton'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'character_description' => ['required', 'string'],
        ];

        if ($this->input('category') === 'coil') {
            $rules['specifications'] = ['required', 'array'];
            $rules['specifications.flavor'] = ['required', 'integer', 'between:1,5'];
            $rules['specifications.sweetness'] = ['required', 'integer', 'between:1,5'];
            $rules['specifications.throat_hit'] = ['required', 'integer', 'between:1,5'];
        } elseif ($this->input('category') === 'cotton') {
            $rules['specifications'] = ['required', 'array'];
            $rules['specifications.clean_flavor_delivery'] = ['boolean'];
            $rules['specifications.fast_liquid_absorption'] = ['boolean'];
            $rules['specifications.premium_organic_fiber'] = ['boolean'];
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Generate slug from title if not custom-specified (for unique validation checks)
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('title') ?? ''),
        ]);

        if ($this->input('category') === 'cotton') {
            $specs = $this->input('specifications', []);
            $this->merge([
                'specifications' => [
                    'clean_flavor_delivery' => filter_var($specs['clean_flavor_delivery'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    'fast_liquid_absorption' => filter_var($specs['fast_liquid_absorption'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    'premium_organic_fiber' => filter_var($specs['premium_organic_fiber'] ?? false, FILTER_VALIDATE_BOOLEAN),
                ],
            ]);
        }
    }
}
