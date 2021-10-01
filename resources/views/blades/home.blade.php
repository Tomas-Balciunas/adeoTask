@extends('main')
@section('content')
<div id="cont">
<a href="/api/products">List of products</a>
<form method="POST" action="/api/products/recommendation">
{{csrf_field()}}
    <h4>Choose a city:</h4>
    <input type="text" name="city">
    <button type="submit" name="action" value="search">Search</button>
</form>
</div>
@endsection