<header id="header">
    <div class="wrap">
        <div class="header-row">
            @if (isset($logo) && $logo == 'true')
                <a href="{{ isset($bar) && $bar ? route('bar.show', $bar->slug) : route('home') }}" id="logo" title="{{ config('app.name', 'Remy Cointreau') }}">
                    <img src="{{isset($bar->logo) && $bar->logo ? asset('public/images/bars/logo/'.$bar->logo) : asset('public/images/logo.svg')}}" width="222" height="71" alt="{{ isset($bar->name) && $bar->name ? $bar->name : config('app.name', 'Remy Cointreau') }}">
                </a>
            @endif
            @php
                $path = Request::path();
                $pathArr = explode('/', $path);                
            @endphp
            @if ( sizeof($pathArr) > 1 && Str::length($path) != 1)
                <a href="{{ session('lastVisited') }}" class="back-btn {{sizeof($pathArr)}}"><i class="icon-arrow-left"></i></a>
            @endif
            @if (isset($share) && $share == 'true')
            <a href="javascript:;" class="share-btn">
                <i class="icon-share"></i>
                <div class="share-button-wrap">
                    <div class="share-btn-container">
                    </div>
                </div>
            </a>
            @endif
        </div>
    </div><!--/.wrap-->
</header><!--/#header-->