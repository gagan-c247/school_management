@extends('backend.backend',['title'=>'Roles'])
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Permission</h4>
              <p class="card-category">Details Permission</p>
            </div>
            <div class="card-body">
              {{-- <form method="Post" action="{{route('course.store')}}"> --}}
                {!!Form::model($permission,[
                    'route'=> $permission->exists ? ['admin.permission.update',$permission->id] : ['admin.permission.store'],
                    'method'=>$permission->exists ? 'PUT' : 'POST',
                    'files'=>true,
                    'id'=>'role_form_id'
                ])!!}  
                  @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Permission</label>
                      <input type="text" class="form-control" name="name" value="{{$permission->name ?? ''}}">
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="">permission for</label>
                      <select name="type" id="" class="form-control">
                          <option value="" class="bg bg-dark" >Select Type</option>
                          <option value="web" class="bg bg-dark" {{$permission->guard_name == 'web' ? 'selected' : ''}}>web</option>
                          <option value="teacher" class="bg bg-dark" {{$permission->guard_name == 'teacher' ? 'selected' : ''}}>teacher</option>
                          <option value="student" class="bg bg-dark" {{$permission->guard_name == 'student' ? 'selected' : ''}}>student</option>
                      </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                <div class="clearfix"></div>
              {{-- </form> --}}
              {{Form::close()}}
            </div>
          </div>
    </div>
    <div class="col-md-8">
        <div class="card card-plain">
            <div class="card-header card-header-primary">
              <h4 class="card-title mt-0">Permission</h4>
              <p class="card-category">Details of Permission</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Permission Name</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{$permission->id ?? ''}}</td>
                            <td>{{$permission->name ?? ''}}</td>
                            <td>{{$permission->guard_name ?? ''}}</td>
                            <td>{{$permission->created_at->format('d M Y,h:i A') ?? ''}}</td>
                            <td>
                                <a href="{{route('admin.permission.edit',$permission->id)}}"><i class="material-icons">edit</i></a>
                                <a href=""><i class="material-icons">delete</i></a>
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
  
  </div>
@endsection