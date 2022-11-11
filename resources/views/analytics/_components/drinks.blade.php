<div class="col-lg-6">
    @if (isset($most_viewed_drinks) && $most_viewed_drinks)
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Most Viewed Drinks</h3>
            <div class="card-tools">
                <a href="{{ route('export', ['type' => 'most_viewed_drink', 'filters' => request()->all()]) }}"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                </a>                                        
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Drinks</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($most_viewed_drinks as $terms)
                        @php
                            $category = $terms->term;
                        @endphp
                        <tr>
                            <td class="d-flex">
                                <img class="img-circle img-size-32 mr-2"
                                        src="{{ $category->picture ? asset('/public/images/terms/picture/' . $category->picture) : asset('/public/images/placeholder.png') }}"
                                        alt="{{ basename($category->picture) }}">
    
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ $terms->total_count }} <i
                                    class="fas fa-eye"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<div class="col-lg-6">
    @if (isset($least_viewed_drinks) && $least_viewed_drinks)
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Drinks</h3>
                <div class="card-tools">
                    <a href="{{ route('export', ['type'=>'least_viewed_drink', 'filters' => request()->all()]) }}"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                               
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Drinks</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($least_viewed_drinks as $terms)
                            @php
                                $category = $terms->term;
                            @endphp
                            @if (isset($category))
                                <tr>
                                    <td class="d-flex">
                                        <img class="img-circle img-size-32 mr-2"
                                            src="{{ $category->picture ? asset('/public/images/terms/picture/' . $category->picture) : asset('/public/images/placeholder.png') }}"
                                            alt="{{ basename($category->picture) }}">
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        {{ $terms->total_count }} <i
                                        class="fas fa-eye"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>