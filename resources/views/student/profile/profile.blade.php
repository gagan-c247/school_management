@extends('student.studentLayout',['title'=>'Profile'])
@section('header')
    <style>
        /* .dateclass.placeholderclass::before {
            width: 100%;
            content: attr(placeholder);
        }

        .dateclass.placeholderclass:hover::before {
        width: 0%;
        content:attr(placeholder);
        } */
    </style>
    <style>
        .profile-pic {
            /* max-width: 200px; */
            max-height: 200px;
            display: block;
        }
        
        .file-upload {
            display: none;
        }
        .circle {
            /* border-radius: 1000px !important; */
            overflow: hidden;
            width: 100%;
            height: auto;
            /* border: 8px solid rgba(100, 43, 43, 0.7); */
            /* position: absolute;   */
            top: 72px;
        }
        img.profile-pic {
            border-radius: 20px !important;
            max-width: 100%;
            width: 100%;
            height: auto;
        }
        .p-image {
        /* position: absolute;
        top: 167px;
        right: 30px; */
        color: #666666;
        transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .p-image:hover {
        transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .upload-button {
        font-size: 1.2em;
        }
        
        .upload-button:hover {
        transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        color: #999;
        }
    </style>
@endsection         
@section('content')
{{-- Student details Start --}}
{!!Form::model( $student,[
  'route'=> $student->exists ? ['profile.update',$student->id] : ['profile.store'],
  'method'=> $student->exists ? 'PUT' : 'POST',
  'id' => 'student_form_id',
  'files'=>true,
])
  !!}
{{-- <form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data"> --}}
  @csrf
  <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add Student</h4>
            <p class="card-category"> {{$student->name ?? 'Your'}} profile</p>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Class</label>
                    <input type="text" class="form-control" value="{{$student->student_class->name ?? 'Not Defined'}}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Username</label>
                    <input type="text" class="form-control" value="{{$student->username ?? ''}}" disabled="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{$student->email ?? ''}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Student Name</label>
                    <input type="text" name="name" value="{{$student->name ?? ''}}" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="">DOB</label>
                    <input type="date" class="form-control" value="{{$student->dob ?? ''}}" name="dob">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Passward</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Confirm Passward</label>
                    <input type="password" class="form-control" name="confirmPassword">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">City</label>
                    <input type="text" class="form-control" name="city" value="{{$student->city ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Country</label>
                    <input type="text" class="form-control" name="country" value="{{$student->country ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Postal Code</label>
                    <input type="text" class="form-control" name="pincode" value="{{$student->pincode ?? ''}}">
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Mobile Number</label>
                      <input type="text" class="form-control" name="mobile" value="{{$student->mobile ?? ''}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-check bmd-form-group">
                      <label class="" style="padding-right:10px;">Status</label>
                      <input type="radio" class="" name="status" value="1" {{isset($student->status) && $student->status == '1' ? 'checked' : 'unchecked'}}><span style="padding-inline: 4px;, padding-inline-start: 2px;">Active</span> 
                      <input type="radio" class="" name="status" value="0" {{isset($student->status) && $student->status == '0' ? 'checked' : 'unchecked'}}> <span style="padding-inline: 4px;, padding-inline-start: 2px;"> Unactive</span>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  {{-- <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Mobile Number</label>
                    <input type="text" class="form-control">
                  </div> --}}
                </div>
                <div class="col-md-6">
                  <div class="form-check bmd-form-group">
                    <label class="" style="padding-right:10px;">gender</label>
                    <input type="radio" class="" name="gender" value="boy" {{isset($student->gender) && $student->gender == 'boy' ? 'checked' : 'unchecked'}}><span style="padding-inline: 4px;, padding-inline-start: 2px;">boy</span> 
                    <input type="radio" class="" name="gender" value="girl" {{isset($student->gender) && $student->gender == 'girl' ? 'checked' : 'unchecked'}}> <span style="padding-inline: 4px;, padding-inline-start: 2px;"> girl</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                      <textarea class="form-control" rows="5" name="about">{{$student->about ?? ''}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
              <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-avatar">
            {{-- <a href="#pablo">
              <img class="img" src="{{asset('assets/img/faces/marc.jpg')}}">
            </a> --}}
          
                <div class="circle upload-button">
                  <!-- User Profile Image -->
                  @if(isset($student->file) && $student->file->filepath != '')
                      <img class="profile-pic" src="{{'/storage/images/'.$student->file->filepath}}">
                  @else
                      <img class="img profile-pic" src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg">
                  @endif 
                  <!-- Default Image -->
                  {{-- <i class="fa fa-user fa-5x"></i>  --}}
                </div>
                <div class="p-image">
                  {{-- <i class="fa fa-camera upload-button"></i> --}}
                  <input class="file-upload" name="profile" type="file" accept="image/*"/>
                </div>
          </div>
          <div class="card-body">
            <h6 class="card-category">Class {{$student->studentclass->name ?? 'Your Class'}}</h6>
            <h4 class="card-title text-capitalize">{{$student->name ?? 'student name'}}</h4>
            <h4 class="card-title">{{$student->username ?? 'username'}}</h4>
            <p class="card-description">
              
            </p>
            {{-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> --}}
          </div>
        </div>
      </div>
  </div>
{{Form::close()}}
{{-- </form> --}}
{{-- Student details END --}}

{{-- Parents details Start --}}
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Add Parents</h4>
        <p class="card-category">parents details</p>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Father Name</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Mother Name</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Father Mobile Number</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Mother Mobile Number</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Father Email Address</label>
                <input type="email" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Mother Email Address</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Adress</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">City</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Country</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Postal Code</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary pull-right">Update Profile</button> 
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Guradian</h4>
        <p class="card-category">Guardian details (optional)</p>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Guardian Name</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Relationship </label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Mobile Number</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Email Address</label>
                  <input type="text" class="form-control">
                </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-md-12">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Adress</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">City</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Country</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Postal Code</label>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
          {{-- <button type="submit" class="btn btn-primary pull-right">Update Profile</button> --}}
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Parents details finish --}}
@endsection
@section('footer')
<script>
  $(document).ready(function() {   
    var readURL = function(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button").on('click', function() {
    $(".file-upload").click();
    });
  });
</script>
@endsection