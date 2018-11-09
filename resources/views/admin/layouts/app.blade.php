<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Artuni">

    <link rel="shortcut icon" href="/content/assets/images/favicon_1.ico">

    <title>@yield('title')</title>

    <!--Morris Chart CSS -->
    
    <link href="/content/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="/content/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="/content/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="/content/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/content/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="/content/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    @yield('style')
    <script src="/content/assets/js/modernizr.min.js"></script>
</head>
<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    
                    <!-- image logo here -->
                    <a href="#" class="logo">
                        <i class="icon-c-logo"> <img src="/image/1.png" height="42" /> </i>
                        <span><img src="/image/1.png" height="50" /></span>
                    </a>
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="md md-menu"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>

                       

                        


                        <ul  class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown top-menu-item-xs">
                                <a href="#" id="totalnoti" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="icon-bell"></i> 
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="notifi-title"> اطلاعیه ها</li>
                                    <li class="list-group slimscroll-noti notification-list " id="notiItem">
                                       
                                    </li>
                                   
                                </ul>
                            </li>
                            
                            <li class="dropdown top-menu-item-xs">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="/image/user.png" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    
                                    <li><a href="/HeadSupporter/UserInfo/edit"><i class="ti-user m-r-10 text-custom"></i> پروفایل({{ Auth::user()->name }})</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off m-r-10 text-danger"></i> خروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>



                        <li class="has_sub">
                            <a href="/admin/posts" class="waves-effect"><i class="md md-account-child text-custom"></i>مدیرت پست ها</a>
                        </li>

                        <li class="has_sub">
                            <a href="/admin/categories" id="ordernoti" class="waves-effect"><i class="md md-share"></i>دسته بندی ها
                            </a>
                        </li>

                        <li class="has_sub">
                            <a id="comment_noti" href="/admin/comments" class="waves-effect"><i class="md md-open-in-browser"></i>نظرات</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    @yield('content')
                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="">
                
                
            </footer>

        </div>


       

    </div>
    <!-- END wrapper -->



    <script>
            var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="/content/assets/js/jquery.min.js"></script>
    <script src="/content/assets/js/bootstrap-rtl.min.js"></script>
    <script src="/content/assets/js/detect.js"></script>
    <script src="/content/assets/js/fastclick.js"></script>
    <script src="/content/assets/js/jquery.slimscroll.js"></script>
    <script src="/content/assets/js/jquery.blockUI.js"></script>
    <script src="/content/assets/js/waves.js"></script>
    <script src="/content/assets/js/wow.min.js"></script>
    <script src="/content/assets/js/jquery.nicescroll.js"></script>
    <script src="/content/assets/js/jquery.scrollTo.min.js"></script>
    <!-- Todojs  -->
    <script src="/content/assets/pages/jquery.todo.js"></script>

    <!-- chatjs  -->
    <script src="/content/assets/pages/jquery.chat.js"></script>

    

    <script src="/content/assets/js/jquery.core.js"></script>
    <script src="/content/assets/js/jquery.app.js"></script>
    <script type="text/javascript">
        $(function notifications() {
           var url="{{ url('/admin/noti') }}";
        
            $.ajax({
                url: url,
                method: 'GET',
                success: function(result){
                    if (result != 0) {

                    
                    document.getElementById('comment_noti').innerHTML += '<span id="number" class="label label-pink pull-right">' + result + '</span>';
                    document.getElementById('notiItem').innerHTML += '<a href="/admin/comments" class="list-group-item"><div class="media"><div class="pull-left p-r-10"><em class="fa fa-user-plus noti-pink"></em></div><div class="media-body"><h5 class="media-heading">' + '<span id="ordernotinumber" class="label label-pink pull-right">' + result + '</span> احراز هویت فروشندگان</h5><p class="m-0"><small>فروشنده ها منتظرن !!!</small></p></div></div></a>';
                    }
                    if (result > 0) {
                        document.getElementById('totalnoti').innerHTML +='<span  class=" badge badge-xs badge-danger">'+result+'</span>' ;
                    }
                },
                error: function(result){
                 alert('متاسفانه مشکلی در سیستم رخ داده است.');  
                }
            });
               
        })
    </script>
    @yield('javascript')
</body>
</html>