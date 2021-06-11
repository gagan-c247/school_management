@extends('backend.backend')


@section('content')
<div class="row">
  <div class="col-md-4">
    @can('course-create')
      <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Course</h4>
            <p class="card-category">Details Course</p>
          </div>
          <div class="card-body">
            {!!Form::model($course,[
              'route'=> $course->exists ? ['admin.course.update',$course->id] : ['admin.course.store'],
              'method'=> $course->exists ? 'PUT' : 'POST',
              'id'=> 'course_form_id',
              'files' => true,
            ]) !!}
            {{-- <form method="Post" action="{{route('admin.course.store')}}"> --}}
                @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$course->name ?? ''}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="">Type</label>
                    <select name="type" id="" class="form-control">
                        <option value="">Select Type</option>
                        <option value="Class" class="bg bg-dark" {{$course->type == 'Class'? 'selected' : ''}}>Class</option>
                        <option value="Course" class="bg bg-dark" {{$course->type == 'Course'? 'selected' : ''}}>Course</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Description</label>
                    <input type="text" class="form-control" name="description" value="{{$course->description ?? ''}}">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
              <div class="clearfix"></div>
            {{-- </form> --}}
            {{Form::close()}}
          </div>
      </div>
    @endcan 
  </div>
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
                            <td>{{$course->created_at->format('d M Y, h:i A') ?? ''}}</td>
                            <td>
                                @can('course-edit')<a href="{{route('admin.course.edit',$course->id)}}"><i class="material-icons">edit</i></a>@endcan
                                @can('course-destroy')<a href="#" data-id="{{$course->id}}" class="delete"><i class="material-icons">delete</i></a>@endcan
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

                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <li class="page-item">
                      <a class="page-link" href="{{$courses->previousPageUrl()}}" tabindex="-1">Previous</a>
                    </li>
                    @for($i=1;$i<=$courses->lastPage();$i++)
                    <li class="page-item"><a class="page-link" href="{{$courses->url($i)}}">{{$i}}<a></li>
                    @endfor
                    <li class="page-item">
                      <a class="page-link" href="{{$courses->nextPageUrl()}}">Next</a>
                    </li>
                  </ul>
                </nav>

              </div>
            </div>
          </div>
    </div>
   
  </div>
@endsection
@section('footer')
<script>
  $(document).on('click','.delete',function(){
   var id = $(this).attr("data-id");
    var dataHtml =   $(this).closest('tr');

   var confirem = confirm("Are You Sure? You want to delete!");

    if(confirem){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url : '/home/course/'+id,
        method: 'delete',
        data: {
            "_token": "{{ csrf_token() }}",
            "id": id
            },
        success:function(data){
            // console.log(data.status == 'success');
          if(data.status == 'success'){
            dataHtml.remove();
          }
        }
      });
    }
   
  });
</script>
  
@endsection