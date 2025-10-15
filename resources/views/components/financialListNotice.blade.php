<div class="col-md-5 mt-1">
    <div class="row">
        <div class="col-md-12">
            <label class="font-weight-bold "><span class="font-weight-normal">{{($i+1).'. '}}</span>Name of site: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("name",@$finacialAffairst,$i) }}</span></label>
        </div>
        <x-financialAddress :finacial_affairst="$finacialAffairst" :i="$i"></x-financialAddress>
    </div>
</div>
<div class="col-md-7 mt-1">
    <div class="row">
        <div class="col-md-12">
            <label class="font-weight-bold">Name of Government Unit: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("gov_name",@$finacialAffairst,$i) }}</span></label>
        </div>
        <div class="col-md-12">
            <label class="font-weight-bold ">Street: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("gov_street_number",@$finacialAffairst,$i) }}</span></label>
        </div>
        <div class="col-md-4">
            <label class="font-weight-bold ">City: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("gov_city",@$finacialAffairst,$i) }}</span></label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold ">State: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("gov_state",@$finacialAffairst,$i) }}</span></label>
        </div>
        <div class="col-md-6">
            <label class="font-weight-bold ">Zip: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("gov_zip",@$finacialAffairst,$i) }}</span></label>
        </div>
 

      
    </div>
</div>
<div class="col-md-5">
            <label class="font-weight-bold">Environmental Law, If You Know It: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value($environmentKey,@$finacialAffairst,$i) }}</span></label>
        </div>
        <div class="col-md-7">
            <label class="font-weight-bold ">Date of Notice: <span
                    class="font-weight-normal">{{ Helper::validate_key_loop_value("notice_date",@$finacialAffairst,$i) }}</span></label>
        </div>
