@extends('backend.backend')


@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-plain">
            <div class="card-header card-header-primary">
              <h4 class="card-title mt-0">Course</h4>
              <p class="card-category">Details of Courses</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>{{$course->id ?? ''}}</td>
                            <td>{{$course->name ?? ''}}</td>
                            <td>{{$course->type ?? ''}}</td>
                            <td>{{$course->created_at ?? ''}}</td>
                            <td>
                                <a href="{{route('admin.course.edit',$course->id)}}"><i class="material-icons">edit</i></a>
                                <a href="{{route('admin.course.index')}}"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>   
                    @empty
                        <tr class="text-center">
                            <td colspan="5">
                                Data Not Found!!
                            </td>
                        </tr>
                    @endforelse
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Course</h4>
              <p class="card-category">Details Course</p>
            </div>
            <div class="card-body">
              <form method="Post" action="{{route('admin.course.store')}}">
                  @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Name</label>
                      <input type="text" class="form-control" name="name" value="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="">Type</label>
                      <select name="type" id="" class="form-control">
                          <option value="">Select Type</option>
                          <option value="Class" class="bg bg-dark">Class</option>
                          <option value="Course" class="bg bg-dark">Course</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Description</label>
                      <input type="text" class="form-control" name="description" value="">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
    </div>
  </div>
@endsection