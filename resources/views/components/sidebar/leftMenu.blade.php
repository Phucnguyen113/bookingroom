<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  <li class="nav-item">
    <a href="{{request()->is('tags') ? '#' : url('/tags')}}" class="nav-link {{request()->is('tags*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Tags
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{request()->is('blogs') ? '#' : url('/blogs')}}" class="nav-link {{request()->is('blogs*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Blogs
        <!-- <span class="right badge badge-danger">New</span> -->
      </p>
    </a>
  </li>
</ul>