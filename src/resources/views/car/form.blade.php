@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">Please fix the validation errors!</div>
@endif

<form method="post" action="{{ $car->exists ? '/cars/patch/' . $car->id : '/cars/put' }}" enctype="multipart/form-data">
    @csrf

    <!-- Manufacturer Dropdown -->
    <div class="mb-3">
        <label for="car-manufacturer" class="form-label">Manufacturer</label>
        <select id="car-manufacturer" name="manufacturer_id" class="form-select @error('manufacturer_id') is-invalid @enderror">
            <option value="">Choose the manufacturer!</option>
            @foreach($manufacturers as $manufacturer)
                <option value="{{ $manufacturer->id }}" @if ($manufacturer->id == old('manufacturer_id', $car->manufacturer_id)) selected @endif>
                    {{ $manufacturer->name }}
                </option>
            @endforeach
        </select>
        @error('manufacturer_id')
            <p class="invalid-feedback">{{ $errors->first('manufacturer_id') }}</p>
        @enderror
    </div>

    <!-- Model Input -->
    <div class="mb-3">
        <label for="car-model" class="form-label">Model</label>
        <input type="text" id="car-model" name="model" value="{{ old('model', $car->model) }}" class="form-control @error('model') is-invalid @enderror">
        @error('model')
            <p class="invalid-feedback">{{ $errors->first('model') }}</p>
        @enderror
    </div>

    <!-- Year Input -->
    <div class="mb-3">
        <label for="car-year" class="form-label">Year</label>
        <input type="number" id="car-year" name="year" value="{{ old('year', $car->year) }}" class="form-control @error('year') is-invalid @enderror">
        @error('year')
            <p class="invalid-feedback">{{ $errors->first('year') }}</p>
        @enderror
    </div>

    <!-- On The Road Checkbox -->
    <div class="mb-3">
    <div class="form-check">
        <!-- Hidden input to ensure a value is always submitted -->
        <input type="hidden" name="on_the_road" value="0">
        <!-- Checkbox input -->
        <input
            type="checkbox"
            id="car-on_the_road"
            name="on_the_road"
            value="1"
            class="form-check-input @error('on_the_road') is-invalid @enderror"
            @if (old('on_the_road', $car->on_the_road ?? false)) checked @endif
        >
        <label class="form-check-label" for="car-on_the_road">MOT</label>
        @error('on_the_road')
            <p class="invalid-feedback">{{ $errors->first('on_the_road') }}</p>
        @enderror
    </div>
</div>
    <!-- Type Dropdown -->
    <div class="mb-3">
    <label for="car-type" class="form-label">Type</label>
    <select id="car-type" name="type_id" class="form-select @error('type_id') is-invalid @enderror">
        <option value="">Choose the type!</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}" @if ($type->id == old('type_id', $car->type_id)) selected @endif>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
    @error('type_id')
        <p class="invalid-feedback">{{ $errors->first('type_id') }}</p>
    @enderror
</div>

    <!-- Image Input -->
    <div class="mb-3">
    <label for="car-image" class="form-label">Image</label>
    
    @if ($car->image)
        <img 
            src="{{ asset('images/' . $car->image) }}" 
            class="img-fluid img-thumbnail d-block mb-2" 
            alt="{{ $car->model }}"
        >
    @endif

    <input 
        type="file" 
        accept="image/png, image/webp, image/jpeg" 
        id="car-image" 
        name="image" 
        class="form-control @error('image') is-invalid @enderror"
    >

    @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        {{ $car->exists ? 'Update' : 'Create' }}
        
    </button>
</form>
@endsection