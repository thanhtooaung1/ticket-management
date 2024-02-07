@extends('dashboard.index')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <a href="{{ route('ticket.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-left"></i></a>
                Edit Ticket
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('ticket.update', $ticket->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title', $ticket->title) }}" autofocus>
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
                            <textarea id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message"
                                value="" autofocus>{{ old('message', $ticket->message) }}</textarea>
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
                                        value={{ $label->id }} {{ $ticket->labels->contains($label) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $label->name }}</label>
                                </div>
                            @endforeach


                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="categories" class="col-md-4 col-form-label text-md-end">Categories</label>
                        <div class="col-md-6">
                            @foreach ($categories as $category)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="categories[]"
                                        value={{ $category->id }}
                                        {{ $ticket->categories->contains($category) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $category->name }}</label>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    @if (Auth::user()->isAdmin())
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Assigned User</label>
                            <div class="col-md-6">
                                <select class=" form-control" aria-label="Default select example" name="assigned_user_id">
                                    <option value="">Select agent</option>
                                    @foreach ($agents as $agent)
                                        <option value={{ $agent->id }}
                                            {{ $agent->id == $ticket->assigned_user_id ? 'selected' : '' }}>
                                            {{ $agent->name }}</option>
                                    @endforeach
                                </select>
                                @error('assigned_user_id')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Priority</label>
                        <div class="col-md-6">
                            <select class=" form-control" aria-label="Default select example" name="priority">
                                @foreach ([2 => 'High', 1 => 'Normal', 0 => 'Low'] as $key => $value)
                                    <option value={{ $key }} {{ $key == $ticket->priority ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            @error('priority')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Status</label>
                        <div class="col-md-6">
                            @foreach ([0 => 'Close', 1 => 'Open'] as $key => $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                        value={{ $key }} {{ $ticket->status == $key ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">{{ $value }}</label>
                                </div>
                            @endforeach
                            @error('status')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end"></label>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start">
                                @foreach ($ticket->images as $image)
                                    <div class="mx-1"><img width="50px" height="50px" class="rounded-circle"
                                            src={{ $image->imageUrl() }} alt=""></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Images</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="inputGroupFile02" multiple name="images[]"
                                    value="{{ old('images[]', $ticket->images) }}">
                                {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
                            </div>
                            @error('priority')
                                <span class="text-danger">
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
