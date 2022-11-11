@extends('layouts.app')

@section('content')
    <x-app-header logo="true" :bar="isset($bar) ? $bar : null"></x-app-header>
    <x-app-banner title="What would you like to order"></x-app-banner>

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">
                <x-app-search></x-app-search>
                @if (isset($categories) && !empty($categories) && count($categories))
                    <div class="category-section section-row">
                        <div class="wrap">
                            @if (request()->has('search'))
                                <h2 class="section-title">Categories</h2>
                            @endif
                            <div class="category-boxes">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($categories as $category)
                                    {{-- @php
                                        $bg = ['orange', 'sky-blue', 'green', 'pink'];
                                        if ($i < 4) {
                                            $index = $i++;
                                        } else {
                                            $index = 0;
                                            $i = 0;
                                        }
                                    @endphp --}}
                                    <x-app-category-card :category="$category" :background="$category->background_color"
                                                         :bar="isset($bar) ? $bar : null"></x-app-category-card>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($bar) && isset($promotions) && !empty($promotions) && count($promotions) && !request()->has('search'))
                    <div class="promotion-section section-row border-bottom">
                        <div class="wrap">
                            <h2 class="section-title">Deals</h2>

                            <div class="promotion-row owl-carousel owl-theme">
                                @foreach ($promotions as $promotion)
                                    <div class="item">
                                        <a href="{{ route('promotion-details', ['bar' => $bar->slug, $promotion->id]) }}"
                                           class="promotion-box"
                                           {{ $promotion->image? 'style=background-image:url(' . asset('public/images/promotion/' . $promotion->image) . ')': null }}>
                                            <div class="promotion-content">
                                                <div class="discount-box">
                                                    <h2>{!! $promotion->promotion_for !!}</h2>
                                                </div>
                                                <p>{{ $promotion->title }}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            {{-- <div class="promotion-row">
                                <div class="promotion-boxes">
                                    @foreach ($promotions as $promotion)
                                        <a href="{{ $promotion->link ? $promotion->link : 'javascript:void(0)' }}"
                                            class="promotion-box"
                                            {{ $promotion->image? 'style=background-image:url(' . asset('public/images/promotion/' . $promotion->image) . ')': null }}>
                                            <div class="promotion-content">
                                                <div class="discount-box">
                                                    <h2>{!! $promotion->title !!}</h2>
                                                </div>
                                                <p>{{ $promotion->description }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div> --}}
                        </div>
                    </div>
                @endif

                @if (isset($items) && !empty($items) && count($items))
                    <div class="best-seller section-row">
                        <div class="wrap">
                            <h2 class="section-title">Recommended</h2>
                            <div class="best-items">
                                @foreach ($items as $item)
                                    <x-app-item-card :item="$item"></x-app-item-card>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif


                @if (isset($categories) && count($categories) == 0 && isset($items) && count($items) == 0)
                    <h2 class="text-center mt-4">Nada Encontrado</h2>
                @endif

            </div>
        </div>
    </div>

@endsection
