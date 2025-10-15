<?php
$fromline = 2;
$lineIndex = 1;
$part2Debtors = [];
$pagefrom = 1;
$totalCount = is_array($creditors) ? count($creditors) : 1;
foreach ($creditors as $creditli) {
    if (in_array($creditli['debt_owned_by'], Helper::OWNBY_FORM_VALUES)) {
        $creditli['codebtor']['fromLine'] = $fromline.'.'.$lineIndex;
        $part2Debtors[] = $creditli['codebtor'];
    }
    $lineIndex++;
}
$part2Debtors = [];
$countCodebtor = is_array($part2Debtors) ? count($part2Debtors) : 1;
$totalCodebtorPages = $countCodebtor > 0 ? ceil(($countCodebtor) / 6) : 0;
$totalPage = ceil(($totalCount - 2) / 3);

$totalPage = $totalPage + $totalCodebtorPages;
$totalPage = $totalPage + 1;
if (empty($part2Debtors)) {
    $totalPage = $totalPage + 1;
}
?>
<section class="page-section official-form-106d padd-20" id="official-form-106d">
    <div class="container pl-2 pr-0">
        <form class="official_frm_106d_first save_official_forms" name="official_frm_106d" id="official_frm_106d" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>

           <!-- use below varibale for PArt D -->
           <?php $partDMain = isset($dynamicPdfData['106d']) && !empty($dynamicPdfData['106d']) ? json_decode($dynamicPdfData['106d'], 1) : null;
?>
            <x-officialForm.bankruptcyCourtListBox
                districtName="Bankruptcy District Information"
                :districtList="$district_names"
                :savedData="$savedData"
                districtCheckboxName="Check if this is an"
            ></x-officialForm.bankruptcyCourtListBox>
            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Schedule D') }}</h4>
                        <!-- <h4>{{ __('Official Form 106D') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Schedule D: Creditors Who Have Claims Secured by
                            Property') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14"><strong>{{ __('Be as complete and accurate as possible. If
                            two
                            married people are filing together, both are equally responsible for
                            supplying correct
                            information. If more space is needed, copy the Additional Page, fill
                            it
                            out, number the entries, and attach it to this form. On the top of
                            any
                            additional pages, write your name and case number (if known).') }}
                            </strong>
                        </p>
                    </div>
                </div>
                <!-- Row 1 -->
                <div class="col-md-12">
                    <div class="input-group d-inline-block">
                        <label for=""> <strong class="d-block">{{ __('1. Do any creditors have claims secured by your
                        property?') }}
                        </strong> </label>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('Group1-106D#0');?>" value="Choice1" type="checkbox"
                            <?php echo isset($partDMain[base64_encode('Group1-106D#0')]) ? Helper::validate_key_toggle(base64_encode('Group1-106D#0'), $partDMain, 'Choice1') : ($loan_own_type_property != true ? 'checked' : '');?>>
                        <label>{{ __('No. Check this box and submit this form to the court with your other schedules. You have nothing else to report on this form.') }}</label>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('Group1-106D#1');?>" value="Choice1" type="checkbox"
                            <?php echo isset($partDMain[base64_encode('Group1-106D#1')]) ? Helper::validate_key_toggle(base64_encode('Group1-106D#1'), $partDMain, 'Choice1') : ($loan_own_type_property == true ? 'checked' : '');?>>
                        <label>{{ __('Yes. Fill in all of the information below.') }}</label>
                    </div>
                </div>
            </div>
            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title">
                        <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('List All Secured Claims') }}
                        </h2>
                    </div>
                </div>
            </div>
            <!-- Row 2 -->
            <?php //$i=1;
          $totalOfPropertValues = array_sum(array_column($creditors, 'debt_amount_due'));
$totalBasedOnDynamic = 0;
$count = count($creditors);
$array1 = array_slice($creditors, 0, 2);
$array2 = array_slice($creditors, 2, $count);
$totalFirstPage = array_sum(array_column($array1, 'debt_amount_due'));
$i = 1;

foreach ($array1 as $creditor) {
    $fieldName = LocalFormHelper::schD($i);

    ?>
            <div class="form-border">
                <div class="row mt-2 pt-0 pl-0 pr-0 column-heading">
                    <?php if ($i == 1) { ?>
                    <div class="col-md-7 pl-0">
                        <div class="input-group pl-3 gray-row d-inline-block">
                            <label class="f10"><strong class="mb-0">{{ __('2. List all secured claims.') }}</strong> {{ __('If a creditor has more than one secured claim, list the creditor separately for each claim. If more than one creditor has a particular claim, list the other creditors in Part 2. As much as possible, list the claims in alphabetical order according to the creditor’s name.') }} </label>
                        </div>
                    </div>
                        <x-officialForm.homeLoan.columnAmountOfClaimBox></x-officialForm.homeLoan.columnAmountOfClaimBox>
                    <?php } ?>
                    <!-- Form Content Started -->
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($fieldName['noBox']); ?>" class="square" readonly  value="2.<?php echo $i;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$i}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDMain"
                            :creditor="$creditor"
                            :nameArray="$fieldName"
                            formType=""
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDMain"
                        :creditor="$creditor"
                        :fieldName="$fieldName"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
            </div>
            <?php
                $i++;
}
?>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_9"
                    :value="$totalFirstPage"
                    :partDMain="$partDMain"
                ></x-officialForm.homeLoan.dollarValueInColumn>

				<input type="hidden" name="<?php echo base64_encode('fill_27.0')?>" value="<?php echo $totalPage; ?>">
                <h3 style="text-align:right;">Page <?php echo $pagefrom; ?> of <?php echo $totalPage; ?> </h3>
            </div>
            <!-- Row 2 -->
            <div class="form-border mt-3">
                <?php //$i=1;
                $pagefrom++;
$array1 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 0, 3) : $array2;
$array2 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 3, count($array2)) : [];
$j = $i;
$i = 1;
$totalSecondPage = array_sum(array_column($array1, 'debt_amount_due'));
$totalAmountuptoSecond = '';
foreach ($array1 as $creditor) {
    $nameArray = LocalFormHelper::partD1($i);
    ?>
                @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArray['noBox']); ?>" class="square" readonly  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$j}}"
                            i="{{$j}}"
                            :partDpart1add1="$partDMain"
                            :creditor="$creditor"
                            :nameArray="$nameArray"
                            formType=""
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDMain"
                        :creditor="$creditor"
                        :fieldName="$nameArray"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
    $i++;
    $j++;
}

?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalSecondPage"
                    :partDMain="$partDMain"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDMain"
                    :arrayData="$array2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php
        //step 1 add 1
        $array1 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 0, 3) : $array2;
//step 1 add 1
$array2 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 3, count($array2)) : [];
if (!empty($array1)) {  ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add1" id="official_frm_106d_step1_add1" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add1"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add1.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part1_add1.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add1 = isset($dynamicPdfData['106d_part1_add1']) && !empty($dynamicPdfData['106d_part1_add1']) ? json_decode($dynamicPdfData['106d_part1_add1'], 1) : null; ?>
  			<div class="form-border mt-3">
                <?php
        $totalThirdPage = array_sum(array_column($array1, 'debt_amount_due'));
    $totalAmountuptoThird = '';
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $indexStep1) {
        $creditor = $array1[$indexStep1] ?? [];
        $nameArrayStep1 = LocalFormHelper::partDStep1($i);
        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayStep1['noBox']); ?>" class="square"  readonly value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$k}}"
                            :partDpart1add1="$partDpart1add1"
                            :creditor="$creditor"
                            :nameArray="$nameArrayStep1"
                            formType=""
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add1"
                        :creditor="$creditor"
                        :fieldName="$nameArrayStep1"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
            $i++;
        $k++;
        $j++;
    }
    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalThirdPage"
                    :partDMain="$partDpart1add1"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add1"
                    :arrayData="$array2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>
        </form>
        <?php } ?>
        <?php
        //step 1 add 2
         $array1 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 0, 3) : $array2;
//step 1 add 2
$array2 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 3, count($array2)) : [];
if (!empty($array1)) {
    ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add2" id="official_frm_106d_step1_add2" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add2"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add2.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part1_add2.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add2 = isset($dynamicPdfData['106d_part1_add2']) && !empty($dynamicPdfData['106d_part1_add2']) ? json_decode($dynamicPdfData['106d_part1_add2'], 1) : null; ?>
  			<div class="form-border mt-3">
                <?php //$i=1;
            $totalFourthPage = array_sum(array_column($array1, 'debt_amount_due'));
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $indexStep2) {
        $creditor = $array1[$indexStep2] ?? [];
        $nameArrayStep2 = LocalFormHelper::partDStep1($i);
        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayStep2['noBox']); ?>" class="square"  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDpart1add2"
                            :creditor="$creditor"
                            :nameArray="$nameArrayStep2"
                            formType="-106D"
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add2"
                        :creditor="$creditor"
                        :fieldName="$nameArrayStep2"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
        $i++;
        $k++;
        $j++;
    }
    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalFourthPage"
                    :partDMain="$partDpart1add2"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add2"
                    :arrayData="$array2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php } ?>

         <?php
        //step 1 add 3
         $array3 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 0, 3) : $array2;
//step 1 add 3
$array3_2 = !empty($array2) && count($array2) > 3 ? array_slice($array2, 3, count($array2)) : [];

if (!empty($array3)) {
    ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add3" id="official_frm_106d_step1_add3" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add3"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add3.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part1_add3.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add3 = isset($dynamicPdfData['106d_part1_add3']) && !empty($dynamicPdfData['106d_part1_add3']) ? json_decode($dynamicPdfData['106d_part1_add3'], 1) : null; ?>

  			<div class="form-border mt-3">
                <?php //$i=1;
               $totalFourthPage = array_sum(array_column($array3, 'debt_amount_due'));
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $indexStep3) {
        $creditor = $array1[$indexStep3] ?? [];
        $nameArrayStep3 = LocalFormHelper::partDStep1($i);

        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayStep3['noBox']); ?>" class="square"  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDpart1add3"
                            :creditor="$creditor"
                            :nameArray="$nameArrayStep3"
                            formType="-106D"
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add3"
                        :creditor="$creditor"
                        :fieldName="$nameArrayStep3"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
        $i++;
        $k++;
        $j++;
    }

    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalFourthPage"
                    :partDMain="$partDpart1add3"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add3"
                    :arrayData="$array3_2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php } ?>

        <?php
             $array4 = !empty($array3_2) && count($array3_2) > 3 ? array_slice($array3_2, 0, 3) : $array3_2;
$array4_2 = !empty($array3_2) && count($array3_2) > 3 ? array_slice($array3_2, 3, count($array3_2)) : [];

if (!empty($array4)) {
    ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add4" id="official_frm_106d_step1_add4" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add4"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add4.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part1_add4.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add4 = isset($dynamicPdfData['106d_part1_add4']) && !empty($dynamicPdfData['106d_part1_add4']) ? json_decode($dynamicPdfData['106d_part1_add4'], 1) : null; ?>

  			<div class="form-border mt-3">
                <?php //$i=1;
          $totalFourthPage = array_sum(array_column($array4, 'debt_amount_due'));
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $index) {
        $creditor = $array1[$index] ?? [];
        $nameArrayPart1Step4 = LocalFormHelper::partDStep1($i);

        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayPart1Step4['noBox']); ?>" class="square"  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDpart1add4"
                            :creditor="$creditor"
                            :nameArray="$nameArrayPart1Step4"
                            formType="-106D"
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add4"
                        :creditor="$creditor"
                        :fieldName="$nameArrayPart1Step4"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
        $i++;
        $k++;
        $j++;
    }

    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalFourthPage"
                    :partDMain="$partDpart1add4"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add4"
                    :arrayData="$array4_2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php } ?>

        <?php
             $array5 = !empty($array4_2) && count($array4_2) > 3 ? array_slice($array4_2, 0, 3) : $array4_2;
$array5_2 = !empty($array4_2) && count($array4_2) > 3 ? array_slice($array4_2, 3, count($array4_2)) : [];

if (!empty($array5)) {
    ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add5" id="official_frm_106d_step1_add5" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add5"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add5.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part5_add1.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add5 = isset($dynamicPdfData['106d_part1_add5']) && !empty($dynamicPdfData['106d_part1_add5']) ? json_decode($dynamicPdfData['106d_part1_add5'], 1) : null; ?>

  			<div class="form-border mt-3">
                <?php //$i=1;
           $totalFourthPage = array_sum(array_column($array5, 'debt_amount_due'));
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $index) {
        $creditor = $array5[$index] ?? [];
        $nameArrayStep5 = LocalFormHelper::partDStep1($i);
        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayStep5['noBox']); ?>" class="square"  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDpart1add5"
                            :creditor="$creditor"
                            :nameArray="$nameArrayStep5"
                            formType="-106D"
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add5"
                        :creditor="$creditor"
                        :fieldName="$nameArrayStep5"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
            $i++;
        $k++;
        $j++;
    }

    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalFourthPage"
                    :partDMain="$partDpart1add5"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add5"
                    :arrayData="$array5_2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php } ?>
        <?php
         $array6 = !empty($array5_2) && count($array5_2) > 3 ? array_slice($array5_2, 0, 3) : $array5_2;
$array6_2 = !empty($array5_2) && count($array5_2) > 3 ? array_slice($array5_2, 3, count($array5_2)) : [];

if (!empty($array6)) {
    ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add6" id="official_frm_106d_step1_add6" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add6"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add6.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part1_add6.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add6 = isset($dynamicPdfData['106d_part1_add6']) && !empty($dynamicPdfData['106d_part1_add6']) ? json_decode($dynamicPdfData['106d_part1_add6'], 1) : null; ?>

  			<div class="form-border mt-3">
                <?php //$i=1;
           $totalFourthPage = array_sum(array_column($array6, 'debt_amount_due'));
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $indexStep6) {
        $creditor = $array6[$indexStep6] ?? [];
        $nameArrayStep6 = LocalFormHelper::partDStep1($i);
        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayStep6['noBox']); ?>" class="square"  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDpart1add6"
                            :creditor="$creditor"
                            :nameArray="$nameArrayStep6"
                            formType="-106D"
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add6"
                        :creditor="$creditor"
                        :fieldName="$nameArrayStep6"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
        $i++;
        $k++;
        $j++;
    }

    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalFourthPage"
                    :partDMain="$partDpart1add6"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add6"
                    :arrayData="$array6_2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php } ?>

        <?php
         $array7 = !empty($array6_2) && count($array6_2) > 3 ? array_slice($array6_2, 0, 3) : $array6_2;
$array7_2 = !empty($array6_2) && count($array6_2) > 3 ? array_slice($array6_2, 3, count($array6_2)) : [];

if (!empty($array7)) {
    ?>
		<form class="official_frm_106d save_official_forms" name="official_frm_106d_step1_add7" id="official_frm_106d_step1_add7" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <x-officialForm.homeLoan.hiddenInputs
                formId="106d_part1_add7"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part1_add7.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part1_add7.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
            ></x-officialForm.homeLoan.hiddenInputs>
            <!-- use below varibale for PArt D -->
            <?php $partDpart1add7 = isset($dynamicPdfData['106d_part1_add7']) && !empty($dynamicPdfData['106d_part1_add7']) ? json_decode($dynamicPdfData['106d_part1_add7'], 1) : null; ?>

  			<div class="form-border mt-3">
                <?php //$i=1;
              $totalFourthPage = array_sum(array_column($array7, 'debt_amount_due'));
    $i = 1;
    $k = 3;
    foreach ([0,1,2] as $indexStep7) {
        $creditor = $array7[$indexStep7] ?? [];
        $nameArrayStep7 = LocalFormHelper::partDStep1($i);
        ?>
               @include("attorney.official_form.homeloan_common",['i'=>$i])
                <!-- Form Content Started -->
                <div class="row">
                    <div class="col-md-7">
                        <input name="<?php echo base64_encode($nameArrayStep7['noBox']); ?>" class="square"  value="2.<?php echo $j;?>">
                        <x-officialForm.homeLoan.creditorsAddressBox
                            k="{{$k}}"
                            i="{{$i}}"
                            :partDpart1add1="$partDpart1add7"
                            :creditor="$creditor"
                            :nameArray="$nameArrayStep7"
                            formType="-106D"
                        ></x-officialForm.homeLoan.creditorsAddressBox>
                    </div>
                    <x-officialForm.homeLoan.creditorStep1RightBox
                        :partDMain="$partDpart1add7"
                        :creditor="$creditor"
                        :fieldName="$nameArrayStep7"
                    ></x-officialForm.homeLoan.creditorStep1RightBox>
                </div>
                <?php
        $i++;
        $k++;
        $j++;
    }
    ?>
            </div>
            <div class="form-border">
                <x-officialForm.homeLoan.dollarValueInColumn
                    name="undefined_23"
                    :value="$totalFourthPage"
                    :partDMain="$partDpart1add7"
                ></x-officialForm.homeLoan.dollarValueInColumn>
                <?php $pagefrom++; ?>
                <x-officialForm.homeLoan.dollarValueInColumnLast
                    name="undefined_24"
                    :value="$totalOfPropertValues"
                    :partDMain="$partDpart1add7"
                    :arrayData="$array7_2"
                    :pagefrom="$pagefrom"
                    :totalPage="$totalPage"
                ></x-officialForm.homeLoan.dollarValueInColumnLast>
            </div>

        </form>
        <?php } ?>
    <!-- use below varibale for PArt D -->
        <?php
        $partDpart2add1 = !empty($dynamicPdfData['106d_part2_add1']) ? json_decode($dynamicPdfData['106d_part2_add1'], 1) : null;
$count = count($part2Debtors);
$codebtor1List = array_slice($part2Debtors, 0, 6);
$codebtor2List = array_slice($part2Debtors, 6, $count);
?>
        <?php $pagefrom++; ?>
       
        <x-officialForm.homeLoan.part2Form
            formId="106d_part2_add1"
            formName="official_frm_106d_step2_add1"
            clientId="{{$client_id}}"
            sourcePDFName="{{ 'form_b106d_part2_add1.pdf' }}"
            clientPDFName="{{ $client_id.'_b106d_part2_add1.pdf' }}"
            caseNumber="{{ $caseno }}"
            debtor1="{{ $onlyDebtor }}"
            debtor2="{{ $spousename }}"
            :i="$i"
            :partDpart2add="$partDpart2add1"
            :codebtor1List="$codebtor1List"
            :pagefrom="$pagefrom"
            :totalPage="$totalPage"
        ></x-officialForm.homeLoan.part2Form>
        <?php
$codebtor1List2 = !empty($codebtor2List) && count($codebtor2List) > 6 ? array_slice($codebtor2List, 0, 6) : $codebtor2List;
$codebtor2List2 = !empty($codebtor2List) && count($codebtor2List) > 6 ? array_slice($codebtor2List, 6, count($codebtor2List)) : [];
if (!empty($codebtor1List2)) {
    $partDpart2add2 = isset($dynamicPdfData['106d_part2_add2']) && !empty($dynamicPdfData['106d_part2_add2']) ? json_decode($dynamicPdfData['106d_part2_add2'], 1) : null; ?>
            <?php $pagefrom++; ?>
            <x-officialForm.homeLoan.part2Form
                formId="106d_part2_add2"
                formName="official_frm_106d_step2_add2"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part2_add2.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part2_add2.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
                :i="$i"
                :partDpart2add="$partDpart2add2"
                :codebtor1List="$codebtor1List2"
                :pagefrom="$pagefrom"
                :totalPage="$totalPage"
            ></x-officialForm.homeLoan.part2Form>
        <?php } ?>
        <?php
    $codebtor1List3 = !empty($codebtor2List2) && count($codebtor2List2) > 6 ? array_slice($codebtor2List2, 0, 6) : $codebtor2List2;
$codebtor2List3 = !empty($codebtor2List2) && count($codebtor2List2) > 6 ? array_slice($codebtor2List2, 6, count($codebtor2List2)) : [];
if (!empty($codebtor1List3)) {
    ?>
        <?php $partDpart2add3 = isset($dynamicPdfData['106d_part2_add3']) && !empty($dynamicPdfData['106d_part2_add3']) ? json_decode($dynamicPdfData['106d_part2_add3'], 1) : null; ?>
        <x-officialForm.homeLoan.part2Form
                formId="106d_part2_add3"
                formName="official_frm_106d_step2_add3"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part2_add3.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part2_add3.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
                :i="$i"
                :partDpart2add="$partDpart2add3"
                :codebtor1List="$codebtor1List3"
                :pagefrom="$pagefrom"
                :totalPage="$totalPage"
            ></x-officialForm.homeLoan.part2Form>
		<?php } ?>
        <?php
         $codebtor1List4 = !empty($codebtor2List3) && count($codebtor2List3) > 6 ? array_slice($codebtor2List3, 0, 6) : $codebtor2List3;
$codebtor2List4 = !empty($codebtor2List3) && count($codebtor2List3) > 6 ? array_slice($codebtor2List3, 6, count($codebtor2List3)) : [];
if (!empty($codebtor1List4)) {
    ?>
            <?php $partDpart2add4 = isset($dynamicPdfData['106d_part2_add4']) && !empty($dynamicPdfData['106d_part2_add4']) ? json_decode($dynamicPdfData['106d_part2_add4'], 1) : null; ?>

            <x-officialForm.homeLoan.part2Form
                formId="106d_part2_add4"
                formName="official_frm_106d_step2_add4"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part2_add4.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part2_add4.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
                :i="$i"
                :partDpart2add="$partDpart2add4"
                :codebtor1List="$codebtor1List4"
                :pagefrom="$pagefrom"
                :totalPage="$totalPage"
            ></x-officialForm.homeLoan.part2Form>
        <?php } ?>

        <?php
    $codebtor1List5 = !empty($codebtor2List4) && count($codebtor2List4) > 6 ? array_slice($codebtor2List4, 0, 6) : $codebtor2List4;
$codebtor2List5 = !empty($codebtor2List4) && count($codebtor2List4) > 6 ? array_slice($codebtor2List4, 6, count($codebtor2List4)) : [];
if (!empty($codebtor1List5)) {
    ?>
            <?php $partDpart2add5 = isset($dynamicPdfData['106d_part2_add5']) && !empty($dynamicPdfData['106d_part2_add5']) ? json_decode($dynamicPdfData['106d_part2_add5'], 1) : null; ?>
            <x-officialForm.homeLoan.part2Form
                formId="106d_part2_add5"
                formName="official_frm_106d_step2_add5"
                clientId="{{$client_id}}"
                sourcePDFName="{{ 'form_b106d_part2_add5.pdf' }}"
                clientPDFName="{{ $client_id.'_b106d_part2_add5.pdf' }}"
                caseNumber="{{ $caseno }}"
                debtor1="{{ $onlyDebtor }}"
                debtor2="{{ $spousename }}"
                :i="$i"
                :partDpart2add="$partDpart2add5"
                :codebtor1List="$codebtor1List5"
                :pagefrom="$pagefrom"
                :totalPage="$totalPage"
            ></x-officialForm.homeLoan.part2Form>
		<?php } ?>

        <div class="row align-items-center avoid-this" style="margin-left:1px;">
            <div class="form-title mb-9" style="margin-top:15px;">
            <button type="submit" onclick="submitSchDForm()" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2 print-hide">
                <span class="card-title-text">{{ __('Generate Schedule D (Secured Debts) PDF') }}</span>
            </button>
            </div>
            <div class="form-title mb-9" style="margin-top:15px;">
                <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-106d')" href="javascript:void(0)">
                    <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
                        <span class="card-title-text">{{ __('print')}}</span>
                    </button>
                </a>
            </div>
        </div>
    </div>

</section>
<script>
    sumColA_AmountClaims();
        sumTotalAmountClaims();
    function sumColA_AmountClaims()
    {
        var totalAmount = 0;
        $('.colAmountOfClaims').each(function(i, obj) {
            totalAmount += parseFloat($(this).val());
    });

        $('#undefined_9').val(totalAmount);

    }


    $('.colAmountOfClaims').blur(function (){
        sumColA_AmountClaims();
        sumTotalAmountClaims();
    });

    function sumTotalAmountClaims()
    {
        var totalAmount = 0;
        $('.undefined_9').each(function(i, obj) {
            //test
            totalAmount += parseFloat($(this).val());
        });

        $('#d_Amount_of_claim').val( totalAmount );
    }
    sumColA_AmountClaims();
    sumTotalAmountClaims();
    $('.undefined_9').blur(function (){
        sumTotalAmountClaims();
    });
</script>
