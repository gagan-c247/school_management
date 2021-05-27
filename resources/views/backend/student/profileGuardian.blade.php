@extends('backend.backend',['title'=>'Student Profile'])

@section('header')
@endsection         
@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('backend.student.profileSidebar')
        </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Guardian of Student</h4>
            <p class="card-category"> {{$student->name ?? 'Student'}} profile</p>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-5">
                    <label class="bmd-label-floating">Name</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->guardian->name ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-3">
                    <label class="bmd-label-floating">Email</label>
                    <p class="text-white  border-bottom">{{$student->guardian->email ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Contact no.</label>
                    <p class="text-white  border-bottom">{{$student->guardian->mobile ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-6">
                    <label class="bmd-label-floating">Relationship</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->guardian->relationship ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <label class="bmd-label-floating">Address</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->guardian->address ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                    <label class="bmd-label-floating">City</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->guardian->city ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Country</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->guardian->country ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Postalcode</label>
                    <p class="text-white  border-bottom">{{$student->guardian->pincode ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
{{-- Student details END --}}
@endsection
@section('footer')
@endsection