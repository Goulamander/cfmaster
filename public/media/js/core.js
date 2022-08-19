window.onload = function exampleFunction() {
	getUserPlan()
	showAllUniqueCostEntry()
	dashboardstats()
}
var currentdate = new Date();
var currentYear = currentdate.getFullYear();
var dashboardstatsdata = '';
var currentAccountBal = '';
var currentAccountDate = '';
var currentAccountYear = '';
var max = '';
var min = '';
function dashboardstats() {
	$.ajax({
		url: '/dashboard/stats',
		type: 'get',
		dataType: 'json',
		success: function (data) {
			data.sort(function (a, b) {
				return new Date(a.starting_date) - new Date(b.starting_date);
			});
			stats(data)
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function stats(statsdata) {
	google.charts.load('current', { 'packages': ['line'] });
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var previewsvalue = '';
		var newsvalue = currentAccountBal;
		var data = new google.visualization.DataTable();
		data.addColumn('date', 'X');
		data.addColumn('number', 'Figure Cost');
		for (var i = 0; i < statsdata.length; i++) {
			previewsvalue = +statsdata[i].payment_amount + +newsvalue;
			data.addRow([new Date(statsdata[i].starting_date), Number(previewsvalue)]);
			newsvalue = previewsvalue;
		}
		data.sort([{ column: 0 }, { column: 1 }]);
		var options = {
			chart: {
				title: 'Your Account Balance Sheet Based on Credit And Debit Payments.',
				subtitle: 'in Euro(€)'
			},
			hAxis: {
				title: 'Starting At'
			},
			vAxis: {
				title: "Payment Amount",
				viewWindowMode: 'explicit',
			}
		};
		var formatter = new google.visualization.NumberFormat(
			{ prefix: '€', negativeColor: 'red', negativeParens: true });
		formatter.format(data, 1);
		var chart = new google.charts.Line(document.getElementById('chart_div'));

		chart.draw(data, google.charts.Line.convertOptions(options));
	}
}
$("#status").on("click", function (e) {
	var formData = {
		description: $("#description").val(),
		payment_amount: $("#payment_amount").val(),
		entry_date: $("#entry_date").val()
	};
	var dataString = $(this).serialize();
	url = 'uniqueCost/singleEntry';
	$.ajax({
		type: "POST",
		url: url,
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data: formData,
		dataType: "json",
		encode: true,
	}).done(function (data) {
		if (data.status == 200) {
			resetUniqueCostEntry()
			showAllUniqueCostEntry()
			dashboardstats()
			toastr.success(data.message);
		} else {
			toastr.error(data.message);
		}
	}).fail(function (errors) {
		toastr.error("Request Failed, Please Try Again.");
	});
	e.preventDefault();
});
function showAllUniqueCostEntry() {
	$.ajax({
		url: '/uniqueCost/allsingleEntry',
		type: 'get',
		dataType: 'json',
		success: function (data) {
			var entriesdata = '';
			var response = data.singleEntries;
			for (var i in response) {
				entriesdata = entriesdata + '<div class="row" id ="singleEntry-' + response[i].id + '">';
				entriesdata = entriesdata + '<div class="col-sm-4 entryDateClass" >' + response[i].entry_date + '</div>';
				entriesdata = entriesdata + '<div class="col-sm-3 paymentAmountClass"> € ' + response[i].payment_amount + '</div>';
				entriesdata = entriesdata + '<div class="col-sm-3 paidButtonClasss"><button type="button" class="btn btn-sm btn-paid btn-round"  onclick="deleteSingleCostEntry(' + response[i].id + ')">paid</button></div>';
				entriesdata = entriesdata + '<div class="col-sm-1 settingButtonClass" ><a class="settings" onclick="editSingleCostEntry(' + response[i].id + ')"><i class="material-icons">settings</i></a></div>';
				entriesdata = entriesdata + '<div class="col-sm-12"><p style="border-bottom: 2px solid;margin-top: 1rem;">' + response[i].description + '</p></div>';
				entriesdata = entriesdata + '</div>';
			}
			$('.singleEntries').html(entriesdata);
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function resetUniqueCostEntry() {
	$("#description").val('')
	$("#payment_amount").val('')
	$("#entry_date").val('')
}
function editSingleCostEntry(id) {
	$.ajax({
		url: '/uniqueCost/getSingleEntry/' + id,
		type: 'get',
		dataType: 'json',
		success: function (data) {
			$('#singleEntry-' + id).empty();
			var response = data.singleEntry;
			var editEntryData = '';
			editEntryData = editEntryData + '<div class="col-md-4"><input type="date" id="entry_date_' + id + '" class="form-control" value="' + response.entry_date + '" required></div>';
			editEntryData = editEntryData + ' <div class="col-md-3"><input type="number" id="payment_amount_' + id + '" class="form-control" value="' + response.payment_amount + '" required></div>';
			editEntryData = editEntryData + '<div class="col-sm-2"><button type="button" class="btn btn-sm btn-unpaid btn-round" onclick="editSingleEntryForm(' + id + ',event)">Edit</button></div>';
			editEntryData = editEntryData + ' <div class="col-md-9"><input type="text" id="description_' + id + '" class="form-control" value="' + response.description + '" required></div>';
			$('#singleEntry-' + id).html(editEntryData);
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function deleteSingleCostEntry(id) {
	$.ajax({
		url: '/uniqueCost/deleteSingleEntry/' + id,
		type: 'get',
		dataType: 'json',
		success: function (data) {
			if (data.status == 200) {
				showAllUniqueCostEntry()
				dashboardstats()
				toastr.success(data.message);
			} else {
				toastr.error(data.message);
			}
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function editSingleEntryForm(id, event) {
	event.preventDefault();
	var formData = {
		description: $("#description_" + id).val(),
		payment_amount: $("#payment_amount_" + id).val(),
		entry_date: $("#entry_date_" + id).val(),
		id: id
	};
	var dataString = $(this).serialize();
	url = '/uniqueCost/updatesingleEntry';
	$.ajax({
		type: "POST",
		url: url,
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data: formData,
		dataType: "json",
		encode: true,
	}).done(function (data) {
		if (data.status == 200) {
			showAllUniqueCostEntry()
			dashboardstats()
			toastr.success(data.message);
		} else {
			toastr.error(data.message);
		}
	}).fail(function (errors) {
		toastr.error("Request Failed, Please Try Again.");
	});
}
function getUserPlan() {
	$.ajax({
		url: '/user/getUserPlan',
		type: 'get',
		dataType: 'json',
		success: function (data) {
			$(".current_date").val(data.current_date);
			$(".currentDate").html(data.current_date);
			$(".current_account_bal").val(data.current_account_bal);
			currentAccountBal = data.current_account_bal;
			currentAccountDate = data.current_date;
			var tempdate = new Date(currentAccountDate);
			currentAccountYear =  tempdate.getFullYear();
			$(".currentAmazonSaldo").val(data.currentAmazonSaldo);
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function updateUserAccountDate(action) {
	var work = 0;
	if (action == 'current_date') {
		var formData = {
			current_date: $(".current_date").val(),
		};
		work = 1;
	}
	else if (action == 'current_account_bal') {
		var formData = {
			current_account_bal: $(".current_account_bal").val(),
		};
		work = 1;
	}
	else if (action == 'currentAmazonSaldo') {
		var formData = {
			currentAmazonSaldo: $(".currentAmazonSaldo").val(),
		};
		work = 1;
	}
	if (work == 1) {
		$.ajax({
			url: '/user/updateCurrentDate',
			method: 'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			data: formData,
			success: function (data) {
				if (data.status == 200) {
					toastr.success(data.message);
					if (data.updatetype == 'current_date') {
						$(".current_date").val(data.current_date);
						$(".current_date").html(data.current_date);
						currentAccountDate = data.current_date;
						var tempdate = new Date(currentAccountDate);
						currentAccountYear =  tempdate.getFullYear();
					}
					if (data.updatetype == 'current_account_bal') {
						$(".current_account_bal").val(data.current_account_bal);
						currentAccountBal = data.current_account_bal;
					}
					if (data.updatetype == 'currentAmazonSaldo') {
						$(".currentAmazonSaldo").val(data.currentAmazonSaldo);
					}
					dashboardstats()
				} else {
					toastr.error(data.message);
				}
			},
			error: function () {
				toastr.error("Failed ! Try Again");
			}
		});
	} else {
		toastr.error("Something Wrong! Try Again");
	}
}
$('#change-report').click(function(){
	$('.product-orders').toggle();
	$('.earning-of-sales').toggle(); 
});