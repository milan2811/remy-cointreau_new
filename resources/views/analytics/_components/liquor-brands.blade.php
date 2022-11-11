 <div class="col-lg-6">
     <!-- Brands Analytics -->
     @if (isset($most_viewed_brands) && $most_viewed_brands->count())
     <div class="card">
         <div class="card-header border-0">
             <h3 class="card-title">Most Viewed Brands</h3>
             <div class="card-tools">
                 <a href="{{ route('export', ['type' => 'most_viewed_brands', 'filters' => request()->all()]) }}" target="_blank"
                    title="Download as CSV" class="btn btn-tool btn-sm">
                     <i class="fas fa-download"></i>
                 </a>                                                
             </div>
         </div>
         <div class="card-body table-responsive p-0">
             <table class="table table-striped table-valign-middle">
                 <thead>
                     <tr>
                         <th>Brand</th>
                         <th>Views</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($most_viewed_brands as $terms)
                         @php
                             $brand = $terms->term;
                         @endphp
                         <tr>
                             <td class="d-flex">                                                                    
                                 {{ $brand ? $brand->name : null }}
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
    @if (isset($least_viewed_brands) && $least_viewed_brands->count())
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Brands</h3>
                <div class="card-tools">
                    <a href="{{ route('export', ['type' => 'least_viewed_brands', 'filters' => request()->all()]) }}"
                    target="_blank" title="Download as CSV"
                    class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                                           
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($least_viewed_brands as $terms)
                            @php
                                $brand = $terms->term;
                            @endphp
                            <tr>
                                <td class="d-flex">                                                                    
                                    {{ $brand->name }}
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
    <!-- ./Brands Analytics -->
 </div>