<form name="official_frm_121" id="official_frm_106g"  class="save_official_forms"   action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="106g">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106g.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106g.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('Case number#0-106G'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1#0-106G'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2-106G'); ?>" value="<?php echo $spousename; ?>">

    <section class="page-section official-form-106g padd-20" id="official-form-106g">
        <div class="container pl-2 pr-0">
            <div class="frm106g row">
                <div class="frm106g col-md-7">
                    <div class="frm106g section-box">
                        <div class="frm106g section-header bg-back text-white">
                            <p class="frm106g font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                        </div>
                        <div class="frm106g section-body padd-20">
                            <div class="row">
                            <div class="frm106g col-md-12">
                                    <div class="frm106g input-group">
                                        <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                        <select name="<?php echo base64_encode('Bankruptcy District Information-106G'); ?>" class="form-control frm106g district-select" id="district_name"> 
                                            @foreach ($district_names as $district_name)
                                            <option
                                                <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?>
                                                value="{{$district_name->district_name}}" class="form-control">
                                                {{$district_name->district_name}}
                                            </option> 
                                            @endforeach
                                        </select>

                                    </div></div>
                            </div></div>
                    </div>
                </div>

                <div class="col-md-5 106gfrm1">
                    <div class="frm106g amended">
                        <input type="checkbox" name="<?php echo base64_encode('Check if this is an-106G');?>">
                        <label>{{ __('Check if this is an amended filing') }}</label>
                    </div>
                </div>
            </div>

            <div class="row frm106g padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Schedule G') }}</h4>
                        <!-- <h4>{{ __('Official Form 106G') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Schedule G: Executory Contracts and Unexpired Leases') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14"><strong>{{ __('Be as complete and accurate as possible. If
                                two
                                married people are filing together, both are equally responsible for
                                supplying correct
                                information. If more space is needed, copy the additional page, fill
                                it
                                out, number the entries, and attach it to this page. On the top of
                                any
                                additional pages, write your name and case number (if known)') }}
                            </strong></p>
                    </div>
                </div>
            </div>
            <!-- Row 1 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-inline-block">
                        <label for=""> <strong class="d-block">{{ __('1. Do you have any executory contracts or
                                unexpired
                                leases?') }}
                            </strong> </label>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('check1#1-106G');?>" value="no" type="radio">
                        <label>{{ __('No. Check this box and file this form with the court with your other schedules. You have
                            nothing else to report on this form') }}</label>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('check1#1-106G');?>" value="yes" type="radio">
                        <label>{{ __('Yes. Fill in all of the information below even if the contracts or leases are listed on
                            Schedule A/B: Property (Official Form 106A/B)') }}</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group d-inline-block">
                        <label for=""> <strong class="d-block">{{ __('2. List separately each person or company with
                                whom
                                you have the contract or lease. Then state what each contract or
                                lease
                                is for (for
                                example, rent, vehicle lease, cell phone).') }}
                            </strong> {{ __('See the instructions for this form in the instruction booklet for more examples of
                            executory contracts and unexpired leases.') }} </label>
                    </div>
                </div>
            </div>
            <div class="form-border">
                <div class="row column-heading 106gfrm">
                    <div class="col-md-6">
                        <div class="input-group 106gfrm">
                            <label><strong class="mb-0">{{ __('Person or company with whom you have the
                                    contract or
                                    lease') }}</strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group ">
                            <label><strong class="mb-0">{{ __('State what the contract or lease is
                                    for') }}</strong>
                            </label>
                        </div>
                    </div>

                </div>
                <!-- Row 2.1 -->
                <div class="row border-bottm-1">
                    <div class="col-md-7"><strong>2.1</strong></div>
                    <div class="col-md-6">

                        <div class="row 106gfrm">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label>{{ __("Priority Creditor’s Name") }} </label>
                                    <input name="<?php echo base64_encode('Company Name 2.1-106G');?>" type="text"
                                        value="" class="form-control">
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <label>{{ __('Street') }}</label>
                                            <input name="<?php echo base64_encode('Street 2.1-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row 106gfrm1">
                                    <div class="col-md-6 106gfrm1">
                                        <div class="input-group 106gfrm1">
                                            <label>{{ __('City') }}</label>
                                            <input name="<?php echo base64_encode('City 2.1-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label>{{ __('State') }}</label>
                                            <input name="<?php echo base64_encode('State 2.1-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <label>{{ __('Zip Code') }}</label>
                                            <input name="<?php echo base64_encode('Zip 2.1-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 106gfrm4">
                        <div class="input-group mt-4">
                            <textarea name="<?php echo base64_encode('Contact Info 2.1-106G');?>" class="form-control"
                                cols="15" rows="8"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Row 2.2 -->
                <div class="row border-bottm-1">
                    <div class="col-md-7"><strong>2.2</strong></div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12 106gfrm3">
                                <div class="input-group">
                                    <label>{{ __("Priority Creditor’s Name") }} </label>
                                    <input name="<?php echo base64_encode('Company Name 2.2-106G');?>" type="text"
                                        value="" class="form-control">
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <label>{{ __('Street') }}</label>
                                            <input name="<?php echo base64_encode('Street 2.2-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row 106gfrm3">
                                    <div class="col-md-6 106gfrm3">
                                        <div class="input-group 106gfrm3">
                                            <label>{{ __('City') }}</label>
                                            <input name="<?php echo base64_encode('City 2.2-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 106gfrm">
                                        <div class="input-group 106gfrm">
                                            <label>{{ __('State') }}</label>
                                            <input name="<?php echo base64_encode('State 2.2-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 106gfrm">
                                        <div class="input-group 106gfrm">
                                            <label>{{ __('Zip Code') }}</label>
                                            <input name="<?php echo base64_encode('Zip 2.2-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 106gfrm">
                        <div class="input-group mt-4 106gfrm">
                            <textarea name="<?php echo base64_encode('Contact Info 2.2-106G');?>" class="form-control"
                                cols="15" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Row 2.3 -->
                <div class="row border-bottm-1">
                    <div class="col-md-7"><strong>2.3</strong></div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12 106gfrm">
                                <div class="input-group 106gfrm">
                                    <label>{{ __("Priority Creditor’s Name") }} </label>
                                    <input name="<?php echo base64_encode('Company Name 2.3-106G');?>" type="text"
                                        value="" class="106gfrm form-control">
                                </div>
                                <div class="row">

                                    <div class="col-md-12 106gfrm">
                                        <div class="input-group">
                                            <label>{{ __('Street') }}</label>
                                            <input name="<?php echo base64_encode('Street 2.3-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row 106gfrm2">
                                    <div class="col-md-6 106gfrm2">
                                        <div class="input-group 106gfrm2">
                                            <label>{{ __('City') }}</label>
                                            <input name="<?php echo base64_encode('City 2.3-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label>{{ __('State') }}</label>
                                            <input name="<?php echo base64_encode('State 2.3-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 106gfrm">
                                        <div class="input-group">
                                            <label>{{ __('Zip Code') }}</label>
                                            <input name="<?php echo base64_encode('Zip 2.3-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 106gfrm1">
                        <div class="input-group mt-4">
                            <textarea name="<?php echo base64_encode('Contact Info 2.3-106G');?>" class="form-control"
                                cols="15" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Row 2.4 -->
                <div class="row border-bottm-1">
                    <div class="col-md-7"><strong>2.4</strong></div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12 106gfrm">
                                <div class="input-group">
                                    <label>{{ __("Priority Creditor’s Name") }} </label>
                                    <input name="<?php echo base64_encode('Company Name 2.4-106G');?>" type="text"
                                        value="" class="106gfrm form-control">
                                </div>
                                <div class="row">

                                    <div class="col-md-12 106gfrm">
                                        <div class="input-group">
                                            <label>{{ __('Street') }}</label>
                                            <input name="<?php echo base64_encode('Street 2.4-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row 106gfrm4">
                                    <div class="col-md-6 106gfrm4">
                                        <div class="input-group 106gfrm4">
                                            <label>{{ __('City') }}</label>
                                            <input name="<?php echo base64_encode('City 2.4-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label>{{ __('State') }}</label>
                                            <input name="<?php echo base64_encode('State 2.4-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 106gfrm">
                                        <div class="input-group">
                                            <label>{{ __('Zip Code') }}</label>
                                            <input name="<?php echo base64_encode('Zip 2.4-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 106gfrm2">
                        <div class="input-group mt-4">
                            <textarea name="<?php echo base64_encode('Contact Info 2.4-106G');?>" class="form-control"
                                cols="15" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Row 2.5 -->
                <div class="row ">
                    <div class="col-md-7"><strong>2.5</strong></div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group 106gfr5">
                                    <label>{{ __("Priority Creditor’s Name") }} </label>
                                    <input name="<?php echo base64_encode('Company Name 2.5-106G');?>" type="text"
                                        value="" class="form-control">
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <label>{{ __('Street') }}</label>
                                            <input name="<?php echo base64_encode('Street 2.5-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row 106gfrm5">
                                    <div class="col-md-6 106gfrm5">
                                        <div class="input-group 106gfrm5">
                                            <label>{{ __('City') }}</label>
                                            <input name="<?php echo base64_encode('City 2.5-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label>{{ __('State') }}</label>
                                            <input name="<?php echo base64_encode('State 2.5-10G6');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <label>{{ __('Zip Code') }}</label>
                                            <input name="<?php echo base64_encode('Zip 2.5-106G');?>" type="text"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 106gfrm3">
                        <div class="input-group mt-4">
                            <textarea name="<?php echo base64_encode('Contact Info 2.5-106G');?>" class="form-control"
                                cols="15" rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Additional Page if You Have More Contracts or Leases -->
            <div class="row">
                <div class="col-md-12 my-3">
                    <h4>{{ __('Additional Page if You Have More Contracts or Leases') }}</h4>
                </div>
            </div>
            <div class="form-border">
                <div class="row column-heading">
                    <div class="col-md-6">
                        <div class="input-group ">
                            <label><strong class="mb-0">{{ __('Person or company with whom you have the
                                    contract or
                                    lease') }}</strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 106gfrm">
                        <div class="input-group 106gfrm">
                            <label><strong class="mb-0 106gfrm">{{ __('State what the contract or lease is
                                    for') }}</strong>
                            </label>
                        </div>
                    </div>

                </div>
                <?php for ($i = 6;$i <= 13;$i++) {
                    $borderClass = '';
                    if ($i < 13) {
                        $borderClass = 'border-bottm-1';
                    }
                    ?>
                <!-- Row 2.1 -->
                <div class="row <?php echo $borderClass;?>>">
                    <div class="col-md-7"><strong>2.</strong></div>
                    <div class="col-md-6">

                        <div class="106gfrm row">
                            <div class="106gfrm col-md-12">
                                <div class="input-group 106gfrm">
                                    <label>{{ __("Priority Creditor’s Name") }} </label>
                                    <input name="<?php echo base64_encode('Company Name 2.'.$i.'-106G');?>" type="text"
                                        value="" class="form-control 106gfrm">
                                </div>
                                <div class="row 106gfrm">

                                    <div class="col-md-12 106gfrm">
                                        <div class="input-group 106gfrm">
                                            <label>{{ __('Street') }}</label>
                                            <input name="<?php echo base64_encode('Street 2.'.$i.'-106G');?>"
                                                type="text" value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row 106gfrm6">
                                    <div class="col-md-6 106gfrm6">
                                        <div class="input-group 106gfrm6">
                                            <label>{{ __('City') }}</label>
                                            <input name="<?php echo base64_encode('City 2.'.$i.'-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 106gfrm">
                                        <div class="input-group 106gfrm">
                                            <label>{{ __('State') }}</label>
                                            <input name="<?php echo base64_encode('State 2.'.$i.'-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 106gfrm">
                                        <div class="106gfrm input-group">
                                                <label>{{ __('Zip Code') }}</label>
                                            <input name="<?php echo base64_encode('Zip 2.'.$i.'-106G');?>" type="text"
                                                value="" class="106gfrm form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                     <!-- start description box-->
                    <div class="col-md-6">
                        <div class="input-group mt-4">
                            <textarea name="<?php echo base64_encode('Contact Info 2.'.$i.'-106G');?>"
                                class="form-control" cols="15" rows="8"></textarea>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <!-- start pdf button-->
            <x-officialForm.generatePdfButton title="Generate Schedule G Contracts/Leases PDF" divtitle="coles_official-form-106g">
            </x-officialForm.generatePdfButton>
        </div>
    </section>
</form>