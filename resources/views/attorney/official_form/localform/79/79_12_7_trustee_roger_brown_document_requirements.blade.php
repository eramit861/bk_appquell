<?php
$mainTitle = 'Ch 7 Trustee Roger Brown';
$list = [];
$list['General Forms & Documents to Request Once Filed'] = [
        'Trustee questionnaire',
        'Domestic Support Form',
        'Debtor ID Form',
        'Paystub AFTER Filing',
        'Tax Return of Year BK was filed',
        'Statement for Financial Accounts - Need month covering filing date',
    ];
$list['Default Documents Required'] = [
        'DL & SSC',
        '3 Months of Paystubs before filing',
        '2 Most Recently Filed Tax Returns',
        'Statements for financial accounts (3 months before filing)',
        'Stocks Statement',
        'Retirement Statement',
        'Whole Life Insurance Policy Statement',
        'Loan Statement for any loan secured by real property/mortgage/vehicle loan',
        'Titles for any vehicles',
        'Vehicle Registration',
        'Vehicle Insurance',
        'Divorce Decree if Within 2 past 2 years and/or property settlement agreement',
    ];
?>
@include('attorney.official_form.localform.79.common.document_requirements', ['mainTitle'=> $mainTitle, 'list' => $list])