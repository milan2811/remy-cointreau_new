@extends('layouts.home')

@section('content')    
    @if (isset($content['banner']) && ($content['banner']->title || $content['banner']->heading || $content['banner']->image))
        <div class="banner-section">
            <div class="wrap">
                <div class="banner-row">
                    <div class="banner-info">
                        @if ($content['banner']->title)
                            <span>{{$content['banner']->title}}</span>                            
                        @endif
                        @if ($content['banner']->heading)
                            <h1>{!!$content['banner']->heading!!}</h1>                            
                        @endif
                        @if ($content['banner']->description)
                            <p>{{$content['banner']->description}}</p>                            
                        @endif
                        @if ($content["banner"]->cta && $content["banner"]->cta->text)
                            <a href="{{$content["banner"]->cta->url ? $content["banner"]->cta->url : '#'}}" class="button">{{$content["banner"]->cta->text}}</a>                            
                        @endif
                    </div>
                    <div class="banner-image">
                        @if ($content["banner"]->image)
                            <figure>
                                <img src="{{$content["banner"]->image ? asset('/public/images/uploads/'.$content['banner']->image) : asset('public/home/images/hero-img.png')}}" alt="banner-image">
                            </figure>                            
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/ banner section End-->        
    @endif

    @if (isset($content['available']) && $content['available'])
        <!--/ Restaurantes section Start-->
        <div class="Restaurantes-section">
            <div class="wrap">
                @if (isset($content['available']->heading) && isset($content['available']->heading))
                    <h2>{!! $content['available']->heading !!}</h2>                    
                @endif
                <div class="Restaurantes-row">

                    <nav class="owl-filter-bar">
                        <a href="#" class="item button btn-outline" data-owl-filter=".restaurant">Restaurante</a>
                        <a href="#" class="item button btn-outline" data-owl-filter=".bar">Bar</a>
                        <a href="#" class="item button btn-outline" data-owl-filter=".night">Nightclub</a>
                    </nav>

                    <div class="owl-carousel category-slider">  
                        @if (isset($content['available']->restaurants))
                            @foreach ($content['available']->restaurants as $item)
                                <div class="item restaurant">
                                    <div class="Restaurantes-images">
                                        <a href="{{$item->url ? $item->url : 'javascript:void(0)'}}">
                                            <figure>
                                                <img src="{{isset($item->image) && $item->image ? asset('public/images/uploads/'. $item->image) : asset('public/images/placeholder.png')}}" alt="{{$item->name}}">
                                            </figure>
                                            <h4>{{$item->name}}</h4>
                                        </a>
                                    </div>
                                </div>
                            @endforeach                                        
                        @endif  
                        @if (isset($content['available']->bars))
                            @foreach ($content['available']->bars as $item)
                                <div class="item bar">
                                    <div class="Restaurantes-images">
                                        <a href="{{$item->url ? $item->url : 'javascript:void(0)'}}">
                                            <figure>
                                                <img src="{{isset($item->image) && $item->image ? asset('public/images/uploads/'. $item->image) : asset('public/images/placeholder.png')}}" alt="{{$item->name}}">
                                            </figure>
                                            <h4>{{$item->name}}</h4>
                                        </a>
                                    </div>
                                </div>
                            @endforeach                                        
                        @endif
                        @if (isset($content['available']->nightclubs))
                            @foreach ($content['available']->nightclubs as $item)
                                <div class="item night">
                                    <div class="Restaurantes-images">
                                        <a href="{{$item->url ? $item->url : 'javascript:void(0)'}}">
                                            <figure>
                                                <img src="{{isset($item->image) && $item->image ? asset('public/images/uploads/'. $item->image) : asset('public/images/placeholder.png')}}" alt="{{$item->name}}">
                                            </figure>
                                            <h4>{{$item->name}}</h4>
                                        </a>
                                    </div>
                                </div>
                            @endforeach                                        
                        @endif                                               
                    </div>
                </div>
            </div>
        </div>
        <!--/ Restaurantes section End-->    
    @endif

    @if (isset($content['about']) && ($content['about']->heading || $content['about']->description || $content['about']->image))
        <!--/ about section Start-->
        <div class="about-section" id="cómo-funciona">
            <div class="wrap">
                <div class="about-row">
                    @if ($content['about']->heading)
                        <h2>{!!$content['about']->heading!!}</h2>                        
                    @endif
                    @if ($content['about']->description)
                        <p>{{$content['about']->description}}</p>                        
                    @endif
                    @if ($content['about']->image)
                        <figure>
                            <img src="{{asset('public/images/uploads/'. $content['about']->image)}}" alt="{{$content['about']->image}}">
                        </figure>                        
                    @endif
                </div>
            </div>
        </div>
        <!--/ about section End-->        
    @endif

    @if (isset($content['easy']) && ($content['easy']->heading || $content['easy']->description || $content['easy']->image || $content['easy']->feature))
    <!--/ manage section Start-->
    <div class="manage-section" id="características">
        <div class="manage-left">
            <div class="manage-info">
                <div class="manage-title">
                    @if ($content['easy']->heading)
                        <h2>{!!$content['easy']->heading!!}</h2>                        
                    @endif
                    @if ($content['easy']->description)
                        <p>{{$content['easy']->description}}</p>                        
                    @endif
                    @if ($content['easy']->feature && sizeof($content['easy']->feature))
                        <ul>
                            @foreach ($content['easy']->feature as $feature)
                                <li>
                                    <i class="{{$feature->icon}}"></i>
                                    @if ($feature->heading)
                                        <h4>{{$feature->heading}}</h4>                                        
                                    @endif
                                    @if ($feature->description)
                                        <p>{{$feature->description}}</p>                                        
                                    @endif
                                </li>                                
                            @endforeach                            
                        </ul>                        
                    @endif
                </div>
            </div>
        </div>
        @if ($content['easy']->image)
            <div class="manage-image">
                <figure>
                    <img src="{{asset('public/images/uploads/'. $content['easy']->image)}}" alt="{{$content['easy']->image}}">
                </figure>
            </div>            
        @endif
    </div>
    <!--/ manage section End-->
    @endif

    @if (isset($content['how']) && ($content['how']->heading || $content['how']->description || $content['how']->image || $content['how']->help))
    <!--/ help section Start-->
    <div class="help-section" id="beneficios">
        <div class="wrap">
            <div class="help-row">
                <div class="cols cols2">
                    <div class="col">
                        @if ($content['how']->image )
                            <div class="help-image">
                                <figure>
                                    <img src="{{asset('public/images/uploads/'. $content['how']->image)}}" alt="{{$content['how']->image}}">
                                </figure>
                            </div>                            
                        @endif
                    </div>
                    <div class="col">
                        <div class="help-info">
                            @if ($content['how']->heading)
                                <h2>{!!$content['how']->heading!!}</h2>                                
                            @endif
                            @if ($content['how']->description)
                                <p>{{$content['how']->description}}</p>                                
                            @endif
                            @if ($content['how']->help && sizeof($content['how']->help))
                                <ul>
                                    @foreach ($content['how']->help  as $help)
                                        <li>
                                            @if ($help->heading)
                                                <h4>{{$help->heading}}</h4>                                                
                                            @endif
                                            @if ($help->description)
                                                <p>{{$help->description}}</p>                                                
                                            @endif
                                        </li>                                        
                                    @endforeach                                    
                                </ul>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ help section Start-->
    @endif

    @if (isset($content['logos']) && sizeof($content['logos'])) 
    <!--/ brands section Start-->
    <div class="brands-section">
        <div class="wrap">
            <div class="logo-boxes">
                @foreach ($content['logos'] as $logo)
                    <div class="logo-box item">
                        <img src="{{$logo->image ? asset('public/images/uploads/'.$logo->image) : asset('public/home/images/brand-1.png')}}" alt="{{$logo->image}}">
                    </div>
                @endforeach                
            </div>
        </div>
    </div>
    <!--/ brands section End-->
    @endif

@endsection
