<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/CafeteriaApp.Frontend/fonts/glyphicons-halflings-regular.eot" rel="font-woff">
  <link href="/CafeteriaApp.Frontend/fonts/glyphicons-halflings-regular.svg" rel="font-woff">
  <link href="/CafeteriaApp.Frontend/fonts/glyphicons-halflings-regular.ttf" rel="x-font-ttf">
  <link href="/CafeteriaApp.Frontend/fonts/glyphicons-halflings-regular.woff" rel="font-woff">
  <link href="/CafeteriaApp.Frontend/fonts/glyphicons-halflings-regular.woff2" rel="font-woff">
  <link href="/CafeteriaApp.Frontend/Content/font face.css" rel="stylesheet">

  <script src="/CafeteriaApp.Frontend/Scripts/libs/jquery-3.2.1.js"></script>
  <script src="/CafeteriaApp.Frontend/Scripts/libs/angular.min.js"></script>
  <script src="/CafeteriaApp.Frontend/Scripts/libs/bootstrap.min.js"></script>
  <script src="/CafeteriaApp.Frontend/Scripts/libs/bootstrap-gh-pages/ui-bootstrap-2.5.0.js"></script>

  <script src="/CafeteriaApp.Frontend/Scripts/libs/bootstrap-gh-pages/ui-bootstrap-tpls-2.5.0.js"></script>
  <!-- <script src="/CafeteriaApp.Frontend/Scripts/libs/angular-route.js"></script> -->

  <script src="/CafeteriaApp.Frontend/Scripts/libs/angular-modal-service.js"></script>
  <!-- <script src="/CafeteriaApp.Frontend/Scripts/libs/knockout-3.4.2.js"></script> -->
  <!-- <script src="/CafeteriaApp.Frontend/Scripts/alertify/alertify.min.js"></script> -->
  <!-- Bootstrap Core CSS -->
  <link href="/CafeteriaApp.Frontend/Content/bootstrap.min.css" rel="stylesheet">



  <!-- MetisMenu CSS -->
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/metisMenu/metisMenu.min.css" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
  <!-- DataTables Responsive CSS -->
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/sb-admin-2.css" rel="stylesheet">
  <!-- Morris Charts CSS -->
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/morrisjs/morris.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/font-awesome/fonts/fontawesome-webfont.woff" rel="font-woff">
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/font-awesome/fonts/fontawesome-webfont.woff2" rel="octet-stream">
  <link href="/CafeteriaApp.Frontend/Scripts/adminTheme/font-awesome/fonts/fontawesome-webfont.ttf" rel="x-font-ttf">
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/metisMenu/metisMenu.min.js"></script>
  <!-- DataTables JavaScript -->
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/datatables/js/jquery.dataTables.min.js"></script>
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/datatables-plugins/dataTables.bootstrap.min.js"></script>
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/datatables-responsive/dataTables.responsive.js"></script>
  <!-- Morris Charts JavaScript -->
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/raphael/raphael.min.js"></script>
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/morrisjs/morris.min.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="/CafeteriaApp.Frontend/Scripts/adminTheme/sb-admin-2.js"></script>
 
  <link href="/CafeteriaApp.Frontend/Areas/Customer/layout_style.css" rel="stylesheet" type="text/css">
 <!-- <link href="/CafeteriaApp.Frontend/Areas/Customer/layout_style.css" rel="stylesheet" type="text/css"> -->


 
 </head>
 <body style="background-image:	url('/CafeteriaApp.Frontend/Scripts/CustomerTheme/images/background image1.jpg')">
<div id="wrapper">
        <!-- Navigation -->
      <nav class="navbar navbar-default navbar-fixed-top" style="background-image:	url('/CafeteriaApp.Frontend/Scripts/CustomerTheme/images/background image1.jpg')">
        <div class="container-fluid">
          <div class="navbar-header">
            <a style="color:white" class="navbar-brand" href="/CafeteriaApp.Frontend/Areas/Public/Cafeteria/Views/showing cafeterias.php">Cafeterias Page</a>
          </div>
          <ul class="nav navbar-nav">
            <li ><a class="navbar-brand"  href="#">Home</a></li>
            <li><a class="navbar-brand"  href="#"> <?php echo _("Contact");?></a></li>
            <li><a class="navbar-brand"  href="#"><?php echo _("Help");?></a></li>
            <li><a class="navbar-brand"  href="/CafeteriaApp.Frontend/Views/logout.php">Log out</a></li>
            <form action="/TestI18N/language.php" method="post" style="float:right">
              <input type="submit" name="english" value="English" />
              <input type="submit" name="german" value="German" />
            </form>


          </ul>
          </div>

      </nav>
      </div>
        <!-- /#page-wrapper -->
<div> Copyright &copy;<?php echo date("Y"); ?>, Restaurant</div>
    </body>
    </html>
