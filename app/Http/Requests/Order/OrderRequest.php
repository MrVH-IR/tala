<?php

namespace App\Http\Requests\Order;

use App\Order\OrderEnum;
use App\Order\OrderStatusEnum;
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
            'user_id' => ['required', 'exists:users,id', 'string'],
            'asset_id' => ['required', 'exists:assets,id', 'string'],
            'type' => ['required', Rule::enum(OrderEnum::class), 'string', 'max:6'],
            'amount' => 'required|numeric|min:0|max:100000000000000000000000000000000000',
            'price' => 'required|numeric|min:0|max:100000000000000000000000000000000000',
            'total_money' => 'required|numeric|min:0|max:100000000000000000000000000000000000',
            'status' => ['required', 'string', 'max:20', Rule::enum(OrderStatusEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'نوع منبع الزامی است.',
            'user_id.string' => 'نوع منبع باید به صورت متن باشد.',
            'user_id.exists' => 'کاربر مورد نظر وجود ندارد',

            'asset_id.required' => 'نماد الزامی است',
            'asset_id.string' => 'نوع نماد باید به صورت متن باشد',
            'asset_id.exists' => 'نماد مورد نظر وجود ندارد',

            'type.required' => 'درخواست شما نوع انجام عملیات ندارد',
            'type.string' => 'درخواست عملیات باید به صورت متن باشد',
            'type.enum' => 'نوع درخواست عملیات اشتباه است',
            'type.max' => 'تعداد کاراکتر های درخواست عملیات زیاد است',

            'amount.required' => 'مبلغ الزامی است.',
            'amount.numeric' => 'مبلغ باید یک عدد باشد.',
            'amount.min' => 'مبلغ نمی‌تواند کمتر از ۰ باشد.',
            'amount.max' => 'مبلغ مورد نظر نمیتواند بیشتر از ۳۶ رقم باشد',

            'price.numeric' => 'مبلغ باید به صورت عددی باشد',
            'price.required' => 'مبلغ الزامی می باشد',
            'price.min' => 'مبلغ نماد نمی تواند ۰ باشد',
            'price.max' => 'مبلغ نماد بیشتر از ۳۶ رقم نمی تواند باشد',

            'total_money.required' => 'مبلغ کل الزامی می باشد',
            'total_money.numeric' => 'مبلغ کل باید عدد باشد',
            'total_money.min' => 'مبلغ کل نمیتواند ۰ باشد',
            'total_money.max' => 'مبلغ کل نمیتواند بیشتر از ۳۶ رقم باشد',

            'status.required' => 'حالت حاظر درخواست را وارد کنید',
            'status.string' => 'حالت حاظر درخواست باید متن باشد',
            'status.enum' => 'حالت حاظر درخواست اشتباه است',
            'status.max' => 'حالت حاظر درخواست طولانی است',
        ];
    }
}
