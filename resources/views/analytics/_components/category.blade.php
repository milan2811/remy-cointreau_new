<div class="col-lg-6">                                   
    @if (isset($most_viewed_category) && $most_viewed_category)
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Most Viewed Category</h3>
                <div class="card-tools">
                    <a href="{{ route('export', ['type' => 'most_viewed_category', 'filters' => request()->all()]) }}"
                        target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                                    
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($most_viewed_category as $terms)
                            @php
                                $category = $terms->term;
                            @endphp
                            <tr>
                                <td class="d-flex">                                                                    
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
    @if (isset($least_viewed_category) && $least_viewed_category)
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Category</h3>
                <div class="card-tools">
                    <a href="{{ route('export', ['type' => 'least_viewed_category', 'filters' => request()->all()]) }}"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                                                   
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($least_viewed_category as $terms)
                            @php
                                $category = $terms->term;
                            @endphp
                            @if (isset($category))
                                <tr>
                                    <td class="d-flex">                                                                        
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

