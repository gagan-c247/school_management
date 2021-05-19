<div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item active  ">
        <a class="nav-link" href="javascript:void(0)">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">content_paste</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">library_books</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('teacher.profile.index')}}">
              <i class="material-icons">person</i>
              <p>Profile</p>
            </a>
          </li>
         {{-- <li class="nav-item {{\Request::segment(2) == 'teacher' && \Request::segment(3) == 'create' ? 'active' : ''}}">
            <a class="nav-link" href="{{route('teacher.create')}}">
              <i class="material-icons">person</i>
              <p>Teacher</p>
            </a>
          </li>
          <li class="nav-item {{\Request::segment(2) == 'teacher' && \Request::segment(3) != 'create' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('teacher.index')}}">
              <i class="material-icons">content_paste</i>
              <p>All Teacher</p>
            </a>
          </li> --}}
            {{-- <li class="nav-item {{\Request::segment(2) == 'student' && \Request::segment(3) == 'create'  ? 'active' : ''}}">
            <a class="nav-link" href="{{route('student.create')}}">
              <i class="material-icons">person</i>
              <p>Student </p>
            </a>
          </li>
          <li class="nav-item {{\Request::segment(2) == 'student' && \Request::segment(3) != 'create' ? 'active' : ''}}">
            <a class="nav-link" href="{{route('student.index')}}">
              <i class="material-icons">content_paste</i>
              <p>All Student</p>
            </a>
          </li> --}}
         {{-- <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">person</i>
              <p>Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('course.index')}}">
              <i class="material-icons">person</i>
              <p>Course</p>
            </a>
          </li> --}}
      </li>
      <!-- your sidebar here -->
    </ul>
  </div>