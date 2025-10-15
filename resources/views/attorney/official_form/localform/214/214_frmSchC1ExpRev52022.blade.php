<div class="row">

    <div class="col-md-12 mb-3 mt-3">
        <h3 class="text-center ">
            {{ __("UNITED STATES BANKRUPTCY COURT") }}<br>{{ __("EASTERN DISTRICT OF NORTH CAROLINA") }}<br>
            <x-officialForm.inputText name="DIVISION" class="w-auto" value=""></x-officialForm.inputText>{{ __("DIVISION") }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group">
            <label>{{ __("IN THE MATTER OF:") }}</label>
            <textarea name="<?php echo base64_encode('Text13')?>" value="" class="form-control" rows="1" cols="">{{$onlyDebtor}}</textarea>
            <label>{{ __("Debtor(s)") }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="CASE NUMBER:"
            casenoNameField="Text14"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __("SCHEDULE C-1 - PROPERTY CLAIMED AS EXEMPT") }}</h3>
        <p><span class="pl-4"></span> {{ __("I,") }} 
            <x-officialForm.inputText name="I" class="width_30percent" value=""></x-officialForm.inputText>
            {{ __("claim the following property as exempt pursuant to 11 U.S.C. § 522 and the laws of the State of North Carolina, and nonbankruptcy Federal law:") }} 
            <span class="text-bold"> {{ __("(Attach additional sheets if necessary)") }} </span>.
        </p>
        <p>
            <span class="pl-4 pr-2">1.</span>
            {{ __("NCGS 1C-1601(a)(1) (NC Const., Article X, Section 2) REAL OR PERSONAL PROPERTY USED AS A RESIDENCE OR BURIAL PLOT (The exemption is not to exceed $35,000; however, an unmarried debtor who is 65 years of age or older is entitled to retain an aggregate interest in the property not to exceed $60,000 in value so long as the property was previously owned by the debtor as a tenant by the entireties or as a joint tenant with rights of survivorship and the former co-owner of the property is deceased, in which case the debtor must specify his/her age and the name of the former co-owner, if a child use initials only, of the property below).") }}
        </p>
    </div>
    <div class="col-md-12 table_sect table_sect_head_border">
        <table class="w-100 text-center">
            <tr>
                <th class="p-2">{{ __("Description of") }} <br>{{ __("Property and Address") }}</th>
                <th class="p-2">{{ __("Market Value") }}</th>
                <th class="p-2">{{ __("Owner") }} <br>{{ __("(D1)Debtor 1") }} <br> {{ __("(D2)Debtor 2") }} <br>{{ __("(J)Join") }}</th>
                <th class="p-2">{{ __("Mortgage Holder or Lien Holder") }}</th>
                <th class="p-2">{{ __("Amount of Mortgage or Lien") }}</th>
                <th class="p-2">{{ __("Net Value") }}</th>
                <th class="p-2">{{ __("Value Claimed as Exempt Pursuant to") }} <br> {{ __("NCGS 1C-1601(a)(1)") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Description of Property and AddressRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Market ValueRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Owner D1Debtor 1 D2Debtor 2 JJointRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Mortgage Holder or Lien HolderRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text5')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text6')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text7')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>
       
    <div class="col-md-2 mt-3">
        <p class="mb-0 pt-2">{{ __("Debtor's Age:") }}</p>
        <p class="mb-0 pt-3">{{ __("Name of former co-owner:") }}</p>
    </div>
    <div class="col-md-2 mt-3">
        <x-officialForm.inputText name="undefined_2" class="w-auto" value=""></x-officialForm.inputText>
        <x-officialForm.inputText name="Name of former coowner" class="w-auto mt-1" value=""></x-officialForm.inputText>
    </div>
    <div class="col-md-8 mt-3"></div>
    <div class="col-md-12">
        <p class="text-bold p-text-end">{{ __("VALUE OF REAL ESTATE CLAIMED AS EXEMPT PURSUANT TO NCGS 1C-1601(a)(1): $") }} 
            <x-officialForm.inputText name="Text12" class="w-auto price-field" value=""></x-officialForm.inputText></p>
        
    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <p>
            <span class="pl-4 pr-2"> 2.</span> 
            {{ __("NCGS 1C-1601(a)(3) MOTOR VEHICLE (The exemption in one vehicle is not to exceed $3,500).") }}
        </p>
        <table class="w-100 text-center">
        <tr>
                <th class="p-2">{{ __("Model, Year Style of Auto") }}</th>
                <th class="p-2">{{ __("Market Value") }}</th>
                <th class="p-2">{{ __("Owner") }} <br>{{ __("(D1)Debtor 1") }} <br> {{ __("(D2)Debtor 2") }} <br>{{ __("(J)Join") }}</th>
                <th class="p-2">{{ __("Lien Holder") }}</th>
                <th class="p-2">{{ __("Amount of Lien") }}</th>
                <th class="p-2">{{ __("Net Value") }}</th>
                <th class="p-2">{{ __("Value Claimed as Exempt Pursuant to") }} <br> {{ __("NCGS 1C-1601(a)(3)") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Model Year Style of AutoRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Market ValueRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Owner D1Debtor 1 D2Debtor 2 JJointRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Lien HolderRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text8')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text9')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text10')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>

        <p class="text-bold p-text-end">{{ __("VALUE OF MOTOR VEHICLE CLAIMED AS EXEMPT PURSUANT TO NCGS 1C-1601(a)(3): $") }} 
            <x-officialForm.inputText name="Text11" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
        <p>
            <span class="pl-4 pr-2"> 3.</span> 
            {{ __("NCGS 1C-1601(a)(4) (NC Const., Article X, Section 1) PERSONAL OR HOUSEHOLD GOODS (The debtor’s aggregate interest is not to exceed $5,000 plus $1,000 for each dependent of the debtor, not to exceed $4,000 total for dependents). The number of dependents for exemption purposes is .") }} 
        </p>

    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <table class="w-100 text-center">
            <tr>
                <th class="p-2">{{ __("Description of Property") }}</th>
                <th class="p-2">{{ __("Market Value") }}</th>
                <th class="p-2">{{ __("Owner") }} <br>{{ __("(D1)Debtor 1") }} <br> {{ __("(D2)Debtor 2") }} <br>{{ __("(J)Join") }}</th>
                <th class="p-2">{{ __("Lien Holder") }}</th>
                <th class="p-2">{{ __("Amount of Lien") }}</th>
                <th class="p-2">{{ __("Net Value") }}</th>
                <th class="p-2">{{ __("Claimed as Exempt Pursuant to") }} <br> {{ __("NCGS 1C-1601(a)(4)") }}</th>
            </tr>
            <tr>
                <th class="p-2">{{ __("Clothing & personal") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueClothing  personal" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointClothing  personal" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderClothing  personal" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienClothing  personal" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueClothing  personal" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Clothing  personal" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Kitchen appliances") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueKitchen appliances" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointKitchen appliances" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderKitchen appliances" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienKitchen appliances" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueKitchen appliances" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Kitchen appliances" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Stove") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueStove" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointStove" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderStove" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienStove" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueStove" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Stove" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Refrigerator") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueRefrigerator" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointRefrigerator" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderRefrigerator" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienRefrigerator" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueRefrigerator" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Refrigerator" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Freezer") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueFreezer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointFreezer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderFreezer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienFreezer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueFreezer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Freezer" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Washing machine") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueWashing machine" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointWashing machine" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderWashing machine" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienWashing machine" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueWashing machine" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Washing machine" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Dryer") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueDryer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointDryer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderDryer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienDryer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueDryer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Dryer" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("China") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueChina" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointChina" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderChina" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienChina" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueChina" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4China" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Silver") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueSilver" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointSilver" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderSilver" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienSilver" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueSilver" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Silver" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Jewelry") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueJewelry" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointJewelry" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderJewelry" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienJewelry" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueJewelry" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Jewelry" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Living room furniture") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueLiving room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointLiving room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderLiving room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienLiving room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueLiving room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Living room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Den furniture") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueDen furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointDen furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderDen furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienDen furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueDen furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Den furniture" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Bedroom furniture") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueBedroom furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointBedroom furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderBedroom furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienBedroom furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueBedroom furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Bedroom furniture" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Dining room furniture") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueDining room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointDining room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderDining room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienDining room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueDining room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Dining room furniture" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Television") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueTelevision" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointTelevision" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderTelevision" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienTelevision" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueTelevision" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Television" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("()Stereo ()VCR/DVD") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueStereo VCRDVD" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointStereo VCRDVD" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderStereo VCRDVD" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienStereo VCRDVD" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueStereo VCRDVD" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Stereo VCRDVD" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("()Radio ()Video Camera") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueRadio Video Camera" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointRadio Video Camera" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderRadio Video Camera" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienRadio Video Camera" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueRadio Video Camera" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Radio Video Camera" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Musical Instruments") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueMusical Instruments" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointMusical Instruments" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderMusical Instruments" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienMusical Instruments" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueMusical Instruments" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Musical Instruments" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("()Piano ()Organ") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValuePiano Organ" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointPiano Organ" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderPiano Organ" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienPiano Organ" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValuePiano Organ" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Piano Organ" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Air conditioner") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueAir conditioner" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointAir conditioner" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderAir conditioner" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienAir conditioner" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueAir conditioner" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Air conditioner" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Paintings/Art") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValuePaintingsArt" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointPaintingsArt" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderPaintingsArt" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienPaintingsArt" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValuePaintingsArt" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4PaintingsArt" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Lawn mower") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueLawn mower" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointLawn mower" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderLawn mower" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienLawn mower" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueLawn mower" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Lawn mower" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Yard tools") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueYard tools" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointYard tools" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderYard tools" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienYard tools" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueYard tools" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Yard tools" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Crops") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueCrops" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointCrops" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderCrops" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienCrops" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueCrops" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Crops" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("Recreational Equipment") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueRecreational Equipment" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointRecreational Equipment" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderRecreational Equipment" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienRecreational Equipment" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueRecreational Equipment" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Recreational Equipment" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">{{ __("()Computer") }}</th>
                <td class="p-2"><x-officialForm.inputText name="Market ValueComputer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Owner D1Debtor 1 D2Debtor 2 JJointComputer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Lien HolderComputer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of LienComputer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Net ValueComputer" class="mt-1" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Claimed as Exempt Pursuant to NCGS 1C1601a4Computer" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>

        </table>

        <p class="text-bold p-text-end">{{ __("VALUE CLAIMED AS EXEMPT PURSUANT TO NCGS 1C-1601(a)(4) : $") }} 
            <x-officialForm.inputText name="Text15" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <p><span class="pl-4 pr-2">4.</span> {{ __("NCGS 1C-1601(a)(5) TOOLS OF TRADE (The debtor’s aggregate interest is not to exceed $2,000 in value).") }}</p>
         <table class="w-100 text-center">
            <tr>
                <th class="p-2">{{ __("Description") }}</th>
                <th class="p-2">{{ __("Market Value") }}</th>
                <th class="p-2">{{ __("Owner") }} <br>{{ __("(D1)Debtor 1") }} <br> {{ __("(D2)Debtor 2") }} <br>{{ __("(J)Join") }}</th>
                <th class="p-2">{{ __("Lien Holder") }}</th>
                <th class="p-2">{{ __("Amount of Lien") }}</th>
                <th class="p-2">{{ __("Net Value") }}</th>
                <th class="p-2">{{ __("Value Claimed as Exempt Pursuant to") }} <br> {{ __("NCGS 1C-1601(a)(5)") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('DescriptionRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Market ValueRow1_3')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Owner D1Debtor 1 D2Debtor 2 JJointRow1_3')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Lien HolderRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Amount of LienRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Net ValueRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Value Claimed as Exempt Pursuant to NCGS 1C1601a5Row1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
        <p class="text-bold p-text-end">{{ __("VALUE CLAIMED AS EXEMPT PURSUANT TO NCGS-1C-1601(a)(5): $") }}
             <x-officialForm.inputText name="Text16" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <p><span class="pl-4 pr-2">5.</span> {{ __("NCGS 1C-1601(a)(6) LIFE INSURANCE (NC Const., Article X, Section 5)") }}</p>
         <table class="w-100 text-center">
            <tr>
                <th class="p-2">{{ __("Description") }}</th>
                <th class="p-2">{{ __("Insured") }}</th>
                <th class="p-2">{{ __("Last Four Digits of Policy Number") }}</th>
                <th class="p-2">{{ __("Beneficiary") }}<br> {{ __("(if child, initials only)") }}</th>
                <th class="p-2">{{ __("Cash Value") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('DescriptionRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('InsuredRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Last Four Digits of Policy NumberRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Beneficiary if child initials onlyRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Cash ValueRow1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">6.</span>{{ __("NCGS 1C-1601(a)(7) PROFESSIONALLY PRESCRIBED HEALTH AIDS (For Debtor or Debtor's Dependents, no limit on value).") }}</p>
         <table class="w-100">
            <tr>
                <th class="p-2 p-text-start">{{ __("Description") }}</th> 
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('DescriptionRow1_3')?>" value="" class="form-control" rows="3"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">7.</span>
            {{ __("NCGS 1C-1601(a)(8) COMPENSATION FOR PERSONAL INJURY, INCLUDING COMPENSATION FROM PRIVATE DISABILITY POLICIES OR ANNUITIES, OR COMPENSATION FOR DEATH OF A PERSON UPON WHOM THE DEBTOR WAS DEPENDENT FOR SUPPORT. COMPENSATION NOT EXEMPT FROM RELATED LEGAL, HEALTH OR FUNERAL EXPENSE.") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2 p-text-start">{{ __("Description") }}</th>
                <th>{{ __("Source of Compensation, Including Name (If child, initials only) & Last Four Digits of Account Number of any Disability Policy/Annuity") }}</th> 
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('DescriptionRow1_4')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Source of Compensation Including Name If child initials only  Last Four Digits of Account Number of any Disability PolicyAnnuityRow1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">8.</span> 
            {{ __("NCGS 1C-1601(a)(2) ANY PROPERTY [Debtor’s aggregate interest in any property is not to exceed $5,000 in value of any unused exemption amount to which the debtor is entitled under NCGS 1C-1601(a)(1)].") }}
        </p>
         <table class="w-100 text-center">
            <tr>
                <th class="p-2">{{ __("Description of") }} <br>{{ __("Property and Address") }}</th>
                <th class="p-2">{{ __("Market Value") }}</th>
                <th class="p-2">{{ __("Owner") }} <br>{{ __("(D1)Debtor 1") }} <br> {{ __("(D2)Debtor 2") }} <br>{{ __("(J)Join") }}</th>
                <th class="p-2">{{ __("Lien Holder") }}</th>
                <th class="p-2">{{ __("Amount of Lien") }}</th>
                <th class="p-2">{{ __("Net Value") }}</th>
                <th class="p-2">{{ __("Value Claimed as Exempt Pursuant to") }} <br> {{ __("NCGS 1C-1601(a)(2)") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Description of Property and AddressRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Market ValueRow1_4')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Owner D1Debtor 1 D2Debtor 2 JJointRow1_4')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Lien HolderRow1_3')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Amount of LienRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Net ValueRow1_2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Value Claimed as Exempt Pursuant to NCGS 1C1601a2Row1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
        <p class="text-bold p-text-end">{{ __("VALUE CLAIMED AS EXEMPT PURSUANT TO NCGS 1C-1601(a)(2) : $") }} 
            <x-officialForm.inputText name="Text17" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <p><span class="pl-4 pr-2">9.</span>
            {{ __('NCGS 1C-1601(a)(9) and 11 U.S.C. § 522 INDIVIDUAL RETIREMENT PLANS & RETIREMENT FUNDS, as defined in the Internal Revenue Code, and any plan treated in the same manner as an individual retirement plan, including individual retirement accounts and Roth retirement accounts as described in §§ 408(a) and 408A of the Internal Revenue Code, individual retirement annuities as described in § 408(b) of the Internal Revenue Code, accounts established as part of a trust described in § 408(c) of the Internal Revenue Code, and funds in an account exempt from taxation under § 401, 403, 408, 408A, 414, 457, or 510(a) of the Internal Revenue Code. For purposes of this subdivision,') }} 
             "{{ __('Internal Revenue Code') }}" 
            {{ __('means Code as defined in G.S. 105-228.90.') }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Type of Account") }}</th>
                <th class="p-2">{{ __("Location of Account") }}</th>
                <th class="p-2">{{ __("Last Four Digits of Account Number") }}</th>
            </tr>
            <tr>
            <td class="p-2"><textarea name="<?php echo base64_encode('Type of AccountRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Location of AccountRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Last Four Digits of Account NumberRow1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">10.</span>
            {{ __("NCGS 1C-1601(a)(10) FUNDS IN A COLLEGE SAVINGS PLAN, as qualified under § 529 of the Internal Revenue Code, and that are not otherwise excluded from the estate pursuant to 11 U.S.C. §§ 541(b)(5)-(6), (e), not to exceed a cumulative limit of $25,000. If funds were placed in a college savings plan within the 12 months prior to filing, the contributions must have been made in the ordinary course of the debtor’s financial affairs and must have been consistent with the debtor’s past pattern of contributions. The exemption applies to funds for a child of the debtor that will actually be used for the child’s college or university expenses") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("College Savings Plan") }}</th>
                <th class="p-2">{{ __("Last Four Digits of Account Number") }}</th>
                <th class="p-2">{{ __("Value") }}</th>
                <th class="p-2">{{ __("Initials of Child Beneficiary") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text2')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text3')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Text4')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">11.</span>
            {{ __("NCGS 1C-1601(a)(11) RETIREMENT BENEFITS UNDER THE RETIREMENT PLANS OF OTHER STATES AND GOVERNMENTAL UNITS OF OTHER STATES (The debtor’s interest is exempt only to the extent that these benefits are exempt under the laws of the state or governmental unit under which the benefit plan is established).") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Name of Retirement Plan") }}</th>
                <th class="p-2">{{ __("State Governmental Unit") }}</th> 
                <th class="p-2">{{ __("Last Four Digits of Identifying Number") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Name of Retirement PlanRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('State Governmental UnitRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Last Four Digits of Identifying NumberRow1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">12.</span>
            {{ __("NCGS 1C-1601(a)(12) ALIMONY, SUPPORT, SEPARATE MAINTENANCE, AND CHILD SUPPORT PAYMENTS OR FUNDS THAT HAVE BEEN RECEIVED OR TO WHICH THE DEBTOR IS ENTITLED (The debtor’s interest is exempt to the extent the payments or funds are reasonably necessary for the support of the debtor or any dependent of the debtor).") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Type of Support") }}</th>
                <th class="p-2">{{ __("Amount") }}</th> 
                <th class="p-2">{{ __("Location of Funds") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Type of SupportRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('AmountRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Location of FundsRow1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">13.</span>
            {{ __("TENANCY BY THE ENTIRETY. The following property is claimed as exempt pursuant to 11 U.S.C. § 522 and the law of the State of North Carolina pertaining to property held as tenants by the entirety.") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Description of") }}<br>{{ __("Property and Address") }}</th>
                <th>{{ __("Market Value") }}</th> 
                <th>{{ __("Lien Holder") }}</th>
                <th>{{ __("Amount of Lien") }}</th>
                <th>{{ __("Net Value") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Description of Property and AddressRow1_3')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Market ValueRow1_5')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Lien HolderRow1_4')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Amount of LienRow1_3')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Net ValueRow1_3')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
        <p class="text-bold p-text-end">{{ __("VALUE CLAIMED AS EXEMPT: $") }}
             <x-officialForm.inputText name="Text18" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <p><span class="pl-4 pr-2">14.</span>
            {{ __("NORTH CAROLINA PENSION FUND EXEMPTIONS") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-3">a.</th>
                <td class="p-2"><label>{{ __("North Carolina Local Government Employees Retirement benefits NCGS 128-31") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="North Carolina Local Government Employees Retirement benefits NCGS 12831" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">b.</th>
                <td class="p-2"><label>{{ __("North Carolina Teachers and State Employees Retirement benefits NCGS 135-9") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="North Carolina Teachers and State Employees Retirement benefits NCGS 1359" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">c.</th>
                <td class="p-2"><label>{{ __("Firemen's Relief Fund pensions NCGS 58-86-90") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Firemens Relief Fund pensions NCGS 588690" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">d.</th>
                <td class="p-2"><label>{{ __("Fraternal Benefit Society benefits NCGS 58-24-85") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Fraternal Benefit Society benefits NCGS 582485" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">e.</th>
                <td class="p-2"><label>{{ __("Benefits under the Supplemental Retirement Income Plan for teachers and state employees are exempt from levy, sale, and garnishment NCGS 135-95") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Benefits under the Supplemental Retirement Income Plan for teachers and state employees are exempt from levy sale and garnishment NCGS 13595" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">f.</th>
                <td class="p-2"><label>{{ __("Benefits under the Supplemental Retirement Income Plan for state law enforcement officers are exempt from levy, sale, and garnishment NCGS 143-166.30(g)") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Benefits under the Supplemental Retirement Income Plan for state law enforcement officers are exempt from levy sale and garnishment NCGS 14316630g" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">15.</span>
            {{ __("OTHER EXEMPTIONS CLAIMED UNDER LAWS OF THE STATE OF NORTH CAROLINA") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-3">a.</th>
                <td class="p-2"><label>{{ __("Aid to the Aged, Disabled and Families with Dependent Children NCGS 108A-36") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Aid to the Aged Disabled and Families with Dependent Children NCGS 108A36" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">b.</th>
                <td class="p-2"><label>{{ __("Aid to the Blind NCGS 111-18") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Aid to the Blind NCGS 11118" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">c.</th>
                <td class="p-2"><label>{{ __("Yearly Allowance of Surviving Spouse NCGS 30-15") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Yearly Allowance of Surviving Spouse NCGS 3015" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">d.</th>
                <td class="p-2"><label>{{ __("Workers Compensation benefits NCGS 97-21") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Workers Compensation benefits NCGS 9721" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">e.</th>
                <td class="p-2"><label>{{ __("Unemployment benefits, so long as not commingled and except for debts for necessities purchased while unemployed NCGS 96-17") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Unemployment benefits so long as not commingled and except for debts for necessities purchased while unemployed NCGS 9617" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">f.</th>
                <td class="p-2"><label>{{ __("Group insurance proceeds NCGS 58-58-165") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Group insurance proceeds NCGS 5858165" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">g.</th>
                <td class="p-2"><label>{{ __("Partnership property, except on a claim against the partnership NCGS 59-55") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Partnership property except on a claim against the partnership NCGS 5955" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">h.</th>
                <td class="p-2"><label>{{ __("Wages of debtor necessary for support of family NCGS 1-362") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Wages of debtor necessary for support of family NCGS 1362" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">i.</th>
                <td class="p-2"><label>{{ __("Benefits under the Separate Insurance Benefits Plan for state and local law enforcement officers are exempt from levy, sale, and garnishment NCGS 143-166.60(h)") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Benefits under the Separate Insurance Benefits Plan for state and local law enforcement officers are exempt from levy sale and garnishment NCGS 14316660h" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-3">j.</th>
                <td class="p-2"><label>{{ __("Vested benefits under the North Carolina Public Employee Deferred Compensation Plan are exempt from levy, sale, and garnishment NCGS 147-9.4") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Vested benefits under the North Carolina Public Employee Deferred Compensation Plan are exempt from levy sale and garnishment NCGS 14794" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">16.</span>
            {{ __("FEDERAL PENSION FUND EXEMPTIONS") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">a.</th>
                <td class="p-2"><label>{{ __("Foreign Service Retirement and Disability Payments 22 U.S.C. § 4060") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Foreign Service Retirement and Disability Payments 22 USC  4060" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">b.</th>
                <td class="p-2"><label>{{ __("Civil Service Retirement benefits 5 U.S.C. § 8346") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Civil Service Retirement benefits 5 USC  8346" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">c.</th>
                <td class="p-2"><label>{{ __("Railroad Retirement Act annuities and pensions 45 U.S.C. § 231m") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Railroad Retirement Act annuities and pensions 45 USC  231m" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">d.</th>
                <td class="p-2"><label>{{ __("Veterans benefits 38 U.S.C. § 5301") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Veterans benefits 38 USC  5301" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">e.</th>
                <td class="p-2"><label>{{ __("Special pension paid to winners of Congressional Medal of Honor 38 U.S.C. § 1562") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Special pension paid to winners of Congressional Medal of Honor 38 USC  1562" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">f.</th>
                <td class="p-2"><label>{{ __("Annuities payable for service in the General Accounting Office 31 U.S.C. 776") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Annuities payable for service in the General Accounting Office 31 USC 776" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">17.</span>
            {{ __("OTHER EXEMPTIONS CLAIMED UNDER NONBANKRUPTCY FEDERAL LAW") }}
        </p>
         <table class="w-100">
            <tr>
                <th class="p-2">a.</th>
                <td class="p-2"><label>{{ __("Social Security benefits 42 U.S.C. § 407") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Social Security benefits 42 USC  407" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">b.</th>
                <td class="p-2"><label>{{ __("Injury or death compensation payments from war risk hazards 42 U.S.C. § 1717") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Injury or death compensation payments from war risk hazards 42 USC  1717" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">c.</th>
                <td class="p-2"><label>{{ __("Wages owing a master or seamen, except for support of a spouse and/or minor children 46 U.S.C. § 11109") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Wages owing a master or seamen except for support of a spouse andor minor children 46 USC  11109" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">d.</th>
                <td class="p-2"><label>{{ __("Longshoremen and Harbor Workers Compensation Act death and disability benefits 33 U.S.C. § 916") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Longshoremen and Harbor Workers Compensation Act death and disability benefits 33 USC  916" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">e.</th>
                <td class="p-2"><label>{{ __("Crop insurance proceeds 7 U.S.C. § 1509") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Crop insurance proceeds 7 USC  1509" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">f.</th>
                <td class="p-2"><label>{{ __("Public safety officers’ death benefits 42 U.S.C. § 3796. See subsection (g)") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Public safety officers death benefits 42 USC  3796 See subsection g" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">g.</th>
                <td class="p-2"><label>{{ __("Railroad unemployment insurance 45 U.S.C. § 352. See subsection (e)") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Railroad unemployment insurance 45 USC  352 See subsection e" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
            <tr>
                <th class="p-2">h.</th>
                <td class="p-2"><label>{{ __("Other and please specify") }}</label></td>
                <td class="p-2 width_20percent"><x-officialForm.inputText name="Other and please specify" class="mt-1" value=""></x-officialForm.inputText></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p><span class="pl-4 pr-2">18.</span>{{ __("RECENT PURCHASES") }}</p>
        <p class="pl-4"><span class="pl-4 pl-3"> (a).</span> {{ __("List tangible personal property purchased by the debtor within ninety (90) days of the filing of the bankruptcy petition.") }}</p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Description") }}</th>
                <th>{{ __("Market Value") }}</th> 
                <th>{{ __("Lien Holder") }}</th>
                <th>{{ __("Amount of Lien") }}</th>
                <th>{{ __("Net Value") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('DescriptionRow1_5')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Market ValueRow1_6')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Lien HolderRow1_5')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Amount of LienRow1_4')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Net ValueRow1_4')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <p class="pl-4"><span class="pl-4 pl-3"> (b).</span> {{ __("List any tangible personal property from 18(a) that is directly traceable to the liquidation or conversion of property that may be exempt and that was not acquired by transferring or using additional property.") }}</p>
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Description of Replacement Property") }}</th>
                <th>{{ __("Description of Property Liquidated or Converted that May Be Exempt") }}</th> 
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('Description of Replacement PropertyRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Description of Property Liquidated or Converted that May Be ExemptRow1')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p><span class="pl-4 ml-3 pr-2">19.</span>{{ __("The debtor's property is subject to the following claims:") }}</p>
        <table class="w-100">
            <tr>
                <td class="p-2">a.</td>
                <td class="p-2"><label>{{ __("Of the United States or its agencies as provided by federal law") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">b.</td>
                <td class="p-2"><label>{{ __("Of the State of North Carolina or its subdivisions for taxes, appearance bonds or fiduciary bonds") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">c.</td>
                <td class="p-2"><label>{{ __("Of a lien by a laborer for work done and performed for the person claiming the exemption. but only as to the specific property affected") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">d.</td>
                <td class="p-2"><label>{{ __("Of a lien by a mechanic for work done on the premises, but only as to the specific property affected") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">e.</th>
                <td class="p-2"><label>{{ __("For payment of obligations contracted for the purchase of specific real property affected.") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">f.</td>
                <td class="p-2"><label>{{ __("For contractual security interests in specific property affected; provided, that the exemptions shall apply to the debtor’s household goods notwithstanding any contract for a nonpossessory, nonpurchase money security interest in any such goods") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">g.</td>
                <td class="p-2"><label>{{ __("For statutory liens, on the specific property affected, other than judicial liens") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">h.</td>
                <td class="p-2"><label>{{ __("For child support, alimony or distributive award order pursuant to Chapter 50 of the General Statutes of North Carolina") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">i.</td>
                <td class="p-2"><label>{{ __("For criminal restitution orders docketed as civil judgments pursuant to G.S. 15A-1340.38") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">j.</td>
                <td class="p-2"><label>{{ __("Debts of a kind specified in 11 U.S.C. § 523(a)(1) (certain taxes), (5) (domestic support obligations)") }}</label></td>
            </tr>
            <tr>
                <td class="p-2">k.</td>
                <td class="p-2"><label>{{ __("Debts of a kind specified in 11 U.S.C. § 522(c)") }}</label></td>
            </tr>
        </table>
    
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
         <table class="w-100">
            <tr>
                <th class="p-2">{{ __("Claimant") }}</th>
                <th class="p-2">{{ __("Nature of Claim") }}</th> 
                <th class="p-2">{{ __("Amount of Claim") }}</th>
                <th class="p-2">{{ __("Description of Property") }}</th>
                <th class="p-2">{{ __("Value of Property") }}</th>
                <th class="p-2">{{ __("Net Value") }}</th>
            </tr>
            <tr>
                <td class="p-2"><textarea name="<?php echo base64_encode('ClaimantRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Nature of ClaimRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Amount of ClaimRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Description of PropertyRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Value of PropertyRow1')?>" value="" class="form-control" rows="5"></textarea></td>
                <td class="p-2"><textarea name="<?php echo base64_encode('Net ValueRow1_5')?>" value="" class="form-control" rows="5"></textarea></td>
            </tr>
        </table>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __("None of the property listed in paragraph 18(a), except qualified replacement property under 18(b), has been included in this claim of exemptions.") }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __("None of the claims listed in paragraph 19 is subject to this claim of exemptions.") }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __("I declare that to the extent any exemptions I have claimed appear on its face to exceed the amount allowed by the applicable statute, I claim only the maximum amount allowed by statute.") }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __("UNSWORN DECLARATION UNDER PENALTY OF PERJURY ON BEHALF OF INDIVIDUAL") }}<br>{{ __("TO SCHEDULE C-1 - PROPERTY CLAIMED AS EXEMPT") }}</h3>
        <p>
            <span class="pl-4"></span>
            {{ __("I,") }} <x-officialForm.inputText name="I_2" class="width_30percent" value="{{$onlyDebtor}}"></x-officialForm.inputText>,
            {{ __("declare under penalty of perjury that I have read the foregoing Schedule C-1 - Property Claimed as Exempt, consisting of") }} 
            <x-officialForm.inputText name="C1 Property Claimed as Exempt consisting of" class="w-auto" value=""></x-officialForm.inputText>
            {{ __("sheets, and that they are true and correct to the best of my knowledge, information and belief.") }}
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on:"
            dateNameField="Executed on"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

</div>