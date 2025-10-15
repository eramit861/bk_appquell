<section class="page-section official-form-108 padd-20" id="official-form-108">
<form name="official_frm_108" id="official_frm_108" class="official_108_form_first save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="form_id" value="108">
                    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b108.pdf'; ?>">
                    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b108.pdf'; ?>">
                    <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
                    <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
                    <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
               
                    <div class="container pl-2 pr-0">
                        <div class="row">
                            <div class="108frm col-md-7">
                                <div class="108frm section-box">
                                    <div class="108frm section-header bg-back text-white">
                                        <p class="108frm font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                                    </div>
                                    <div class="108frm section-body padd-20">
                                        <div class="row">

                                            <div class="108frm col-md-12">
                                                <div class="input-group">
                                                    <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                                    <select name="<?php echo base64_encode('Bankruptcy District Information');?>" class="form-control district-select" id="district_name"> @foreach ($district_names as $district_name)
                                                            <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="108frm form-control">{{$district_name->district_name}}</option> @endforeach </select>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="108frm col-md-5">
								<div class="108frm amended">
									<input type="checkbox" name="<?php echo base64_encode('Check if this is an');?>">
									<label>{{ __('Check if this is an amended filing') }}</label>
									</div>
								</div>
                        </div>

                        <div class="row 108frm padd-20">
                            <div class="col-md-12 mb-3">
                                <div class="108frm form-title">
                                    <h4>{{ __('Statement of Intentions') }} </h4>
                                    <!-- <h4>{{ __('Official Form 108') }} </h4> -->
                                    <h2 class="font-lg-22">{{ __('Statement of Intention for Individuals Filing Under
                                        Chapter 7') }}
                                    </h2> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-subheading">
                                    <div class="input-group"> <strong>
                                            {{ __('If you are an individual filing under chapter 7, you must fill out
                                            this
                                            form if:') }}
                                            <ul>
                                                <li>{{ __('creditors have claims secured by your property, or') }}</li>
                                                <li>{{ __('you have leased personal property and the lease has not
                                                    expired.') }}
                                                </li>
                                            </ul>
                                            {{ __('You must file this form with the court within 30 days after you file
                                            your bankruptcy petition or by the date set for the meeting of
                                            creditors,
                                            whichever is earlier, unless the court extends the time for cause.
                                            You
                                            must also send copies to the creditors and lessors you list on the
                                            form.') }}<br>
                                            {{ __('If two married people are filing together in a joint case, both are
                                            equally responsible for supplying correct information.') }}
                                            <br>
                                            Both debtors must sign and date the form.
                                            <br>
                                            {{ __('Be as complete and accurate as possible. If more space is needed,
                                            attach
                                            a separate sheet to this form. On the top of any additional pages,
                                            write your name and case number (if known)') }}
                                        </strong> </div>
                                </div>
                            </div>
                        </div>
                        <!-- Part 1 -->
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                                    <h2 class="font-lg-18">{{ __('List Your Creditors Who Have Secured Claims') }}</h2> </div>
                            </div>
                        </div>
                        <!-- Row 1 -->
                        <div class="form-border mb-3">
                            <!-- First Row Heading -->
                            <div class="row  mt-3">
                                <div class="col-md-4">
                                    <div class="column-heading">
                                        <h4>{{ __('Identify the creditor and the property that is collateral') }} </h4> </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="column-heading">
                                        <h4>{{ __('What do you intend to do with the property that
                                            secures a debt?') }}</h4> </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="column-heading">
                                        <h4>{{ __('Did you claim the property
                                            as exempt on Schedule C?') }}</h4> </div>
                                </div>
                            </div>
                            <!-- Second Row Body -->

                         
<?php

$count = count($statementIntent);

                    $page1Taxes = array_slice($statementIntent, 0, 4);

                    $page2Taxes = array_slice($statementIntent, 4, $count);

                    $codebtorGroup = array_chunk($page2Taxes, 9);
                    $totalCountPages = count($codebtorGroup);
                    $totalCountPages = $totalCountPages + 2;
                    $j = 1;
                    $ind = 0;
                    foreach ($page1Taxes as $prop) {

                        $fieldNamesArray = LocalFormHelper::stmtIntNames();
                        $fieldNames = isset($fieldNamesArray[$ind]) ? $fieldNamesArray[$ind] : $fieldNamesArray[0];
                        ?>

                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <label>{{ __('Creditor’s name:') }}</label>
                                            <input  name="<?php echo base64_encode($fieldNames['name']); ?>" type="text" value="<?php echo Helper::validate_key_value('creditor_name', $prop); ?>" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of property securing debt') }}</label>
                                            <textarea name="<?php echo base64_encode($fieldNames['desc']); ?>" id="" cols="20" rows="5" class="form-control"><?php echo Helper::validate_key_value('describe_secure_claim', $prop); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="frm108 col-md-4">
                                        <div class="frm108 input-group">
                                            <input name="<?php echo base64_encode($fieldNames['check1']); ?>" <?php echo Helper::validate_key_toggle('retain_above_property', $prop, 0) ?> value="surrender" type="checkbox">
                                            <label>{{ __('Surrender the property') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($fieldNames['check1']); ?>" value="retain and redeem" type="checkbox" <?php echo Helper::validate_key_toggle('retain_above_property', $prop, 1) ?> >
                                            <label>{{ __('Retain the property and redeem it.') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($fieldNames['check1']); ?>" value="retain and reaffirmation"  type="checkbox">
                                            <label>{{ __('Retain the property and enter into a Reaffirmation Agreement.') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($fieldNames['check1']); ?>" value="retain and explain"  type="checkbox">
                                            <label>{{ __('Retain the property and [explain]:') }}</label>
                                            <input name="<?php echo base64_encode($fieldNames['check4Explain']); ?>" type="text" value="" class="form-control"> </div>
                                    </div>
                                    <div class="frm108 col-md-4">
                                        <div class="frm108 input-group">
                                            <input name="<?php echo base64_encode($fieldNames['check2']); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($fieldNames['check2']); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $j++;
                        $ind++;
                    } ?>
                            <input type="hidden" name="<?php echo base64_encode('Text1')?>" value="1">
							<input type="hidden" name="<?php echo base64_encode('Text2')?>" value="{{$totalCountPages}}">
                            <h3 style="text-align:right;">Page 1 of {{$totalCountPages}} </h3>		

                        </div>
                </div>     
                </form>
           	
<?php
$codeCount = $j;
                    $borderClass = '';
                    $itretion = 1;
                    foreach ($codebtorGroup as $listCodebtor) {
                        if (!empty($listCodebtor)) {
                            if ($codeCount != $j) {
                                $codeCount = $codeCount + 8;
                            }

                            ?>
 @include("attorney.official_form.default.sch_108_additional",['intdebtors' => $listCodebtor,'index' => $codeCount,'part' => $itretion,'totalpages' => ($totalCountPages),'pageno' => ($itretion+1)])
	<?php $itretion++;
                            $codeCount++;
                        }
                    } ?>
                <form name="official_frm_108_last" id="official_frm_108_last" class="official_108_form save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="form_id" value="108_last">
                    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b108_last.pdf'; ?>">
                    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b108_last.pdf'; ?>">
                    <input type="hidden" class="108frm" name="<?php echo base64_encode('Case number0-108'); ?>" value="<?php echo $caseno; ?>">
                    <input type="hidden" class="108frm" name="<?php echo base64_encode('Debtor 1-108'); ?>" value="<?php echo $onlyDebtor; ?>">
                    <input type="hidden" class="108frm" name="<?php echo base64_encode('Debtor 2-108'); ?>" value="<?php echo $spousename; ?>">
                    <div class="container">
                        <!-- Part 2 -->
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                                    <h2 class="font-lg-18">{{ __('List Your Unexpired Personal Property Leases') }}</h2> </div>
                            </div>
                        </div>
                        <!-- Row 2 -->
                        <div class="form-border mb-3">
                            <!-- First Row Heading -->
                            <div class="row  mt-3">
                                <div class="col-md-12">
                                    <div class="input-group mb-3"> <strong>{{ __('For any unexpired personal property lease that you listed in
                                            Schedule G: Executory Contracts and Unexpired Leases (Official Form
                                            106G),
                                            fill in the information below. Do not list real estate leases.
                                            Unexpired
                                            leases are leases that are still in effect; the lease period has not
                                            yet
                                            ended. You may assume an unexpired personal property lease if the
                                            trustee does not assume it. 11 U.S.C. § 365(p)(2).') }}</strong> </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="column-heading">
                                        <h4>{{ __('Describe your unexpired personal property leases') }} </h4> </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="column-heading">
                                        <h4>{{ __('What do you intend to do with the property that
                                            secures a debt?') }}</h4> </div>
                                </div>
                            </div>
                            <!-- Second Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input  name="<?php echo base64_encode('Lessors Name 2a'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2a'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2a'); ?>" value="no"  type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2a'); ?>" value="yes"  type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Third Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input name="<?php echo base64_encode('Lessors Name 2b'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2b'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2b'); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2b'); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fourth Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input name="<?php echo base64_encode('Lessors Name 2c'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2c'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2c'); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2c'); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fifth Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input name="<?php echo base64_encode('Lessors Name 2d'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2d'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2d'); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2d'); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sixth Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input name="<?php echo base64_encode('Lessors Name 2e'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2e'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2e'); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2e'); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-- Seventh Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input name="<?php echo base64_encode('Lessors Name 2f'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2f'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2f'); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2f'); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-- Eighteth Row Body -->
                            <div class="col-md-12 border-bottm-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <label>{{ __('Lessor’s name:') }}</label>
                                            <input name="<?php echo base64_encode('Lessors Name 2g'); ?>" type="text" value="" class="form-control"> </div>
                                        <div class="input-group">
                                            <label>{{ __('Description of leased property:') }} </label>
                                            <textarea name="<?php echo base64_encode('PropertyDescription 2g'); ?>" id="" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2g'); ?>" value="no" type="checkbox">
                                            <label>{{ __('No') }}</label>
                                        </div>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('check2g'); ?>" value="yes" type="checkbox">
                                            <label>{{ __('Yes') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Part 2 -->
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
                                    <h2 class="font-lg-18">{{ __('Sign Below') }}</h2> </div>
                            </div>
                        </div>
                        <!-- Row 2 -->
                        <div class="form-border mb-3">
                            <!-- First Row Heading -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3"> <strong>{{ __('Under penalty of perjury, I declare that I have indicated my
                                            intention about any property of my estate that secures a debt and
                                            any
                                            personal property that is subject to an unexpired lease') }}</strong> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group signature-field">
                                        <p>{{ __('Signature of Debtor 1') }}</p> 
                                        <span> <input name="<?php echo base64_encode('Signature of Debtor 1'); ?>"  type="text" value="{{$debtor_sign}}" class="form-control"></span>
                                    </div>
                                    <div class="input-group signature-field">
                                        <label for="">{{ __('Executed on') }}</label>
                                        <input  name="<?php echo base64_encode('Date signed Debtor 1'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"> </div>
                                </div>
                                <div class="108frm col-md-6">
                                    <div class="108frm input-group signature-field">
                                        <p>{{ __('Signature of Debtor 2') }}</p> 
                                        <span> <input name="<?php echo base64_encode('Signature of Debtor 2'); ?>"  type="text" value="{{$debtor2_sign}}" class="108frm form-control"></span>
                                        <div class="108frm input-group signature-field">
                                            <label for="">{{ __('Executed on') }}</label>
                                            <input name="<?php echo base64_encode('Date signed Debtor 2'); ?>" value="{{$currentDate}}" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed 108frm form-control"> </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="<?php echo base64_encode('Text1')?>" value="{{$itretion+1}}">
                        <input type="hidden" name="<?php echo base64_encode('Text2')?>" value="{{$totalCountPages}}">
                        <h3 style="text-align:right;">Page {{$itretion+1}} of {{$totalCountPages}} </h3>
                        </div>
                       	
                    </div>
                       
                </form>
                <div class="row padd-20 align-items-center avoid-this" style="margin-left:1px;">
                    <div class="form-title mb-9">
                        <button type="submit" onclick="generateIndividualPDF('official_108_form_first','official_108_form')" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2 print-hide">
                            <span class="card-title-text">{{ __('Generate Statement of Intentions PDF') }}</span>
                        </button>
                    </div>
                    <div class="form-title mb-9" >
                    <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-108')" href="javascript:void(0)">
                        <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
                            <span class="card-title-text">{{ __('print')}}</span>
                        </button>
                    </a>
                </div>
                </div>
                </section>
					
                    
				