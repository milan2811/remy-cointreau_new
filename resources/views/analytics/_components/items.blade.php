<div class="col-lg-6">
    @if (isset($most_viewed) && $most_viewed)
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Most Viewed Items</h3>
            <div class="card-tools">
                <a href="{{ route('export', ['type' => 'most_viewed_items', 'filters' => request()->all()]) }}"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Bar/Restaurant</th>
                        <th>Price</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($most_viewed as $items)
                        @php
                            $item = $items->item;
                            $image = json_decode($item->media);
                        @endphp
                        <tr>
                            <td class="d-flex">
                                <img class="img-circle img-size-32 mr-2"
                                        src="{{ $image ? asset('public/images/items/' . $image[0]) : asset('/public/images/placeholder.png') }}"
                                        alt="{{ $image ? $image[0] : null }}">
                                <a
                                    href="{{ route('items.edit', ['item' => $item->id, 'bar' => $item->bar ? $item->bar->id : null, 'analytics' => 1]) }}">{{ $item->name }}</a>
                            </td>
                            <td>
                                @if ($item->bar)
                                    <a
                                        href="{{ route('bars.edit', ['bar' => $item->bar->id, 'analytics' => 1]) }}">{{ $item->bar->name }}</a>
                                @endif
                            </td>
                            <td>{{ getItemPriceRange($item) }}</td>
                            <td class="text-center">
                                {{ $items->total_count }} <i
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
    @if (isset($least_viewed) && $least_viewed)
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Least Viewed Items</h3>
                <div class="card-tools">
                    <a href="{{ route('export', ['type' => 'least_viewed_items', 'filters' => request()->all()]) }}"
                    target="_blank" title="Download as CSV" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>                                          
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Bar/Restaurant</th>
                            <th>Price</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($least_viewed as $items)
                            @php
                                $item = $items->item;
                                $image = json_decode($item->media);
                            @endphp
                            <tr>
                                <td class="d-flex">
                                    <img class="img-circle img-size-32 mr-2"
                                        src="{{ $image ? asset('public/images/items/' . $image[0]) : asset('/public/images/placeholder.png') }}"
                                        alt="{{ $image ? $image[0] : null }}">
                                    <a
                                    href="{{ route('items.edit', ['item' => $item->id, 'bar' => $item->bar ? $item->bar->id : '', 'analytics' => 1]) }}">{{ $item->name }}</a>
                                </td>
                                <td>
                                    @if ($item->bar)
                                        <a
                                        href="{{ route('bars.edit', ['bar' => $item->bar->id, 'analytics' => 1]) }}">{{ $item->bar->name }}</a>
                                    @endif
                                </td>
                                <td>{{ getItemPriceRange($item) }}</td>
                                <td class="text-center">
                                    {{ $items->total_count }} <i
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