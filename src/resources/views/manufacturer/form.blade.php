@extends('layout')
@section('content')
 <h1>{{ $title }}</h1>
 @if ($errors->any())
 <div class="alert alert-danger">Please fix the errors!</div>
 @endif
 <form method="post" action="{{ $manufacturer->exists ? '/manufacturers/patch/' . $manufacturer->id : '/manufacturers/put' }}">
 @csrf
 <div class="mb-3">
 <label for="manufacturer-name" class="form-label">Manufacturer name</label>
 <input
 type="text"
 value="{{ old('name', $manufacturer->name) }}"
 class="form-control @error('name') is-invalid @enderror"
 id="manufacturer-name"
 name="name">
 @error('name')
 <p class="invalid-feedback">{{ $errors->first('name') }}</p>
 @enderror
 </div>
 <button type="submit" class="btn btn-primary">Save</button>
 </form>
@endsection
