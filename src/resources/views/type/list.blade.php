@extends('layout')
@section('content')
 <h1>{{ $title }}</h1>
 @if (count($items) > 0)
 <table class="table table-striped table-hover table-sm">
 <thead class="thead-light">
 <tr>
 <th>ID</td>
<th>Name</td>
<th>&nbsp;</td>
 </tr>
 </thead>
 <tbody>
 @foreach($items as $type)
 <tr>
 <td>{{ $type->id }}</td>
 <td>{{ $type->name }}</td>
 <td><a href="/types/update/{{ $type->id }}" class="btn btn-outline-primary btnsm">Edit</a>
 <form action="/types/delete/{{ $type->id }}" method="post" class="deletion-form d-inline">
 @csrf
 <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
</form>
</td>
 </tr>
 @endforeach
 </tbody>
 </table>
 @else
 <p>No entries found in database</p>
 @endif
 <a href="/types/create" class="btn btn-primary">Add new</a>
 
@endsection
