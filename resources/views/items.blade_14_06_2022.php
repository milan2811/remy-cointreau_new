@extends('layouts.app')

@section('content')
    <x-app-header logo="true" share="true" :bar="(isset($bar) && !empty($bar) ? $bar : null)"></x-app-header>    
    <x-app-banner :title="(isset($category->name)? $category->name : 'Title here')"></x-app-banner>

    <div id="main">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">
                <x-app-search :url="(isset($category->name) ? route('items', $category->slug) : '')" :bar="(isset($bar) && !empty($bar) ? $bar : null)"></x-app-search>

                <div class="filter-section section-row border-bottom">
                    <div class="wrap">
                        <div class="filter-row">
                            <ul class="filter-list owl-carousel owl-theme">
                                <li {{ !request()->has('ingredients') || request()->get("ingredients") == "" ? 'class=active' : ''}}><a href="{{ url()->current() }}">All</a></li>
                                @if (isset($ingredients) && $ingredients != '')
                                    @foreach ($ingredients as $key=>$ingredient)
                                    <li {{ request()->has('ingredients') && request()->get("ingredients") == $ingredient->slug ? 'class=active' : ''}}><a href="{{ url()->current()."?ingredients=$ingredient->slug" }}">{{ $ingredient->name}}</a></li>
                                    @endforeach                                    
                                @endif                                
                            </ul>
                            @if (isset($items) && !empty($items))
                                <div class="best-seller">                                    
                                    <div class="best-items">
                                        @foreach ($items as $item)
                                            <x-app-item-card :item="$item"></x-app-item-card>
                                        @endforeach                                 
                                    </div>                                    
                                </div>                
                            @endif                            
                        </div>
                    </div>
                </div>
                @if (isset($categories) && !empty($categories))
                    <div class="category-section section-row">
                        <div class="wrap">
                            <h2 class="section-title">Categories</h2>
                            <div class="category-boxes">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($categories as $key=>$category)
                                {{-- @php
                                    $bg = ["orange", "sky-blue", "green", "pink"];
                                    if($i < 4) {
                                        $index = $i++;
                                    } else {
                                        $index = 0;
                                        $i = 0;
                                    }                                    
                                @endphp --}}
                                    <x-app-category-card :category="$category" :background="$category->background_color" :bar="(isset($bar) ? $bar : null)"></x-app-category-card>
                                @endforeach                                
                            </div>
                        </div>
                    </div>                    
                @endif
            </div><!--/#content-->
        </div><!--/#primary-->
	</div><!--/#main -->
@endsection