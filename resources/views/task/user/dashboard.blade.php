@extends('layouts.user.app')

@push('css')

<link rel="stylesheet" href="{{asset('task/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endpush

@section('content')

@endsection

@push('scripts')


<script src="{{asset('task/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('task/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

@endpush