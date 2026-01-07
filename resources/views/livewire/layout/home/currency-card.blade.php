<div class="currency-card">
    <div class="currency-icon">{{ $item['symbol'] }}</div>
    <h3 class="currency-title">{{ $item['name'] }}</h3>
    <p class="currency-price">{{ number_format($item['price']) }} <span class="currency-unit">{{ $item['unit'] }}</span></p>
    <p class="price-change positive"{{ $item['change_value'] < 0 ? 'text-red-400' : 'text-green-400' }}">{{ $item['change_percent'] }}%</p>
    <p class="currency-date">{{ $item['date'] }} - {{ $item['time'] }}</p>
</div>
