<?php

namespace App\Http\Requests;

use Mapi\Easyapi\Requests\BaseRequest;

class ItemRequest extends BaseRequest
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
                'description' => ['required', 'string'],
                'price' => ['required', 'numeric', 'min:0'],
                'category_id' => ['bail', 'required', 'integer', 'min:1', 'exists:categories,id'],
                'discount_id' => ['bail', 'integer', 'min:1', 'exists:discounts,id']
            ];
        }
        return [];
    }
}
