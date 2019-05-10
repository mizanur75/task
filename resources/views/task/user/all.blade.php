@extends('layouts.user.app')

@push('css')

<link rel="stylesheet" href="{{asset('task/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endpush

@section('content')
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>File</th>
                  <th>Asigned User</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                <tr>
                  
                  <td>{{$task->id}}</td>
                  <td>{{$task->title}}</td>
                  <td>{{$task->description}}</td>
                  <td><a href="{{asset('uploads/'.$task->file)}}" target="_blank">{{$task->file}}</a></td>
                  <td>{{$task->user->name}}</td>
                  <td>
                    @if($task->status==1)
                        <span class="badge bg-yellow">pending</span>
                        @elseif($task->status==2)
                        <span class="badge bg-green">Completed</span>
                        @else
                        <span class="badge bg-red">Failed</span>
                    @endif
                  </td>
                  <td>
                    <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                  
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
@endsection

@push('scripts')


<script src="{{asset('task/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('task/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush