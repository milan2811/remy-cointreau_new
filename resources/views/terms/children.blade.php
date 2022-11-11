<div class="table-container mt-5">
  @if ($term && $term->children->count() != 0)
  <div class="form-group float-right">
    <a href="{{ route($title . '.create') }}" class="btn btn-block btn-outline-primary">Add Sub {{$title}}</a>
  </div>
  <table id="{{ $title }}-table" class="table table-bordered table-hover" style="width: 100%;">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Slug</th>
        {{-- <th>Date</th> --}}
        <th>Actions</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  @endif
</div>