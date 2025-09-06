<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <div style="text-align: center;">
            <img src="{{ asset('backend/AdminAssets/backend/dist/img/logo2.png') }}"
                 alt="Logo"
                 class="brand-image img-circle elevation-3"
                 style=" width: 150px; height: 150px; object-fit: contain;">
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

{{---------}}
{{--                <li class="nav-item {{ request()->routeIs('categories.index') || request()->is('admin/categories/*') ? 'menu-open' : '' }}">--}}
{{--                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') || request()->is('admin/categories/*') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-list"></i>--}}
{{--                        <p>--}}
{{--                            Category--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <!-- Category with Sub Category nested -->--}}
{{--                <li class="nav-item {{ request()->routeIs('category.index') || request()->routeIs('subcategories.index') || request()->is('admin/category/*') || request()->is('admin/subcategories/*') ? 'menu-open' : '' }}">--}}
{{--                    <a href="{{route('online-courses.index')}}" class="nav-link {{ request()->routeIs('category.index') || request()->routeIs('subcategories.index') || request()->is('admin/category/*') || request()->is('admin/subcategories/*') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-graduation-cap"></i>--}}
{{--                        <p>--}}
{{--                            Online Courses--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item {{ request()->routeIs('category.index') || request()->routeIs('subcategories.index') || request()->is('admin/category/*') || request()->is('admin/subcategories/*') ? 'menu-open' : '' }}">--}}
{{--                    <a href="{{route('top-course.index')}}" class="nav-link {{ request()->routeIs('category.index') || request()->routeIs('subcategories.index') || request()->is('admin/category/*') || request()->is('admin/subcategories/*') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-graduation-cap"></i>--}}
{{--                        <p>--}}
{{--                            Top Course--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item {{ request()->routeIs('about-us.index') || request()->is('admin/about-us/*') ? 'menu-open' : '' }}">--}}
{{--                    <a href="{{ route('about-us.index') }}" class="nav-link {{ request()->routeIs('about-us.index') || request()->is('admin/about-us/*') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-info-circle"></i>--}}
{{--                        <p>--}}
{{--                            About Us--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item {{ request()->routeIs('subscriptions.index') || request()->is('admin/subscriptions/*') ? 'menu-open' : '' }}">--}}
{{--                    <a href="{{ route('subscriptions.index') }}" class="nav-link {{ request()->routeIs('subscriptions.index') || request()->is('admin/subscriptions/*') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-envelope"></i>--}}
{{--                        <p>--}}
{{--                            Subscription--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{-------}}

                <li class="nav-item {{ request()->routeIs([
        'categories.index',
        'category.index',
        'subcategories.index',
        'online-courses.index',
        'top-course.index',
        'about-us.index',
        'subscriptions.index'
    ]) || request()->is('admin/categories/*')
      || request()->is('admin/category/*')
      || request()->is('admin/subcategories/*')
      || request()->is('admin/online-courses/*')
      || request()->is('admin/top-course/*')
      || request()->is('admin/about-us/*')
      || request()->is('admin/subscriptions/*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link {{ request()->routeIs([
            'categories.index',
            'category.index',
            'subcategories.index',
            'online-courses.index',
            'top-course.index',
            'about-us.index',
            'subscriptions.index'
        ]) || request()->is('admin/categories/*')
          || request()->is('admin/category/*')
          || request()->is('admin/subcategories/*')
          || request()->is('admin/online-courses/*')
          || request()->is('admin/top-course/*')
          || request()->is('admin/about-us/*')
          || request()->is('admin/subscriptions/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            CMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <!-- Category -->
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <!-- Online Courses -->
                        <li class="nav-item">
                            <a href="{{ route('online-courses.index') }}" class="nav-link {{ request()->routeIs('online-courses.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Online Courses</p>
                            </a>
                        </li>
                        <!-- Top Course -->
                        <li class="nav-item">
                            <a href="{{ route('top-course.index') }}" class="nav-link {{ request()->routeIs('top-course.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Course</p>
                            </a>
                        </li>
                        <!-- About Us -->
                        <li class="nav-item">
                            <a href="{{ route('about-us.index') }}" class="nav-link {{ request()->routeIs('about-us.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                        <!-- Subscription -->
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="nav-link {{ request()->routeIs('subscriptions.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subscription</p>
                            </a>
                        </li>
                        <!-- Contact Us -->
                        <li class="nav-item">
                            <a href="{{ route('contactus.index') }}" class="nav-link {{ request()->routeIs('contact-us.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact Us</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Student Review -->
                <li class="nav-item {{ request()->routeIs('product.index') || request()->is('admin/product/*') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link {{ request()->routeIs('student.review.index') || request()->is('admin/student-review/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Student Review
                        </p>
                    </a>
                </li>

                <!-- Earning -->
                <li class="nav-item {{ request()->routeIs('order.index') || request()->is('admin/order/*') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link {{ request()->routeIs('earning.index') || request()->is('admin/earning/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Earning
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php
