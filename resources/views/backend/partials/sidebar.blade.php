<aside class="main-sidebar sidebar-primary elevation-4">

    <!-- =================== Brand Logo Section =================== -->
    <a href="" class="brand-link">
        <div style="text-align: center; padding: 5px 0; background-color: #f8f9fa;">
            <img src="{{ asset('backend/AdminAssets/backend/dist/img/BrandPicture.png') }}"
                 alt="Logo"
                 style="width: 180px; height: 80px; object-fit: contain; display: block; margin: 0 auto;">
        </div>
    </a>

    <!-- =================== Sidebar Section =================== -->
    <div class="sidebar">

        <!-- =================== Sidebar Menu =================== -->
        <nav class="mt-10" style="margin-top: 50px;">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="false">

                <!-- =================== Dashboard =================== -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

{{--                <!-- =================== My Courses =================== -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href=""--}}
{{--                       class="nav-link {{ request()->routeIs('courses.in-progress') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-book"></i>--}}
{{--                        <p>My Courses</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <!-- =================== Create Course Dropdown =================== -->


                <!-- =================== CMS Dropdown =================== -->
                @php
                    $cmsRoutes = [
                        'web-terms.index', 'web-privacy-policies.index'
                    ];
                    $cmsOpen = collect($cmsRoutes)->contains(fn($r) => request()->routeIs($r) || request()->is("admin/{$r}/*"));
                @endphp

                <li class="nav-item {{ $cmsOpen ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $cmsOpen ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            CMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @php
                            $subMenu = [
                                ['route' => 'contacts.web.index', 'icon' => 'far fa-circle', 'label' => 'Contact Us'],
                                ['route' => 'blogs.index', 'icon' => 'far fa-circle', 'label' => 'Create Blogs'],
                                ['route' => 'web-terms.index', 'icon' => 'far fa-circle', 'label' => 'Terms & Conditions'],
                                ['route' => 'web-privacy-policies.index', 'icon' => 'far fa-circle', 'label' => 'Privacy & Policy'],
                                ['route' => 'global-electrician-days.index', 'icon' => 'far fa-circle', 'label' => 'GlobalElectricianDay'],
                                ['route' => 'timelines.index', 'icon' => 'far fa-circle', 'label' => 'GlobalTimeline'],
                                ['route' => 'movements.index', 'icon' => 'far fa-circle', 'label' => 'GlobalMovement'],
                                ['route' => 'global-multimedia.index', 'icon' => 'far fa-circle', 'label' => 'GlobalMultimedia'],
                                ['route' => 'electricianDay-images.index', 'icon' => 'far fa-circle', 'label' => 'ElectricianDayImage'],
                                ['route' => 'electricianDay-posts.index', 'icon' => 'far fa-circle', 'label' => 'ElectricianDayPost'],
                                ['route' => 'electrician-day-banners.index', 'icon' => 'far fa-circle', 'label' => 'ElectricianDayBanners'],
                                ['route' => 'electrician-day-videos.index', 'icon' => 'far fa-circle', 'label' => 'ElectricianDayVideos'],

                            ];
                        @endphp

                        @foreach($subMenu as $item)
                            <li class="nav-item">
                                <a href="{{ route($item['route']) }}"
                                   class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                    <i class="{{ $item['icon'] }} nav-icon"></i>
                                    <p>{{ $item['label'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>



{{--                <!-- =================== Single Links =================== -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href=""--}}
{{--                       class="nav-link {{ request()->routeIs('share.experiance.index') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-star"></i>--}}
{{--                        <p>Share Experience</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item">--}}
{{--                    <a href=""--}}
{{--                       class="nav-link {{ request()->routeIs('enrollments.index') ? 'active' : '' }}">--}}
{{--                        <i class="fas fa-user-graduate nav-icon"></i>--}}
{{--                        <p>Enrollments</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('blogs.index')}}"--}}
{{--                       class="nav-link {{ request()->routeIs('web.blogs.index') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon fas fa-certificate"></i>--}}
{{--                        <p>Blogs</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('contacts.web.index')}}"--}}
{{--                       class="nav-link {{ request()->routeIs('earning.index') || request()->is('admin/earning/*') ? 'active' : '' }}">--}}
{{--                        <i class="fas fa-phone-alt"></i>--}}
{{--                        <p>Contact Us</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->

</aside>

<!-- =================== Sidebar Custom Styles =================== -->
<style>
    /* Sidebar link hover effect */
    .nav-sidebar .nav-item .nav-link:hover {
        background-color: #007bff !important;
        color: #fff !important;
        position: relative;
    }

    /* White dot on hover (right side) */
    .nav-sidebar .nav-item .nav-link:hover::after {
        content: "•";
        color: #fff;
        font-size: 18px;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    /* Keep white dot for active menu (right side) */
    .nav-sidebar .nav-item .nav-link.active {
        background-color: #007bff !important;
        color: #fff !important;
        position: relative;
    }
    .nav-sidebar .nav-item .nav-link.active::after {
        content: "•";
        color: #fff;
        font-size: 18px;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    /* Default icon color */
    .nav-sidebar .nav-item .nav-link i.nav-icon {
        color: #343a40;
    }

    /* Icon color on hover */
    .nav-sidebar .nav-item .nav-link:hover i.nav-icon {
        color: #fff !important;
    }

    /* Icon color when active */
    .nav-sidebar .nav-item .nav-link.active i.nav-icon {
        color: #fff !important;
    }
</style>
<!-- =================== Mobile Styles =================== -->
<style>
    @media (max-width: 768px) {
        .main-sidebar {
            position: fixed;
            top: 0;
            left: -260px; /* hidden initially */
            width: 260px;
            height: 100%;
            background: #fff;
            z-index: 1050;
            overflow-y: auto;
            transition: left 0.3s;
        }
        .main-sidebar.open {
            left: 0;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }
        .sidebar-overlay.active {
            display: block;
        }

        /* Menu text bold and black */
        .nav-sidebar .nav-link {
            font-weight: bold;
            color: #000 !important;
        }
        .nav-sidebar .nav-link i.nav-icon {
            color: #343a40;
        }

        /* Submenu collapsed initially */
        .nav-treeview {
            display: none;
            padding-left: 15px;
        }
        .nav-item.menu-open > .nav-treeview {
            display: block;
        }
    }
</style>

<!-- =================== Mobile JS =================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.main-sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        // Create overlay
        const overlay = document.createElement('div');
        overlay.classList.add('sidebar-overlay');
        document.body.appendChild(overlay);

        // Toggle sidebar
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });

        // Mobile submenu toggle
        document.querySelectorAll('.nav-item.has-treeview > a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const parent = link.parentElement;
                    parent.classList.toggle('menu-open');
                }
            });
        });
    });
</script>


