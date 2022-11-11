@php
    $type = ['brands' => 'Liqueurs brand', 'ingredients' => 'Non-alcoholic ingredients', 'category' => 'Liqueurs category'];
@endphp
<div>
    <p>Hi, {{ $data->username }}</p>
    <div>
        <h4>Your Request for terms "{{$term->name}}" in "{{$type[$data->request_for]}}" has been Approved</h4>        
    </div>
</div>