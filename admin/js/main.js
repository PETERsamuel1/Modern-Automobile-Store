$(document).ready(function(){
	var DOMAIN = "..";

	getAllCategories(1,5);
	getAllProducts(1,5);
	getAllCustomers(1,5);
	getAllCustomerIssues(1,5);
	getAllPayments(1,5);
	getCategory();
	getCategoriesNo();
	getProductsNo();
	getCustomersNo();
	getMoneyAmount();
	showProductGraph();
	showPaymentGraph();

	function showProductGraph(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getProductGraph:1},
	        success : function (data)
	        {
	        	if (data == "NO_DATA") {
	        		$("#info").show();
	        	}else{
	        		console.log(data);
		            var date = [];
		            var products = [];

		            for (var i in data) {
		            	var day = (data[i].dateregistered) * 1000;
		            	if (day != "") {
		            		var d = new Date(parseInt(day, 10));
		            		var dat = d.toDateString();
		            		console.log(dat);
		            		date.push(data[i].datecreated);
		            	}
		                products.push(data[i].totalproducts);

		            }

		            var chartdata = {
		                labels: date,
		                datasets: [
		                    {
		                        label: 'Spare parts',
		                        backgroundColor: '#3486eb',
		                        borderColor: '#46d5f1',
		                        hoverBackgroundColor: '#CCCCCC',
		                        hoverBorderColor: '#666666',
		                        data: products
		                    }
		                ]
		            };

		            var graphTarget = $("#graphCanvas");

		            var barGraph = new Chart(graphTarget, {
		                type: 'bar',
		                data: chartdata
		            });
	        	}
	        }
		});
	}

	function showPaymentGraph(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getPaymentGraph:1},
	        success : function (data)
	        {
	        	if (data == "NO_DATA") {
	        		$("#info").show();
	        	}else{
	        		console.log(data);
		            var date = [];
		            var payments = [];

		            for (var i in data) {
		            	var day = (data[i].dateregistered) * 1000;
		            	if (day != "") {
		            		var d = new Date(parseInt(day, 10));
		            		var dat = d.toDateString();
		            		console.log(dat);
		            		date.push(data[i].datecreated);
		            	}
		                payments.push(data[i].totalproducts);

		            }

		            var chartdata = {
		                labels: date,
		                datasets: [
		                    {
		                        label: 'Payments',
		                        backgroundColor: '#3486eb',
		                        borderColor: '#46d5f1',
		                        hoverBackgroundColor: '#CCCCCC',
		                        hoverBorderColor: '#666666',
		                        data: payments
		                    }
		                ]
		            };

		            var graphTarget = $("#graphPaymentCanvas");

		            var barGraph = new Chart(graphTarget, {
		                type: 'bar',
		                data: chartdata
		            });
	        	}
	        }
		});
	}

	function getCategoriesNo(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getCategoriesNo:1},
			success : function(data){
				$("#categoriescount").html(data);
			}
		})
	}

	function getProductsNo(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getProductsNo:1},
			success : function(data){
				$("#productscount").html(data);
			}
		})
	}

	function getCustomersNo(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getCustomersNo:1},
			success : function(data){
				$("#customerscount").html(data);
			}
		})
	}

	function getMoneyAmount(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getMoneyAmount:1},
			success : function(data){
				$("#totalmoney").html(data);
			}
		})
	}

	$("#prod_name").on("focus",function(){

	})

	function hideOptionMenu(){
		$(".option-menu").hide();
	}

	$("#newprodbtn").on("click",function(){
		$("#addnewproduct").modal("show");
	})

	function getCategory(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getCategory:1},
			success : function(data){
				var choose = "<option value=''>Choose Category</option>";
				$("#select_cat").html(choose+data);
				$(".productcategory").html(choose+data);
			}
		})
	}

	function hideCategoryModal(){
		$("#addnewcategory").modal('hide');
		$("#success_msg").html("");
		$("#txtCatname").val("");
	}

	function hideProductModal(){
		$("#addnewproduct").modal('hide');;
	}

	function successAlert(msg){
		$("#classalert").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-success'></i> Success!</h5></center><center>" + msg + "</center></div>");
	}

	function failAlert(msg){
		$("#classalert").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fas fa-danger'></i> Fail!</h5></center><center>" + msg + "</center></div>");
		$("#classalert").fadeOut(5000);
	}

	$("select.rowno").change(function(){
        //var selectedno = $(this).children("option:selected").val();
        var pn = 1;
		var rn = $(this).children("option:selected").val();
		getAllCategories(pn,rn);
    });

    $("select.prowno").change(function(){
        //var selectedno = $(this).children("option:selected").val();
        var pn = 1;
		var rn = $(this).children("option:selected").val();
		getAllProducts(pn,rn);
    });

    $("select.productcategory").change(function(){
        //var selectedno = $(this).children("option:selected").val();
        var pn = 1;
		var rn = 5;
		var catid = $(this).children("option:selected").val();
		getProductsByCategory(pn,rn,catid);
    });

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		var rn = $(".rowno").val();
		getAllCategories(pn,rn);
	})

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		var rn = $(".prowno").val();
		getAllProducts(pn,rn);
	})

	$("body").delegate(".small-menu","click",function(){
		var menuid = $(this).attr("menuid");
		$("."+menuid).fadeToggle(1000);
		if ($("."+menuid).is(":visible")) {
			$(this).css({"background-color":"blue","border-radius":"50%"});
		}else{
			$(this).css({"background-color":"transparent","border-radius":"50%"});
		}
	})

	function getAllCategories(pn,rn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllCategories:1,pageno:pn,rowno:rn},
			success : function(data){
				$("#categories_table").html(data);
			}
		})
	}

	function getAllProducts(pn,rn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllProducts:1,pageno:pn,rowno:rn},
			success : function(data){
				$("#products_table").html(data);
				hideOptionMenu();
			}
		})
	}

	function getAllCustomers(pn,rn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllCustomers:1,pageno:pn,rowno:rn},
			success : function(data){
				$("#customers_table").html(data);
				//hideOptionMenu();
			}
		})
	}

	function getAllCustomerIssues(pn,rn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllCustomerIssues:1,pageno:pn,rowno:rn},
			success : function(data){
				$("#customerissues_table").html(data);
				//hideOptionMenu();
			}
		})
	}

	function getAllPayments(pn,rn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllPayments:1,pageno:pn,rowno:rn},
			success : function(data){
				if (data == "NO_PAYMENTS") {
					$("#no_payments").removeClass("no-show");
					$("#payment-table-container").hide();
				}else{
					$("#no_payments").addClass("no-show");
					$("#payment-table-container").show();
					$("#payments_table").html(data);
				}
				//hideOptionMenu();
			}
		})
	}

	function getProductsByCategory(pn,rn,catid){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getProductsByCategory:1,pageno:pn,rowno:rn,catId:catid},
			success : function(data){
				$("#products_table").html(data);
				hideOptionMenu();
			}
		})
	}

	$("#psearch").on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        //var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get(DOMAIN+"/includes/action.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                //resultDropdown.html(data);
                $("#products_table").html(data);
            });
        } else{
            resultDropdown.empty();
            getAllProducts(1, 5);
        }
    });

	$("body").delegate("#removecat","click",function(){
		var catid = $(this).attr("categoryid");
		if (confirm("Are you sure ? You want to delete this record..!")) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {deleteCategory:1,id:catid},
				success : function(data){
					if (data == "DEPENDENT_RECORD") {
						failAlert("Sorry ! this Category is dependent on other sub categories");
					}else if(data == "RECORD_DELETED"){
						successAlert("Category Deleted Successfully..!");
						getAllCategories(1,5);
					}else if(data == "DELETED"){
						alert("Deleted Successfully");
					}else{
						alert(data);
					}
						
				}
			})
		}else{

		}
	})

	$("body").delegate("#removeproduct","click",function(){
		var pid = $(this).attr("productid");
		if (confirm("Are you sure ? You want to delete this record..!")) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {deleteProduct:1,id:pid},
				success : function(data){
					if (data == "DEPENDENT_RECORD") {
						failAlert("Sorry ! this Category is dependent on other sub categories");
					}else if(data == "RECORD_DELETED"){
						successAlert("Category Deleted Successfully..!");
						getAllProducts(1,5);
					}else if(data == "DELETED"){
						alert("Deleted Successfully");
					}else{
						alert(data);
					}
						
				}
			})
		}else{

		}
	})

	$("body").delegate("#editcat","click",function(){
		var catid = $(this).attr("categoryid");
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getSingleCategory:1,id:catid},
			success : function(data){
				$("#editcategory").modal('show');
				$("#txtEditCatname").val(data.category_name);
				$("#txtEditCatname").css({"border-color" : "#3FBAE4"});
				var content = "";
				if (data.status == "Active") {
					content += '<label class="switch">' +
									'<input type="checkbox" checked="checked" id="togCatStatus" catid="' + data.id + '">' +
										'<span class="slider round"></span>' +
								'</label>' +
								'<p class="status">Active</p>';
				}else{
					content += '<label class="switch">' +
									'<input type="checkbox" id="togCatStatus" catid="' + data.id + '">' +
										'<span class="slider round"></span>' +
								'</label>' +
								'<p class="status">Inactive</p>';
				}
				$(".updatestatus").html(content);
				/*
				for(var i in data){
					var categoryname = data[i].category_name;
					alert(categoryname);
					$("#txtEditCatname").val(categoryname);
				}*/
				//console.log(data);
			}
		})
	})

	$("body").delegate("#togCatStatus","click",function(){
		var rn = $(".rowno").val();
		var tablename = "category_table";
		var fieldname = "status";
		var catid = "";
		var status = "";
		if($(this).prop("checked") == true){
			catid = $(this).attr("catid");
			status = "Active";
	    }
	    else if($(this).prop("checked") == false){
	    	catid = $(this).attr("catid");
	        status = "Inactive";
	    }

	    if (catid != "" && status != "") {
	    	$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {updateRecord:1,table:tablename,id:catid,field:fieldname,fieldvalue:status},
				success : function(data){
					if (data == "UPDATED") {
						getAllCategories(1,rn);
						//successAlert("The collector status has been updated successfully");
					}else if (data == "UNKNOWN_ERROR") {
						alert("unknown errors");
					}
				}
			})
	    }
	})

	$("body").delegate("#togProdStatus","click",function(){
		var rn = $(".prowno").val();
		var tablename = "product_table";
		var fieldname = "status";
		var pid = "";
		var status = "";
		if($(this).prop("checked") == true){
			pid = $(this).attr("pid");
			status = "Active";
	    }
	    else if($(this).prop("checked") == false){
	    	pid = $(this).attr("pid");
	        status = "Inactive";
	    }

	    if (pid != "" && status != "") {
	    	$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {updateRecord:1,table:tablename,id:pid,field:fieldname,fieldvalue:status},
				success : function(data){
					if (data == "UPDATED") {
						getAllProducts(1,rn);
						//successAlert("The collector status has been updated successfully");
					}else if (data == "UNKNOWN_ERROR") {
						alert("unknown errors");
					}
				}
			})
	    }
	})

	$("#savecatbtn").on("click",function(){
		var catname = $("#txtCatname");
		var status = false;

		if (catname.val() == "") {
			catname.addClass("border-danger");
			$("#catname_error").html("<span class='text-danger'>Enter Category Name</span>");
			status = false;
		}else{
			catname.removeClass("border-danger");
			$("#catname_error").html("");
			status = true;
		}

		if (status) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {saveCategory:1,catName:catname.val()},
				success : function(data){
					if (data == "CATEGORY_ALREADY_EXISTS") {
						catname.addClass("border-danger");
						$("#catname_error").html("<span class='text-danger'>This category already exists!</span>");
					}else if (data == "CATEGORY_ADDED_SUCCESSFULLY") {
						catname.addClass("border-success");
						$("#success_msg").html("<span class='text-success'>" + catname.val() + " category has been saved successfully.</span>");
						getAllCategories(1,5);
						setTimeout(function() {
						    hideCategoryModal();
						}, 5000);
					}else{
						alert("Unknown Error occured try again");
					}
				}
			});
		}
	})

	//admin login form
	$("#adminloginform").on("submit",function(){
		var adminemail = $("#adminemail");
		var adminpass = $("#adminpassword");
		var status = false;
		if (adminemail.val() == "") {
			adminemail.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
			status = false;
		}else{
			adminemail.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}
		if (adminpass.val() == "") {
			adminpass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			adminpass.removeClass("border-danger");
			$("#p_error").html("");
			status = true;
		}
		if (status) {
			//$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#adminloginform").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
						//$(".overlay").hide();
						adminemail.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>Your are not yet Registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						//$(".overlay").hide();
						adminpass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else if(data == "LOGGED_IN"){
						window.location.href = DOMAIN+"/admin/dashboard.php";
					}
				}
			})
		}
	});

	$("#newproductform").on("submit",function(e){

		e.preventDefault();

		var status = false;
		var pcategory = $("#select_cat");
		var pphoto = $("#productphoto");
		var pname = $("#prod_name");
		var pprice = $("#prod_price");
		var pamount = $("#prod_amount");
		var pdesc = $("#prod_description");

		if (pcategory.val() == "") {
			pcategory.addClass("border-danger");
			$("#pcat_error").html("<span class='text-danger'>Please Select Category Name</span");
			status = false;
		}else{
			pcategory.removeClass("border-danger");
			$("#pcat_error").html("");
			status = true;
		}
		if (pphoto.val() == "") {
			pphoto.addClass("border-danger");
			$("#pphoto_error").html("<span class='text-danger'>Please Select an image for your product</span");
			status = false;
		}else{
			pphoto.removeClass("border-danger");
			$("#pphoto_error").html("");
			status = true;
		}
		if (pname.val() == "") {
			pname.addClass("border-danger");
			$("#pname_error").html("<span class='text-danger'>Please Enter product name</span");
			status = false;
		}else{
			pname.removeClass("border-danger");
			$("#pname_error").html("");
			status = true;
		}
		if (pprice.val() == "") {
			pprice.addClass("border-danger");
			$("#pprice_error").html("<span class='text-danger'>Please Enter product price</span");
			status = false;
		}else{
			pprice.removeClass("border-danger");
			$("#pprice_error").html("");
			status = true;
		}
		if (pamount.val() == "") {
			pamount.addClass("border-danger");
			$("#pamount_error").html("<span class='text-danger'>Please Enter Product Amount</span");
			status = false;
		}else{
			pamount.removeClass("border-danger");
			$("#pamount_error").html("");
			status = true;
		}
		if (pdesc.val() == "") {
			pdesc.addClass("border-danger");
			$("#pdesc_error").html("<span class='text-danger'>Please Enter product description</span");
			status = false;
		}else{
			pdesc.removeClass("border-danger");
			$("#pdesc_error").html("");
			status = true;
		}
		if (status == true) {
			$.ajax({
			   url : DOMAIN+"/includes/action.php",
			   //type: "POST",
			   method: "POST",
			   data:  new FormData(this),
			   contentType: false,
			         cache: false,
			   processData:false,
			   beforeSend : function()
			   {
			    //$("#preview").fadeOut();
			   // $("#err").fadeOut();
			   },
			   success: function(data)
			      {
				    if(data=='invalid')
				    {
				    	$("#alert").html("<span class='text-danger'>The file you uploaded is invalid</span>");
				     // invalid file format.
				     //$("#err").html("Invalid File !").fadeIn();
				     //alert("Invalid file");
				    }else if(data=='PRODUCT_ALREADY_EXISTS'){
				    	$("#alert").html("<span class='text-danger'>A product with similar name has been created</span>");
				    }else if (data=='notuploaded') {
				    	$("#alert").html("<span class='text-danger'>Image not uploaded successfully</span>").fadeIn();
				    }else if(data=='UNKNOWN_ERROR'){
				     alert("Unknown Error");
				    }else if(data =='PRODUCT_ADDED_SUCCESSFULLY'){
				    	$("#alert").html("<span class='text-success'>The product details have been saved successfully</span>");
				    	getAllProducts(1,5);
				    	hideProductModal();
				    }
			      },
			     error: function(e) 
			      {
			    //$("#err").html(e).fadeIn();
			    alert("Error");
			      }          
			    });
			}
		/*
		var radioValue = $("input[name='radiomeasurements']:checked").val();
		if(radioValue){
			alert("This is a -" + radioValue);
		}
		*/
	})

});