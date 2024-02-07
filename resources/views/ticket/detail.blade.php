@extends('dashboard.index')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div>
                        <div class="card-header bg-dark">
                            <a href="{{ route('ticket.index') }}" class="btn btn-dark btn-sm"><i
                                    class="fas fa-arrow-left"></i></a>
                            Ticket Detail
                        </div>
                        <div class="p-3">
                            <div class="mb-3">
                                <div class="row">
                                    <h3>This is a ticket title</h3>

                                </div>
                                <small>Created by {{ $ticket->user->name }}</small>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <small>Priority:</small>
                                        <div>{{ $ticket->getPriority() }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <small>Status:</small>
                                        <div><span
                                                class="px-2 rounded {{ $ticket->status == 0 ? 'bg-danger' : 'bg-success' }}">
                                                {{ $ticket->getStatus() }}</span></div>
                                    </div>
                                </div>

                            </div>
                            @if (!is_null($ticket->assignedAgent))
                                <div class="mb-3">
                                    <small>Assigned Agent:</small>
                                    <div>{{ $ticket->assignedAgent->name }}</div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <small>Description:</small>
                                <div>{{ $ticket->message }}</div>
                            </div>
                            <div class="mb-3">
                                <small class="fw-bold">Labels:</small>
                                <div>
                                    @foreach ($ticket->labels as $label)
                                        <span class="border px-2 rounded">{{ $label->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="fw-bold">Categories:</small>
                                <div>
                                    @foreach ($ticket->categories as $category)
                                        <span class="border px-2 rounded">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="fw-bold">Images:</small>
                                <div class="d-flex">
                                    @foreach ($ticket->images as $image)
                                        <div class="mx-2"><img width="60px" src={{ $image->imageUrl() }} alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-dark">Comments</div>
                    <div class="p-3">
                        @foreach ($ticket->comments as $comment)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-1"><i class="fas fa-user"></i></div>
                                    <div class="col-md-9">
                                        <div class="font-weight-bold">{{ $comment->user->name }}</div>
                                        <div>{{ $comment->message }}</div>
                                    </div>
                                    <div class="col-md-2">
                                        @if (Auth::user()->id == $comment->user->id)
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                                    class="btn text-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($ticket->status == 1)
                    <div class="card">
                        <div class="p-3">
                            <form method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <input name="ticket_id" type="hidden" value={{ $ticket->id }}>
                                <div class=" mb-3">
                                    <div class="">
                                        <input id="message" type="text"
                                            class="form-control @error('message') is-invalid @enderror" name="message"
                                            value="{{ old('message') }}" placeholder="Enter comment">
                                        @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
