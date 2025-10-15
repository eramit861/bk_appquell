<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Table Example</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    .text-center {
      text-align: center;
    }

    .row {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .col-4 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 33.333333%;
      flex: 0 0 33.333333%;
      max-width: 33.333333%;
    }

    .col-12 {
      width: 100%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .table,
    .th,
    .td {
      border: 1px solid #ddd;
    }

    td {
      padding: 8px;
      font-size: 14px;
      line-height: 14px;
    }

    .tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    h4 {
      font-size: 18px;
      margin-bottom: 15px;
    }

    .font {
      font-size: 14px;
      margin-top: 450px;
    }

    .mb-0 {
      margin-bottom: 0px !important;
    }

    .w-20 {
      width: 20% !important;
    }

    .w-40 {
      width: 40% !important;
    }

    .w-100 {
      width: 100% !important;
    }
    .hide-data{
      display: none !important;
    }
  </style>
</head>

<body>
  <div class="row">
    <div class="col-12 text-center">
      <img style="width:100px;" src="<?php echo public_path($company_logo); ?>" alt="logo" />
    </div>
    <div class="col-12 text-center">
      <h4><?php echo $labelBank; ?></h4>
    </div>
    <table class="table">
      <tr class="tr">
        <th class="th">Date</th>
        <th class="th">Description of what the funds were used for</th>
        <th class="th">Transaction amount</th>
      </tr>
      <?php foreach ($data as $index => $value) { ?>
        <tr>
          <td class="td"><?php echo $value['sample']; ?></td>
          <td class="td" style="width:auto"><?php echo $value['description']; ?></td>
          <td class="td">$<?php echo $value['value']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div class="row <?php echo $transaction_pdf_signature_enabled == 1 ? '' : 'hide-data'; ?>">
    <div class="col-12 font">
      <p class="mb-0">The transactions exceeding $600.00 from the above bank account over the past 90 days, to the best of my
        knowledge, constitute all relevant transactions.
      </p>
      </br>
      <p class="mb-0">
        I declare under penalty of perjury under the laws of the United States that the foregoing is true and correct.
      </p>
    </div>

    <table style="border: 0px solid black;">
      <tr>
        <td>
          <div class="col-4"><label class="">Date:<?php echo $date; ?></label></div>
        </td>
        <td>
          <div class="col-4"><label class="">X</label></label></div>
          <div style="border: 0.001em solid black;"></div>
        </td>
        <td>
          <div class="col-4"><?php echo $client_type != 1 ? "<label class=''>X</label>" : ""; ?></div>
          <div style="border: 0.001em solid black;"></div>
        </td>
      </tr>
      <tr>
        <td>
        </td>
        <td><?php echo "(" . $debtorname . ")"; ?>
        </td>
        <td><?php echo "(" . $spousename . ")"; ?>
        </td>

      </tr>
    </table>

  </div>

</body>

</html>