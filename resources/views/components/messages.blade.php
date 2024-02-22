@if(session('success'))
    <div class="alert alert-success text-right">{{session('success')}}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-right">{{session('error')}}</div>
@endif

@if(session('message'))
    <div class="alert alert-info text-right">{{session('message')}}</div>
@endif
