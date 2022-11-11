@extends('layouts.admin')

@section('content')
    @php
    $user = auth()->user();
    @endphp
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {!! Form::model($home, ['url' => route('page.update', 'contact'), 'class' => 'repeater', 'method' => 'POST', 'files' => true]) !!}
            <div class="row">
                <div class="col-12">
                    {{-- Banner Section --}}
                    <div class="accordion" id="banner-accordian">
                        <div class="card">
                            <div class="card-header" id="banner-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#banner-collapse">
                                        <h4>Banner Section</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="banner-collapse" class="collapse" aria-labelledby="banner-heading"
                                data-parent="#banner-accordian">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('banner-title', 'Title') !!}
                                        <div class="input-group">
                                            {!! Form::text('banner[title]', null, ['class' => 'form-control', 'id' => 'banner-title']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('banner-heading', 'Heading') !!}
                                        <div class="input-group">
                                            {!! Form::text('banner[heading]', null, ['class' => 'form-control', 'id' => 'banner-heading']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('banner-description', 'Description') !!}
                                        <div class="input-group">
                                            {!! Form::textarea('banner[description]', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                        </div>
                                    </div>                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Banner Section --}}

                    <div class="accordion" id="logos-accordian">
                        <div class="card">
                            <div class="card-header" id="logos-heading">
                                <h2 class="mb-0">
                                    <button type="button" class="btn d-flex justify-content-between w-100"
                                        data-toggle="collapse" data-target="#logos-collapse">
                                        <h4>Logos</h4>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="logos-collapse" class="collapse" aria-labelledby="logos-heading"
                                    data-parent="#logos-accordian">
                                <div class="card-body">
                                    <div class="bars table-responsive">                                        
                                        <table class="table sortable-table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="10px">#</th>
                                                    <th>Image</th>                                                    
                                                    <th width="10px"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-list" data-repeater-list="logos">
                                                @if (isset($home) && isset($home['logos']))
                                                    @foreach ($home['logos'] as $logo)
                                                        <tr class="sortable-item" data-repeater-item>
                                                            <td><i class="fa fa-bars"></i></td>
                                                            <td><label>
                                                                <img src="{{isset($logo->image) && $logo->image ? asset('public/images/uploads/'. $logo->image) : asset('public/images/placeholder.png')}}" width="150" height="100" alt="">
                                                                {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                                {!! Form::hidden('image_name', isset($logo->image) ? $logo->image : null) !!}
                                                            </label> </td>                                                            
                                                            <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                        </tr>    
                                                    @endforeach
                                                @else
                                                    <tr class="sortable-item" data-repeater-item>
                                                        <td><i class="fa fa-bars"></i></td>
                                                        <td><label>
                                                            <img src="{{asset('public/images/placeholder.png')}}" width="150" height="100" alt="">
                                                            {!! Form::file('image', ['class' => 'form-control d-none', 'accept' => 'image/*']) !!}
                                                            {!! Form::hidden('image_name', null) !!}
                                                        </label> </td>                                                       
                                                        <td><button class="btn btn-danger remove" data-repeater-delete type="button"> - </button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="text-right">
                                            <button class="btn btn-secondary add" data-repeater-create type="button">
                                                + Add
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>                        
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-right">
                                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .accordion {
            margin: 15px;
        }

        .accordion .fa {
            margin-right: 0.2rem;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which
            // is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa")
                    .addClass("fa-minus").removeClass("fa-plus");
            });
            // Toggle plus minus icon on show hide
            // of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa")
                    .removeClass("fa-minus").addClass("fa-plus");
            });


            $(document).ready(function() {

                const repeater = $('.repeater .table-responsive').repeater({
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    ready: function (setIndexes) {

                    }
                });

                $('.repeater').submit(() => {
                    $('.repeater .table-responsive').repeater();
                })

                // let repeaterHTML = $(".bars.table-responsive .sortable-table tbody tr:first").parent().html();
                // let featureRepeaterHtml = $(".feature.table-responsive .sortable-table tbody tr:first").parent().html();
                // let helpRepeaterHtml = $(".help.table-responsive .sortable-table tbody tr:first").parent().html();
                
                $('.sortable-table .sortable-list').sortable({
                    connectWith: '.sortable-table .sortable-list',
                    placeholder: 'placeholder',   
                    helper: (e, ui) => {
                        ui.children().each(function() {
                            $(this).width($(this).width());                        
                        });
                        return ui;
                    },
                    start: (e, ui) => {
                        ui.placeholder.height(ui.item.height());
                        ui.placeholder.width(ui.item.width());
                    }        
                });

                function fixWidthHelper(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());                        
                    });
                    return ui;
                }

                $(document).on("change", 'input[accept="image/*"]', (e) => {                    
                    if(e.target.files[0]) {
                        let url = URL.createObjectURL(e.target.files[0]);
                        console.log($(e.target).prev());
                        $(e.target).prev().attr('src', url);
                    }
                });

                // $(".add").click((e) =>  {
                //     e.preventDefault();                    
                //     let table = $(e.target).closest(".table-responsive");
                //     if(table.attr("class").includes("feature")) {
                //         table.find("tbody").append(featureRepeaterHtml)
                //         table.find("tbody tr:last input").val("")
                //     } else if(table.attr("class").includes("help")) {
                //         table.find("tbody").append(helpRepeaterHtml)
                //         table.find("tbody tr:last input").val("")
                //     } else {
                //         table.find("tbody").append(repeaterHTML)                    
                //         table.find("tbody tr:last input").val("")
                //     }
                // })

                // $(document).on("click", "button.remove", (e) => {
                //     e.preventDefault();
                //     console.log(e);
                //     $(e.target).closest("tr").remove();
                // });

            });
        });
    </script>
@endsection
