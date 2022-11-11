@extends('layouts.app', ['body_class' => 'product-detail'])

@section('content')
    @php
    $title = isset($promotion->title) ? strip_tags($promotion->title) : 'Title here';
    @endphp
    <x-app-header logo="true" share="true" :bar="isset($bar) && !empty($bar) ? $bar : null"></x-app-header>
    <x-app-banner title=""></x-app-banner>

    {{-- <div class="product-banner" style="background-image:url({{ isset($promotion->media) && !empty($promotion->media) ? asset('public/images/items/'. $image[0]) : asset('/public/images/placeholder.png') }})"></div> --}}

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">

                <div class="product-info border-bottom">
                    <div class="wrap">

                        <div class="inner-product-details">
                            <div class="product-banner">
                                <img src="{{ isset($promotion->image) && !empty($promotion->image)? asset('public/images/promotion/' . $promotion->image): asset('/public/images/placeholder.png') }}"
                                     alt="{{ $title }}">
                            </div>
                            <div class="title-price">
                                @if (isset($title))
                                    <h2 class="section-title section-title2">{{ $title }}</h2>
                                @endif                                

                                <div class="ingredients">
                                    {!! $promotion->promotion_for !!}
                                </div>
                                <div class="ingredients">
                                    {!! $promotion->short_description !!}
                                </div>
                                @php
                                    $prices = json_decode($promotion->price);
                                    $min = 0;
                                    $max = 0;
                                @endphp
                                @if ($prices)
                                    <div class="product-price mt-3">
                                        @foreach ($prices->price as $index => $price)
                                            <h4>{{ sizeof($prices->price) > 1 ? $prices->quantity[$index] : null }} <span>$
                                                    {{ $prices->price[$index] }}</span></h4>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="ingredients">
                                    @if (isset($promotion->link) && $promotion->link != '')
                                        <a href="{{ $promotion->link }}" target="_blank" class="button btn-outline">View item regular menu</a>
                                    @endif
                                </div> 
                            </div>
                        </div>
                        {!! $promotion->description !!}
                    </div>
                </div>
            </div>
            <!--/#content-->
        </div>
        <!--/#primary-->
    </div>
    <!--/#main -->
@endsection
