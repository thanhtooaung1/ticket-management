@extends('dashboard.index')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div>
                <div class="card-header bg-dark">Labels</div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($labels as $label)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $label->name }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-outline-warning"
                                                href="{{ route('label.edit', $label->id) }}"><i class="fas fa-pen"></i></a>
                                            {{-- <a class="btn btn-outline-info" href="{{ route('user.show', $user->id) }}"><i
                                                    class="fas fa-info"></i></a> --}}
                                            <form action="{{ route('label.destroy', $label->id) }}" method="POST"
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
