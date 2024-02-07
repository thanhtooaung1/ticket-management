@extends('dashboard.index')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div>
                <div class="card-header bg-dark">Tickets</div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Title</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                                <th scope="col">Priority</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>
                                        <span class="px-2 rounded {{ $ticket->status == 0 ? 'bg-danger' : 'bg-success' }}">
                                            {{ $ticket->getStatus() }}</span>
                                    </td>
                                    <td>{{ $ticket->getPriority() }}</td>
                                    <td>
                                        <div class="text-center">
                                            @if (Auth::user()->role != 2)
                                                <a class="btn btn-outline-warning"
                                                    href="{{ route('ticket.edit', $ticket->id) }}"><i
                                                        class="fas fa-pen"></i></a>
                                            @endif

                                            <a class="btn btn-outline-info"
                                                href="{{ route('ticket.show', $ticket->id) }}"><i
                                                    class="fas fa-info"></i></a>
                                            {{-- @if (Auth::user()->role != 2) --}}
                                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            {{-- @endif --}}

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
