@extends('layouts.app', ['body_class' => 'product-detail'])

@section('content')
    <x-app-header logo="true" share="true" :bar="(isset($bar) && !empty($bar) ? $bar : null)"></x-app-header>
    <x-app-banner :title="(isset($item->name)? $item->name : 'Title here')"></x-app-banner>

    @php
    $image = json_decode($item->media);
    @endphp
    {{-- <div class="product-banner" style="background-image:url({{ isset($item->media) && !empty($item->media) ? asset('public/images/items/'. $image[0]) : asset('/public/images/placeholder.png') }})"></div> --}}

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">

                <div class="product-info border-bottom">
                    <div class="wrap">

                        <div class="inner-product-details">
                            <div class="product-banner">
                                <img src="{{ isset($item->media) && !empty($item->media)? asset('public/images/items/' . $image[0]): asset('/public/images/placeholder.png') }}"
                                    alt="{{ $item->name }}">
                            </div>
                            <div class="title-price">
                                @if (isset($item->name))
                                    <h2 class="section-title section-title2">{{ $item->name }}</h2>
                                @endif
                                @php
                                    $prices = json_decode($item->price);
                                    $min = 0;
                                    $max = 0;
                                @endphp
                                @if ($prices)
                                    <div class="product-price">
                                        @foreach ($prices->price as $index => $price)
                                            <h4>{{ sizeof($prices->price) > 1 ? $prices->quantity[$index] : null }} <span>$
                                                    {{ $prices->price[$index] }}</span></h4>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="ingredients">
                                    @if (isset($terms))
                                        @php
                                            $ingredients = $terms->where('type', 'ingredients');
                                            $brandsIndex = 0;
                                        @endphp
                                        <ul>
                                            {{-- @foreach ($selectedCategory as $index => $cat)
                                                <li>
                                                    {{ ucwords($cat['name']) }}
                                                    @if (isset($selectedBrands[$brandsIndex]) && $selectedBrands[$brandsIndex]->children)
                                                        {{ ucwords($selectedBrands[$brandsIndex]->name) }}
                                                        @if (isset($selectedBrands[$brandsIndex + 1]))
                                                            {{ ucwords($selectedBrands[$brandsIndex + 1]->name) }}
                                                        @endif
                                                    @endif
                                                    @php
                                                        $brandsIndex = $brandsIndex + 2;
                                                    @endphp
                                                </li>
                                            @endforeach
                                            <hr/> --}}
                                            @foreach ($selectedBrandsCates as  $selectedBrandsCate)
                                                <li>
                                                    @if (isset($selectedBrandsCate[0]))
                                                            {{ ucwords($selectedBrandsCate[0]->name) }}
                                                    @endif
                                                    @if (isset($selectedBrandsCate[1]))
                                                            {{ ucwords($selectedBrandsCate[1]->name) }}
                                                    @endif
                                                    @if (isset($selectedBrandsCate[1]) && isset($selectedBrandsCate[2]))
                                                            {{ ucwords($selectedBrandsCate[2]->name) }}
                                                    @endif
                                                </li>
                                            @endforeach
                                            @if ($ingredients->count())
                                                @foreach ($ingredients as $term)
                                                    <li>{{ ucwords($term->name) }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>



                        {!! $item->description !!}
                    </div>
                </div>
                @if (isset($related_items) && !empty($related_items) && $related_items->count())
                    <div class="best-seller section-row">
                        <div class="wrap">
                            <h2 class="section-title">Similar Items </h2>
                            <div class="best-items">
                                @foreach ($related_items as $itm)
                                    <x-app-item-card :item="$itm"></x-app-item-card>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!--/#content-->
        </div>
        <!--/#primary-->
    </div>
    <!--/#main -->
@endsection
