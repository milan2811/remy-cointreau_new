@extends('layouts.home')

@section('content')    
    <div class="page-content">
        <div class="wrap">
            @if (isset($content['page_content']))
                {!!$content['page_content']!!}
            @endif
        </div>
    </div>
@endsection