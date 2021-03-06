<div class="row" ng-controller="getMenuItemsAndCustomerOrder" ng-init="customer='<?= $userName; ?>';userImage='<?=$userImage;?>'; loggedIn='<?=$loggedIn?>'" >

  <div class="col-md-8 w3-animate-bottom">
    
    <div class="row" ng-repeat="m in menuItems" style="width: 100%;margin-left: 40px">
      <div class="row">
        <div class="col-md-6">
          <img class="img-rounded img-block" style="width: 70%;height: 70%;" src="{{m.Image}}"/>

          <h1 ng-bind="m.Name" class="menu-name"></h1>

          <a ng-if='loggedIn' id="{{'favorites' + m.Id}}" class="btn btn-info btn-favorite" title="add to favorites" ng-click="toggleFavoriteItem(m.Id)">
            <span class="glyphicon glyphicon-heart"></span>
          </a>

          <a ng-if='loggedIn' class="btn btn-circle addToOrder clickable" title="Add To Order" ng-click="addToOrder(m.Id)" >
            <i style="font-size: 3rem" class="fa fa-plus"></i>
          </a>
        </div>
      

        <div class="col-md-6">
          <!-- Stars Rating -->
          <div class="stars" ng-if='loggedIn'>
            <form>
              <input ng-change='addRatingOrUpdate(m.Id, data.ItemRating[$index])' class="star star-5" id="star-5-{{m.Id}}" type="radio" name="star" value="5" ng-model="data.ItemRating[$index]" />
              <label class="star star-5" for="star-5-{{m.Id}}"></label>
              <input ng-change='addRatingOrUpdate(m.Id, data.ItemRating[$index])' class="star star-4" id="star-4-{{m.Id}}" type="radio" name="star" value="4" ng-model="data.ItemRating[$index]" />
              <label class="star star-4" for="star-4-{{m.Id}}"></label>
              <input ng-change='addRatingOrUpdate(m.Id, data.ItemRating[$index])' class="star star-3" id="star-3-{{m.Id}}" type="radio" name="star" value="3" ng-model="data.ItemRating[$index]" />
              <label class="star star-3" for="star-3-{{m.Id}}"></label>
              <input ng-change='addRatingOrUpdate(m.Id, data.ItemRating[$index])' class="star star-2" id="star-2-{{m.Id}}" type="radio" name="star" value="2" ng-model="data.ItemRating[$index]" />
              <label class="star star-2" for="star-2-{{m.Id}}"></label>
              <input ng-change='addRatingOrUpdate(m.Id, data.ItemRating[$index])' class="star star-1" id="star-1-{{m.Id}}" type="radio" name="star" value="1" ng-model="data.ItemRating[$index]" />
              <label class="star star-1" for="star-1-{{m.Id}}"></label>
            </form>
          </div>
       
          <a title="Show/Hide Comments" style="color: orange;float: right" ng-click="toggleMenuItemComments($index, m.Id)" class="btn btn-lg btn-comments">
            <span style="color: #5bc0de;" class="glyphicon glyphicon-comment"></span>
          </a>
          <div style="color: orange;font-style: italic;font-size: 2rem">
            <div><b>Price :</b> $ <span ng-bind="m.Price"></span>
            </div>

            <div><b>Rating : </b> 
              <span ng-bind="m.Rating" ></span>
              <span> from </span>
              <span ng-bind="m.RatingUsersNo" ></span>
              <span>  user(s)</span>
            </div>

            <div><b>calories: </b>35 kcl</div>
            <div><b>Description : </b>ingredients,
              <span ng-bind="m.Description"></span>
            </div>

          </div>
        </div>
      </div>
      <!-- Comments -->
      <div class="row">
        <table class="col-md-12 comments" id="{{'comments' + m.Id}}" ng-if="data.ShowHides[$index]" style="box-shadow: -12px -12px 12px #E9E598">
        
          <tbody>
            <tr ng-repeat="comm in data.comments[$index]">
              <td>
                <img src="{{comm.Image}}" style="width: 50px;height: 50px;border-radius: 50%;box-sizing: border-box;">
                &nbsp;<span style="font-size: 1.2rem">
                {{comm.UserName}}</span>
              </td>
              <td>{{comm.Date}}</td>
              <td><p style="font-size: 1.7rem">{{comm.Details}}</p></td>
              <td ng-if="checkEditAndRemove( comm.Id, menuItems.indexOf(m) )">
                <a style="cursor: pointer" ng-click="editComment( $index, menuItems.indexOf(m) )">edit</a> &nbsp;
                <a ng-click="deleteComment( comm.Id, $index, menuItems.indexOf(m) )" style="cursor: pointer">remove</a>
              </td>
            </tr>
          </tbody>
     
          <tbody ng-if='loggedIn'>
            <tr>
            <!-- <textarea ng-KeyPress="$event.keyCode ==13 ? addCommentBackAndFront(m.Id,commentDetails,customer) :null" ></textarea> -->
              <td colspan="2">
                <textarea id="{{'textarea' + $index}}" type="textarea" placeholder="add your comment ........" ng-model="data.commentDetails[$index]" style="display: block;width: 100%;border-radius: 10px;line-height: 2.5rem;padding-bottom: 10px;">
                </textarea>

              </td>
              <td> 
                <input id="{{'addUpdateBtn' + $index}}" style="display: block;margin-left: 10px;" class="btn btn-info" type="submit" name="addComment" value="Add" ng-click="addCommentBackAndFront($index, m.Id, data.commentDetails[$index], customer, data.add_edits[$index], userImage)"/>
              </td>

            </tr>
          </tbody>

        </table>

      </div>

      <div ng-cloak ng-if="menuItems.indexOf(m) < menuItems.length - 1">
        <hr width="100%" style="background-color: black">
      </div>

      <br>
    </div>
  </div>

  <div id="openOrder" ng-if='loggedIn' ng-if="orderItems.length > 0 && roleid == false" class="col-md-4 w3-animate-zoom" style="position: fixed;right: 0;bottom: 0" ng-cloak>

    <div>
      <label style="color: white;margin-left: 10px;font-size: 1.5rem">Order {{orderId}}
      </label>
    
      <a class="btn checkout pull-right" style="margin-bottom: 5px" ng-href="/checkout/{{orderId}}" ng-cloak target="_self">
        Checkout <span class="glyphicon glyphicon-usd"></span>
      </a>

      <a onclick="$('.table.order').fadeToggle('slow');$(this).children('span').toggleClass('glyphicon-arrow-up glyphicon-arrow-down');" class="pull-right btn btn-info btn-circle" style="margin:0 10px 0 0;padding: 5px 0" href="javascript:;"><span class="glyphicon glyphicon-arrow-down"></span>
      </a>

      <a style="font-style: italic;color: white" class="btn btn-info btn-lg" href="/cashier/order/show" ng-cloak ng-if="roleid == true" target="_self">
        Return To Orders
      </a>
    </div>

    <table class="table order" ng-cloak ng-if="orderItems.length > 0">
      <thead>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th>Total Price</th>
          <th></th>
        </tr>
      </thead>

      <tbody ng-repeat="o in orderItems">

        <tr>
          <td style="color: #58AF50;font-size: 2rem;font-family: FontAwesome" ng-bind="o.Name" ></td>
          <td style="font-size: 2rem" ng-bind="o.Quantity"></td>
          <td ng-bind="o.TotalPrice"></td>
          <td ng-cloak ng-if="orderItems.length > 0">
            <div style="width: 100px;border-radius: 50%;border: 2px solid orange;text-align: center">

              <a title="Increase Quantity" ng-click="increaseQuantity(o)" class="btn"><i class="fa fa-plus"></i></a>

              <a style="color: red" title="Decrease Quantity" ng-click="decreaseQuantity(o)" class="btn"><i class="fa fa-minus"></i>
              </a>

            </div>
            
            <a class="btn removeItem" title="Remove From Order" ng-click="deleteOrderItem(o)" style="font-style: italic">Remove Item
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- <div id="thead">Total: <span ng-bind="currentOrder.Total"></span></div> -->
  </div>

</div>