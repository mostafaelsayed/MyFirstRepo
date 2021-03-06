<?php
  require(__DIR__ . '/../layout.php');
?>

<title>Categories</title>

<link rel="stylesheet" type="text/css" href="/js/alertify/css/alertify.min.css">
<link rel="stylesheet" type="text/css" href="/js/alertify/css/themes/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/js/alertify/css/themes/default.min.css">
<link rel="stylesheet" type="text/css" href="/js/alertify/css/themes/semantic.min.css">

<!-- <link href="/css/alertify.bootstrap.css" rel="stylesheet">
<link href="/css/alertify.core.css" rel="stylesheet">
<link href="/css/alertify.default.css" rel="stylesheet"> -->

<style type="text/css">
  .w3-animate-zoom {
    animation: animatezoom 0.6s
  }

  @keyframes animatezoom {
    from {
      transform: scale(0)
    }
    to {
      transform: scale(1)
    }
  }

  .img-block {
    display: inline-block;
    border: 1px solid;
  }
    
</style>

<div class="container">

  <h1 class="page-header" id="header" style="color: #965C2A">Categories</h1>

  <div class="w3-animate-zoom row" ng-controller="getCategories">

      <div class="col-md-6" ng-repeat="c in categories">

        <div style="text-align: center;font-size: 20px">

          <!-- text-decoration: none is to remove the little black line on the image -->
          <a style="text-decoration: none;" href="/public/categories/{{c.Name}}">
            <img class="img-rounded img-block" style="margin: 0 auto;width: 300px;height: 300px" ng-src={{c.Image}} />
          </a>

          <br>

          <a href="/public/categories/{{c.Name}}"><span ng-bind="c.Name"></span></a>

        </div>

      </div>

  </div>

</div>

<script src="/js/show_categories.js"></script>
<script type="text/javascript" src="/js/alertify/alertify.min.js"></script>

<?php require(__DIR__ . '/footer.php'); ?>