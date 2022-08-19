
$("#runningCostEntry").on("submit", function (e) {
	var formData = {
		description: $("#description").val(),
		payment_amount: $("#payment_amount").val(),
		interval: $("#interval").val(),
		starting_date: $("#starting_date").val(),
		numberOfPayment: $("#numberOfPayment").val(),
	};
	console.log(formData);
	var dataString = $(this).serialize();
	url = 'runningCost/newEntry';
	$.ajax({
		type: "POST",
		url: url,
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data: formData,
		dataType: "json",
		encode: true,
	}).done(function (data) {
		if (data.status == 200) {
			resetRunningCostEntry()
			showAllRunningCostEntry()
			toastr.success(data.message);
		} else {
			toastr.error(data.message);
		}
	}).fail(function (errors) {
		toastr.error("Request Failed, Please Try Again.");
	});
	e.preventDefault();
});
function showAllRunningCostEntry() {
	$.ajax({
		url: '/runningCost/all',
		type: 'get',
		dataType: 'json',
		success: function (data) {
			runningStats()
			if (data.entries.length > 0) {
				console.log(data.entries)

				var entriesdata = '';
				var response = data.entries;
				for (var i in response) {
					entriesdata = entriesdata + '<tr>';
					entriesdata = entriesdata + '<tr class="editEntry' + response[i].id + '">';
					entriesdata = entriesdata + '<td>' + response[i].description + '</td>';
					entriesdata = entriesdata + '<td> € ' + response[i].payment_amount + '</td>';
					entriesdata = entriesdata + '<td>' + response[i].interval + '</td>';
					entriesdata = entriesdata + '<td>' + response[i].starting_date + '</td>';
					entriesdata = entriesdata + '<td class="text-right">' + response[i].numberOfPayment + '</td>';
					entriesdata = entriesdata + '<td class="text-right">';
					entriesdata = entriesdata + '<button class=" btn btn-info btn-round btn-fab button" id="editEntry" data-id="' + response[i].id + '" onclick="updateRunningCostRecord(' + response[i].id + ')"><i class="material-icons">edit</i></button>';
					entriesdata = entriesdata + '<button class=" btn btn-danger btn-round btn-fab button" id="deleteEntry" data-id="' + response[i].id + '" onclick="recordDeleteConfirmButton(' + response[i].id + ')"><i class="material-icons">delete</i></button></td>';
					entriesdata = entriesdata + '</tr>';
				}
				$('.runningCostTable').html(entriesdata);
			}
			else {
				console.log(data.entries)
				entriesdata = entriesdata + '<tr>';
				entriesdata = entriesdata + '<td  colspan="6" class="text-center">';
				entriesdata = entriesdata + 'No Record Present in Our System';
				entriesdata = entriesdata + '</td></tr>';
				$('.runningCostTable').html(entriesdata);
			}
			$('.td-price').html('€ ' + data.totalentryamount + '');
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function resetRunningCostEntry() {
	$("#description").val('')
	$("#payment_amount").val('')
	$("#interval").val('')
	$("#starting_date").val('')
	$("#numberOfPayment").val('')
}
window.onload = function exampleFunction() {
	getUserPlan()
	showAllRunningCostEntry()
}
function recordDeleteConfirmButton(id) {
	swal({
		title: "Are you sure?",
		text: "Once deleted, you will not be able to recover this Record!",
		icon: "warning",
		buttons: {
			defeat: "Delete",
			cancel: "Not Now"
		},
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				recordDelete(id)
			} else {
				swal("Your imaginary file is safe!", {
					icon: "warning",
				});
			}
		});
}
function recordDelete(id) {
	console.log(id);
	$.ajax({
		url: '/runningCost/delete/' + id,
		type: 'get',
		dataType: 'json',
		success: function (data) {
			if (data.status) {
				showAllRunningCostEntry()
				swal("Poof! Your Running has been deleted!", {
					icon: "success",
				});
			}
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function runningStats() {
	$.ajax({
		url: '/running/stats',
		type: 'get',
		dataType: 'json',
		success: function (data) {
			// findminmax(data)
			data.sort(function (a, b) {
				// Turn your strings into dates, and then subtract them
				// to get a value that is either negative, positive, or zero.
				return new Date(a.starting_date) - new Date(b.starting_date);
			});
			resultRunningStats(data)
		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function resultRunningStats(statsdata) {
	google.charts.load('current', { 'packages': ['line'] });
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var previewsvalue = 0;
		var newsvalue = currentAccountBal;
		var data = new google.visualization.DataTable();
		data.addColumn('date', 'X');
		data.addColumn('number', 'Figure Cost');
		for (var i = 0; i < statsdata.length; i++) {
			previewsvalue = +statsdata[i].payment_amount + +newsvalue;
			data.addRow([new Date(statsdata[i].starting_date), previewsvalue]);
			newsvalue = previewsvalue;
		}
		// data.sort([{column: 1}, {column: 0}]);
		console.log('data', data)
		console.log('statsdata', statsdata)
		var options = {
			chart: {
				title: 'Your Account Balance Sheet Based on Running Cost Payments.',
				subtitle: 'in Euro(€)'
			},
			hAxis: {
				title: 'Starting At'
			},
			vAxis: {
				title: "Payment Amount",
				viewWindowMode: 'explicit',
				// viewWindow: {
				// 	max: max,
				// 	min: min
				// }
			}
		};
		var formatter = new google.visualization.NumberFormat(
			{ prefix: '€', negativeColor: 'red', negativeParens: true });
		formatter.format(data, 1);
		var chart = new google.charts.Line(document.getElementById('running_chart_div'));

		chart.draw(data, google.charts.Line.convertOptions(options));
	}
}
function updateRunningCostRecord(id) {
	$.ajax({
		url: '/runningCost/singleRunningCost/' + id,
		type: 'get',
		datatype: 'json',
		success: function (data) {
			$(".editEntry" + id).empty();
			console.log(data);
			editRunnigCostform = '';
			editRunnigCostform += '<td> <input type="text" class="form-control" id="description_' + data[0].id + '"placeholder="Enter Description" value="' + data[0].description + '" required></td>';
			editRunnigCostform += '<td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number"id="payment_amount_' + data[0].id + '" class="form-control figure-cost" style="width: 34px;" required  value="' + data[0].payment_amount + '"></div></td>';
			editRunnigCostform += '<td>';
			editRunnigCostform += '<select  data-style="select-with-transition"title="Choose Intervel" data-size="4" id="interval_' + data[0].id + '" required  value ="' + data[0].interval + '" >';
			console.log(editRunnigCostform += '<option  selected>' + data[0].interval + '</option><option value="1">Monthly </option><option value="3">Quartly</option><option value="12">Yearly</option><option value="6">half</option></select></td>');
			editRunnigCostform += '<td><div class="form-group bmd-form-group is-filled"><input type="date" class="form-control datepicker"id="starting_date_' + data[0].id + '"  value="' + data[0].starting_date + '" required></div></td>';
			editRunnigCostform += '<td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" class="form-control" id="numberOfPayment_' + data[0].id + '" style="width: 34px;" placeholder="Number of Payments"  value="' + data[0].numberOfPayment + '" required></div></td>';
			editRunnigCostform += '<td class="text-right">';
			editRunnigCostform += '<button class="btn btn-round btn-fab button btn-success" onclick="updateRunningCost(' + id + ',event)">  <i class="material-icons">done</i></button>';
			editRunnigCostform += '<button class="btn btn-round btn-fab button btn-danger" onclick="cancalUpdate()"> <i class="material-icons">close</i></button></td>'
			$(".editEntry" + id).html(editRunnigCostform)
		}, error: function () {
			alert("Failed! Please try again.");
		}
	});
}
function updateRunningCost(id, event) {
	event.preventDefault();
	var formData = {
		description: $("#description_" + id).val(),
		payment_amount: $("#payment_amount_" + id).val(),
		interval: $('#interval_' + id + " option:selected").val(),
		starting_date: $("#starting_date_" + id).val(),
		numberOfPayment: $("#numberOfPayment_" + id).val(),
		id: id
	};
	console.log(formData);
	var dataString = $(this).serialize();
	url = '/runningCost/editRunningCost';
	$.ajax({
		method: 'post',
		url: url,
		data: formData,
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		dataType: 'json',
		encode: 'true',
		success: function (data) {
			if (data.status == 200) {
				showAllRunningCostEntry()

				toastr.success(data.message);
			} else {
				toastr.error(data.message);
			}
		},
		error: function () {
			toastr.error("Request Failed, Please Try Again.");
		}
	});

}
function cancalUpdate() {
	swal("Running cost updation cancelled!!", {
		icon: "warning",
	});
	showAllRunningCostEntry();
	console.log(showAllRunningCostEntry());
}