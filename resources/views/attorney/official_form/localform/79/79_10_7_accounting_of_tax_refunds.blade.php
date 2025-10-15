<h3 class="underline col-md-12 text-center">BANKRUPTCY DEBTOR ACCOUNTING OF TAX REFUNDS</h3>

<div class="col-md-12 mt-2 row">
    <div class="col-md-6 d-flex align-items-center">
    <span>Debtor Name:</span>
    <input class="form-control w-auto" value="{{$onlyDebtor}}" type="text" name="<?php echo base64_encode('Text1'); ?>">
    </div>
    <div class="col-md-6 d-flex align-items-center">
    <span>Joint Debtor Name:</span>
    <input class="form-control w-auto" value="{{$spousename}}" type="text" name="<?php echo base64_encode('Text2'); ?>">
</div>
</div>
<div class="col-md-12 mt-2 row">
    <div class="col-md-3 d-flex align-items-center">
        <span>Phone:</span>
        <input class="form-control w-auto" value="{{$debtorPhoneHome}}" type="text" name="<?php echo base64_encode('Text3'); ?>">
    </div>
    <div class="col-md-3 d-flex align-items-center">
        <span>Email:</span>
        <input class="form-control w-aut" value="{{$debtor_email}}" type="text" name="<?php echo base64_encode('Text26'); ?>">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <span>Bankruptcy Filing Date:</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text5'); ?>">
    </div>
</div>
<div class="col-md-12 mt-2 row">
    <div class="col-md-6 d-flex align-items-center">
        <span class="mr-2">2021 Federal Tax Refund Amount:</span>$
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text6'); ?>">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <span>Date Received:</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text7'); ?>">
    </div>
</div>
<div class="col-md-12 mt-2 row">
    <div class="col-md-6 d-flex align-items-center">
        <span class="mr-4">2021 State Tax Refund Amount:</span>$
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text8'); ?>">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <span>Date Received:</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text9'); ?>">
    </div>
</div>
<div class="col-md-12 mt-2 row">
    <div class="col-md-8 d-flex align-items-center">
        <span>Name Of Bank the Tax Refunds were deposited into:</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text10'); ?>">
    </div>
    <div class="col-md-4 d-flex align-items-center">
        <span>Account No.</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text11'); ?>">
    </div>
</div>

<table class="w-100 mt-3">
    <thead>
    <tr>
        <th class="p-2">No.</th>
        <th class="p-2">Date:</th>
        <th class="p-2">Name of person or business paid:</th>
        <th class="p-2">How was refund used? What goods/services were bought?</th>
        <th class="p-2">Amount of payment</th>
        <th class="p-2">Receipt attached: "Yes" or why not</th>
    </tr>
    </thead>
    <tbody>
        <?php for ($i = 1;$i <= 35;$i++) {?>
        <tr>
        <td class="text-center"><?php echo $i ?></td>
        <td><input class="form-control " value="" type="text" name="<?php echo base64_encode('Date'.$i); ?>"></td>
        <td><input class="form-control " value="" type="text" name="<?php echo base64_encode('Name'.$i); ?>"></td>
        <td><input class="form-control " value="" type="text" name="<?php echo base64_encode('RefundUsed'.$i); ?>"></td>
        <td><input class="form-control " value="" type="text" name="<?php echo base64_encode('Amount'.$i); ?>"></td>
        <td><input class="form-control " value="" type="text" name="<?php echo base64_encode('ReciptAttached'.$i); ?>"></td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
        <td class="text-center">--</td>
        <td class="text-center">--</td>
        <td class="text-center">--------------------</td>
        <td class="">
        <div class="text-end justify-content-end">TOTAL:</div>
        </td>
        <td class="d-flex px-1 text-center">$<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Total2'); ?>"></td>
        <td></td>
        </tr>
    </tfoot>
</table>