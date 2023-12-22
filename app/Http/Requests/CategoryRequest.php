<?php

namespace App\Http\Requests;

use Mapi\Easyapi\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return array_merge($this->getRules, [

            ]);
        } elseif ($this->isMethod('post')) {
            return [
                'name' => ['required', 'string'],
                'discount_id' => ['bail', 'integer', 'min:1', 'exists:discounts,id']
            ];
        }
        return [];
    }
}
