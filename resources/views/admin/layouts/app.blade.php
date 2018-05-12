<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('sb-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{ asset('sb-admin/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    @yield('page_specific_include_css_file')

    <!-- Custom CSS -->
    <link href="{{ asset('sb-admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{ asset('sb-admin/vendor/morrisjs/morris.css') }} " rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset('sb-admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        h1.page-header{font-size: 18px; font-weight: bold;}
    </style>
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color: #3C8DBC;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}" style="color:#fff;">Welcome in Admin Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown" style="background-color: #fff">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Change Password</a>
                        </li>                       
                        <li class="divider"></li>
                        <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li>
                        -->
                        <li>
                            <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manage Categories<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/admin/category/create') }}">Add Category</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/categories') }}">View Categories</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manage Products<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/admin/product/create') }}">Add Product</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/products') }}">View Products</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('/admin/orders') }}"><i class="fa fa-table fa-fw"></i> Orders</a>
                        </li>
                       
                      
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Manage CMS Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/admin/pages/about-us') }}">About Us Page</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/pages/contact-us') }}">Contact Us Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        @yield('content')

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('sb-admin/vendor/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('sb-admin/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('sb-admin/data/morris-data.js') }}"></script>
    @yield('page_specific_include_js_file')

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('sb-admin/dist/js/sb-admin-2.js') }}"></script>
    @yield('page_level_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataTables').DataTable({
                responsive: true
            });
        });
    </script>
</body>
</html>
