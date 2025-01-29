@extends('layout')
@section('content')
<h1>{{ $title }}</h1>
@if ($errors->any())
 <div class="alert alert-danger">Please fix the validation errors!</div>
@endif
<form
 method="post"
 action="{{ $car->exists ? '/cars/patch/' . $car->id : '/cars/put' }}">
 @csrf
 <div class="mb-3">
 <label for="car-name" class="form-label">Name</label>
 <input
 type="text"
 id="car-name"
 name="name"
 value="{{ old('name', $car->name) }}"
 class="form-control @error('name') is-invalid @enderror"
 >
 @error('name')
 <p class="invalid-feedback">{{ $errors->first('name') }}</p>
 @enderror
 </div>
 <div class="mb-3">
 <label for="car-manufacturer" class="form-label">Manufacturer</label>
 <select
 id="car-manufacturer"
 name="manufacturer_id"
 class="form-select @error('manufacturer_id') is-invalid @enderror"
 >
 <option value="">Choose the manufacturer!</option>
 @foreach($manufacturers as $manufacturer)
 <option
 value="{{ $manufacturer->id }}"
 @if ($manufacturer->id == old('manufacturer_id', $car->manufacturer-
>id ?? false)) selected @endif
 >{{ $manufacturer->name }}</option>
 @endforeach
 </select>
 @error('manufacturer_id')
 <p class="invalid-feedback">{{ $errors->first('manufacturer_id') }}</p>
 @enderror
 </div>
 <div class="mb-3">
 <label for="book-description" class="form-label">Description</label>
 <textarea
 id="book-description"
 name="description"
 class="form-control @error('description') is-invalid @enderror"
 >{{ old('description', $book->description) }}</textarea>
 @error('description')
 <p class="invalid-feedback">{{ $errors->first('description') }}</p>
 @enderror
 </div>
 <div class="mb-3">
 <label for="car-year" class="form-label">Release year</label>
 <input
 type="number" max="{{ date('Y') + 1 }}" step="1"
 id="car-year"
 name="year"
 value="{{ old('year', $book->year) }}"
 class="form-control @error('year') is-invalid @enderror"
 >
 @error('year')
 <p class="invalid-feedback">{{ $errors->first('year') }}</p>
 @enderror
 // image
 <div class="mb-3">
 <div class="form-check">
 <input
 type="checkbox"
 id="car-on_the_road"
 name="on_the_road"
 value="1"
 class="form-check-input @error('on_the_road') is-invalid @enderror"
 @if (old('on_the_road', $car->on_the_road)) checked @endif
 >
 <label class="form-check-label" for="car-on_the_road">
 Publish
 </label>
 @error('on_the_road')
 <p class="invalid-feedback">{{ $errors->first('on_the_road') }}</p>
 @enderror
 </div>
 </div>
 <button type="submit" class="btn btn-primary">
 {{ $car->exists ? 'Update' : 'Create' }}
 </button>
</form>
@endsection