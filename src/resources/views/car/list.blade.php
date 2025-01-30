@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
    <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Year</th>
                <th>MOT</th>
                <th>Type</th>
                <th>Image</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->manufacturer->name }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{!! $car->on_the_road ? '&#x2714;' : '&#x274C;' !!}</td>
                    <td>{{ $car->type->name }}</td>
                    <td>
                    @if ($car->image)
        <img src="{{ asset('images/' . $car->image) }}" alt="Car Image" style="max-width: 100px;">
    @else
        No Image
    @endif
                    </td>
                    <td>
                        <a href="/cars/update/{{ $car->id }}" class="btn btn-outline-primary btn-sm">Edit</a> /
                        <form method="post" action="/cars/delete/{{ $car->id }}" class="d-inline deletion-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No entries found in the database.</p>
@endif

<a href="/cars/create" class="btn btn-primary">Add New Car</a>
@endsection