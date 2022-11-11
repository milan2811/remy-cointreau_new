<a href="{{ isset($bar) && $bar ? route('bar.items', ['bar' => $bar->slug, 'term' => $category->slug]) : route('items', $category->slug) }}" class="category-box" style="--bg-color: {{isset($background) ? $background: '#FFE7D7'}}">
    <figure>
        <img src="{{ $category->picture ? asset('/public/images/terms/picture/' . $category->picture) : asset('/public/images/placeholder.png') }}" alt="{{ basename($category->picture) }}">
    </figure>
    <p>{{ $category->name }}</p>
</a>