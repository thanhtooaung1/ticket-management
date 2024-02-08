@extends('dashboard.index')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <a href="{{ route('ticket.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-left"></i></a>
                Create Ticket
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" autofocus>
                            @error('title')
                                <span class="text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="message" class="col-md-4 col-form-label text-md-end">Message</label>
                        <div class="col-md-6">
                            <textarea id="message" type="text" class="form-control @error('title') is-invalid @enderror" name="message">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="labels" class="col-md-4 col-form-label text-md-end">Labels</label>
                        <div class="col-md-6">
                            <div>
                                @foreach ($labels as $label)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="{{ $label->id }}"
                                            name="labels[]" value={{ $label->id }}
                                            @if (in_array($label->id, old('labels') ?? [])) checked @endif>
                                        <label class="form-check-label"
                                            for="{{ $label->id }}">{{ $label->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('labels')
                                <small class="text-danger" role="alert">{{ $message }}
                                </small>
                            @enderror
                        </div>


                    </div>
                    <div class="row mb-3">
                        <label for="categories" class="col-md-4 col-form-label text-md-end">Categories</label>
                        <div class="col-md-6">
                            <div>
                                @foreach ($categories as $category)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="{{ $category->id }}"
                                            name="categories[]" value={{ $category->id }}
                                            @if (in_array($category->id, old('categories') ?? [])) checked @endif>
                                        <label class="form-check-label"
                                            for="{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach

                            </div>
                            @error('categories')
                                <small class="text-danger" role="alert">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Priority</label>
                        <div class="col-md-6">
                            <select class=" form-control" aria-label="Default select example" name="priority">
                                @foreach ([2 => 'High', 1 => 'Normal', 0 => 'Low'] as $key => $value)
                                    <option value={{ $key }} {{ old('priority') == $key ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            @error('priority')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Images</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="inputGroupFile02" multiple name="images[]">
                                {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
                            </div>
                            @error('images')
                                <small class="text-danger">{{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
