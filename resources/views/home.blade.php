{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@include('backend.layout.header')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-xl-4 col-lg-12">
                <div class="card card-chart">
                  <div class="card-header card-header-success">
                    <div class="ct-chart" id="dailySalesChart"></div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Daily Sales</h4>
                    <p class="card-category">
                      <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">access_time</i> updated 4 minutes ago
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12">
                <div class="card card-chart">
                  <div class="card-header card-header-warning">
                    <div class="ct-chart" id="websiteViewsChart"></div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Email Subscriptions</h4>
                    <p class="card-category">Last Campaign Performance</p>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">access_time</i> campaign sent 2 days ago
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12">
                <div class="card card-chart">
                  <div class="card-header card-header-danger">
                    <div class="ct-chart" id="completedTasksChart"></div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Completed Tasks</h4>
                    <p class="card-category">Last Campaign Performance</p>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">access_time</i> campaign sent 2 days ago
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">group</i>
                    </div>
                    <p class="card-category">Total Student</p>
                    <h3 class="card-title">{{$studentCount ?? '0'}}
                      <small>Students</small>
                    </h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons text-warning">person</i>
                      <a href="{{route('admin.student.index')}}" class="warning-link">list of students...</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">group</i>
                    </div>
                    <p class="card-category">Total Teacher</p>
                    <h3 class="card-title">{{$teacherCount ?? ''}}
                      <small>Teachers</small>
                    </h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">date_range</i> Last 24 Hours
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                  <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">info_outline</i>
                    </div>
                    <p class="card-category">Fixed Issues</p>
                    <h3 class="card-title">75</h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">local_offer</i> Tracked from Github
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                      <i class="fa fa-twitter"></i>
                    </div>
                    <p class="card-category">Followers</p>
                    <h3 class="card-title">+245</h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">update</i> Just Updated
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Student</h4>
                    <p class="card-category">New Student Details</p>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="table table-hover">
                      <thead class="text-warning">
                        <th>ID</th>
                        <th>Name</th>
                        <th>class</th>
                        <th>Created At</th>
                      </thead>
                      <tbody>
                        
                        @foreach ($latestStudent as $student)
                          <tr>
                            <td>{{$student->id ?? ''}}</td>
                            <td>{{$student->name ?? ''}}</td>
                            <td>{{$student->studentclass->name ?? ''}}</td>
                            <td>{{$student->created_at->format('d M Y') ?? ''}}</td>
                          </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12">
                <div class="card">
                  <div class="card-header card-header-warning">
                    <h4 class="card-title">Teacher</h4>
                    <p class="card-category">New Teacher Details</p>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="table table-hover">
                      <thead class="text-warning">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Created At</th>
                      </thead>
                      <tbody>
                        
                        @foreach ($latestTeacher as $teacher)
                          <tr>
                            <td>{{$teacher->id ?? ''}}</td>
                            <td>{{$teacher->name ?? ''}}</td>
                            <td>{{$teacher->designation ?? ''}}</td>
                            <td>{{$teacher->created_at->format('d M Y') ?? ''}}</td>
                          </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                </div>
                {{-- <div class="card">
                  <div class="card-header card-header-tabs card-header-warning">
                    <div class="nav-tabs-navigation">
                      <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">Tasks:</span>
                        <ul class="nav nav-tabs" data-tabs="tabs">
                          <li class="nav-item">
                            <a class="nav-link active" href="#profile" data-toggle="tab">
                              <i class="material-icons">bug_report</i> Bugs
                              <div class="ripple-container"></div>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#messages" data-toggle="tab">
                              <i class="material-icons">code</i> Website
                              <div class="ripple-container"></div>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#settings" data-toggle="tab">
                              <i class="material-icons">cloud</i> Server
                              <div class="ripple-container"></div>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="profile">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Sign contract for "What are conference organizers afraid of?"</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                              </td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Create 4 Invisible User Experiences you Never Knew About</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane" id="messages">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                              </td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Sign contract for "What are conference organizers afraid of?"</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane" id="settings">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                              </td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>Sign contract for "What are conference organizers afraid of?"</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                  <i class="material-icons">close</i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
    </div>
@include('backend.layout.footer')