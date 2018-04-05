<?php

  require(__DIR__.'/../../../CafeteriaApp.Backend/functions.php');

  validatePageAccess($conn);

  require(__DIR__.'/../layout.php');

?>

<head>

  <title>Adding Category</title>

  <link href="../../css/input_file.css" rel="stylesheet">

  <script src="../../js/image_module.js"></script>

  <script src="../../js/location_provider.js"></script>

  <script src="../../js/add_category.js"></script>

</head>

<div class="row">
  
  <h1 class="page-header">Create Category</h1>

</div>

<div ng-app="add_category" ng-controller="addCategory">

  <div class="row">

    <form novalidate role="form" name="myform" id="centerBlock">

      <div class="form-group">

        <label>Name</label>

        <input id="inputField" type="text" class="form-control" ng-model="name" ng-maxlength="20" name="name" required />

        <span ng-show="myform.name.$touched && myform.name.$invalid && name.length == 0" id="inputControl" ng-cloak>

          Category Name is Required

          <br>

        </span>

        <span ng-show="myform.name.$error.maxlength" id="inputControl" ng-cloak>

          Category Name must be less than or equal to 20 characters

          <br>

        </span>

        <br>

        <div><label>Image</label></div>

        <div class="dropzone" file-dropzone="[image/png, image/jpeg]" file="image" file-name="imageFileName" data-max-file-size="3">

        </div>

        <input type="file" fileread="uploadme.src" name="file" id="file" class="inputfile" required>

        <span ng-show="myform.file.$touched && myform.file.$invalid" id="inputControl" ng-cloak>

          Image is Required

          <br>

        </span>

        <img ng-src="{{ uploadme.src }}" style="width: 300px;height: 300px">

        <span>

          <button class="btn btn-primary" onclick="mylabel.click()" style="position: absolute;margin-top: 150px">Choose image</button>

          <label id="mylabel" for="file"></label>

        </span>

      </div>

      <div class="form-group">

        <input type="submit" value="save" class="btn btn-primary" ng-click="addCategory()">

      </div>

    </form>

  </div>

</div>