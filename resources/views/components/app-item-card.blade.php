@php
    $image = json_decode($item->media);    
@endphp
<div class="best-item">
    <a href="{{ route('item.show', ['bar' => $item->bar ? $item->bar->slug : null, 'item' => $item ? $item->slug : null]) }}" class="item-img">
        
        <img src="{{ $image ? asset('public/images/items/'. $image[0]) : asset('/public/images/placeholder.png')  }}" alt="{{ $image ? $image[0] : null }}">
    </a>
    <p><a href="{{ route('item.show', ['bar' => $item->bar ? $item->bar->slug : null, 'item' => $item ? $item->slug : null]) }}">{{$item->name}}</a></p>
    <div class="price">
        {{ getItemPriceRange($item) }}
    </div>
</div>