<?php if (Helper::validate_key_value('live_separately', $expenses_info) == 1) { ?>
@include("attorney.official_form.form_spouse_expenses",['BasicInfoPartA'=>$BasicInfoPartA,'BasicInfoPartB'=>$BasicInfoPartB,'expenses_info'=>$spouse_expenses_info,'totalExpensesSpouse' => $totalExpensesSpouse])
<?php } ?>