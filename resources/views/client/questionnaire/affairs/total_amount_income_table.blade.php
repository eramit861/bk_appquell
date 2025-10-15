
<table class="total-amount-income-table table table-no-padding" style="border: 1px solid #eaeaea;">
	<thead>
		<tr>
			<th>Year</th>
			<th></th>
			<th>{{ $debtorname }} Source of Income</th>
			<th>Input {{ $debtorname }} income</th>
		</tr>
	</thead>	
	<tbody>
		<tr>
			<td data="Period">
				<div class="form-group">
					{{ Helper::validate_key_value(0, $taxYears) }}</br>
				</div>
			</td>
			<td data="Period">
				<div class="form-group">
					<strong class="text-c-blue border-dotted">YTD:</strong>
				</div>
			</td>
			
			<td data="Source of income">
			<div class="d-block text-left"><a href="javascript:void(0)" onclick="openFlagPopup('sofa-irs-popup-image-ytd', '', false);" class="text-c-blue small-font">Where do I find this? <img alt="Quick Tip" src="{{url('assets/img/quick-tip.jpg')}}" width="28px" /></a></div>
				<div class="amount-this-year d-flex  form-group">
					<div class="d-inline radio-primary ">
						<input type="radio" onchange="allowNegativeValue(this)" id="total_amount_this_year_yes"
							name="total_amount_this_year"
							 value="1" required {{ Helper::validate_key_toggle('total_amount_this_year', $finacial_affairs, 1)}}>
						<label for="total_amount_this_year_yes"
							class="cr text-c-black ">Wages</label>
					</div>
				
					<div class="d-inline radio-primary ">
						<input type="radio" onchange="allowNegativeValue(this)" id="total_amount_this_year_no"
							name="total_amount_this_year" value="0" required {{ Helper::validate_key_toggle('total_amount_this_year', $finacial_affairs, 0)}}>
						<label for="total_amount_this_year_no"
							class="cr text-c-black">Business</label>
					</div>
				</div>
			</td>
			<td  data="Gross income" class="text-center p-relative">
				<div class="total_amount_this_year_income form-group">
				<x-dsmi />
					<input type="number"     class="form-control  {{ Helper::validate_key_negative_class('total_amount_this_year', $finacial_affairs, 0)}}  required" name="total_amount_this_year_income" value="{{ Helper::validate_key_value('total_amount_this_year_income', $finacial_affairs)}}">
				</div>
				</div>
				
				<a href="javascript:void(0)" class="{{ !empty(Helper::validate_key_value('total_amount_this_year_income_extra', $finacial_affairs)) ? 'hide-data' : ''}} border-bottom-light-blue to_in_first float-right" onclick="$('.in_extra_1').removeClass('hide-data');$(this).addClass('hide-data');"><i class="feather icon-plus mr-0"></i>Add More Income This Year</a>
			</td>
		</tr>
		<!-- Additional tr-->
		@include("client.questionnaire.affairs.total_price_debtor.total_amount_income_extra")
		<!-- Additional tr end-->
		
		<tr>
			<td data="Period">
				<div class="form-group">
					<label>{{ Helper::validate_key_value(1, $taxYears) }}</label>
				</div>
			</td>
			<td data="Period">
				
			</td>
			<td data="Source of income">
			<div class="d-block text-left"><a href="javascript:void(0)" class="text-c-blue small-font" onclick="openFlagPopup('sofa-irs-popup-image', '', false);">Where do I find this? <img alt="Quick Tip" src="{{url('assets/img/quick-tip.jpg')}}" width="28px" /></a></div>
				<div class="amount-last-year d-flex  form-group">
					<div class="d-inline radio-primary ">
						<input type="radio" onchange="allowNegativeValue(this)" id="total_amount_last_year_yes"
							name="total_amount_last_year"
							 value="1" required {{ Helper::validate_key_toggle('total_amount_last_year', $finacial_affairs, 1)}}>
						<label for="total_amount_last_year_yes"
							class="cr text-c-black ">Wages</label>
					</div>
				
					<div class="d-inline radio-primary ">
						<input type="radio" onchange="allowNegativeValue(this)" id="total_amount_last_year_no"
							name="total_amount_last_year" value="0" required {{ Helper::validate_key_toggle('total_amount_last_year', $finacial_affairs, 0)}}>
						<label for="total_amount_last_year_no"
							class="cr text-c-black">Business</label>
					</div>
				</div>
			</td>
			<td data="Gross income" class="text-center p-relative">
				<div class="total_amount_this_year_income form-group">
				<x-dsmi />
					<input type="number"     class="form-control {{ Helper::validate_key_negative_class('total_amount_last_year', $finacial_affairs, 0)}} required" name="total_amount_last_year_income" value="{{ Helper::validate_key_value('total_amount_last_year_income', $finacial_affairs)}}">
				</div>
				</div>
				<a href="javascript:void(0)" class="{{ !empty(Helper::validate_key_value('total_amount_last_year_income_extra', $finacial_affairs)) ? 'hide-data' : ''}} border-bottom-light-blue absolution-income-icon last_yr_in_first float-right" onclick="$('.last_year_extra').removeClass('hide-data');$(this).addClass('hide-data');"><i class="feather icon-plus mr-0"></i>Add More Income This Year</a>
			</td>
		</tr>
		<!-- Additional tr-->
		@include("client.questionnaire.affairs.total_price_debtor.total_amount_last_year_income_extra")
		<!-- Additional tr end-->

		<tr>
			<td data="Period">
				<div class="form-group">
					<label>{{ Helper::validate_key_value(2, $taxYears) }}</label>
				</div>
			</td>
			<td data="Period">
				
			</td>
			<td data="Source of income">
			<div class="d-block text-left"><a href="javascript:void(0)" onclick="openFlagPopup('sofa-irs-popup-image', '', false);" class="text-c-blue small-font">Where do I find this? <img alt="Quick Tip" src="{{url('assets/img/quick-tip.jpg')}}" width="28px" /></a></div>
				<div class="amount-last-before-year d-flex  form-group">
					<div class="d-inline radio-primary ">
						<input type="radio" onchange="allowNegativeValue(this)" id="total_amount_lastbefore_year_yes"
							name="total_amount_lastbefore_year"
							 value="1" required {{ Helper::validate_key_toggle('total_amount_lastbefore_year', $finacial_affairs, 1)}}>
						<label for="total_amount_lastbefore_year_yes"
							class="cr text-c-black ">Wages</label>
					</div>
					
					<div class="d-inline radio-primary ">
						<input type="radio" onchange="allowNegativeValue(this)" id="total_amount_lastbefore_year_no"
							name="total_amount_lastbefore_year" value="0" required {{ Helper::validate_key_toggle('total_amount_lastbefore_year', $finacial_affairs, 0)}}>
						<label for="total_amount_lastbefore_year_no"
							class="cr text-c-black">Business</label>
					</div>
				</div>
			</td>
			<td data="Gross income" class="text-center p-relative">
				<div class="total_amount_this_year_income form-group">
				<x-dsmi />
					<input type="number"     class="form-control  {{ Helper::validate_key_negative_class('total_amount_lastbefore_year', $finacial_affairs, 0)}} required" name="total_amount_lastbefore_year_income" value="{{ Helper::validate_key_value('total_amount_lastbefore_year_income', $finacial_affairs)}}">
				</div>
				</div>
				<a href="javascript:void(0)" class="{{ !empty(Helper::validate_key_value('total_amount_lastbefore_year_income_extra', $finacial_affairs)) ? 'hide-data' : ''}} border-bottom-light-blue absolution-income-icon last_yr_add_first float-right" onclick="$('.last_before_extra').removeClass('hide-data');$(this).addClass('hide-data');"><i class="feather icon-plus mr-0"></i>Add More Income This Year</a>
			</td>
		</tr>
		<!-- Additional tr-->
		@include("client.questionnaire.affairs.total_price_debtor.total_amount_last_before_income_extra")
		<!-- Additional tr end-->

	</tbody>
</table>