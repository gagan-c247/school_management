@extends('backend.backend')


@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0"> Table on Plain Background</h4>
          <p class="card-category"> Here is a subtitle for this table</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="">
                <tr>
                  <th width="10%">ID </th>
                  <th width="30%">Name</th>
                  <th width="20%">Designation</th>
                  <th width="30%">Created At</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($teachers as $teacher)
                  <tr>
                    <td> {{'#'.$teacher->id ?? ''}}</td>
                    <td> 
                      <div class="row">
                        <div class="col-md-2">
                          <img class="rounded-circle" src="{{'/storage/images/'.$teacher->file->filepath ?? ''}}" height="100%" width="55px" alt="">
                        </div>
                        <div class="col-md-10">
                          <h6 class="mb-0 text-capitalize">{{$teacher->name ?? ''}}</h6>
                          <p class="text-lowercase">{{$teacher->email ?? ''}}</p>
                        </div>
                      </div>
                    </td>
                    <td class="text-capitalize">  {{$teacher->designation ?? ''}} </td>
                    <td> {{$teacher->created_at->format('d M Y, H:i A') ?? ''}} </td>
                    <td> 
                      <a href="{{route('admin.teacher.edit',$teacher->id)}}"><i class="material-icons">edit</i></a>  
                      <a href=""><i class="material-icons">delete</i></a>  
                    </td>
                  </tr>
                @empty
                    
                @endforelse
              
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection