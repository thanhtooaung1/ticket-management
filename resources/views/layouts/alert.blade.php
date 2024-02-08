@if (session('create'))
    <div class="alert alert-success" role="alert">
        {{ session('create') }}
    </div>
@elseif (session('update'))
    <div class="alert alert-info" role="alert">
        {{ session('update') }}
    </div>
@elseif (session('delete'))
    <div class="alert alert-danger" role="alert">
        {{ session('delete') }}
    </div>
@endif
