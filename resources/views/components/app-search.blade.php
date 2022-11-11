<div class="search-section">
    <div class="wrap">
        <div class="search-row">
            {!! Form::open(['url' => url()->current(), 'method' => 'GET', 'id' => 'search-form']) !!}
            <div class="form-group">
                @if (request()->has('ingredients'))
                    {!! Form::hidden('ingredients', request()->get('ingredients')) !!}
                @endif
                @if (isset($bar))
                    {!! Form::hidden('bar_id', $bar->id) !!}
                @endif
                {!! Form::text('search', request()->has('search') ? request()->get('search') : null, ['class' => 'textbox', 'placeholder' => 'Look for your favorite drink....']) !!}
                <a href="javascript:void(0)" class="search-button" onclick="$('#search-form').submit()"><i
                        class="icon-search"></i></a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
