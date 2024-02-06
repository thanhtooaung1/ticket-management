@extends('dashboard.index')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div>
                <div class="card-header bg-dark">
                    <a href="{{ route('user.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-left"></i></a>
                    Create User
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="text"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm
                                Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="text"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}">
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Role</label>
                            <div class="col-md-6">
                                <select class=" form-control" aria-label="Default select example" name="role">
                                    @foreach ([2 => 'Regular', 1 => 'Agent'] as $key => $value)
                                        <option value={{ $key }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
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
    </div>
@endsection
