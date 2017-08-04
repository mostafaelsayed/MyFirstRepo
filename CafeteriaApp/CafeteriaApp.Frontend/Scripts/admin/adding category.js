function categoryNewViewModel() {
  var self = this;
  self.categoryName = ko.observable();
  self.categoryImage = ko.observable();
  self.chooseImageClicked = ko.observable(0);
  ko.fileBindings.defaultOptions.buttonText = "Choose Image";
  self.fileData = ko.observable({
    base64String: ko.observable(),
    dataURL: ko.observable()
  });
  var x = window.location.href;
  self.cafeteriaId = ko.observable(parseInt(x.split("?id=")[1]));


  // self.getCategory = function() {
  //   $.ajax({
  //     type: 'GET',
  //     url: '/CafeteriaApp.Backend/Requests/Category.php?id='+self.cafeteriaId(),
  //     contentType: 'application/json'
  //   }).done(function(response){
  //     var data = JSON.parse(response);
  //     self.categoryName(data.Name);
  //     self.categoryImage(data.Image);
  //   }).fail(function(response){
  //     console.log(response);
  //   });
  // }

  $("#file").on('change' , function() {
        self.chooseImageClicked(1);
  });

  //self.getCafeteria();

  self.addCategory = function() {
    //console.log(id);
    var data = {
      //Id: id,
      Name: self.categoryName(),
      Image: self.fileData().base64String(),
      CafeteriaId: self.cafeteriaId()
    };
    $.ajax({
      type: 'POST',
      url: '/CafeteriaApp.Backend/Requests/Category.php',
      contentType: 'application/json; charset=utf-8',
      data: JSON.stringify(data)
    }).done(function(response){
      console.log(response);
      //self.getCafeteria();
      window.history.back();
      // var data = JSON.parse(response);
      // self.cafeteriaName(data.Name);
      // self.cafeteriaImage(data.Image);
    }).fail(function(response){
      console.log(response);
    });
   }
}
