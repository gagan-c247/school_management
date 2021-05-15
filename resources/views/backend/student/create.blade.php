@extends('backend.backend')

@section('header')
    <style>
        .dateclass.placeholderclass::before {
            width: 100%;
            content: attr(placeholder);
        }

        .dateclass.placeholderclass:hover::before {
        width: 0%;
        content:attr(placeholder);
        }
    </style>
@endsection         
@section('content')
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add Student</h4>
          <p class="card-category"> your profile</p>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Class</label>
                  <select name="" id="" class="form-control">
                      <option value="" class="bg bg-dark">Select Class</option>
                      <option value="" class="bg bg-dark"> Play School</option>
                      <option value="" class="bg bg-dark"> KG First</option>
                      <option value="" class="bg bg-dark"> KG Secound</option>
                      <option value="" class="bg bg-dark">Class 1st</option>
                      <option value="" class="bg bg-dark">Class 2nd</option>
                      <option value="" class="bg bg-dark">Class 3rd</option>
                      <option value="" class="bg bg-dark">Class 4th</option>
                      <option value="" class="bg bg-dark">Class 5th</option>
                      <option value="" class="bg bg-dark">Class 6th</option>
                      <option value="" class="bg bg-dark">Class 7th</option>
                      <option value="" class="bg bg-dark">Class 8th</option>
                      <option value="" class="bg bg-dark">Class 9th</option>
                      <option value="" class="bg bg-dark">Class 10th</option>
                      <option value="" class="bg bg-dark">Class 11th</option>
                      <option value="" class="bg bg-dark">Class 12th</option> 
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Username</label>
                  <input type="text" class="form-control" disabled="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Email address</label>
                  <input type="email" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Student Name</label>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label class="bmd-label-floating">DOB</label>
                  <input type="date" class="form-control dateclass placeholderclass">
                </div>
              </div>
            </div>
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
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Mobile Number</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-check bmd-form-group">
                    <label class="" style="padding-right:10px;">Status</label>
                    <input type="radio" class="" name="status"><span style="padding-inline: 4px;, padding-inline-start: 2px;">Active</span> 
                    <input type="radio" class="" name="status"> <span style="padding-inline: 4px;, padding-inline-start: 2px;"> Unactive</span>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>About Me</label>
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                    <textarea class="form-control" rows="5"></textarea>
                  </div>
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
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="#pablo">
            <img class="img" src="{{asset('assets/img/faces/marc.jpg')}}">
          </a>
        </div>
        <div class="card-body">
          <h6 class="card-category">CEO / Co-Founder</h6>
          <h4 class="card-title">Alec Thompson</h4>
          <p class="card-description">
            Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
          </p>
          <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
        </div>
      </div>
    </div>
  </div>
@endsection