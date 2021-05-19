@extends('backend.backend',['title'=>'Roles'])
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Role</h4>
              <p class="card-category">Details Role</p>
            </div>
            <div class="card-body">
              {{-- <form method="Post" action="{{route('course.store')}}"> --}}
                {!!Form::model($role,[
                    'route'=> $role->exists ? ['admin.role.update',$role->id] : ['admin.role.store'],
                    'method'=>$role->exists ? 'PUT' : 'POST',
                    'files'=>true,
                    'id'=>'role_form_id'
                ])!!}  
                  @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Role</label>
                      <input type="text" class="form-control" name="name" value="{{$role->name ?? ''}}">
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="">Role for</label>
                      <select name="type" id="" class="form-control type">
                          <option value="">Select Type</option>
                          <option value="web" class="bg bg-dark" {{$role->guard_name == 'web' ? 'selected' : ''}}>web</option>
                          <option value="teacher" class="bg bg-dark" {{$role->guard_name == 'teacher' ? 'selected' : ''}}>teacher</option>
                          <option value="student" class="bg bg-dark" {{$role->guard_name == 'student' ? 'selected' : ''}}>student</option>
                      </select>
                      @error('type')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      @if(isset($permissions))
                        @foreach ($permissions as $permission)
                          <input type="checkbox" name="permission[]"  value="{{$permission->name}}" 
                          @foreach ($rolePermissions as $rolePermission)
                            @if($permission->id == $rolePermission)
                              {{'checked'}}
                            @endif
                          @endforeach
                          > {{$permission->name ?? ''}} <br>
                        @endforeach
                      @else
                        <div class="permission"></div>
                      @endif
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
              <h4 class="card-title mt-0">Role</h4>
              <p class="card-category">Details of Role</p>
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
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{$role->id ?? ''}}</td>
                            <td>{{$role->name ?? ''}}</td>
                            <td>{{$role->guard_name ?? ''}}</td>
                            <td>{{$role->created_at->format('d M Y,h:i A') ?? ''}}</td>
                            <td>
                                <a href="{{route('admin.role.edit',$role->id)}}"><i class="material-icons">edit</i></a>
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
@section('footer')
<script>
    //  $(document).on('change','.type',
   var guardSearch = function(){
        var type = $('.type').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          url : '{{route("admin.permissionSearch")}}',
          method : 'post',
          datatype : 'JSON',
          data : {_token:'{{csrf_token()}}',type:type},
          success:function(data){
            if(data.status == 'success'){
              console.log(data.permissions);
              $('.permission').html(data.permissions);
            }
          }
        }); 
    }
    $('.type').change(guardSearch);
    $('.type').hover(guardSearch);
  
   

    //  });
</script>
    
@endsection