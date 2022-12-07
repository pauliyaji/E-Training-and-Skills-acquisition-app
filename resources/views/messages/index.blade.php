@extends('layouts/layout')
@section('content')
<iframe src="{{URL::to('/')}}/chatify" width="100%" height="600"></iframe>

@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@yield('scripts')
