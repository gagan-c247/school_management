<div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item active  ">
        <a class="nav-link" href="{{route('admin.home')}}">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
        {{-- <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">content_paste</i>
              <p>Dashboard</p>
            </a>
        </li> --}}

          {{-- <li class="nav-item ">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">library_books</i>
              <p>Dashboard</p>
            </a>
          </li> --}}
          @can('teacher-section')
          <li class="nav-item {{\Request::segment(2) == 'teacher' ? 'active' : ''}}">
            <a class="nav-link teacher " href="#">
              <i class="material-icons">person</i>
              <p>Teacher</p>
            </a>
            <ul class="nav ml-3 teacherList" style="{{\Request::segment(2) == 'teacher' ? '' :'display: none;'}}">
              @can('teacher-create')
              <li class="nav-item {{\Request::segment(2) == 'teacher' && \Request::segment(3) == 'create' ? 'active' : ''}}">
                <a class="nav-link " href="{{route('admin.teacher.create')}}">
                  <i class="material-icons">content_paste</i>
                  <p>Add Teacher</p>
                </a>
              </li>
              @endcan
              @can('teacher-list')
              <li class="nav-item {{\Request::segment(2) == 'teacher' && \Request::segment(3) != 'create' ? 'active' : ''}}">
                <a class="nav-link " href="{{route('admin.teacher.index')}}">
                  <i class="material-icons">content_paste</i>
                  <p>All Teacher</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          <script>
             var flag = false;  
              $(document).on('click','.teacher',function() {
              
                if(flag == false){
                  $('.teacherList').show();
                  flag=true;
                }else{
                  $('.teacherList').hide();
                  flag=false;
                }
              });
              $(document).on('click','.student',function() {
                if(flag == false){
                  $('.studentList').show();
                  flag=true;
                }else{
                  $('.studentList').hide();
                  flag=false;
                }
              }); 
          </script>


          @can('student-section')
          <li class="nav-item {{\Request::segment(2) == 'student' ? 'active' : ''}}">
            <a class="nav-link student" href="#">
              <i class="material-icons">person</i>
              <p>Student </p>
            </a>
            <ul class="nav ml-3 studentList" style="{{\Request::segment(2) == 'student' ? '' :'display: none;'}}">
              @can('student-create')
              <li class="nav-item {{\Request::segment(2) == 'student' && \Request::segment(3) == 'create'  ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.student.create')}}">
                  <i class="material-icons">person</i>
                  <p>Add Student</p>
                </a>
              </li>
              @endcan
              @can('student-list')
              <li class="nav-item {{\Request::segment(2) == 'student' && \Request::segment(3) != 'create' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.student.index')}}">
                  <i class="material-icons">content_paste</i>
                  <p>All Student</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">person</i>
              <p>Management</p>
            </a>
          </li>
          @can('course-section')
            @can('course-list')
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.course.index')}}">
                <i class="material-icons">dashboard</i>
                <p>Course</p>
              </a>
            </li>
            @endcan
          @endcan
          @can('role-permission')
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.role.index')}}">
              <i class="material-icons">content_paste</i>
              <p>Role</p>
            </a>
          </li>
          @endcan
          @can('role-permission')
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.permission.index')}}">
              <i class="material-icons">content_paste</i>
              <p>Permission</p>
            </a>
          </li>
          @endcan
          <li class="nav-item {{\Request::segment(2) == 'user' ? 'active' : ''}}">
            <a class="nav-link user" href="#" >
              <i class="material-icons">person</i>
              <p>Users</p>
            </a>
            <ul class="nav userList ml-3" style="{{\Request::segment(2) != 'user' ? 'display: none;' : ''}}">
              @can('user-all')
              <li class="nav-item {{\Request::segment(2) == 'user' && \Request::segment(3) != 'create' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.user.index')}}">
                  <i class="material-icons">person</i>
                  <p>All User</p>
                </a>
              </li>
              @endcan
              @can('user-create')
              <li class="nav-item {{\Request::segment(2) == 'user' && \Request::segment(3) == 'create' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.user.create')}}">
                  <i class="material-icons">person</i>
                  <p>Add User</p>
                </a>
              </li>
              @endcan          
            </ul>
            <script>
              var flag =false;
               $(document).on('click','.user',function() {
                if(flag == false){
                  $('.userList').show();
                  flag=true;
                }else{
                  $('.userList').hide();
                  flag=false;
                }
              }); 
            </script>
          </li>

          <li class="nav-item {{\Request::segment(2) == 'fileupload' ? 'active' : ''}}">
            <a class="nav-link file" href="#" >
              <i class="material-icons">dashboard</i>
              <p>FileUpload</p>
            </a>
            <ul class="nav fileuploadList ml-3" style="{{\Request::segment(2) != 'fileupload' ? 'display: none;' : ''}}">
              <li class="nav-item {{\Request::segment(2) == 'fileupload' && \Request::segment(3) != 'create' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.fileupload.index')}}">
                  <i class="material-icons">content_paste</i>
                  <p>All File</p>
                </a>
              </li>
              <li class="nav-item {{\Request::segment(2) == 'fileupload' && \Request::segment(3) == 'create' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.fileupload.create')}}">
                  <i class="material-icons">content_paste</i>
                  <p>FileUpload</p>
                </a>
              </li> 
            </ul>
            <script>
              var flag =false;
               $(document).on('click','.file',function() {
                if(flag == false){
                  $('.fileuploadList').show();
                  flag=true;
                }else{
                  $('.fileuploadList').hide();
                  flag=false;
                }
              }); 
            </script>
          </li>
      </li>
      <!-- your sidebar here -->
    </ul>
  </div>