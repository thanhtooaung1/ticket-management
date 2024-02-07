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
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="message" class="col-md-4 col-form-label text-md-end">Message</label>
                        <div class="col-md-6">
                            <textarea id="message" type="text" class="form-control @error('title') is-invalid @enderror" name="message"
                                value="{{ old('message') }}" autofocus></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="labels" class="col-md-4 col-form-label text-md-end">Labels</label>
                        <div class="col-md-6">
                            @foreach ($labels as $label)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="labels[]"
                                        value={{ $label->id }}>
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $label->name }}</label>
                                </div>
                            @endforeach
                            @error('labels')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="categories" class="col-md-4 col-form-label text-md-end">Categories</label>
                        <div class="col-md-6">
                            <div>
                                @foreach ($categories as $category)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            name="categories[]" value={{ $category->id }}>
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('categories')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Priority</label>
                        <div class="col-md-6">
                            <select class=" form-control" aria-label="Default select example" name="priority">
                                @foreach ([2 => 'High', 1 => 'Normal', 0 => 'Low'] as $key => $value)
                                    <option value={{ $key }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('priority')
                                <span class="text-danger">{{ $message }}</span>
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
                                <span class="text-danger">{{ $message }}
                                </span>
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
