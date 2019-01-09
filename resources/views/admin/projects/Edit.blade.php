
@extends('admin.master')
@section('content')
<!-- Main content -->
<!-- <projects></projects> -->

<section class="content">
    <div class="row">
    <div class="col-md-12">

    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Update Form</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="post" action="/projects" role="form">
            <div class="box-body">
                @csrf
                @putch
                <!-- text input -->
                <div class="form-group">
                    <label>Project Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Project Name" value="{{ $project->title }}">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Project Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Project Description">{{ $project->description }}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

                </div>
              </form>

            </div>
            <!-- /.box-body -->
           
        </div>


       
    </div> 
    </div> 
</section>
@endsection


    