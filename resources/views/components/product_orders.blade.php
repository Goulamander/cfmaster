<div class="table-responsive product-orders">
	<table class="table">
		<thead class=" text-main">
			<tr>
				<th>Month</th>
				<th>Demand</th>
				<th>Incoming</th>
				<th>Calculated Stock</th>
				<th colspan="3" class="text-left">Initial Payment</th>
				<th colspan="3" class="text-left">Final Payment</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>January</td>
				<td><input type="text" placeholder="-" class=" demand_1 form-control text-center" min="0" value="" onchange="onChangedDemand(1)"></td>
				<td><input type="text" placeholder="-" class="incoming_1 form-control text-center" min="0"  value="" onchange="onChangedIncoming(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_1" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_1 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center initial_payment_amount_1"><input type="hidden" id="initial_payment_date_1"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_1" onclick="paidInitalPayment(1)">unpaid</button></span></td>
				<td class="final_payment_date_1 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_1 "><input type="hidden" id="final_payment_date_1"></td>
				<td><button class="btn btn-initalpayment final_payment_button_1" onclick="paidFinalPayment(1)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>Feburary</td>
				<td><input type="text" placeholder="-" class=" demand_2 form-control text-center" min="0" value="" onchange="onChangedDemand(2)"></td>
				<td><input type="text" placeholder="-" class="incoming_2 form-control text-center"min="0"  value="" onchange="onChangedIncoming(2)"></td>
				<td><input class="form-control  text-center currentStock_2" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_2">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_2"><input type="hidden" id="initial_payment_date_2"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_2" onclick="paidInitalPayment(2)">unpaid</button></span></td>
				<td class="final_payment_date_2">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_2"><input type="hidden" id="final_payment_date_2"></td>
				<td><button class="btn btn-initalpayment final_payment_button_2" onclick="paidFinalPayment(2)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>March</td>
				<td><input type="text" placeholder="-" class=" demand_3 form-control text-center" min="0" value="" onchange="onChangedDemand(3)"></td>
				<td><input type="text" placeholder="-" class="incoming_3 form-control text-center" min="0"  value="" onchange="onChangedIncoming(3)"></td>
				<td><input class="form-control  text-center currentStock_3" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_3">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_3"><input type="hidden" id="initial_payment_date_3"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_3" onclick="paidInitalPayment(3)">unpaid</button></span></td>
				<td class="final_payment_date_3">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_3"><input type="hidden" id="final_payment_date_3"></td>
				<td><button class="btn btn-initalpayment final_payment_button_3" onclick="paidFinalPayment(3)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>April</td>
				<td><input type="text" placeholder="-" class=" demand_4 form-control text-center" min="0" value="" onchange="onChangedDemand(4)"></td>
				<td><input type="text" placeholder="-" class="incoming_4 form-control text-center" min="0"  value="" onchange="onChangedIncoming(4)"></td>
				<td><input class="form-control  text-center currentStock_4" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_4">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center initial_payment_amount_4"><input type="hidden" id="initial_payment_date_4"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_4" onclick="paidInitalPayment(4)">unpaid</button></span></td>
				<td class="final_payment_date_4">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center final_payment_amount_4"><input type="hidden" id="final_payment_date_4"></td>
				<td><button class="btn btn-initalpayment final_payment_button_4" onclick="paidFinalPayment(4)">unpaid</button></span></td></tr>
			<tr>
				<td>May</td>
				<td><input type="text" placeholder="-" class=" demand_5 form-control text-center" min="0" value="" onchange="onChangedDemand(5)"></td>
				<td><input type="text" placeholder="-" class="incoming_5 form-control text-center" min="0"  value="" onchange="onChangedIncoming(5)"></td>
				<td><input class="form-control  text-center currentStock_5" type="text" data-id="" value="0"disabled></td>
				<td class="initial_payment_date_5">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_5"><input type="hidden" id="initial_payment_date_5"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_5" onclick="paidInitalPayment(5)">unpaid</button></span></td>
				<td class="final_payment_date_5">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center final_payment_amount_5"><input type="hidden" id="final_payment_date_5"></td>
				<td><button class="btn btn-initalpayment final_payment_button_5" onclick="paidFinalPayment(5)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>June</td>
				<td><input type="text" placeholder="-" class=" demand_6 form-control text-center" min="0" value="" onchange="onChangedDemand(6)"></td>
				<td><input type="text" placeholder="-" class="incoming_6 form-control text-center" min="0"  value="" onchange="onChangedIncoming(6)"></td>
				<td><input class="form-control  text-center currentStock_6" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_6">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_6"><input type="hidden" id="initial_payment_date_6"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_6"	onclick="paidInitalPayment(6)">unpaid</button></span></td>
				<td class="final_payment_date_6">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_6"><input type="hidden" id="final_payment_date_6"></td>
				<td><button class="btn btn-initalpayment final_payment_button_6"onclick="paidFinalPayment(6)">unpaid</button></span></td>
			<tr>
				<td>July</td>
				<td><input type="text" placeholder="-" class=" demand_7 form-control text-center"min="0" value="" onchange="onChangedDemand(7)"></td>
				<td><input type="text" placeholder="-" class="incoming_7 form-control text-center"  min="0"  value="" onchange="onChangedIncoming(7)"></td>
				<td><input class="form-control  text-center currentStock_7" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_7">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center initial_payment_amount_7"><input type="hidden" id="initial_payment_date_7"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_7"onclick="paidInitalPayment(7)">unpaid</button></span></td>
				<td class="final_payment_date_7">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_7"><input type="hidden" id="final_payment_date_7"></td>
				<td><button class="btn btn-initalpayment final_payment_button_7"onclick="paidFinalPayment(7)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>Augest</td>
				<td><input type="text" placeholder="-" class=" demand_8 form-control text-center" min="0" value="" onchange="onChangedDemand(8)"></td>
				<td><input type="text" placeholder="-" class="incoming_8 form-control text-center" min="0"  value="" onchange="onChangedIncoming(8)"></td>
				<td><input class="form-control  text-center currentStock_8" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_8">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_8"><input type="hidden" id="initial_payment_date_8"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_8"
						onclick="paidInitalPayment(8)">unpaid</button></span></td>
				<td class="final_payment_date_8">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_8"><input type="hidden" id="final_payment_date_8"></td>
				<td><button class="btn btn-initalpayment final_payment_button_8" onclick="paidFinalPayment(8)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>September</td>
				<td><input type="text" placeholder="-" class=" demand_9 form-control text-center"min="0" value="" onchange="onChangedDemand(9)"></td>
				<td><input type="text" placeholder="-" class="incoming_9 form-control text-center"  min="0"  value="" onchange="onChangedIncoming(9)"></td>
				<td><input class="form-control  text-center currentStock_9" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_9">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center initial_payment_amount_9"><input type="hidden" id="initial_payment_date_9"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_9"onclick="paidInitalPayment(9)">unpaid</button></span></td>
				<td class="final_payment_date_9">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_9"><input type="hidden" id="final_payment_date_9"></td>
				<td><button class="btn btn-initalpayment final_payment_button_9" onclick="paidFinalPayment(9)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>October</td>
				<td><input type="text" placeholder="-" class=" demand_10 form-control text-center"	min="0" value="" onchange="onChangedDemand(10)"></td>
				<td><input type="text" placeholder="-" class="incoming_10 form-control text-center"  min="0"  value="" onchange="onChangedIncoming(10)"></td>
				<td><input class="form-control  text-center currentStock_10" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_10">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_10"><input type="hidden" id="initial_payment_date_10"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_10"	onclick="paidInitalPayment(10)">unpaid</button></span></td>
				<td class="final_payment_date_10">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_10"><input type="hidden" id="final_payment_date_10"></td>
				<td><button class="btn btn-initalpayment final_payment_button_10"onclick="paidFinalPayment(10)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>November</td>
				<td><input type="text" placeholder="-" class=" demand_11 form-control text-center" min="0" value="" onchange="onChangedDemand(11)"></td>
				<td><input type="text" placeholder="-" class="incoming_11 form-control text-center"  min="0"  value="" onchange="onChangedIncoming(11)"></td>
				<td><input class="form-control  text-center currentStock_11" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_11">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_11"><input type="hidden" id="initial_payment_date_11"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_11"onclick="paidInitalPayment(11)">unpaid</button></span></td>
				<td class="final_payment_date_11">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center final_payment_amount_11"><input type="hidden" id="final_payment_date_11"></td>
				<td><button class="btn btn-initalpayment final_payment_button_11" onclick="paidFinalPayment(11)">unpaid</button></span></td>
			</tr>
			<tr>
				<td>December</td>
				<td><input type="text" placeholder="-" class=" demand_12 form-control text-center" min="0" value="" onchange="onChangedDemand(12)"></td>
				<td><input type="text" placeholder="-" class="incoming_12 form-control text-center" min="0"  value="" onchange="onChangedIncoming(12)"></td>
				<td><input class="form-control  text-center currentStock_12" type="text" data-id="" value="0" disabled></td>
				<td class="initial_payment_date_12">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center initial_payment_amount_12"><input type="hidden" id="initial_payment_date_12"></td>
				<td><button class="btn btn-initalpayment initial_payment_button_12" onclick="paidInitalPayment(12)">unpaid</button></span></td>
				<td class="final_payment_date_12">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center final_payment_amount_12"><input type="hidden" id="final_payment_date_12"></td>
				<td><button class="btn btn-initalpayment final_payment_button_12" onclick="paidFinalPayment(12)">unpaid</button></span></td>
			</tr>
		</tbody>
	</table>
</div>