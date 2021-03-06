<!DOCTYPE html>
<meta charset="utf-8" />
<?php
require 'db.php';
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}else{
    $search_word = db::getInstance()->real_escape_string($_GET['search_word']);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>KuBook | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="AdminLTE/dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="AdminLTE/bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>KU</b>B</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>KU</b>Book</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="./logout.php"><i class="fa  fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $_SESSION['user_name']?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i><?=$_SESSION['user_id']?></a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>User Menu</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="./index.php"><i class="fa fa-circle-o"></i>Search Book</a></li>
                            <li><a href="./return_book.php"><i class="fa fa-circle-o"></i>Return Book</a></li>
                            <li><a href="./search_seat.php"><i class="fa fa-circle-o"></i>Search Seat</a></li>
                            <li><a href="./return_seat.php"><i class="fa fa-circle-o"></i>Return Seat</a></li>
                        </ul>
                    </li>
                    <? if($_SESSION['user_level'] == 1){ ?>
                    <li class="active treeview menu-open">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>Admin Menu</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="./add_book.php"><i class="fa fa-circle-o"></i>Add Book</a></li>
                            <li class="active"><a href="./manage_book.php"><i class="fa fa-circle-o"></i>Manage Book</a></li>
                        </ul>
                    </li>
                    <? } ?>


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Search Book
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Result</h3>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search Title or Author or Publisher" id="input_word">
                                    <span class="input-group-btn">
                      <button type="button" onclick="click_search()" class="btn btn-info btn-flat">Search</button>
                    </span>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Publish_year</th>
                                        <th>ISBN</th>
                                        <th>Created_at</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //$search_word
    //$check_query="SELECT * FROM book WHERE title LIKE '%".$search_word."%' OR author LIKE '%".$search_word."%' OR publisher LIKE '%".$search_word."%' limit 1000";
    $check_query="SELECT *, (SELECT COUNT(*) FROM rental_book_history history WHERE history.book_id=book.id) status FROM book WHERE title LIKE '%".$search_word."%' OR author LIKE '%".$search_word."%' OR publisher LIKE '%".$search_word."%' limit 100";

    $results = db::getInstance()->get_raw($check_query);
    foreach ($results as $result){
        ?>
        <tr>
            <td><?=$result['id']?></td>
            <td><?=$result['title']?></td>
            <td><?=$result['author']?></td>
            <td><?=$result['publisher']?></td>
            <td><?=$result['publisher_year']?></td>
            <td><?=$result['isbn']?></td>
            <td><?=$result['created_at']?></td>
            <td><button type="button" onclick="do_update(<?=$result['id']?>)" class="btn btn-block btn-info">Update</button></td>
            <td><button type="button" onclick="do_remove(<?=$result['id']?>)" class="btn btn-block btn-danger">Remove</button></td>
        </tr>
        <?
    }

                                    ?>
                                    <!--
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet
                                            Explorer 4.0
                                        </td>
                                        <td>Win 95+</td>
                                        <td> 4</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    -->

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Publish_year</th>
                                        <th>ISBN</th>
                                        <th>Created_at</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-user bg-yellow"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                    <p>New phone +1(800)555-1234</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                    <p>nora@example.com</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                    <p>Execution time 5 seconds</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-warning pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right">
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                            </label>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="AdminLTE/bower_components/raphael/raphael.min.js"></script>
    <script src="AdminLTE/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="AdminLTE/bower_components/moment/min/moment.min.js"></script>
    <script src="AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script src="AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="AdminLTE/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="AdminLTE/dist/js/demo.js"></script>
    <script>
        $(function () {
            $('#example1').DataTable({
                'pageLength': 20,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
    <script>
        function click_search(){
            window.location.href = 'http://kubook.kodev.kr/manage_book.php?search_word='+$('#input_word').val();
        }
    </script>
    <script>
        function do_update(id){
            location.href="update_book.php?book_id="+id;
        }
        function do_remove(id){
            $.get(
                "action_book_remove.php",
                {book_id : id},
                function(data) {
                    alert(data);
                    location.reload();
                }
            );
        }
    </script>
    </body>
    </html>

    <?
}
?>