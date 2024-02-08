@extends('dashboard.index')

@section('content')
    <div>
        @include('layouts.alert')
        <div class="card">
            <div>
                <div class="card-header bg-dark">Users</div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->getRole() }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-outline-warning" href="{{ route('user.edit', $user->id) }}"><i
                                                    class="fas fa-pen"></i></a>
                                            {{-- <a class="btn btn-outline-info" href="{{ route('user.show', $user->id) }}"><i
                                                    class="fas fa-info"></i></a> --}}
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
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
