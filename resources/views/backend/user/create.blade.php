@extends('backend.backend',['title'=>$user->exists ? 'Edit user' : 'Add user'])

@section('header')
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
{!!Form::model( $user,[
  'route'=> $user->exists ? ['admin.user.update',$user->id] : ['admin.user.store'],
  'method'=> $user->exists ? 'PUT' : 'POST',
  'id' => 'user_form_id',
  'files'=>true,
])
  !!}
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">user Profile</h4>
          <p class="card-category">user your profile</p>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                {{-- <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Company (disabled)</label>
                  <input type="text" class="form-control" disabled="">
                </div> --}}
              </div>
              <div class="col-md-3">
                {{-- <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Username</label>
                  <input type="text" class="form-control text-uppercase" disabled value="{{$user->username ?? ''}}">
                </div> --}}
              </div>
              <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">User Email address</label>
                    <input type="email" class="form-control" name="email"  value="{{$user->email ?? old('email')}}" {{isset($user->email) ? 'disabled' : '' }}>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">User Name</label>
                  <input type="text" class="form-control" name="name" value="{{$user->name ?? old('name')}}">
                </div>
              </div>
              {{-- <div class="col-md-6">
                <div class="form-group ">
                  <label class="">DOB</label>
                  <input type="date" class="form-control" value="{{$user->dob ?? old('dob')}}" name="dob">
                </div>
              </div> --}}
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
              <div class="col-md-6">
                {{-- <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Designation</label>
                <input type="text" class="form-control" name="designation" value="{{$user->designation ?? old('designation')}}">
                </div> --}}
              </div>
              <div class="col-md-6">
                {{-- <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Mobile Number</label>
                <input type="text" class="form-control" name="mobile" value="{{$user->mobile ?? old('mobile')}}">
                </div> --}}
              </div>
              <div class="col-md-6">
                {{-- <div class="form-group ">
                </div> --}}
              </div>
              <div class="col-md-6">
                {{-- <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Mobile (optional)</label>
                <input type="text" class="form-control" name="altmobile" value="{{$user->altmobile ?? old('altmobile')}}">
                </div> --}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                {{-- <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Adress</label>
                  <input type="text" class="form-control" name="address" value="{{$user->address ?? old('address')}}">
                </div> --}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                {{-- <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">City</label>
                  <input type="text" class="form-control" name="city" value="{{$user->city ?? old('city')}}">
                </div> --}}
              </div>
              <div class="col-md-4">
                {{-- <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Country</label>
                  <input type="text" class="form-control" name="country" value="{{$user->country ?? old('country')}}">
                </div> --}}
              </div>
              <div class="col-md-4">
                {{-- <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Postal Code</label>
                  <input type="text" class="form-control" name="pincode" value="{{$user->pincode ?? old('pincode')}}">
                </div> --}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {{-- <div class="form-check bmd-form-group">
                  <label class="" style="padding-right:10px;">Status</label>
                  <input type="radio" class="" name="status" value="1" {{isset($user->status) && $user->status == '1' ? 'checked' : 'unchecked'}}><span style="padding-inline: 4px;, padding-inline-start: 2px;">Active</span> 
                  <input type="radio" class="" name="status" value="0" {{isset($user->status) && $user->status == '0' ? 'checked' : 'unchecked'}}> <span style="padding-inline: 4px;, padding-inline-start: 2px;"> Unactive</span>
                </div> --}}
              </div>
              <div class="col-md-6">
                {{-- <div class="form-check bmd-form-group">
                  <label class="" style="padding-right:10px;">Gender</label>
                  <input type="radio" class="" name="gender" value="male" {{isset($user->gender) && $user->gender == 'male' ? 'checked' : 'unchecked'}}><span style="padding-inline: 4px;, padding-inline-start: 2px;">Male</span> 
                  <input type="radio" class="" name="gender" value="Female" {{isset($user->gender) && $user->gender == 'female' ? 'checked' : 'unchecked'}}> <span style="padding-inline: 4px;, padding-inline-start: 2px;"> Female</span>
                </div> --}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                {{-- <div class="form-group">
                  <label>About Me</label>
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                    <textarea class="form-control" rows="5" name="about">{{$user->about ?? old('about')}}</textarea>
                  </div>
                </div> --}}
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
          <div class="circle upload-button">
            <!-- User Profile Image -->
            @if(isset($user->file) && $user->file->filepath != '')
                <img class="profile-pic" src="{{'/storage/images/'.$user->file->filepath}}">
            @else
                <img class="img profile-pic" src="https://www.pngitem.com/pimgs/m/528-5286598_all-photo-png-clipart-male-teacher-clipart-png.png">
            @endif 
            <!-- Default Image -->
          </div>
          <div class="p-image">
            <input class="file-upload" name="profile" type="file" accept="image/*"/>
          </div>
        </div>
        <div class="card-body">
          <h6 class="card-category">{{$user->designation ?? 'CEO / Co-Founder'}}</h6>
          <h4 class="card-title text-capitalize">{{$user->name ?? 'Your Name'}}</h4>
          <p class="card-description text-uppercase">
            {{$user->username ?? ''}}
          </p>
        </div>
      </div>
    </div>
  </div>
{{Form::close()}}
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