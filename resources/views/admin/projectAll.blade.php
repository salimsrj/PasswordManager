
@extends('admin.master')
@section('content')
<!-- Main content -->
<!-- <projects></projects> -->

<section class="content">
    <div class="row">
    <div class="col-md-12">

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bordered Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <!-- <th style="width: 10px">SL</th> -->
                  <th>Title</th>
                  <th>Users</th>
                  <th>Label</th>
                </tr>
                @foreach( $projects as $project)
                <tr>
                <!-- <th>#</th> -->
                <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                <td>{{ $project->title }}</td>                
                <td>Admin</td>
                <td><a href="/projects/{{ $project->id }}/edit" class="btn btn-success">Edit</a>&nbsp;
                <form class="delete_form" method="post" action="/projects/{{ $project->id }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
                </form>
                </td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            {{ $projects->links() }}
              <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul> -->
            </div>
        </div>


       
    </div> 
    </div> 
</section>
@endsection


    