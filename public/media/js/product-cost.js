//global variables
var currentProductId;
var delayTimer;
var method;
var currentproductdata = [];
var currentStock = 0;
//functions
window.onload = function exampleFunction() {
	showAllProducts()
	getUserPlan()
}
function showAllProducts() {
	$.ajax({
		url: '/product/showallproduct',
		type: 'get',
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		dataType: 'json',
		success: function (data) {
			var productdata = '';
			if (data.latest_id) {
				latest_id = data.latest_id.id;
			} else {
				latest_id = 0;
			}
			currentProductId = latest_id;
			var response = data.getAllProducts;
			for (var i in response) {
				if (response[i].id == currentProductId) {
					productdata = productdata + '<button onclick="getSingleUserData(' + response[i].id + ')" id="' + response[i].id + '" class="btn product-btn btn-round btn-main">' + response[i].product_name + '</button>';
				} else {
					productdata = productdata + '<button onclick="getSingleUserData(' + response[i].id + ')" id="' + response[i].id + '" class="btn product-btn btn-round">' + response[i].product_name + '</button>';
				}
			}
			productdata = productdata + '<button class="btn  btn-round" data-toggle="modal" data-target="#product_create" onclick="addProductConfig()">New Product <i class="material-icons">add_circle_outline</i></button>';
			$(".product-btn").css('color', 'white');
			$('.product_list').html(productdata);
			getSingleUserData(latest_id)

		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function getSingleUserData(id) {
	$.ajax({
		url: '/product/getSingleUserData/' + id,
		type: 'get',
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		dataType: 'json',
		success: function (data) {
			$(".editproduct").prop('disabled', false);
			$(".sendingIncoming").prop('disabled', false);
			$(".currentStock").prop('disabled', false);
			$('#' + currentProductId).removeClass("btn-main");
			$('#' + id).addClass("btn-main");
			currentProductId = id;
			$('.product-name').html(data.result.product_name);
			$('.currentStock').val(data.stock.current_stock);
			currentStock = data.stock.current_stock;
			currentYear = currentdate.getFullYear();
			$('.currentYear').html(currentYear);
			$('select[name=currentYear]').val(currentYear);
			$('.selectpicker').selectpicker('refresh')
			currentproductdata = data.result;
			retrieveDataOFDemandAndStock(data.estimateSales)
		},
		error: function () {
			currentYear = currentdate.getFullYear();
			$(".editproduct").prop('disabled', true);
			$(".sendingIncoming").prop('disabled', true);
			$(".currentStock").prop('disabled', true);
			$('.currentYear').html(currentYear);
			$('select[name=currentYear]').val(currentYear);
			$('.selectpicker').selectpicker('refresh');
			$('.product-name').html('No Product Exist in Record');
			toastr.error("Failed to load products");
		}
	});
}
$("#create_product").on("submit", function (e) {
	var deposit_portion = $("#deposit_portion").val()
	var final_payment_portion = $("#final_payment_portion").val()
	var total_portion = +deposit_portion + +final_payment_portion;
	var formData = {
		product_name: $("#product_name").val(),
		costs_till_ready_to_sell: $("#costs_till_ready_to_sell").val(),
		payout_per_unit_by: $("#payout_per_unit_by").val(),
		ppc_cost_per_product: $("#ppc_cost_per_product").val(),
		deposit_portion: deposit_portion,
		deposit_leadtime: $("#deposit_leadtime").val(),
		payment_delay_amazon: $("#payment_delay_amazon").val(),
		final_payment_portion: final_payment_portion,
		final_payment_leadtime: $("#final_payment_leadtime").val(),
		selling_price_for_sales_tax: $("#selling_price_for_sales_tax").val(),
		id: currentProductId,
	};
	var dataString = $(this).serialize();
	if (method == 'addProduct') {
		url = 'product/store';
	}
	else if (method == 'editProduct') {
		url = 'product/edit';
	}

	if (total_portion == 100) {
		$.ajax({
			type: "POST",
			url: url,
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data: formData,
			dataType: "json",
			encode: true,
		}).done(function (data) {
			if (data.status == 200) {
				$('#product_create').modal('hide');
				$("#create_product").trigger("reset");
				showAllProducts()
				toastr.success(data.message);
			} else {
				toastr.error(data.message);
			}
		}).fail(function (errors) {
			toastr.error("The product name has already been taken.");
		});
	}
	else {
		toastr.error("Deposite and Final Portion not more than 100%.");
	}
	e.preventDefault();
});
$('.currentStock').on('input', function () {
	var id = $(this).data('ter');
	var currentStock = $(this).val();
	clearTimeout(delayTimer);
	delayTimer = setTimeout(function () {
		toastr.options = {
			"closeButton": true,
			"newestOnTop": true,
			"positionClass": "toast-top-right"
		};
		$.ajax({
			url: 'product/updateStock',
			dataType: 'json',
			method: 'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data: {
				'current_stock': currentStock,
				'product_id': currentProductId
			},
			success: function (data) {
				if (data.message) {
					getSingleUserData(currentProductId)
					toastr.success(data.message);
				} else {
					toastr.error("Current Stock not updated");
				}
			},
			error: function (data) {
				toastr.error("Current Stock not updated");
			}
		});
	}, 1500);
});
function editproductconfig() {
	$('.prdouctModelTitle').html('Product Properties');
	$('#product_name').val(currentproductdata.product_name);
	$('#costs_till_ready_to_sell').val(currentproductdata.costs_till_ready_to_sell);
	$('#payout_per_unit_by').val(currentproductdata.payout_per_unit_by);
	$('#ppc_cost_per_product').val(currentproductdata.ppc_cost_per_product);
	$('#deposit_portion').val(currentproductdata.deposit_portion);
	$('#deposit_leadtime').val(currentproductdata.deposit_leadtime);
	$('#payment_delay_amazon').val(currentproductdata.payment_delay_amazon);
	$('#final_payment_portion').val(currentproductdata.final_payment_portion);
	$('#final_payment_leadtime').val(currentproductdata.final_payment_leadtime);
	$('#selling_price_for_sales_tax').val(currentproductdata.selling_price_for_sales_tax);
	$("#create_product").prop('id', 'edit_product');
	method = 'editProduct';
	$('#product_create').show();
}
function addProductConfig() {
	method = 'addProduct';
	$(".create_product").prop('id', 'create_product');
	$("#create_product").trigger("reset");
	$('.prdouctModelTitle').html("Add New Product Cost");
}
$('[data-toggle="popover"]').popover({
	placement: 'left',
	trigger: 'hover'
});
$('select').on('change', function (e) {
	$('.currentYear').html(this.value);
	$('select[name=currentYear]').val(this.value);
	$('.selectpicker').selectpicker('refresh');
	currentYear = this.value;
	getDemandAndStockData()
});
function onChangedDemand(getmonth) {
	var demand = $('.demand_' + getmonth).val();
	if(!demand){
		demand = 0;
	}
	if (demand >= 0) {
		clearTimeout(delayTimer);
		delayTimer = setTimeout(function () {
			toastr.options = {
				"closeButton": true,
				"newestOnTop": true,
				"positionClass": "toast-top-right"
			};
			$.ajax({
				url: 'product/updateDemandIncomig',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				dataType: 'json',
				method: 'post',
				data: {
					'demand': demand,
					'month': getmonth,
					'current_year': currentYear,
					'product_id': currentProductId
				},
				success: function (data) {
					if (data.message) {
						retrieveDataOFDemandAndStock(data.retrieveDate);
						// getDemandStockData(currentProductId)
						toastr.success(data.message);
					} else {
						toastr.error("Request Failed, Please Try Again.");
					}
				},
				error: function (data) {
					toastr.error("Request Failed, Please Try Again.");
				}
			});
		}, 1000);
	} else {
		toastr.error("Input Value not Allowed");
	}
}

function onChangedIncoming(getmonth) {
	incoming = $('.incoming_' + getmonth).val();
	if(!incoming){
		incoming = 0;
	}
	var PaymentAmount = incoming * currentproductdata.costs_till_ready_to_sell;
	var initialAmount = PaymentAmount * currentproductdata.deposit_portion / 100;
	var finalAmount = PaymentAmount * currentproductdata.final_payment_portion / 100;
	var pureinitialdate = new Date(parseInt(getmonth) + "/1" + '/' + currentYear);
	pureinitialdate.setDate(pureinitialdate.getDate() - currentproductdata.deposit_leadtime * 7);
	var initial_payment_date = pureinitialdate.toLocaleDateString("fr-CA")

	var purefinaldate = new Date(parseInt(getmonth) + "/1" + '/' + currentYear);
	purefinaldate.setDate(purefinaldate.getDate() - currentproductdata.final_payment_leadtime * 7);
	var final_payment_date = purefinaldate.toLocaleDateString("fr-CA");
	if (incoming >= 0) {
		clearTimeout(delayTimer);
		delayTimer = setTimeout(function () {
			toastr.options = {
				"closeButton": true,
				"newestOnTop": true,
				"positionClass": "toast-top-right"
			};
			$.ajax({
				url: 'product/updateDemandIncomig',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				dataType: 'json',
				method: 'post',
				data: {
					'incoming': incoming,
					'month': getmonth,
					'current_year': currentYear,
					'product_id': currentProductId,
					'initialAmount': initialAmount,
					'finalAmount': finalAmount,
					'initial_payment_date': initial_payment_date,
					'final_payment_date': final_payment_date,
				},
				success: function (data) {
					if (data.message) {
						retrieveDataOFDemandAndStock(data.retrieveDate);
						// getDemandStockData(currentProductId)
						toastr.success(data.message);
					} else {
						toastr.error("Request Failed, Please Try Again.");
					}
				},
				error: function (data) {
					toastr.error("Request Failed, Please Try Again.");
				}
			});
		}, 100);
	} else {
		toastr.error("Negative Value not Allowed");
	}
}
function onChangedDemandES(getmonth) {
	var demand = $('#demand_' + getmonth).val();
	var fh_payment_amount = (parseFloat(currentproductdata.payout_per_unit_by - currentproductdata.ppc_cost_per_product) * parseInt(demand))/2;
	var pureinitialdate = new Date(parseInt(getmonth) + "/1" + '/' + currentYear);
	pureinitialdate.setDate(pureinitialdate.getDate() + parseInt(currentproductdata.payment_delay_amazon/2) * 7 -1);
	var fh_payment_date = pureinitialdate.toLocaleDateString("fr-CA");
	
	var sh_payment_amount = (parseFloat(currentproductdata.payout_per_unit_by - currentproductdata.ppc_cost_per_product) * parseInt(demand))/2;
	var purefinaldate = new Date(parseInt(getmonth) + "/1" + '/' + currentYear);
	purefinaldate.setDate(purefinaldate.getDate() + parseInt(currentproductdata.payment_delay_amazon) * 7 -1);
	var sh_payment_date = purefinaldate.toLocaleDateString("fr-CA");
	if(!demand){
		demand = 0;
	}
	if (demand >= 0) {
		clearTimeout(delayTimer);
		delayTimer = setTimeout(function () {
			toastr.options = {
				"closeButton": true,
				"newestOnTop": true,
				"positionClass": "toast-top-right"
			};
			$.ajax({
				url: 'product/updateDemandIncomig',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				dataType: 'json',
				method: 'post',
				data: {
					'demand': demand,
					'month': getmonth,
					'current_year': currentYear,
					'product_id': currentProductId,
					'fh_payment_amount': fh_payment_amount,
					'sh_payment_amount': sh_payment_amount,
					'fh_payment_date': fh_payment_date,
					'sh_payment_date': sh_payment_date,
				},
				success: function (data) {
					if (data.message) {
						retrieveDataOFDemandAndStock(data.retrieveDate);
						// getDemandStockData(currentProductId)
						toastr.success(data.message);
					} else {
						toastr.error("Request Failed, Please Try Again.");
					}
				},
				error: function (data) {
					toastr.error("Request Failed, Please Try Again.");
				}
			});
		}, 1000);
	} else {
		toastr.error("Input Value not Allowed");
	}
}

function onChangedIncomingES(getmonth) {
	incoming = $('#incoming_' + getmonth).val();
	if(!incoming){
		incoming = 0;
	}
	// Estimate for sales
	var PaymentAmount = incoming * currentproductdata.costs_till_ready_to_sell;
	var initialAmount = PaymentAmount * currentproductdata.deposit_portion / 100;
	var finalAmount = PaymentAmount * currentproductdata.final_payment_portion / 100;
	var pureinitialdate = new Date(parseInt(getmonth) + "/1" + '/' + currentYear);
	pureinitialdate.setDate(pureinitialdate.getDate() - currentproductdata.deposit_leadtime * 7);
	var initial_payment_date = pureinitialdate.toLocaleDateString("fr-CA")
	var purefinaldate = new Date(parseInt(getmonth) + "/1" + '/' + currentYear);
	purefinaldate.setDate(purefinaldate.getDate() - currentproductdata.final_payment_leadtime * 7);
	var final_payment_date = purefinaldate.toLocaleDateString("fr-CA");

	// Estimate of Earnings

	if (incoming >= 0) {
		clearTimeout(delayTimer);
		delayTimer = setTimeout(function () {
			toastr.options = {
				"closeButton": true,
				"newestOnTop": true,
				"positionClass": "toast-top-right"
			};
			$.ajax({
				url: 'product/updateDemandIncomig',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				dataType: 'json',
				method: 'post',
				data: {
					'incoming': incoming,
					'month': getmonth,
					'current_year': currentYear,
					'product_id': currentProductId,
					'initialAmount': initialAmount,
					'finalAmount': finalAmount,
					'initial_payment_date': initial_payment_date,
					'final_payment_date': final_payment_date,
				},
				success: function (data) {
					if (data.message) {
						retrieveDataOFDemandAndStock(data.retrieveDate);
						// getDemandStockData(currentProductId)
						toastr.success(data.message);
					} else {
						toastr.error("Request Failed, Please Try Again.");
					}
				},
				error: function (data) {
					toastr.error("Request Failed, Please Try Again.");
				}
			});
		}, 100);
	} else {
		toastr.error("Negative Value not Allowed");
	}
}
function getDemandAndStockData() {
	$.ajax({
		url: '/product/getDataOFDemandAndStock',
		type: 'get',
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		dataType: 'json',
		data: {
			'current_year': currentYear,
			'product_id': currentProductId
		},
		success: function (data) {
			retrieveDataOFDemandAndStock(data)
		},
		error: function () {
			toastr.error("Failed! Product name not loaded");
		}
	});
}
function retrieveDataOFDemandAndStock(data) {
	emptyDemandAndStock()
	var newStock = currentStock;
	var currentStockdata = new Array();
	for (let i = 0; i < 12; i++) {
		var monthcalval = i + 1;
		// const element = data[i];
		Stockdata = [];
		if (data[i].entry_year == currentYear) {
			Stockdata.incoming = parseInt(data[i].incoming);
			Stockdata.demand = parseInt(data[i].demand);
			var stock = parseInt(data[i].incoming) - parseInt(data[i].demand);
			newStock = parseInt(stock) + parseInt(newStock);
			Stockdata.calculatedStock = newStock;
			
			Stockdata.initial_payment_paid = data[i].initial_payment_paid;
			Stockdata.final_payment_amount = data[i].final_payment_amount;
			Stockdata.final_payment_paid = data[i].final_payment_paid;
			Stockdata.fh_payment_paid = data[i].fh_payment_paid;
			Stockdata.sh_payment_paid = data[i].sh_payment_paid;
			Stockdata.month = parseInt(data[i].entry_month);

			//Inital Payment of incoming units
			var initial_payment_amount =  (parseInt(data[i].incoming)*parseInt(currentproductdata.costs_till_ready_to_sell)) * parseInt(currentproductdata.deposit_portion) / 100;
			if (data[i].initial_payment_amount !== initial_payment_amount && data[i].initial_payment_paid == 0) {
				Stockdata.initial_payment_amount = initial_payment_amount;				
			} else {
				Stockdata.initial_payment_amount = data[i].initial_payment_amount;
			}
			//final payment of incoming units
			var final_payment_amount =  (parseInt(data[i].incoming)*parseInt(currentproductdata.costs_till_ready_to_sell)) * parseInt(currentproductdata.final_payment_portion) / 100;
			if (data[i].final_payment_amount !== final_payment_amount && data[i].initial_payment_paid == 0) {
				Stockdata.final_payment_amount = final_payment_amount;
			} else {
				Stockdata.final_payment_amount = data[i].final_payment_amount;
			}
			// Inital Payment Date
			var pureinitialdate = new Date(parseInt(data[i].entry_month) + "/1" + '/' + currentYear);
			pureinitialdate.setDate(pureinitialdate.getDate() - currentproductdata.deposit_leadtime * 7);
			var initial_payment_date = pureinitialdate.toLocaleDateString("fr-CA");
			if (data[i].initial_payment_date !== initial_payment_date && data[i].initial_payment_paid == 0) {
				Stockdata.initial_payment_date = initial_payment_date
			} else {
				Stockdata.initial_payment_date = data[i].initial_payment_date;
			}
			// Final Payment Date
			var purefinaldate = new Date(parseInt(data[i].entry_month) + "/1" + '/' + currentYear);
			purefinaldate.setDate(purefinaldate.getDate() - currentproductdata.final_payment_leadtime * 7);
			var final_payment_date = purefinaldate.toLocaleDateString("fr-CA");
			if (data[i].final_payment_date !== final_payment_date && data[i].final_payment_paid == 0) {
				Stockdata.final_payment_date = final_payment_date;
			} else {
				Stockdata.final_payment_date = data[i].final_payment_date;
			}
			//first half of month Debit payment based on the formula
			//Earning per Unit from Amazon excl. Taxes subtract with PPC cost per product lump * demand divide by half
			var fh_payment_amount = (parseFloat(currentproductdata.payout_per_unit_by - currentproductdata.ppc_cost_per_product) * parseInt(data[i].demand))/2;
			if (data[i].fh_payment_amount !== fh_payment_amount && data[i].fh_payment_paid == 0) {
				Stockdata.fh_payment_amount = fh_payment_amount;				
			} else {
				Stockdata.fh_payment_amount = data[i].fh_payment_amount;
			}
			// Second Half Debit Payment Based on the formula
			var sh_payment_amount = (parseFloat(currentproductdata.payout_per_unit_by - currentproductdata.ppc_cost_per_product) * parseInt(data[i].demand))/2;
			if (data[i].sh_payment_amount !== sh_payment_amount && data[i].sh_payment_paid == 0) {
				Stockdata.sh_payment_amount = sh_payment_amount;				
			} else {
				Stockdata.sh_payment_amount = data[i].sh_payment_amount;
			}
			// first half month Payment Date
			var purefhdate = new Date(parseInt(data[i].entry_month) + "/1" + '/' + currentYear);
			purefhdate.setDate(purefhdate.getDate() + parseInt(currentproductdata.payment_delay_amazon/2) * 7 -1);
			var fh_payment_date = purefhdate.toLocaleDateString("fr-CA");
			if (data[i].fh_payment_date !== fh_payment_date && data[i].fh_payment_paid == 0) {
				Stockdata.fh_payment_date = fh_payment_date;
			} else {
				Stockdata.fh_payment_date = data[i].fh_payment_date;
			}
			// Seconf half month Payment Date
			var pureshdate = new Date(parseInt(data[i].entry_month) + "/1" + '/' + currentYear);
			pureshdate.setDate(pureshdate.getDate() + parseInt(currentproductdata.payment_delay_amazon) * 7 -1);
			var sh_payment_date = pureshdate.toLocaleDateString("fr-CA");
			if (data[i].sh_payment_date !== sh_payment_date && data[i].sh_payment_paid == 0) {
				Stockdata.sh_payment_date = sh_payment_date;
			} else {
				Stockdata.sh_payment_date = data[i].sh_payment_date;
			}
			currentStockdata.push(Stockdata);
		}
	}
	arrangingStockData(currentStockdata)
}
function arrangingStockData(currentStockdata) {
	var previousStock = currentStock;
	var newStock = currentStock;
	currentStockdata.sort(function (a, b) {
		return new Date(parseInt(a.month)) - new Date(parseInt(b.month));
	});
	console.log(currentStockdata)
	for (let i = 1; i < 13; i++) {
		if (i == parseInt(currentStockdata[i - 1].month)) {
			// show Current Stock
			$(".demand_" + i).val(currentStockdata[i-1].demand);
			$(".incoming_" + i).val(currentStockdata[i-1].incoming);
			$(".currentStock_" + i).val(currentStockdata[i-1].calculatedStock);
			$(".initial_payment_date_" + i).html(currentStockdata[i - 1].initial_payment_date);
			$("#initial_payment_date_" + i).val(currentStockdata[i - 1].initial_payment_date);
			$(".initial_payment_amount_" + i).val(currentStockdata[i - 1].initial_payment_amount);
			$(".final_payment_date_" + i).html(currentStockdata[i - 1].final_payment_date);
			$("#final_payment_date_" + i).val(currentStockdata[i - 1].final_payment_date);
			$(".final_payment_amount_" + i).val(currentStockdata[i - 1].final_payment_amount);
			$(".fh_payment_amount_" + i).val(currentStockdata[i - 1].fh_payment_amount);
			$(".sh_payment_amount_" + i).val(currentStockdata[i - 1].sh_payment_amount);
			$(".fh_payment_date_" + i).html(currentStockdata[i - 1].fh_payment_date);
			$("#fh_payment_date_" + i).val(currentStockdata[i - 1].fh_payment_date);
			$(".sh_payment_date_" + i).html(currentStockdata[i - 1].sh_payment_date);
			$("#sh_payment_date_" + i).val(currentStockdata[i - 1].sh_payment_date);
			if (currentStockdata[i-1].initial_payment_paid == 1) {
				$(".initial_payment_button_" + i).prop('disabled', true);
				$(".initial_payment_button_" + i).html('paid');
				$(".initial_payment_button_" + i).css("color", "#64ccb6");
			}
			else {
				$(".initial_payment_button_" + i).prop('disabled', false);
				$(".initial_payment_button_" + i).html('unpaid');
				if(currentStockdata[i-1].incoming > 0){
				$(".initial_payment_button_" + i).css("color", "#cc6464");
				}
			}
			if (currentStockdata[i-1].final_payment_paid == 1) {
				$(".final_payment_button_" + i).prop('disabled', true);
				$(".final_payment_button_" + i).html('paid');
				$(".final_payment_button_" + i).css("color", "#64ccb6");
			} else {
				$(".final_payment_button_" + i).prop('disabled', false);
				$(".final_payment_button_" + i).html('unpaid');
				if(currentStockdata[i-1].incoming > 0){
					$(".final_payment_button_" + i).css("color", "#cc6464");
					}
			}
			if (currentStockdata[i-1].fh_payment_paid == 1) {
				$(".fh_payment_button_" + i).prop('disabled', true);
				$(".fh_payment_button_" + i).html('debited');
				$(".fh_payment_button_" + i).css("color", "#64ccb6");
			}
			else {
				$(".fh_payment_button_" + i).prop('disabled', false);
				$(".fh_payment_button_" + i).html('debited');
				if(currentStockdata[i-1].demand > 0){
				$(".fh_payment_button_" + i).css("color", "#cc6464");
				}
			}
			if (currentStockdata[i-1].sh_payment_paid == 1) {
				$(".sh_payment_button_" + i).prop('disabled', true);
				$(".sh_payment_button_" + i).html('debited');
				$(".sh_payment_button_" + i).css("color", "#64ccb6");
			} else {
				$(".sh_payment_button_" + i).prop('disabled', false);
				$(".sh_payment_button_" + i).html('debited');
				if(currentStockdata[i-1].demand > 0){
					$(".sh_payment_button_" + i).css("color", "#cc6464");
					}
			}
		}
	}

}
function emptyDemandAndStock() {
	for (let index = 1; index < 13; index++) {
		$(".demand_" + index).val('')
		$(".incoming_" + index).val('')
	}
}
function paidInitalPayment(month) {
	var initial_payment_date = $('#initial_payment_date_' + month).val();
	var initial_payment_amount = $('.initial_payment_amount_' + month).val();
	if (initial_payment_amount == 0 || initial_payment_amount == null) {
		toastr.error("Something Wrong!");
	} else {
		$.ajax({
			url: '/product/paidInitalPayment',
			method: 'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			data: {
				'current_year': currentYear,
				'current_month': month,
				'product_id': currentProductId,
				'initial_payment_date': initial_payment_date,
				'initial_payment_amount': initial_payment_amount,
			},
			success: function (data) {
				if (data.status == 200) {
					$(".initial_payment_button_" + month).prop('disabled', true);
					$(".initial_payment_button_" + month).html('paid')
					$(".initial_payment_button_" + month).css("color", "#64ccb6");
					toastr.success(data.message);
				} else {
					toastr.error(data.message);
				}
			},
			error: function () {
				toastr.error("Failed ! Try Again");
			}
		});
	}
}
function paidFinalPayment(month) {
	var final_payment_date = $('#final_payment_date_' + month).val();
	var final_payment_amount = $('.final_payment_amount_' + month).val();
	if (final_payment_amount == 0 || final_payment_amount == null) {
		toastr.error("Something Wrong!");
	} else {
		$.ajax({
			url: '/product/paidFinalPayment',
			method: 'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			data: {
				'current_year': currentYear,
				'current_month': month,
				'product_id': currentProductId,
				'final_payment_date': final_payment_date,
				'final_payment_amount': final_payment_amount,
			},
			success: function (data) {
				if (data.status == 200) {
					toastr.success(data.message);
					$(".final_payment_button_" + month).prop('disabled', true);
					$(".final_payment_button_" + month).html('paid');
					$(".final_payment_button_" + month).css("color", "#64ccb6");
				} else {
					toastr.error(data.message);
				}
			},
			error: function () {
				toastr.error("Failed ! Try Again");
			}
		});
	}
}
$("#deposit_portion").on('change', function () {
	var deposit_portion = $("#deposit_portion").val();
	var final_payment = 100 - deposit_portion;
	$("#final_payment_portion").val(final_payment);
});
$("#final_payment_portion").on('change', function () {
	var deposit_portion = $("#final_payment_portion").val();
	var final_payment = 100 - deposit_portion;
	$("#deposit_portion").val(final_payment);
});
function paidFHPayment(month) {
	var fh_payment_date = $('#fh_payment_date_' + month).val();
	var fh_payment_amount = $('.fh_payment_amount_' + month).val();
	if (fh_payment_amount == 0 || fh_payment_amount == null) {
		toastr.error("Something Wrong!");
	} else {
		$.ajax({
			url: '/product/firstHalfMonth',
			method: 'post',
			type:'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			data: {
				'current_year': currentYear,
				'current_month': month,
				'product_id': currentProductId,
				'fh_payment_date': fh_payment_date,
				'fh_payment_amount': fh_payment_amount,
			},
			success: function (data) {
				if (data.status == 200) {
					$(".fh_payment_button_" + month).prop('disabled', true);
					$(".fh_payment_button_" + month).html('debited')
					$(".fh_payment_button_" + month).css("color", "#64ccb6");
					toastr.success(data.message);
				} else {
					toastr.error(data.message);
				}
			},
			error: function () {
				toastr.error("Failed ! Try Again");
			}
		});
	}
}
function paidSHPayment(month) {
	var sh_payment_date = $('#sh_payment_date_' + month).val();
	var sh_payment_amount = $('.sh_payment_amount_' + month).val();
	if (sh_payment_amount == 0 || sh_payment_amount == null) {
		toastr.error("Something Wrong!");
	} else {
		$.ajax({
			url: '/product/secondHalfMonth',
			method: 'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			data: {
				'current_year': currentYear,
				'current_month': month,
				'product_id': currentProductId,
				'sh_payment_date': sh_payment_date,
				'sh_payment_amount': sh_payment_amount,
			},
			success: function (data) {
				if (data.status == 200) {
					$(".sh_payment_button_" + month).prop('disabled', true);
					$(".sh_payment_button_" + month).html('debited')
					$(".sh_payment_button_" + month).css("color", "#64ccb6");
					toastr.success(data.message);
				} else {
					toastr.error(data.message);
				}
			},
			error: function () {
				toastr.error("Failed ! Try Again");
			}
		});
	}
}