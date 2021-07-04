@extends('main')
@section('content')
<a href="/api/products">List of products</a>
<form method="POST" action="/api/products/recommendation">
{{csrf_field()}}
    <input type="text" name="city">
    <button type="submit" name="action" value="search">Search</button>
</form>
@endsection