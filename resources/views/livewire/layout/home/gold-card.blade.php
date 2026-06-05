<div class="gold-card">
    <div class="card-header">
        <div>
            <h3 class="card-title-gold">{{ $item['name'] }}</h3>
            <p class="card-subtitle">{{ $item['name_en'] }}</p>
        </div>
        <div class="card-price-section">
            <p class="card-price">{{ number_format($item['price']) }} <span class="currency-unit">تومان</span></p>
            <p class="price-change positive">{{ $item['unit'] }}</p>
        </div>
    </div>
    <div class="card-body">
        <div class="card-info-grid">
            <div>
                <span class="info-label">میزان تغییر</span>
                <span class="info-value">{{ $item['change_percent'] }}</span>
            </div>
            <div>
                <span class="info-label">نماد</span>
                <span class="info-value">{{ $item['symbol'] }}</span>
            </div>
            <div>
                <span class="info-label">تاریخ</span>
                <span class="info-value">{{ $item['date'] }}</span>
            </div>
            <div>
                <span class="info-label">ساعت</span>
                <span class="info-value">{{ $item['time'] }}</span>
            </div>
        </div>
    </div>
</div>
