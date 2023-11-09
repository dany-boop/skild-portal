	// ************************************************
	// Shopping Cart API
	// ************************************************
	function convertRp(x) {
		var y = 0;
		if (x == null || x == 0) {
			y = 0;
		} else {
			y = x;
		}
		var number_string = y.toString();
		var sisa = number_string.length % 3;
		var rupiah = number_string.substr(0, sisa);
		var ribuan = number_string.substr(sisa).match(/\d{3}/g);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		return rupiah;
	}

	var cartItems = (function() {
		// =============================
		// Private methods and propeties
		// =============================
		cart = [];

		// Constructor
		function Item(name, price, url, weight, count, id) {
			this.name = name;
			this.price = price;
			this.count = count;
			this.id = id;
			this.url = url;
			this.weight = weight;
		}

		// Save cart
		function saveCart() {
			localStorage.setItem('cartItemsAzarine', JSON.stringify(cart));
		}

		// Load cart
		function loadCart() {
			cart = JSON.parse(localStorage.getItem('cartItemsAzarine'));
		}
		if (localStorage.getItem("cartItemsAzarine") != null) {
			loadCart();
		}


		// =============================
		// Public methods and propeties
		// =============================
		var obj = {};

		// Add to cart
		obj.addItemToCart = function(name, price, url, weight, count, id) {
			event.preventDefault();
			for (var item in cart) {
				if (cart[item].name === name) {
					// cart[item].price = price;
					cart[item].count += count
					saveCart();
					return;
				}
			}
			var item = new Item(name, price, url, weight, count, id);
			cart.push(item);
			saveCart();
		}

		// Set count from item
		obj.setCountForItem = function(name, count) {
			for(var i in cart) {
				if (cart[i].name === name) {
					cart[i].count = count;
					break;
				}
			}
		};
		// Remove item from cart
		obj.removeItemFromCart = function(name) {
			for (var item in cart) {
				if (cart[item].name === name) {
					cart[item].count--;
					if (cart[item].count === 0) {
						cart.splice(item, 1);
					}
					break;
				}
			}
			saveCart();
		}

		// Remove all items from cart
		obj.removeItemFromCartAll = function(name) {
			for (var item in cart) {
				if (cart[item].name === name) {
					cart.splice(item, 1);
					break;
				}
			}
			saveCart();
		}

		// Clear cart
		obj.clearCart = function() {
			cart = [];
			saveCart();
		}

		// Count cart 
		obj.totalCount = function() {
			var totalCount = 0;
			for (var item in cart) {
				totalCount += cart[item].count;
			}
			return totalCount;
		}

		// Total cart
		obj.totalCart = function() {
			var totalCart = 0;
			for (var item in cart) {
				totalCart += cart[item].price * cart[item].count;
			}
			return Number(totalCart.toFixed(2));
		}

		// List cart
		obj.listCart = function() {
			var cartCopy = [];
			for (i in cart) {
				item = cart[i];
				itemCopy = {};
				for (p in item) {
					itemCopy[p] = item[p];

				}

				itemCopy.total = Number(item.price * item.count).toFixed(2);
				cartCopy.push(itemCopy)
			}
			return cartCopy;
		}

		return obj;
	})();


	// *****************************************
	// Triggers / Events
	// ***************************************** 
	// Add item
	

	$('.add-to-cart').click(function(event) {
		var a = $("#product-qty").val();
		if (a){
			$('.add-to-cart').data('quantity', Number(a));
		}
		
		var name = $(this).data('name');
		var price = Number($(this).data('price'));
		var id = $(this).data("id");
		var count = $(this).data('quantity');
		var url = $(this).data('image');
		var weight = $(this).data('weight');
		cartItems.addItemToCart(name, price, url, weight, count, id);
		displayCart();
		displayCartRight();
		displayCartRightSummary();
		displayCheckout();
		// location.reload();
	});

	// Clear items
	$('.clear-cart').click(function() {
		cartItems.clearCart();
		displayCart();
	});



	function displayCart() {
		var cartArray = cartItems.listCart();
		var output = "";
		for (var i in cartArray) {
			output +=
				`      <tr>

              <td>
               <div class="columns is-multiline is-mobile is-vcentered ">
                 <div  class="column is-full-mobile is-4-tablet" >
                  <img src="` + cartArray[i].url + `" class="img-100">
                </div>
                <div  class="column is-full-mobile is-8-tablet" >
                  <h3 class="mb-0 is-size-7">`+cartArray[i].name+`</h3>

                </div>
              </div>
            </td>

            <td align="right">
             <h3>Rp ` + convertRp(cartArray[i].price) + `</h3>
           </td>

           <td>
            <div class="field has-addons has-addons-centered">
              <p class="control">
                <a class="button bg-violet quantity-left-minus btn btn-minus btn-number minus-item"  data-name="` + cartArray[i].name + `" >
                  <span class="">-</span>
                </a>
              </p>
              <p class="control">
   
                <input type="text"  class="form-control input-number input item-count" data-name="` + cartArray[i].name + `"  value="` + cartArray[i].count + `"  style="text-align: center;    border-top: 1px solid #dbdbdb;
    			border-left: 1px solid #dbdbdb;">
   
              </p>
              <p class="control">
                <a class="button bg-violet quantity-right-plus btn btn-order btn-number plus-item" data-name="` + cartArray[i].name + `" >
                  <span class="">+</span>
                </a>
              </p>
            </div>
          </td>

          <td align="right">
            <h3>Rp ` + convertRp(cartArray[i].total) + `</h3>
          </td>
          
          <td>
              <i class="fas fa-trash delete-item" data-name="` + cartArray[i].name + `" style="float: right;"></i>
          </td>
        </tr>`;

		}
		$('.show-cart').html(output);
		$('.total-cart').html("Rp " + convertRp(cartItems.totalCart()));
		$('.total-count').html(cartItems.totalCount());
	}

	function displayCartRight() {
		var cartArray = cartItems.listCart();
		var output = "";
		for (var i in cartArray) {
			output +=
				` <tr>

	             <td>
	               <div class="columns is-multiline is-mobile is-vcentered">
	                 <div  class="column is-3-mobile is-3-tablet pr-0" >
	                  <img src="` + cartArray[i].url + `" class="img-100">
	                </div>
	                <div  class="column is-9-mobile is-9-tablet" >
	                	<div class="columns is-multiline is-mobile is-vcentered">
		                	<div  class="column is-full-mobile is-6-tablet" >
		                  <h3 class="mb-0 is-size-7 font-or">`+cartArray[i].name+`</h3>
		                  <h3 class="font-or">Rp ` + convertRp(cartArray[i].price) + `</h3>
		                  
		                  </div>
		                  <div  class="column is-8-mobile is-6-tablet">
		                  		 <div class="field has-addons has-addons-centered">
					              <p class="control">
					                <a class="button bg-violet quantity-left-minus btn btn-minus btn-number minus-item"  data-name="` + cartArray[i].name + `" >
					                  <span class="">-</span>
					                </a>
					              </p>
					              <p class="control">
					   
					                <input type="text"  class="form-control input-number input item-count" data-name="` + cartArray[i].name + `"  value="` + cartArray[i].count + `"  style="text-align: center;    border-top: 1px solid #dbdbdb;
					    			border-left: 1px solid #dbdbdb;">
					   
					              </p>
					              <p class="control">
					                <a class="button bg-violet quantity-right-plus btn btn-order btn-number plus-item" data-name="` + cartArray[i].name + `" >
					                  <span class="">+</span>
					                </a>
					              </p>
					            </div>
		                  </div>
	                  </div>
	                </div>

	              </div>
	            </td>

	 		   <td>
	              <a class="delete-item delete-hover" data-name="` + cartArray[i].name + `" style="float: right; color: #a70000;">x</a>
	          </td>
        	</tr>`;

		}
		$('.show-cart-right').html(output);
		$('.total-cart').html("Rp " + convertRp(cartItems.totalCart()) + "<input type='hidden' value='"+cartItems.totalCart()+"' class='totcart'>");
		$('.total-count').html(cartItems.totalCount());
	}

	function displayCartRightSummary() {
		var cartArray = cartItems.listCart();
		var output = "";
		for (var i in cartArray) {
			output +=
				` <div class="column is-full-mobile is-12-tablet">
						<div class="columns is-mobile is-multiline">
							<div class="column is-8-mobile is-8-tablet">
								<h3 class="mb-0 is-size-7 font-or">`+cartArray[i].name+`</h3>
								<h3 class="font-or">Rp ` + convertRp(cartArray[i].price) + `</h3>
							</div>
							<div class="column is-4-mobile is-4-tablet has-text-right">
								x ` + cartArray[i].count + `
							</div>
						</div>
				</div>`;
				// output +=
				// ` <tr>
				// 	<td style="padding: 0.2rem 0rem;"><h3 class="mb-0 is-size-7 font-or">`+cartArray[i].name+`</h3>
				// 		<h3 class="font-or">Rp ` + convertRp(cartArray[i].price) + `</h3>
				// 	</td>
				// 	<td style="padding: 0.2rem 0rem;">
				// 		x ` + cartArray[i].count + `
				// 	</td>
				// </tr>`;

		}
		$('.show-cart-right-summary').html(output);
		$('.total-cart1').html("Rp " + convertRp(cartItems.totalCart()) + "<input type='hidden' value='"+cartItems.totalCart()+"' name='grandTotal' class='totcart'>");
		$('.total-count').html(cartItems.totalCount());
	}

	function displayCheckout() {
		var cartArray = cartItems.listCart();
		var output = "";
		for (var i in cartArray) {
			output +=
				`
	               <div class="columns is-multiline is-mobile ">
	                 <div  class="column is-3-mobile is-3-tablet" >
	                  <img src="` + cartArray[i].url + `" class="img-100" style="height:60px;">
	                </div>
	                <div  class="column is-9-mobile is-9-tablet" >
	                  <h3 class="mb-0 is-size-7 font-or">`+cartArray[i].name+`</h3>
	         		  <div class="columns is-multiline is-mobile ">
		                  <div  class="column is-8-mobile is-8-tablet" >
		                  	<h3 class="font-or">Rp ` + convertRp(cartArray[i].price) + `</h3>
		                  </div>
		                  <div  class="column is-4-mobile is-4-tablet has-text-right" >
		                   	<h3 class="font-or">x`+cartArray[i].count+`</h3>
		                  </div>
	                  </div>

	                </div>
	              </div>
	            
        `;
		}
		$('.show-cart1').html(output);
		$('#totalPrice').val(cartItems.totalCart());
		$('.total-cart1').html("Rp " + convertRp(cartItems.totalCart()) + "<input type='hidden' value='"+cartItems.totalCart()+"' name='grandTotal' class='totcart'>");
	}

	// Delete item button
	$('.show-cart-right').on("click", ".delete-item", function(event) {
		var name = $(this).data('name');
		cartItems.removeItemFromCartAll(name);
		displayCartRight();
		displayCartRightSummary();
		displayCheckout();
	})

	$('.show-cart-right').on("click", ".delete-item", function(event) {
		var name = $(this).data('name');
		cartItems.removeItemFromCartAll(name);
		displayCartRight();
		displayCartRightSummary();
		displayCheckout();
	})

	// -1
	$('.show-cart-right').on("click", ".minus-item", function(event) {
		var name = $(this).data('name');
		cartItems.removeItemFromCart(name);
		displayCartRight();
		displayCartRightSummary();
		displayCheckout();
	})
	// +1
	$('.show-cart-right').on("click", ".plus-item", function(event) {
		var name = $(this).attr("data-name");
		cartItems.addItemToCart(name, 0, 0, 0, 1,0);
		displayCartRight();
		displayCartRightSummary();
		displayCheckout();
	})

	// Item count input
$('.show-cart-right').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
  cartItems.setCountForItem(name, count);
  displayCartRight();
  displayCartRightSummary();
  displayCheckout();
});

	// $('.show-cart').on("submit", ".item-p-count", function(event) {
	// 	var name = $(this).data('name');
	// 	var count = Number($(this).val());
	// 	cartItems.setCountForItem(name, count);
	// 	displayCart();
	// });

	// $( ".count-form" ).submit(function( event ) {
	// 	count();
	// 	displayCart();
	// });

	displayCart();
	displayCheckout();
	displayCartRight();
	displayCartRightSummary();



