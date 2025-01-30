@extends('layout')
@section('content')
 <h1>{{ $title }}</h1>
 @if ($errors->any())
 <div class="alert alert-danger">Please fix the errors!</div>
 @endif
 <form method="post" action="{{ $type->exists ? '/types/patch/' . $type->id : '/types/put' }}">
 @csrf
 <div class="mb-3">
 <label for="type-name" class="form-label">Type name</label>
 <input
 type="text"
 value="{{ old('name', $type->name) }}"
 class="form-control @error('name') is-invalid @enderror"
 id="type-name"
 name="name">
 @error('name')
 <p class="invalid-feedback">{{ $errors->first('name') }}</p>
 @enderror
 </div>
 <button type="submit" class="btn btn-primary">Save</button>
 </form>
@endsection
