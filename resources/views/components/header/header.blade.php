<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://ninehousing.com.vn/" target="_blank" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item mr-4" style="display: flex;justify-content: center;align-items: center;">
          <i class="far fa-bell" id="notifications" style="font-size:25px" data-total='{{$totalNotifications > 100 ? "99+" : $totalNotifications }}'></i>
          <ul id="notifications-list">
              @foreach($notifications as $notification)
                <li data-id="{{$notification->id}}" class="{{$notification->read_at ? 'read' : 'no-read'}}">
                  <span class="notification-content">{!!$notification->content!!}</span> <br><span class="notification-time">{{$notification->created_at->format('Y-m-d H:i:s')}}</span>
                </li>
              @endforeach
          </ul>
      </li>
      <li class="nav-item">

        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{Auth::user()->name}}
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
            <a class="dropdown-item" href="{{route('logout')}}">Logout</a>

          </div>
        </div>
      </li>
    </ul>
  </nav>