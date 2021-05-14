{{--Шаблон счетчика для корзины/сравнения и т.п.--}}
@props(['amount'])
<span class="CartBlock-amount">{{ $amount ?? 0 }}</span>
