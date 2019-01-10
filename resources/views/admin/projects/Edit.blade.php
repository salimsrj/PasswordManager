
@extends('admin.master')
@section('content')
<!-- Main content -->
<!-- <projects></projects> -->
<section class="content">
    <div class="row">
    <div class="col-md-12">

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    
    @foreach($errors->all() as $error)            
        <div>{{ $error }}</div>            
    @endforeach
    </div>             
    @endif

    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Update Form</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="post" action="/projects/{{ $project->id }}" role="form">
            <div class="box-body">
                @csrf
                @method('PATCH')
                <!-- text input -->
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label>Project Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Project Name" value="{{ $project->title }}">
                </div>
                <!-- textarea -->
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label>Project Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Project Description">{{ $project->description }}</textarea>
                </div>


                <div class="form-group">
                    <label>Authors</label>
                    <select class="form-control" name="authors[]" multiple>
                        <option value="1">Admin</option>
                        <option value="2">Jhon</option>
                        <option value="3">Doe</option>
                        <option value="4">Karim</option>
                        <option value="5">Rahim</option>
                    </select>
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


    