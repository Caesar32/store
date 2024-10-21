@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session->has('info'))
    <div
     class="alert alert-info">
    </div>
@endif
