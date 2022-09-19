$(document).ready(function(){

	var DOMAIN = ".";

	getAllShopCategories();
	getAllShopProducts(1);
	showLoadingPlaceholder();
	showData();
	getProductCategory();
	getCategoryAndProduct();
	countCartTotalAmount();
	getCartItems();
	getTotalCartAmount();
	getOrderItems();
	getTotalOrderAmount();
	hidePasswordField();
	getBillingDetails();
	hideLogoutBtn();
	getAllFeaturedCollections();
	getFeaturedProducts(4);
	getCategoriesSlider();
	//getIpAddress();
	//hideAllProducts();
	//hideLoadingPlaceholder();

	/*-----------------------
        Categories Slider
    ------------------------*/

    function getSliderFunction(){
	    $(".categories__slider").owlCarousel({
	        loop: true,
	        margin: 0,
	        items: 4,
	        dots: false,
	        nav: true,
	        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
	        animateOut: 'fadeOut',
	        animateIn: 'fadeIn',
	        smartSpeed: 1200,
	        autoHeight: false,
	        autoplay: true,
	        responsive: {

	            0: {
	                items: 1,
	            },

	            480: {
	                items: 2,
	            },

	            768: {
	                items: 3,
	            },

	            992: {
	                items: 4,
	            }
	        }
	    });
	}

	$('.icon-close').on('click', function(){
		var referer = $("#referer").val();
		if ($("#referer").val() != "") {
			window.location.href = referer;
		}else{
			window.location.href = DOMAIN;
		}
	});

	$("body").delegate("#featured-controls li", "click", function(){
		
		$("#featured-controls li").removeClass('active');
		$(this).addClass('active');

	});

	$("body").delegate("#mainfeaturedcollection","click",function(){
		var colid = $(this).attr("colid");
		var limit = 4;
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getFeaturedProductsByCollection:1,collectionid:colid,limit:limit},
			success : function(data){
				$("#featured__filter").html(data);
			}
		})
	})

	function getCategoriesSlider(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getCategoriesSlider:1},
			success : function(data){
				$("#categories__slider_items").html(data);
				getSliderFunction();
			}
		})
	}

	$("body").delegate("#allmaincategories","click",function(){
		var limit = 4;
		getFeaturedProducts(limit);
	})

	function getFeaturedProducts(limit){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getFeaturedProducts:1,limit:limit},
			success : function(data){
				$("#featured__filter").html(data);
			}
		})
	}	

	$('.p-categories').on('click', 'li', function() {
	    $( ".p-categories li" ).removeClass( "active" ); //assuming that it has to be removed from other li's, else remove this line
	    $( this ).addClass( "active" );
	});

	$('.btn-user').on('click', function(){
		$('.chev-down').toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
		toggleLogoutBtn();
	})

	function hideLogoutBtn(){
		$("#btn-logout").hide();
	}

	function toggleLogoutBtn(){
		$("#btn-logout").toggle();
	}

	$('#acc').on('click', function(){
		if($(this).is(':checked')) {
	    	showPasswordField();
	    }else {
    		hidePasswordField();	    
	    }
	})

	var paymentmethod = "";
	$("#check-payment-stkpush").prop("checked", false);
	$("#check-payment-paybill").prop("checked", false);
	$("#stkpushtransactionprogress").hide();

	$('#check-payment-paybill').on('click', function(){
		if($(this).is(':checked')) {
	    	paymentmethod = "paybill";
	    	$("#check-payment-stkpush").prop("checked", false);
	    	$(".checkout__order__widget").css({"border": "none"});
			$(".p-info-text").css({"color": "#444444"});
	    }else {
    		paymentmethod = "";	    
	    }
	    //alert(paymentmethod);
	})

	$('#check-payment-stkpush').on('click', function(){
		if($(this).is(':checked')) {
	    	paymentmethod = "stkpush";
	    	$("#check-payment-paybill").prop("checked", false);
	    	$(".checkout__order__widget").css({"border": "none"});
			$(".p-info-text").css({"color": "#444444"});
	    }else {
    		paymentmethod = "";	    
	    }
	    //alert(paymentmethod);
	})

	$("#back").hide();
	$(".checkout__order_details").hide();
	$("#back").on("click",function(){
		//$(".checkout__form__details").css({"width":"0"});
		$(".checkout__form").show();
		$(".checkout__order_details").hide();
		$("#skip").show();
		$("#back").hide();
	})
	$("#skip").on("click",function(){
		//$(".checkout__form__details").css({"width":"0"});
		$(".checkout__form").hide();
		$(".checkout__order_details").show();
		$("#skip").hide();
		$("#back").show();
	})

	var totalamount = "";
	$('#btn-order').on('click',function(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getTotalCartAmount:1},
			success : function(data){
				totalamount = data;
				if (paymentmethod == "") {
					$(".checkout__order__widget").css({"border-style": "solid",
					    "border-width": "1px",
					    "border-color": "red",
					    "padding": "5px",
					    "margin-bottom": "5px"});
					$(".p-info-text").css({"color": "red"});
				}else if (paymentmethod == "paybill") {
					$(".checkout__order__widget").css({"border": "none"});
					$(".p-info-text").css({"color": "#444444"});
					$("#paybillmodal").modal("show");
					$("#paybillamount").html(totalamount);
				}else if (paymentmethod == "stkpush") {
					$(".checkout__order__widget").css({"border": "none"});
					$(".p-info-text").css({"color": "#444444"});
					$("#stkpushmodal").modal("show");
					$("#stkpushamount").html(totalamount);
				}
				//lipaNaMpesa(totalamount);
			}
		})
		/*
		var totalamount = "";
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getTotalCartAmount:1},
			success : function(data){
				totalamount = data;
				lipaNaMpesa(totalamount);
			}
		})
		*/
	})

	$("#stkpushbtn").on("click", function(){
		$("#stkpushtransactionprogress").show();
		var phoneNumber = $("#txtStkPushPhoneNumber");
		var status = false;

		if(phoneNumber.val() == ""){
			phoneNumber.addClass("border-danger");
			$("#pns_error").html("<span class='text-danger'>Enter your phone number</span>");
			status = false;
		}else{
			phoneNumber.removeClass("border-danger");
			$("#pns_error").html("");
			status = true;
		}

		if (status && (phoneNumber.val() != "")) {
			lipaNaMpesa(totalamount,phoneNumber.val());
		}
	})

	$("#psearch").on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get(DOMAIN+"/includes/action.php", {pterm: inputVal}).done(function(data){
                // Display the returned data in browser
                //resultDropdown.html(data);
                //$("#products_table").html(data);
                $(".main-products").html(data);
            });
        } else{
        	getAllShopProducts(1);
            //resultDropdown.empty();
        }
    });

    function getIpAddress(){
    	$.ajax({
    		url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getIpAddress:1},
			success : function(data){
				alert(data);
			}
    	})
    }

	function lipaNaMpesa(amount,phone){
		$.ajax({
			url : DOMAIN+"/PAYMENT_API/lipa.php",
			method : "POST",
			data : {lipaNaMpesa:1,totalamount:amount,phoneno:phone},
			success : function(data){
				$("#stkpushtransactionprogress").hide();
				if (data == '0') {
					//alert("Complete your transaction in your phone and wait for confirmation from us");
				}else{
					//alert(data);
				}
			}
		})
	}

	function showPasswordField(){
		$(".password-field").show();
		$(".cpassword-field").show();
		$("#cp1_error").show();
		$("#cp2_error").show();
	}

	function hidePasswordField(){
		$(".password-field").hide();
		$(".cpassword-field").hide();
		$("#cp1_error").hide();
		$("#cp2_error").hide();
	}

	function getTotalCartAmount(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getTotalCartAmount:1},
			success : function(data){
				$("#cart-total-amt").html("KES ."+data);
			}
		})
	}

	function getTotalOrderAmount(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getTotalOrderAmount:1},
			success : function(data){
				$("#order_total").html("KES ."+data);
			}
		})
	}

	function countCartTotalAmount(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {countCartTotalAmount:1},
			success : function(data){
				$(".tip-cart").html(data);
			}
		})
	}

	function getCartItems(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getCartItems:1},
			success : function(data){
				if (data == 1) {
					$("#cart-options").hide();
					$("#continue-shopping").show();
					$(".shop__cart__table").hide();
				}else{
					$("#continue-shopping").hide();
					$(".shop__cart__table").show();
					$(".shop__cart__table").html(data);
					getTotalCartAmount();
					$("#cart-options").show();
				}
			}
		})
	}

	function getOrderItems(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getOrderItems:1},
			success : function(data){
				if (data == 1) {
					
				}else{
					$("#order-items").html(data);
					getTotalOrderAmount();
				}
			}
		})
	}
/*
	function net_total(){
		var net_total = 0;

		$('#cart__total__price').each(function(){
			net_total =  net_total + ($(this).val() * 1);
			console.log($(this).val());
		})
		//alert(net_total);
		$('#cart-total-amt').html("Ksh. " + net_total + ".00");
	}
*/
	function hideLoadingPlaceholder(){
		$(".animationLoading").hide();
		$(".main-products").show();
	}

	function showLoadingPlaceholder(){
		$(".animationLoading").show();
		$(".main-products").hide();
	}

	function hideAllProducts(){
		$(".main-products").hide();
	}

	function getAllShopCategories(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllShopCategories:1},
			success : function(data){
				$(".p-categories").html(data);
			}
		})
	}

	$("body").delegate("#allcategories","click",function(){
		getAllShopProducts(1);
		$("#category-nav").html("All");
	})

	$("#show-list").on("click",function(){
		alert("hi");
	})

	$("body").delegate(".dec","click",function(){
		var tablename = "cart_table";
		var fieldname = "product_quantity";
		var cpid = $(this).attr("cpid");
		var oldValue = $(this).parent().find('input').val();
		var newVal = "";
		if (oldValue > 1) {
			newVal = parseFloat(oldValue) - 1;
		}else{
			newVal = 1;
		}

		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateRecord:1,table:tablename,id:cpid,field:fieldname,fieldvalue:newVal},
			success : function(data){
				if (data == "UPDATED") {
					getCartItems();
				}else{
					alert(data);
				}
			}
		})
		//$(this).parent().find('input').val(newVal); 
	})

	$("body").delegate(".inc","click",function(){
		var tablename = "cart_table";
		var fieldname = "product_quantity";
		var cpid = $(this).attr("cpid");
		var oldValue = $(this).parent().find('input').val();
		var newVal = parseFloat(oldValue) + 1;
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateRecord:1,table:tablename,id:cpid,field:fieldname,fieldvalue:newVal},
			success : function(data){
				if (data == "UPDATED") {
					getCartItems();
				}else{
					alert(data);
				}
			}
		})
		//$(this).parent().find('input').val(newVal); 
	})

	function getTotals(){
		var table = document.getElementById("cart-table-data"), sumVal = 0;

        for(var i = 1; i < table.rows.length; i++)
        {
            sumVal = sumVal + parseInt(table.rows[i].cells[4].innerHTML);
        }
       
        $("#cart-total-amt").html(sumVal);
	}

	$("body").delegate("#removecartitem","click",function(){
		var rpid = $(this).attr("removepid");
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {deleteCartItem:1,pid:rpid},
			success : function(data){
				if (data == "RECORD_DELETED") {
					getCartItems();
					countCartTotalAmount();
				}else{
					alert(data);
				}
			}
		})
	})

	/*
	var proQty = $('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('inc')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find('input').val(newVal);
    });
    */

	$("body").delegate("#productdetails","click",function(){
		var pid = $(this).attr("pid");
		window.location.href = encodeURI(DOMAIN+"/product_details.php?productid="+pid+"");
		showData();
		getProductCategory();
		
	})

	function psuccessAlert(msg){
		$("#palert").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-success'></i></h5></center><center>" + msg + "</center></div>");
	}

	function pfailAlert(msg){
		$("#palert").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-danger'></i></h5></center><center>" + msg + "</center></div>");
	}

	var $this;
	function showLoader(){
		$this.children(".btn-icon").hide();
		$this.children(".loader").show();
		$this.children(".btn-text").html("Adding to Cart....");
	}

	function hideLoader(){
		$this.children(".btn-icon").show();
		$this.children(".loader").hide();
		$this.children(".btn-text").html("Add To Cart");
	}

	$("body").delegate(".cart-btn","click",function(){
		var pid = $(this).attr("cpid");
		$this = $(this);
		showLoader();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {addCartProduct:1,productid:pid},
			success : function(data){
				if (data == "PRODUCT_ALREADY_EXISTS") {
					pfailAlert("Product is in cart. Continue shopping");
					//hideLoader();
					hideLoader();
				}else if(data == "PRODUCT_ADDED_SUCCESSFULLY"){
					psuccessAlert("You have added a new product to cart");
					countCartTotalAmount();
					//hideLoader();
					hideLoader();
				}else{
					alert(data);
					//hideLoader();
					hideLoader();
				}
			}
		})
	})

	function showData() {
 		var proid = $("#product_id").val();
 		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getProductDetails:1,productid:proid},
			success : function(data){
				$(".single_product_details").html(data);
				$(".loader").hide();
			}
		})
	}

	function getBillingDetails(){
		var customerid = $("#currentcustomerid").val();
		if (customerid != "") {
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : {getBillingDetails:1,userid:customerid},
				success : function(data){
					if (data != "") {
						//console.log(data);
						for(var i in data){
							$("#txtCustomerFirstname").val(data[i].firstname);
							$("#txtCustomerLastname").val(data[i].lastname);
							$("#txtCountry").val(data[i].country);
							$("#txtCustomerAddress").val(data[i].address);
							$("#txtCustomerApartment").val(data[i].apartment);
							$("#txtCity").val(data[i].city);
							$("#txtCustomerPostcode").val(data[i].postcode);
							$("#txtCustomerPhone").val(data[i].phone);
							$("#txtCustomerEmail").val(data[i].email);
						}
					}
				}
			})
		}
	}

	function getCategoryAndProduct(){
		var productid = $("#product_id").val();
		var breadcrumbcontent = "";
		//alert(productid);
 		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getCategoryAndProduct:1,proid:productid},
			success : function(data){
				breadcrumbcontent += '<a href="#" id="shop-category-name">' + data.category.category_name + '</a>' + 
                        '<span id="shop-product-name">' + data.product.product_name + '</span>';
				$("#breadcrumb__links").html(breadcrumbcontent);
				$("#myproduct").html(data.product.product_name);
			}
		})
	}

	function getProductCategory() {
 		var proid = $("#product_id").val();
 		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getProductCategory:1,productid:proid},
			success : function(data){
				$("#product_catid").val(data);
				getRelatedProducts();
				getCategoryAndProduct();
			}
		})
	}

	function getRelatedProducts(){
		var catid = $("#product_catid").val();
		var proid = $("#product_id").val();
 		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getRelatedProducts:1,categoryid:catid,productid:proid},
			success : function(data){
				$("#relatedproducts").html(data);
			}
		})
	}

	function getAllFeaturedCollections(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllFeaturedCollections:1},
			success : function(data){
				$("#featured-controls").html(data);
			}
		})
	}

	function getAllShopProducts(pn){
		showLoadingPlaceholder();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllShopProducts:1,pageno:pn},
			success : function(data){
				$(".main-products").html(data);
				hideLoadingPlaceholder();
			}
		})
	}

	$("body").delegate("#featuredcollection","click",function(){
		
		showLoadingPlaceholder();
		var catid = $(this).attr("catid");
		getAllShopProductsByCategory(catid,1);
		getCategoryName(catid);
		
	})

	function getCategoryName(catid){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getCategoryName:1,cat_id:catid},
			success : function(data){
				if (data != "") {
					$("#category-nav").html(data.category_name);
					$("#txtCategory").val(data.id);
				}
			}
		})
	}

	function getAllShopProductsByCategory(catid,pn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllShopProductsByCategory:1,pageno:pn,categoryid:catid},
			success : function(data){
				$(".main-products").html(data);
				hideLoadingPlaceholder();
			}
		})
	}

/*
	var selector = $('.p-categories li');

	$(selector).on('click', function(){
		alert("hi");
	    $(selector).removeClass('active');
	    $(this).addClass('active');
	});
*/
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		getAllShopProducts(pn);
	})

	$("body").delegate(".cat-link","click",function(){
		var pn = $(this).attr("pn");
		var catid = $("#txtCategory").val();
		getAllShopProductsByCategory(catid,pn)
	})

	function successAlert(msg){
		$("#classalert").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-success'></i> Success!</h5></center><center>" + msg + "</center></div>");
	}

	function failAlert(msg){
		$("#classalert").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-danger'></i> Fail!</h5></center><center>" + msg + "</center></div>");
	}

	/*updateBillingDetails*/
	$("#btnsavedata").on("click",function(){
		var status = false;
		var cfname = $("#txtCustomerFirstname");
		var clname = $("#txtCustomerLastname");
		var country = $("#txtCountry");
		var caddress = $("#txtCustomerAddress");
		var city = $("#txtCity");
		var cpostcode = $("#txtCustomerPostcode");
		var cphone = $("#txtCustomerPhone");
		var cemail = $("#txtCustomerEmail");
		var capartment = $("#txtCustomerApartment");
		var cuid = $("#currentcustomerid").val();
	
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(cfname.val() == ""){
			cfname.addClass("border-danger");
			$("#cf_error").html("<span class='text-danger'>Enter Firstname</span>");
			status = false;
		}else{
			cfname.removeClass("border-danger");
			$("#cf_error").html("");
			status = true;
		}
		if(clname.val() == ""){
			clname.addClass("border-danger");
			$("#cl_error").html("<span class='text-danger'>Enter Lastname</span>");
			status = false;
		}else{
			clname.removeClass("border-danger");
			$("#cl_error").html("");
			status = true;
		}
		if(country.val() == ""){
			country.addClass("border-danger");
			$("#cc_error").html("<span class='text-danger'>Enter country name</span>");
			status = false;
		}else{
			country.removeClass("border-danger");
			$("#cc_error").html("");
			status = true;
		}
		if(caddress.val() == ""){
			caddress.addClass("border-danger");
			$("#ca_error").html("<span class='text-danger'>Enter your address</span>");
			status = false;
		}else{
			caddress.removeClass("border-danger");
			$("#ca_error").html("");
			status = true;
		}
		if(city.val() == ""){
			city.addClass("border-danger");
			$("#cty_error").html("<span class='text-danger'>Enter city name</span>");
			status = false;
		}else{
			city.removeClass("border-danger");
			$("#cty_error").html("");
			status = true;
		}
		if(cpostcode.val() == ""){
			cpostcode.addClass("border-danger");
			$("#ccp_error").html("<span class='text-danger'>Enter your postal code</span>");
			status = false;
		}else{
			cpostcode.removeClass("border-danger");
			$("#ccp_error").html("");
			status = true;
		}
		if(!e_patt.test(cemail.val())){
			cemail.addClass("border-danger");
			$("#cce_error").html("<span class='text-danger'>Enter Valid Email Address</span>");
			status = false;
		}else{
			cemail.removeClass("border-danger");
			$("#cce_error").html("");
			status = true;
		}
		if(cphone.val() == ""){
			cphone.addClass("border-danger");
			$("#cpn_error").html("<span class='text-danger'>Enter your phone number</span>");
			status = false;
		}else{
			cphone.removeClass("border-danger");
			$("#cpn_error").html("");
			status = true;
		}

		if (status == true) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {updateCustomer:1,cfirstname:cfname.val(),clastname:clname.val(),ccountry:country.val(),caddress:caddress.val(),capartment:capartment.val(), ccity:city.val(),cpostcode:cpostcode.val(),cphone:cphone.val(),cemail:cemail.val(),customerid:cuid},
				success : function(data){
					if(data == "UNKOWN_ERROR"){
						alert("Something Wrong");
					}else if(data == "SUCCESSFULLY_UPDATED"){
						successAlert("Your details have been saved successfully");
						getBillingDetails();
					}
				}
			})
		}
	})

	function registerSuccessAlert(msg){
		$("#registeralert").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-success'></i> Success!</h5></center><center>" + msg + "</center></div>");
	}

	function registerFailAlert(msg){
		$("#registeralert").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-danger'></i> Fail!</h5></center><center>" + msg + "</center></div>");
	}

/*register new customer*/
	$("#usersignupform").on("submit",function(){
		var status = false;
		var cfname = $("#customerFirstname");
		var clname = $("#customerLastname");
		var cphone = $("#customerPhone");
		var cemail = $("#customerEmail");
		var cpass1 = $("#password");
		var cpass2 = $("#cpassword");
	
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(cfname.val() == ""){
			cfname.addClass("border-danger");
			$("#uf_error").html("<span class='text-danger'>Enter Firstname</span>");
			status = false;
		}else{
			cfname.removeClass("border-danger");
			$("#uf_error").html("");
			status = true;
		}
		if(clname.val() == ""){
			clname.addClass("border-danger");
			$("#ul_error").html("<span class='text-danger'>Enter Lastname</span>");
			status = false;
		}else{
			clname.removeClass("border-danger");
			$("#ul_error").html("");
			status = true;
		}
		if(!e_patt.test(cemail.val())){
			cemail.addClass("border-danger");
			$("#ue_error").html("<span class='text-danger'>Enter Valid Email Address</span>");
			status = false;
		}else{
			cemail.removeClass("border-danger");
			$("#ue_error").html("");
			status = true;
		}
		if(cphone.val() == ""){
			cphone.addClass("border-danger");
			$("#up_error").html("<span class='text-danger'>Enter your phone number</span>");
			status = false;
		}else{
			cphone.removeClass("border-danger");
			$("#up_error").html("");
			status = true;
		}

		if(cpass1.val() == "" || cpass1.val().length < 9){
			cpass1.addClass("border-danger");
			$("#up1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status = false;
		}else{
			cpass1.removeClass("border-danger");
			$("#up1_error").html("");
			status = true;
		}
		if(cpass2.val() == "" || cpass2.val().length < 9){
			cpass2.addClass("border-danger");
			$("#up2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status = false;
		}else{
			cpass2.removeClass("border-danger");
			$("#up2_error").html("");
			status = true;
		}

		if ((cpass1.val() == cpass2.val()) && status == true) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#usersignupform").serialize(),
				success : function(data){
					if (data == "CUSTOMER_ALREADY_REGISTERED") {
						cemail.addClass("border-danger");
						registerFailAlert("You are already registered. Go to login page to sign in");
					}else if(data == "UNKOWN_ERROR"){
						alert("Something Wrong");
					}else if(data == "SUCCESSFULLY_REGISTERED"){
						registerSuccessAlert("Your details have been saved successfully");
						window.location.href = encodeURI(DOMAIN+"/login.php");
					}
				}
			})
		}else{
			cpass2.addClass("border-danger");
			$("#up2_error").html("<span class='text-danger'>Password is not matched</span>");
			status = true;
		}
	})

	//customer login form
	$("#usersigninform").on("submit",function(){
		var referer = $("#referer").val();
		var customeremail = $("#customerLoginemail");
		var customerpass = $("#customerLoginpassword");
		var status = false;
		if (customeremail.val() == "") {
			customeremail.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
			status = false;
		}else{
			customeremail.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}
		if (customerpass.val() == "") {
			customerpass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			customerpass.removeClass("border-danger");
			$("#p_error").html("");
			status = true;
		}
		if (status) {
			//$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#usersigninform").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
						//$(".overlay").hide();
						customeremail.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>Your are not yet Registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						//$(".overlay").hide();
						customerpass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else if(referer != ""){
						window.location.href = referer;
					}else{
						window.location.href = DOMAIN+"/index.php";
					}
				}
			})
		}
	});

$("#userchangepasswordform").on("submit",function(){
	var status = false;
	var cpemail = $("#changePasswordEmail");
	var cppassword = $("#changePasswordPassword");
	var cpconfirmpassword = $("#changeConfirmPassword");

	if(cpemail.val() == ""){
		cpemail.addClass("border-danger");
		$("#cpemail_error").html("<span class='text-danger'>Enter your email address</span>");
		status = false;
	}else{
		cpemail.removeClass("border-danger");
		$("#cpemail_error").html("");
		status = true;
	}

	if(cppassword.val() == "" || cppassword.val().length < 9){
		cppassword.addClass("border-danger");
		$("#cppassword_error").html("<span class='text-danger'>Enter new password with more than 9 characters.</span>");
		status = false;
	}else{
		cppassword.removeClass("border-danger");
		$("#cppassword_error").html("");
		status = true;
	}

	if(cpconfirmpassword.val() == "" || cpconfirmpassword.val().length < 9){
		cpconfirmpassword.addClass("border-danger");
		$("#cpconfirmpassword_error").html("<span class='text-danger'>Enter confirm password with more than 9 characters.</span>");
		status = false;
	}else{
		cpconfirmpassword.removeClass("border-danger");
		$("#cpconfirmpassword_error").html("");
		status = true;
	}

	if ((cppassword.val() == cpconfirmpassword.val()) && status == true) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#userchangepasswordform").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
						cpemail.addClass("border-danger");
						$("#cpemail_error").html("<span class='text-danger'>No account for this email address.</span>");
					}else if(data == "UNKOWN_ERROR"){
						alert("Something Wrong");
					}else if(data == "SUCCESSFULLY_UPDATED"){
						$("#changepasswordinfo").html("<span='text-info'>Password changed successfully! You can now <a href='login.php'>login</a></span>");
					}
				}
			})
		}else{
			cpconfirmpassword.addClass("border-danger");
			$("#cpconfirmpassword_error").html("<span class='text-danger'>Password is not matched</span>");
			status = false;
		}


});

/*send contact details*/
	$("#usercontactform").on("submit",function(){
		var status = false;
		var contactname = $("#txtContactName");
		var contactemail = $("#txtContactEmail");
		var contactphone = $("#txtContactPhone");
		var contactmessage = $("#txtContactMessage");
	
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(contactname.val() == ""){
			contactname.addClass("border-danger");
			$("#cname_error").html("<span class='text-danger'>Enter Your Full Name</span>");
			status = false;
		}else{
			contactname.removeClass("border-danger");
			$("#cname_error").html("");
			status = true;
		}
		if(!e_patt.test(contactemail.val())){
			contactemail.addClass("border-danger");
			$("#cemail_error").html("<span class='text-danger'>Enter Valid Email Address</span>");
			status = false;
		}else{
			contactemail.removeClass("border-danger");
			$("#cemail_error").html("");
			status = true;
		}
		if(contactphone.val() == ""){
			contactphone.addClass("border-danger");
			$("#cphone_error").html("<span class='text-danger'>Enter your phone number</span>");
			status = false;
		}else{
			contactphone.removeClass("border-danger");
			$("#cphone_error").html("");
			status = true;
		}
		if(contactmessage.val() == ""){
			contactmessage.addClass("border-danger");
			$("#cmessage_error").html("<span class='text-danger'>Enter your message here</span>");
			status = false;
		}else{
			contactmessage.removeClass("border-danger");
			$("#cmessage_error").html("");
			status = true;
		}
		if (status == true) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#usercontactform").serialize(),
				success : function(data){
					$("#response-msg").html("<span class='text-info'>" + data + "</span>");
				}
			})
		}
	})

});