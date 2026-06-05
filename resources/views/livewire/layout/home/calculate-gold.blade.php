<div class="input-section">

    <div class="input-wrapper">
        <label class="input-label">هزینه طلا (به تومان)</label>
        <input
            type="text"
            wire:model.live.debounce.300ms="amount"
            inputmode="numeric"
            class="form-input"
        />

    </div>

    <div class="input-wrapper">
        <label class="input-label">وزن طلا (گرم)</label>
        <input
            type="text"
            readonly
            value="{{ $weight }}"
            class="bg-gray-100 form-input"
        >
    </div>

    <div class="text-sm text-gray-600">
    <span wire:loading.remove>
        قیمت هر گرم طلای ۱۸ عیار:
        <strong>{{ number_format($gold18Price) }}</strong> تومان
    </span>

        <span wire:loading>
        در حال دریافت قیمت...
    </span>
    </div>

</div>
