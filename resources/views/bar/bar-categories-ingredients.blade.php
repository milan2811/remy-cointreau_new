<div class="row">
  <div class="col-6">
    <div class="form-group">
      {!! Form::label('category', 'Category') !!}
      <div class="input-group">
        {!! Form::select('category', $categories, null, ['class' => 'form-control select2-cat', 'id' => 'category', 'data-placeholder' => 'Select Category', 'required' => true]) !!}
      </div>
      @error('category')
        <span class="invalid-feedback d-block" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      {!! Form::label('ingredients', 'Ingredients') !!}
      <div class="input-group">
        {!! Form::select('ingredients[]', $ingredients, null, ['class' => 'form-control select2-cat', 'id' => 'ingredients', 'data-placeholder' => 'Select Ingredients', 'multiple' => true, 'required' => true]) !!}
      </div>
      @error('ingredients')
        <span class="invalid-feedback d-block" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.select2-cat').select2({
      theme: 'bootstrap4',
    });
  });
</script>
