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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'image_path' => ['nullable', 'string'],
            'marketplace_urls' => ['nullable', 'array'],
            'marketplace_urls.*' => ['nullable', 'url', 'max:2048'],
        ];

        if ($this->input('category') === 'coil') {
            $rules['specifications'] = ['required', 'array'];
            $rules['specifications.flavor'] = ['required', 'integer', 'between:1,5'];
            $rules['specifications.sweetness'] = ['required', 'integer', 'between:1,5'];
            $rules['specifications.throat_hit'] = ['required', 'integer', 'between:1,5'];
            $rules['specifications.diameter'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.version'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.resistance'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.resistance_single'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.resistance_dual'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.wrap'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.material'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.durability'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.foot'] = ['nullable', 'string', 'max:255'];
            $rules['specifications.recommended_liquid'] = ['nullable', 'array'];
            $rules['specifications.recommended_liquid.*'] = ['string'];
            $rules['specifications.compatible_atomizers'] = ['nullable', 'array'];
            $rules['specifications.compatible_atomizers.*'] = ['string'];
            $rules['specifications.recommended_watt'] = ['nullable', 'string', 'max:255'];
            $rules['specifications_resistance_value'] = ['nullable', 'numeric', 'min:0.01', 'max:5.00'];
            $rules['specifications_resistance_type'] = ['nullable', 'string', 'in:single,dual'];
            $rules['specifications_resistance_single'] = ['nullable', 'numeric', 'min:0.01', 'max:5.00'];
            $rules['specifications_resistance_dual'] = ['nullable', 'numeric', 'min:0.01', 'max:5.00'];
            $rules['specifications_foot'] = ['nullable', 'string', 'max:255'];
            $rules['specifications_wrap_value'] = ['nullable', 'integer', 'between:2,15'];
        } elseif ($this->input('category') === 'cotton') {
            $rules['specifications'] = ['required', 'array'];
            $rules['specifications.items'] = ['nullable', 'array'];
            $rules['specifications_text'] = ['nullable', 'string'];
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

        if ($this->input('category') === 'coil') {
            $specs = $this->input('specifications', []);
            
            $resSingle = $this->input('specifications_resistance_single');
            $resDual = $this->input('specifications_resistance_dual');
            $foot = $this->input('specifications_foot');

            if ($resSingle) {
                $specs['resistance_single'] = number_format((float) $resSingle, 2, '.', '');
            } else {
                $specs['resistance_single'] = '';
            }

            if ($resDual) {
                $specs['resistance_dual'] = number_format((float) $resDual, 2, '.', '');
            } else {
                $specs['resistance_dual'] = '';
            }

            if ($foot) {
                $specs['foot'] = $foot;
            } else {
                $specs['foot'] = '';
            }

            // Build compatibility string for specifications['resistance']
            $resistanceParts = [];
            if ($resSingle) {
                $resistanceParts[] = number_format((float) $resSingle, 2, '.', '') . ' Ω single';
            }
            if ($resDual) {
                $resistanceParts[] = number_format((float) $resDual, 2, '.', '') . ' Ω dual';
            }
            
            if (!empty($resistanceParts)) {
                $specs['resistance'] = implode(' / ', $resistanceParts);
            } else {
                // Try legacy specifications_resistance_value/type
                $resVal = $this->input('specifications_resistance_value');
                $resType = $this->input('specifications_resistance_type') ?: 'single';
                if ($resVal) {
                    $cleanResVal = number_format((float) $resVal, 2, '.', '');
                    $specs['resistance'] = $cleanResVal . ' Ω ' . strtolower($resType);
                    if ($resType === 'dual') {
                        $specs['resistance_dual'] = $cleanResVal;
                        $specs['resistance_single'] = '';
                    } else {
                        $specs['resistance_single'] = $cleanResVal;
                        $specs['resistance_dual'] = '';
                    }
                }
            }
            
            $wrapVal = $this->input('specifications_wrap_value');
            if ($wrapVal) {
                $specs['wrap'] = $wrapVal . ' wraps';
            }

            // Ensure checkboxes arrays are defined to avoid array keys missing
            if (!isset($specs['recommended_liquid'])) {
                $specs['recommended_liquid'] = [];
            }
            if (!isset($specs['compatible_atomizers'])) {
                $specs['compatible_atomizers'] = [];
            }
            if (!isset($specs['recommended_watt'])) {
                $specs['recommended_watt'] = $this->input('specifications.recommended_watt') ?: '';
            }
            
            $this->merge([
                'specifications' => $specs,
            ]);
        }

        if ($this->input('category') === 'cotton') {
            $text = $this->input('specifications_text') ?? '';
            // Split by newline, trim whitespace, filter empty lines
            $items = array_filter(array_map('trim', explode("\n", $text)));
            $this->merge([
                'specifications' => [
                    'items' => array_values($items),
                ],
            ]);
        }
    }
}
