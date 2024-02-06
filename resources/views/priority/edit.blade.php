@extends('dashboard.index')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <a href="{{ route('priority.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-left"></i></a>
                Update Priority
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('priority.update', $priority->id) }}">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $priority->name) }}" autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
