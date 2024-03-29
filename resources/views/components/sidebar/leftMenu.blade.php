<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  <li class="nav-item">
    <a href="{{request()->is('/') ? '#' : url('/')}}" class="nav-link {{request()->is('/*') ? 'active' : ''}}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
         Dashboard
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>
  @if(Auth::user()->isAdmin())
    <li class="nav-item">
      <a href="{{request()->is('/users') ? '#' : url('/users')}}" class="nav-link {{request()->is('/users*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-user"></i>
        <p>
          User
          <!-- <span class="right badge badge-danger">New</span> -->
        </p>
      </a>
    </li>
  @endif
  <li class="nav-item {{request()->is('meta-info*') ? 'menu-is-opening menu-open' : ''}}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-cog"></i>
      <p>
        Meta Setting
        <!-- <span class="right badge badge-danger">New</span> -->
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{request()->is('meta-info') ? '#' : route('metaInfo.index')}}" class="nav-link {{request()->is('meta-info/info') ? 'active' : ''}}">
          <i class="nav-icon fas fa-info"></i>
          <p>
            Information
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{request()->is('slide') ? '#' : route('metaInfo.slide')}}" class="nav-link {{request()->is('meta-info/slide') ? 'active' : ''}}">
          <i class="nav-icon fas fa-image"></i>
          <p>
            Slides
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>
    </ul>
  </li>

  <!-- <li class="nav-item">
    <a href="{{request()->is('tags') ? '#' : url('/tags')}}" class="nav-link {{request()->is('tags*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-tag"></i>
      <p>
        Tags
      </p>
    </a>
  </li> -->
  <li class="nav-item">
    <a href="{{request()->is('categories') ? '#' : url('/categories')}}" class="nav-link {{request()->is('categories*') ? 'active' : ''}}">
    <i class="nav-icon fas fa-tasks"></i>
      <p>
        Category
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{request()->is('blogs') ? '#' : url('/blogs')}}" class="nav-link {{request()->is('blogs*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-blog"></i>
      <p>
        Blogs
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{request()->is('rooms') ? '#' : route('rooms.index')}}" class="nav-link {{request()->is('rooms*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-home"></i>
      <p>
        Rooms
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{request()->is('reservations') ? '#' : route('reservations.index')}}" class="nav-link {{request()->is('reservations*') ? 'active' : ''}}">
      <i class="fas fa-envelope"></i>
      <p>
        Reservation
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{request()->is('customer-messages') ? '#' : route('customer-messages.index')}}" class="nav-link {{request()->is('customer-messages*') ? 'active' : ''}}">
      <i class="fas fa-comment-dots"></i>
      <p>
        Customer Message
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>

</ul>