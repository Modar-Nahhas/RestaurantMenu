<?php

namespace App\Http\Requests;

use App\Enums\DiscountTypeEnum;
use Illuminate\Validation\Rule;
use Mapi\Easyapi\Requests\BaseRequest;

class DiscountRequest extends BaseRequest
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
                'where_type' => ['sometimes', 'string', Rule::in(DiscountTypeEnum::values())]
            ]);
        } elseif ($this->isMethod('post')) {
            return [
                'name' => ['required', 'string'],
                'type' => ['required', 'string', Rule::in(DiscountTypeEnum::values())],
                'amount' => ['required','numeric', 'between:1,100']
            ];
        }elseif ($this->isMethod('put')) {
            return [
                'name' => ['required', 'string'],
                'amount' => ['required','numeric', 'between:1,100']
            ];
        }
        return [];
    }
}
