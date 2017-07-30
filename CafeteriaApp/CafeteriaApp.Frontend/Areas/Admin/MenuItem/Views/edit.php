
<title>Edit MenuItem</title>
<?php
include('CafeteriaApp.Frontend/Areas/Admin/layout.php');
 ?>
 <script src="/CafeteriaApp.Frontend/Scripts/admin/menuitem.js"></script>
 <div id="page-wrapper" style="margin-top:-600px">
 <div class="row">
     <div class="col-lg-12">
         <h1 class="page-header">Edit MenuItem</h1>
     </div>
     <!-- /.col-lg-12 -->
 </div>
<div class="row" ng-app="myapp" ng-controller="editMenuItem">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit MenuItem
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form">
                            <div class="form-group" >
                                <label>Name</label>
                                <input type="text" class="form-control" autofocus="autofocus" ng-model="Name" name="name" id="name" required>
                                <label>Price</label>
                                <input type="text" class="form-control" ng-model="Price" name="name" id="name" required>
                                <label>Description</label>
                                <input type="text" class="form-control" ng-model="Description" name="name" id="name" required>
                            </div>
                            <!-- <div data-bind="fileDrag: fileData">
                                <div class="image-upload-preview">
                                    <img width="370" height="266" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                </div>
                                <div class="image-upload-input">
                                    <input type="file" data-bind="fileInput: fileData,customFileInput: {}">
                                </div>
                            </div> -->
                            <div class="form-group" style="float: right">
                                <button ng-click="editMenuItem()" class="btn btn-primary">Save</button>
                                <!-- <button data-bind="click:cancel" class="btn btn-danger">Cancel</button> -->
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </div>
