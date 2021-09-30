@extends('main')
@section('content')
<div id="cont">
@if(!empty($errors->first()))
    <div class="row col-lg-12">
        <div class="alert alert-danger">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif
<a href="/api/products">List of products</a>
<form method="POST" action="/api/products/recommendation">
{{csrf_field()}}
    <h4>Choose a city:</h4>
    <input type="text" name="city">
    <button type="submit" name="action" value="search">Search</button>
</form>
</div>
@endsection