<?php

namespace App\Http\Requests\Order;

use App\Order\OrderEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'source_type' => ['required', Rule::enum(OrderEnum::class), 'string', 'max:100'],
            'amount' => 'required|numeric|min:1000', // Total money to pay
            'price' => 'nullable|numeric|min:0',    // Price per unit
            'description' => 'nullable|string|max:5000',
            'source_id' => 'required|integer|exists:assets,id',
        ];
    }

    public function messages(): array
    {
        return [
            'source_type.required' => 'نوع منبع الزامی است.',
            'source_type.enum' => 'نوع منبع انتخاب‌ شده معتبر نیست.',
            'source_type.string' => 'نوع منبع باید به صورت متن باشد.',
            'source_type.max' => 'نوع منبع نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.',
            'source_type.regex' => 'نوع منبع فقط می‌تواند شامل حروف انگلیسی و اعداد باشد.',

            'amount.required' => 'مبلغ الزامی است.',
            'amount.numeric' => 'مبلغ باید یک عدد باشد.',
            'amount.min' => 'مبلغ نمی‌تواند کمتر از ۱۰۰٬۰۰۰ باشد.',
            'amount.regex' => 'فرمت مبلغ صحیح نیست (حداکثر دو رقم اعشار مجاز است).',

            'description.string' => 'توضیحات باید به صورت متن باشد.',
            'description.max' => 'توضیحات نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'description.regex' => 'توضیحات شامل کاراکترهای غیرمجاز است.',

            'source_id.required' => 'شناسه منبع الزامی است.',
            'source_id.integer' => 'شناسه منبع باید عدد صحیح باشد.',
            'source_id.exists' => 'منبع انتخاب‌ شده در سیستم وجود ندارد.',
        ];
    }
}
