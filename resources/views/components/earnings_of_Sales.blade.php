<div class="table-responsive earning-of-sales" style="display: none">
	<table class="table">
		<thead class=" text-main">
			<tr>
				<th>Month</th>
				<th>Demand</th>
				<th>Incoming</th>
				<th>Calculated Stock</th>
				<th colspan="3" class="text-left">First half of the month</th>
				<th colspan="3" class="text-left">Second half of the month</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>January</td>
				<td><input type="text" placeholder="-"id="demand_1"  class=" demand_1 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_1"  class="incoming_1 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_1" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_1 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_1" value="0"><input type="hidden" id="fh_payment_date_1"></td>
				<td><button class="btn btn-debit fh_payment_button_1" onclick="paidFHPayment(1)">debited</button></span></td>
				<td class="sh_payment_date_1 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_1" value="0"><input type="hidden" id="sh_payment_date_1"></td>
				<td><button class="btn btn-debit sh_payment_button_1" onclick="paidSHPayment(1)">debited</button></span></td>
			</tr>
			<tr>
				<td>Feburary</td>
				<td><input type="text" placeholder="-"id="demand_2"  class=" demand_2 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_2"  class="incoming_2 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_2" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_2 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_2" value="0"><input type="hidden" id="fh_payment_date_2"></td>
				<td><button class="btn btn-debit fh_payment_button_2" onclick="paidFHPayment(2)">debited</button></span></td>
				<td class="sh_payment_date_2 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_2" value="0"><input type="hidden" id="sh_payment_date_2"></td>
				<td><button class="btn btn-debit sh_payment_button_2" onclick="paidSHPayment(2)">debited</button></span></td>
			</tr>
			<tr>
				<td>March</td>
				<td><input type="text" placeholder="-"id="demand_3"  class=" demand_3 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_3"  class="incoming_3 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_3" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_3 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_3" value="0"><input type="hidden" id="fh_payment_date_3"></td>
				<td><button class="btn btn-debit fh_payment_button_3" onclick="paidFHPayment(3)">debited</button></span></td>
				<td class="sh_payment_date_3 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_3" value="0"><input type="hidden" id="sh_payment_date_3"></td>
				<td><button class="btn btn-debit sh_payment_button_3" onclick="paidSHPayment(3)">debited</button></span></td>
			</tr>
			<tr>
				<td>April</td>
				<td><input type="text" placeholder="-"id="demand_4"  class=" demand_4 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_4"  class="incoming_4 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_4" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_4 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_4" value="0"><input type="hidden" id="fh_payment_date_4"></td>
				<td><button class="btn btn-debit fh_payment_button_4" onclick="paidFHPayment(4)">debited</button></span></td>
				<td class="sh_payment_date_4 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_4" value="0"><input type="hidden" id="sh_payment_date_4"></td>
				<td><button class="btn btn-debit sh_payment_button_4" onclick="paidSHPayment(4)">debited</button></span></td>
			</tr>
			<tr>
				<td>May</td>
				<td><input type="text" placeholder="-"id="demand_5"  class=" demand_5 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_5"  class="incoming_5 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_5" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_5 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_5" value="0"><input type="hidden" id="fh_payment_date_5"></td>
				<td><button class="btn btn-debit fh_payment_button_5" onclick="paidFHPayment(5)">debited</button></span></td>
				<td class="sh_payment_date_5 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_5" value="0"><input type="hidden" id="sh_payment_date_5"></td>
				<td><button class="btn btn-debit sh_payment_button_5" onclick="paidSHPayment(5)">debited</button></span></td>
			</tr>
			<tr>
				<td>June</td>
				<td><input type="text" placeholder="-"id="demand_6"  class=" demand_6 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_6"  class="incoming_6 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_6" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_6 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_6" value="0"><input type="hidden" id="fh_payment_date_6"></td>
				<td><button class="btn btn-debit fh_payment_button_6" onclick="paidFHPayment(6)">debited</button></span></td>
				<td class="sh_payment_date_6 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_6" value="0"><input type="hidden" id="sh_payment_date_6"></td>
				<td><button class="btn btn-debit sh_payment_button_6" onclick="paidSHPayment(6)">debited</button></span></td>
			<tr>
				<td>July</td>
				<td><input type="text" placeholder="-"id="demand_7"  class=" demand_7 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_7"  class="incoming_7 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_7" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_7 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_7" value="0"><input type="hidden" id="fh_payment_date_7"></td>
				<td><button class="btn btn-debit fh_payment_button_7" onclick="paidFHPayment(7)">debited</button></span></td>
				<td class="sh_payment_date_7 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_7" value="0"><input type="hidden" id="sh_payment_date_7"></td>
				<td><button class="btn btn-debit sh_payment_button_7" onclick="paidSHPayment(7)">debited</button></span></td>
			</tr>
			<tr>
				<td>Augest</td>
				<td><input type="text" placeholder="-"id="demand_8"  class=" demand_8 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_8"  class="incoming_8 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_8" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_8 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_8" value="0"><input type="hidden" id="fh_payment_date_8"></td>
				<td><button class="btn btn-debit fh_payment_button_8" onclick="paidFHPayment(8)">debited</button></span></td>
				<td class="sh_payment_date_8 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_8" value="0"><input type="hidden" id="sh_payment_date_8"></td>
				<td><button class="btn btn-debit sh_payment_button_8" onclick="paidSHPayment(8)">debited</button></span></td>
			</tr>
			<tr>
				<td>September</td>
				<td><input type="text" placeholder="-"id="demand_9"  class=" demand_9 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_9"  class="incoming_9 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_9" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_9 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_9" value="0"><input type="hidden" id="fh_payment_date_9"></td>
				<td><button class="btn btn-debit fh_payment_button_9" onclick="paidFHPayment(9)">debited</button></span></td>
				<td class="sh_payment_date_9 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_9" value="0"><input type="hidden" id="sh_payment_date_9"></td>
				<td><button class="btn btn-debit sh_payment_button_9" onclick="paidSHPayment(9)">debited</button></span></td>
			</tr>
			<tr>
				<td>October</td>
				<td><input type="text" placeholder="-"id="demand_10"  class=" demand_10 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_10"  class="incoming_10 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_10" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_10 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_10" value="0"><input type="hidden" id="fh_payment_date_10"></td>
				<td><button class="btn btn-debit fh_payment_button_10" onclick="paidFHPayment(10)">debited</button></span></td>
				<td class="sh_payment_date_10 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_10" value="0"><input type="hidden" id="sh_payment_date_10"></td>
				<td><button class="btn btn-debit sh_payment_button_10" onclick="paidSHPayment(10)">debited</button></span></td>
			</tr>
			<tr>
				<td>November</td>
				<td><input type="text" placeholder="-"id="demand_11"  class=" demand_11 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_11"  class="incoming_11 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_11" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_11 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_11" value="0"><input type="hidden" id="fh_payment_date_11"></td>
				<td><button class="btn btn-debit fh_payment_button_11" onclick="paidFHPayment(11)">debited</button></span></td>
				<td class="sh_payment_date_11 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_11" value="0"><input type="hidden" id="sh_payment_date_11"></td>
				<td><button class="btn btn-debit sh_payment_button_11" onclick="paidSHPayment(11)">debited</button></span></td>
			</tr>
			<tr>
				<td>December</td>
				<td><input type="text" placeholder="-"id="demand_12"  class=" demand_12 form-control text-center" min="0" value="" onchange="onChangedDemandES(1)"></td>
				<td><input type="text" placeholder="-" id="incoming_12"  class="incoming_12 form-control text-center" min="0"  value="" onchange="onChangedIncomingES(1)"></td>
				<td class="calculatedStock"><input class="form-control  text-center currentStock_12" type="text" data-id="" value="0" disabled></td>
				<td class="fh_payment_date_12 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled class="form-control text-center fh_payment_amount_12" value="0"><input type="hidden" id="fh_payment_date_12"></td>
				<td><button class="btn btn-debit fh_payment_button_12" onclick="paidFHPayment(12)">debited</button></span></td>
				<td class="sh_payment_date_12 payment_date_style">xx-xx-xxxx</td>
				<td><input type="text" placeholder="-" disabled	class="form-control text-center sh_payment_amount_12" value="0"><input type="hidden" id="sh_payment_date_12"></td>
				<td><button class="btn btn-debit sh_payment_button_12" onclick="paidSHPayment(12)">debited</button></span></td>
			</tr>
		</tbody>
	</table>
</div>