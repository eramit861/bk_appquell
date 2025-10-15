<form name="official_frm_103b" class="save_official_forms"id="official_frm_103b" action="{{route('generate_official_pdf')}}" method="post">
        @csrf
        <input type="hidden" name="form_id" value="103b">
        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
        <input type="hidden" name="sourcePDFName" value="<?php echo 'form_103b.pdf'; ?>">
        <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_103b.pdf'; ?>">
        <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
        <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
        <input type="hidden" name="<?php echo base64_encode('caseNo01'); ?>" value="<?php echo $caseno; ?>">
        <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
        <input type="hidden" name="<?php echo base64_encode('Debtor.Name1'); ?>" value="<?php echo $onlyDebtor; ?>">
        
        <section class="page-section official-form-103b padd-20" id="official-form-103b">
        <div class="container pl-2 pr-0">
            <x-officialForm.form103b.bankruptyCourtList
                :districtNames="$district_names"
                :savedData="$savedData"
                :showCheckBox="true"
            ></x-officialForm.form103b.bankruptyCourtList>
            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Official Form 103B') }}</h4>
                        <!-- <h4>{{ __('Official Form 106C') }} </h4> -->
                        <h2 class="font-lg-22">
                            {{ __('Application to Have the Chapter 7 Filing Fee Waived') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14">
                            <strong>
                                {{ __('Be as complete and accurate as possible. If two married people are filing together, both are equally responsible for supplying correct
                                information. If more space is needed, attach a separate sheet to this form. On the top of any additional pages, write your name and case number
                                (if known).') }}
                            </strong>
                        </p>
                    </div>
                </div>
                <!-- part 1 -->
                <x-officialForm.form103b.part1></x-officialForm.form103b.part1>
                <!-- part 2 -->
                <x-officialForm.form103b.part2></x-officialForm.form103b.part2>
                <!-- part 3 -->
                <x-officialForm.form103b.part3></x-officialForm.form103b.part3>
                <!-- part 4 -->
                <x-officialForm.form103b.part4></x-officialForm.form103b.part4>
                <!-- part 5 -->
                <x-officialForm.form103b.part5
                    :debtorSign="$debtor_sign"
                    :debtor2Sign="$debtor2_sign"
                    :currentDate="$currentDate"
                ></x-officialForm.form103b.part5>
            </div>
        </div>
        <div class="container op">
           <?php $districtName = 'District01'; ?>
            <x-officialForm.form103b.bankruptyCourtList
                :districtNames="$district_names"
                :savedData="$savedData"
                :districtName="$districtName"
            ></x-officialForm.form103b.bankruptyCourtList>
            <x-officialForm.form103b.chapter7
                :districtNames="$district_names"
                :savedData="$savedData"
            ></x-officialForm.form103b.chapter7>
        </div>
        <x-officialForm.generatePdfButton
            title="Generate PDF" divtitle="official_frm_103b"
        ></x-officialForm.generatePdfButton>
    </section>
</form>
