<?php

namespace App\Helpers;

class LocalFormHelper extends Helper
{
    public static function schD($key)
    {
        $arr = [
            1 => [
                'noBox' => '',
                'checkIfClaimRelatesTo' => 'Check if this claim relates to a',
                'debtorA' => 'check 2',
                'debtorB' => 'check 2',
                'debtorC' => 'check 2',
                'debtorD' => 'check 2',
                'debtor1' => 'debtor 1',
                'debtor2' => 'debtor 2',
                'debtor1and2' => 'Debtor 1 and 2',
                'debtorOneOrAnother' => 'One of debtors and another',
                'last4Digits' => 'account number',
                'columnA' => 'undefined',
                'columnB' => 'undefined_2',
                'columnC' => 'undefined_3',
                'propertyClaim' => 'As of the date you file the claim is Check all that apply',
                'contingent' => 'Contingent',
                'inliquidated' => 'Unliquidated',
                'disputed' => 'Disputed',
                'anAgreementYouMade' => 'An agreement you made such as mortgage or secured',
                'statutoryLien' => 'Statutory lien such as tax lien mechanics lien',
                'judgementLien' => 'Judgment lien from a lawsuit',
                'otherRightToOffset' => 'Other including a right to offset',
                'otherTextField' => 'undefined_4',
            ],
            2 => [
                'noBox' => '',
                'checkIfClaimRelatesTo' => 'Check if this claim relates to a_2',
                'debtorA' => 'check 3',
                'debtorB' => 'check 3',
                'debtorC' => 'check 3',
                'debtorD' => 'check 3',
                'debtor1' => 'debtor 1',
                'debtor2' => 'debtor 2',
                'debtor1and2' => 'debtor 1 and 2',
                'debtorOneOrAnother' => 'One of debtors and another',
                'last4Digits' => 'account number 2',
                'columnA' => 'undefined_5',
                'columnB' => 'undefined_6',
                'columnC' => 'undefined_7',
                'propertyClaim' => 'As of the date you file the claim is Check all that apply_2',
                'contingent' => 'Contingent_2',
                'inliquidated' => 'Unliquidated_2',
                'disputed' => 'Disputed_2',
                'anAgreementYouMade' => 'An agreement you made such as mortgage or secured_2',
                'statutoryLien' => 'Statutory lien such as tax lien mechanics lien_2',
                'judgementLien' => 'Judgment lien from a lawsuit_2',
                'otherRightToOffset' => 'Other including a right to offset_2',
                'otherTextField' => 'undefined_8',
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    private static function partD1Node1()
    {
        return [
            'noBox' => 'undefined_12',
            'checkIfClaimRelatesTo' => 'Check if this claim relates to a_3',
            'debtorA' => 'check 4',
            'debtorB' => 'check 4',
            'debtorC' => 'check 4',
            'debtorD' => 'check 4',
            'debtor1' => 'debtor 1',
            'debtor2' => 'debtor 2',
            'debtor1and2' => 'Debtor 1 and 2',
            'debtorOneOrAnother' => 'One of debtors and another',
            'last4Digits' => 'account number 3',
            'columnA' => 'undefined_10',
            'columnB' => 'undefined_13',
            'columnC' => 'undefined_15',
            'propertyClaim' => 'As of the date you file the claim is Check all that apply_3',
            'contingent' => 'Contingent_3',
            'inliquidated' => 'Unliquidated_3',
            'disputed' => 'Disputed_3',
            'anAgreementYouMade' => 'An agreement you made such as mortgage or secured_3',
            'statutoryLien' => 'Statutory lien such as tax lien mechanics lien_3',
            'judgementLien' => 'Judgment lien from a lawsuit_3',
            'otherRightToOffset' => 'Other including a right to offset_3',
            'otherTextField' => 'undefined_11',
        ];
    }
    private static function partD1Node2($type = "")
    {
        return [
            'noBox' => 'undefined_19.1',
            'checkIfClaimRelatesTo' => 'Check if this claim relates to a_4',
            'debtorA' => (($type == "D1") ? 'check 5' : ''),
            'debtorB' => '',
            'debtorC' => '',
            'debtorD' => '',
            'debtor1' => (($type == "D1") ? 'On' : ''),
            'debtor2' => '',
            'debtor1and2' => '',
            'debtorOneOrAnother' => '',
            'last4Digits' => 'account number 4',
            'columnA' => 'undefined_14',
            'columnB' => 'undefined_17',
            'columnC' => 'undefined_18',
            'propertyClaim' => 'As of the date you file the claim is Check all that apply_4',
            'contingent' => 'Contingent_4',
            'inliquidated' => 'Unliquidated_4',
            'disputed' => 'Disputed_4',
            'anAgreementYouMade' => 'An agreement you made such as mortgage or secured_4',
            'statutoryLien' => 'Statutory lien such as tax lien mechanics lien_4',
            'judgementLien' => 'Judgment lien from a lawsuit_4',
            'otherRightToOffset' => 'Other including a right to offset_4',
            'otherTextField' => 'undefined_16'
        ];
    }
    private static function partD1Node3()
    {
        return [
            'noBox' => 'undefined_19.2',
            'checkIfClaimRelatesTo' => 'Check if this claim relates to a_5',
            'debtorA' => 'Debtor 1 only_5',
            'debtorB' => 'Debtor 2 only_5',
            'debtorC' => 'Debtor 1 and Debtor 2 only_5',
            'debtorD' => 'At least one of the debtors and another_5',
            'debtor1' => 'On',
            'debtor2' => 'On',
            'debtor1and2' => 'On',
            'debtorOneOrAnother' => 'On',
            'last4Digits' => 'account number 5',
            'columnA' => 'undefined_20',
            'columnB' => 'undefined_22',
            'columnC' => 'undefined_25',
            'propertyClaim' => 'As of the date you file the claim is Check all that apply_5',
            'contingent' => 'Contingent_5',
            'inliquidated' => 'Unliquidated_5',
            'disputed' => 'Disputed_5',
            'anAgreementYouMade' => 'An agreement you made such as mortgage or secured_5',
            'statutoryLien' => 'Statutory lien such as tax lien mechanics lien_5',
            'judgementLien' => 'Judgment lien from a lawsuit_5',
            'otherRightToOffset' => 'Other including a right to offset_5',
            'otherTextField' => 'undefined_21'
        ];
    }

    public static function partD1($key)
    {
        $arr =
            [
                1 => self::partD1Node1(),
                2 => self::partD1Node2('D1'),
                3 => self::partD1Node3()
            ];

        return static::returnArrValue($arr, $key);
    }

    public static function partDStep1($key)
    {
        $arr = [
            1 => self::partD1Node1(),
            2 => self::partD1Node2('D1'),
            3 => self::partD1Node3()
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function schDStep2($key)
    {

        $arr = [
            1 => [
                'noBox' => 'be notified for any debts in Part 1 do not fill out or submit this page.0',
                'name' => 'Name',
                'street' => 'Number_6',
                'city' => 'Street 2',
                'state' => 'Street 3',
                'zip' => 'Street 4',
                'lineCreditor' => 'On which line in Part 1 did you enter the creditor',
                'Last4Digit' => 'account number 6',
            ],
            2 => [
                'noBox' => '1',
                'name' => 'Name_2',
                'street' => 'Number_7',
                'city' => 'Street 2_2',
                'state' => 'Street 3_2',
                'zip' => 'Street 4_2',
                'lineCreditor' => 'undefined_26',
                'Last4Digit' => 'account number 7',
            ],
            3 => [
                'noBox' => 'be notified for any debts in Part 1 do not fill out or submit this page.2',
                'name' => 'Name_3',
                'street' => 'Number_8',
                'city' => 'Street 2_3',
                'state' => 'Street 3_3',
                'zip' => 'Street 4_3',
                'lineCreditor' => 'undefined_27',
                'Last4Digit' => 'account number 8',
            ],
            4 => [
                'noBox' => 'be notified for any debts in Part 1 do not fill out or submit this page.3',
                'name' => 'Name_4',
                'street' => 'Number_9-106',
                'city' => 'Street 2_4',
                'state' => 'Street 3_4',
                'zip' => 'Street 4_4',
                'lineCreditor' => 'On which line in Part 1 did you enter the creditor_4',
                'Last4Digit' => 'account number',
            ],
            5 => [
                'noBox' => 'be notified for any debts in Part 1 do not fill out or submit this page.4.0',
                'name' => 'Name_5',
                'street' => 'Number_10',
                'city' => 'Street 2_5',
                'state' => 'Street 3_5',
                'zip' => 'Street 4_5',
                'lineCreditor' => 'On which line in Part 1 did you enter the creditor_5',
                'Last4Digit' => 'account number 10',
            ],
            6 => [
                'noBox' => 'be notified for any debts in Part 1 do not fill out or submit this page.4.1',
                'name' => 'Name_6',
                'street' => 'Number_11',
                'city' => 'Street 2_6',
                'state' => 'Street 3_6',
                'zip' => 'Street 4_6',
                'lineCreditor' => 'On which line in Part 1 did you enter the creditor_6',
                'Last4Digit' => 'account number 11',
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getEFPage1($key)
    {
        $arr = [
            1 => [
                "noBox" => 'temp',
                "creditorName" => 'Creditors Name',
                "addressLineA" => 'Street',
                "addressLineB" => '1address',
                "city" => '2city',
                "state" => '3state',
                "zip" => '4zip',
                "last4Digits" => 'account number',
                "whenDebtIncurred" => 'Date debt was incurred',
                "priorityTypeA" => 'Domestic support obligations',
                "priorityTypeB" => 'Taxes and ceratin other debts you owe the government',
                "priorityTypeC" => 'Claims for death or personal injury while intoxicated',
                "priorityTypeD" => 'Other',
                "priorityTypeOtherText" => 'Other unsecurecured claim 2.1',
                "totalClaim" => 'undefined',
                "priorityAmount" => 'undefined_2',
                "nonpriorityAmount" => 'undefined_3',
                "debtor" => 'check 1',
                "debtorA" => 'debtor 1',
                "debtorB" => 'debtor 2',
                "debtorAandB" => 'Debtor 1 and 2',
                "debtorOneOrAnother" => 'One of debtors and another',
                "checkIfThisClaim" => 'Check if this claim relates to a',
                "claimSubjectToOffset" => 'check2',
                "contingent" => 'Contingent',
                "unliquidated" => 'Unliquidated',
                "disputed" => 'Disputed',
            ],
            2 => [
                "noBox" => 'temp',
                "creditorName" => 'Creditors Name_2',
                "addressLineA" => 'Street_2',
                "addressLineB" => '1_2',
                "city" => '2_2',
                "state" => '3_2',
                "zip" => 'fill_27.0',
                "last4Digits" => 'account number 2',
                "whenDebtIncurred" => 'Date debt was incurred_2',
                "priorityTypeA" => 'Domestic support obligations_2',
                "priorityTypeB" => 'Taxes and ceratin other debts you owe the government_2',
                "priorityTypeC" => 'Claims for death or personal injury while intoxicated_2',
                "priorityTypeD" => 'Other_2',
                "priorityTypeOtherText" => 'Other unsecurecured claim 2.2',
                "totalClaim" => 'undefined_5',
                "priorityAmount" => 'undefined_6',
                "nonpriorityAmount" => 'undefined_7',
                "debtor" => 'check 2',
                "debtorA" => 'debtor 1',
                "debtorB" => 'debtor 2',
                "debtorAandB" => 'debtor 1 and 2',
                "debtorOneOrAnother" => 'One of debtors and another',
                "checkIfThisClaim" => 'Check if this claim relates to a_2',
                "claimSubjectToOffset" => 'check3',
                "contingent" => 'Contingent_2',
                "unliquidated" => 'Unliquidated_2',
                "disputed" => 'Disputed_2',
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function SchdEFPage2($key)
    {
        $arr = [
            1 => [
                "noBox" => 'undefined_12',
                "creditorName" => 'Creditors Name_3',
                "addressLineA" => 'Street_3',
                "addressLineB" => '1_3',
                "city" => '2_3',
                "state" => '3_3',
                "zip" => '4_3',
                "last4Digits" => 'account number 3',
                "whenDebtIncurred" => 'Date debt was incurred_3',
                "priorityTypeA" => 'Domestic support obligations_3',
                "priorityTypeB" => 'Taxes and ceratin other debts you owe the government_3',
                "priorityTypeC" => 'Claims for death or personal injury while intoxicated_3',
                "priorityTypeD" => 'Other_3',
                "priorityTypeOtherText" => 'Other unsecurecured claim 2.3',
                "totalClaim" => 'undefined_10',
                "priorityAmount" => 'undefined_13',
                "nonpriorityAmount" => 'undefined_15',
                "debtor" => 'check 3',
                "debtorA" => 'debtor 1',
                "debtorB" => 'debtor 2',
                "debtorAandB" => 'Debtor 1 and 2',
                "debtorOneOrAnother" => 'One of debtors and another',
                "checkIfThisClaim" => 'Check if this claim relates to a_3',
                "claimSubjectToOffset" => 'check4',
                "contingent" => 'Contingent_3',
                "unliquidated" => 'Unliquidated_3',
                "disputed" => 'Disputed_3',
            ],
            2 => [
                "noBox" => 'undefined_19.mid',
                "creditorName" => 'Creditors Name_4',
                "addressLineA" => 'Street_4',
                "addressLineB" => '1_4',
                "city" => '2_4',
                "state" => '3_4',
                "zip" => '4_4',
                "last4Digits" => 'account number 4',
                "whenDebtIncurred" => 'Date debt was incurred_4',
                "priorityTypeA" => 'Domestic support obligations_4',
                "priorityTypeB" => 'Taxes and ceratin other debts you owe the government_4',
                "priorityTypeC" => 'Claims for death or personal injury while intoxicated_4',
                "priorityTypeD" => 'Other_4',
                "priorityTypeOtherText" => 'Other unsecurecured claim 2.4',
                "totalClaim" => 'undefined_14',
                "priorityAmount" => 'undefined_17',
                "nonpriorityAmount" => 'undefined_18',
                "debtor" => 'check 4',
                "debtorA" => 'debtor 1',
                "debtorB" => 'debtor 2',
                "debtorAandB" => 'debtor 1 and 2',
                "debtorOneOrAnother" => 'On',
                "checkIfThisClaim" => 'Check if this claim relates to a_4',
                "claimSubjectToOffset" => 'check5',
                "contingent" => 'Contingent_4',
                "unliquidated" => 'Unliquidated_4',
                "disputed" => 'Disputed_4',
            ],
            3 => [
                "noBox" => 'undefined_19.low',
                "creditorName" => 'Creditors Name_5',
                "addressLineA" => 'Street_5',
                "addressLineB" => '1_5',
                "city" => '2_5',
                "state" => '3_5',
                "zip" => '4_5',
                "last4Digits" => 'account number 5',
                "whenDebtIncurred" => 'Date debt was incurred_5',
                "priorityTypeA" => 'Domestic support obligations_5',
                "priorityTypeB" => 'Taxes and ceratin other debts you owe the government_5',
                "priorityTypeC" => 'Claims for death or personal injury while intoxicated_5',
                "priorityTypeD" => 'Other_5',
                "priorityTypeOtherText" => 'Other unsecurecured claim 2.5',
                "totalClaim" => 'undefined_20',
                "priorityAmount" => 'undefined_22',
                "nonpriorityAmount" => 'undefined_25',
                "debtor" => 'check 5',
                "debtorA" => 'debtor 1',
                "debtorB" => 'debtor 2',
                "debtorAandB" => 'debtor 1 and 2',
                "debtorOneOrAnother" => 'one of debtors and another',
                "checkIfThisClaim" => 'Check if this claim relates to a_5',
                "claimSubjectToOffset" => 'check6',
                "contingent" => 'Contingent_5',
                "unliquidated" => 'Unliquidated_5',
                "disputed" => 'Disputed_5',
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function schedule_ef_part2_page1($key)
    {
        $arr = [
            1 => [
                'box_no' => 'undefined_4.4',
                'name' => 'Creditors Name_6',
                'last_4_digits' => 'account number 6',
                'total_claim' => 'Total_26',
                'street' => 'Street_6',
                'debt_incurred' => 'Date debt was incurred_6',
                'city' => 'City 4.1',
                'state' => 'State 4.1',
                'zip' => 'Zip 4.1',
                'contingent_checkbox' => 'Contingent_6',
                'unliquidated_checkbox' => 'Unliquidated_6',
                'disputed_checkbox' => 'Disputed_6',
                'debtor_radio' => 'check 6',
                'debtor_A' => 'debtor 1',
                'debtor_B' => 'debtor 2',
                'debtor_A_and_B' => 'debtor 1 and 2',
                'debtor_one_or_another' => 'On',
                'student_checkbox' => 'Student loans_6',
                'obligations_checkbox' => 'Obligations arising out of divorce_6',
                'check_if_this_clain_checkbox' => 'Check if this claim relates to a_6',
                'debt_checkbox' => 'Debts in pension plans_6',
                'other_checkbox' => 'Other_6',
                'other_textbox' => 'Other unsecurecured claim 4.1',
                'claim_subject_radio' => 'check8',
                'value_no' => 'no',
                'value_yes' => 'yes',
                'value_on' => 'On',
                'page_no' => 'fill_27.1.2',
                'total_page' => 'fill_27.1.3',
            ],
            2 => [
                'box_no' => 'undefined_4.5',
                'name' => 'Creditors Name_7',
                'last_4_digits' => 'account number 7',
                'total_claim' => 'Total_27',
                'street' => 'Street_7',
                'debt_incurred' => 'Date debt was incurred_7',
                'city' => 'City 4.2',
                'state' => 'State 4.2',
                'zip' => 'Zip 4.2',
                'contingent_checkbox' => 'Contingent_7',
                'unliquidated_checkbox' => 'Unliquidated_7',
                'disputed_checkbox' => 'Disputed_7',
                'debtor_radio' => 'check 7',
                'debtor_A' => 'debtor 1',
                'debtor_B' => 'debtor 2',
                'debtor_A_and_B' => 'debtor 1 and 2',
                'debtor_one_or_another' => 'On',
                'student_checkbox' => 'Student loans_7',
                'obligations_checkbox' => 'Obligations arising out of divorce_7',
                'check_if_this_clain_checkbox' => 'Check if this claim relates to a_7',
                'debt_checkbox' => 'Debts in pension plans_7',
                'other_checkbox' => 'Other_7',
                'other_textbox' => 'Other unsecurecured claim 4.2',
                'claim_subject_radio' => 'check9',
                'value_no' => 'no',
                'value_yes' => 'yes',
                'value_on' => 'On',
                'page_no' => 'fill_27.1.2',
                'total_page' => 'fill_27.1.3',
            ],
            3 => [
                'box_no' => 'undefined_4.6',
                'name' => 'Creditors Name_8',
                'last_4_digits' => 'account number 8',
                'total_claim' => 'Total_28',
                'street' => 'Street_8',
                'debt_incurred' => 'Date debt was incurred_8',
                'city' => 'City 4.3',
                'state' => 'State 4.3',
                'zip' => 'Zip 4.3',
                'contingent_checkbox' => 'Contingent_8',
                'unliquidated_checkbox' => 'Unliquidated_8',
                'disputed_checkbox' => 'Disputed_8',
                'debtor_radio' => 'check 8',
                'debtor_A' => 'debtor 1',
                'debtor_B' => 'debtor 2',
                'debtor_A_and_B' => 'debtor 1 and 2',
                'debtor_one_or_another' => 'On',
                'student_checkbox' => 'Student loans_8',
                'obligations_checkbox' => 'Obligations arising out of divorce_8',
                'check_if_this_clain_checkbox' => 'Check if this claim relates to a_8',
                'debt_checkbox' => 'Debts in pension plans_8',
                'other_checkbox' => 'Other_8',
                'other_textbox' => 'Other unsecurecured claim 4.3',
                'claim_subject_radio' => 'check10',
                'value_no' => 'no',
                'value_yes' => 'yes',
                'value_on' => 'On',
                'page_no' => 'fill_27.1.2',
                'total_page' => 'fill_27.1.3',
            ],
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function schedule_ef_part2($key)
    {
        $arr = [
            1 => [
                'box_no' => 'undefined_4.1',
                'name' => 'Creditors Name_9',
                'last_4_digits' => 'account number 9',
                'total_claim' => 'Total_29',
                'street' => 'Street_9',
                'debt_incurred' => 'Date debt was incurred_9',
                'city' => 'City 4.4',
                'state' => 'State 4.4',
                'zip' => 'Zip 4.4',
                'contingent_checkbox' => 'Contingent_9',
                'unliquidated_checkbox' => 'Unliquidated_9',
                'disputed_checkbox' => 'Disputed_9',
                'debtor_radio' => 'check 9',
                'debtor_A' => 'debtor 1',
                'debtor_B' => 'debtor 2',
                'debtor_A_and_B' => 'debtor 1 and 2',
                'debtor_one_or_another' => 'On',
                'student_checkbox' => 'Student loans_9',
                'obligations_checkbox' => 'Obligations arising out of divorce_9',
                'check_if_this_clain_checkbox' => 'Check if this claim relates to a_9',
                'debt_checkbox' => 'Debts in pension plans_9',
                'other_checkbox' => 'Other_9',
                'other_textbox' => 'Other unsecurecured claim 4.4',
                'claim_subject_radio' => 'check11',
                'value_no' => 'no',
                'value_yes' => 'yes',
                'value_on' => 'On',
                'page_no' => 'fill_27.1.4',
                'total_page' => 'fill_27.1.5',
            ],
            2 => [
                'box_no' => 'undefined_4.2',
                'name' => 'Creditors Name_10',
                'last_4_digits' => 'account number 10',
                'total_claim' => 'Total_30',
                'street' => 'Street_10',
                'debt_incurred' => 'Date debt was incurred_10',
                'city' => 'City 4.5',
                'state' => 'State 4.5',
                'zip' => 'Zip 4.5',
                'contingent_checkbox' => 'Contingent_10',
                'unliquidated_checkbox' => 'Unliquidated_10',
                'disputed_checkbox' => 'Disputed_10',
                'debtor_radio' => 'check 10',
                'debtor_A' => 'debtor 1',
                'debtor_B' => 'debtor 2',
                'debtor_A_and_B' => 'debtor 1 and 2',
                'debtor_one_or_another' => 'On',
                'student_checkbox' => 'Student loans_10',
                'obligations_checkbox' => 'Obligations arising out of divorce_10',
                'check_if_this_clain_checkbox' => 'Check if this claim relates to a_10',
                'debt_checkbox' => 'Debts in pension plans_10',
                'other_checkbox' => 'Other_10',
                'other_textbox' => 'Other unsecurecured claim 4.5',
                'claim_subject_radio' => 'check12',
                'value_no' => 'no',
                'value_yes' => 'yes',
                'value_on' => 'On',
                'page_no' => 'fill_27.1.4',
                'total_page' => 'fill_27.1.5',
            ],
            3 => [
                'box_no' => 'undefined_4.3',
                'name' => 'Creditors Name_11',
                'last_4_digits' => 'account number 11',
                'total_claim' => 'Total_31',
                'street' => 'Street_11',
                'debt_incurred' => 'Date debt was incurred_11',
                'city' => 'City 4.6',
                'state' => 'State 4.6',
                'zip' => 'Zip 4.6',
                'contingent_checkbox' => 'Contingent_11',
                'unliquidated_checkbox' => 'Unliquidated_11',
                'disputed_checkbox' => 'Disputed_11',
                'debtor_radio' => 'check 11',
                'debtor_A' => 'debtor 1',
                'debtor_B' => 'debtor 2',
                'debtor_A_and_B' => 'debtor 1 and 2',
                'debtor_one_or_another' => 'On',
                'student_checkbox' => 'Student loans_11',
                'obligations_checkbox' => 'Obligations arising out of divorce_11',
                'check_if_this_clain_checkbox' => 'Check if this claim relates to a_11',
                'debt_checkbox' => 'Debts in pension plans_11',
                'other_checkbox' => 'Other_11',
                'other_textbox' => 'Other unsecurecured claim 4.6',
                'claim_subject_radio' => 'check13',
                'value_no' => 'no',
                'value_yes' => 'yes',
                'value_on' => 'On',
                'page_no' => 'fill_27.1.4',
                'total_page' => 'fill_27.1.5',
            ],
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function schedule_ef_part_3($key)
    {

        $arr = [
            1 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_12',
                'addressLineA' => 'Street_12',
                'addressLineB' => '',
                'city' => 'City 5.1',
                'state' => 'State 5.1',
                'zip' => 'Zip 5.1',
                'last4Digits' => 'account number 12',
                'lineOf' => 'Referenced line 5.1',
                'checkPriority' => 'check14',
            ],
            2 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_13',
                'addressLineA' => 'Street_13',
                'addressLineB' => '',
                'city' => 'City 5.2',
                'state' => 'State 5.2',
                'zip' => 'Zip 5.2',
                'last4Digits' => 'account number 13',
                'lineOf' => 'Referenced line 5.2',
                'checkPriority' => 'check15',
            ],
            3 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_14',
                'addressLineA' => 'Street_14',
                'addressLineB' => '',
                'city' => 'City 5.3',
                'state' => 'State 5.3',
                'zip' => 'Zip 5.3',
                'last4Digits' => 'account number 14',
                'lineOf' => 'Referenced line 5.3',
                'checkPriority' => 'check16',
            ],
            4 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_15',
                'addressLineA' => 'Street_15',
                'addressLineB' => '',
                'city' => 'City 5.4',
                'state' => 'State 5.4',
                'zip' => 'Zip 5.4',
                'last4Digits' => 'account number 15',
                'lineOf' => 'Referenced line 5.4',
                'checkPriority' => 'check17',
            ], 5 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_16',
                'addressLineA' => 'Street_16',
                'addressLineB' => '',
                'city' => 'City 5.5',
                'state' => 'State 5.5',
                'zip' => 'Zip 5.5',
                'last4Digits' => 'account number 16',
                'lineOf' => 'Referenced line 5.5',
                'checkPriority' => 'check18',
            ], 6 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_17',
                'addressLineA' => 'Street_17',
                'addressLineB' => '',
                'city' => 'City 5.6',
                'state' => 'State 5.6',
                'zip' => 'Zip 5.6',
                'last4Digits' => 'account number 17',
                'lineOf' => 'Referenced line 5.6',
                'checkPriority' => 'check19',
            ],
            7 => [
                'noBox' => '',
                'creditorName' => 'Creditors Name_18',
                'addressLineA' => 'Street_18',
                'addressLineB' => '',
                'city' => 'City 5.7',
                'state' => 'State 5.7',
                'zip' => 'Zip 5.7',
                'last4Digits' => 'account number 18',
                'lineOf' => 'Referenced line 5.7',
                'checkPriority' => 'check20'
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function stmtIntNames()
    {
        return [
            0 => [
                'name' => 'Creditors Name 1a',
                'desc' => 'PropertyDescription 1a',
                'check1' => 'check1 1a',
                'check4Explain' => 'Explain2 1a',
                'check2' => 'check2 1a'
            ],
            1 => [
                'name' => 'Creditors Name 1b',
                'desc' => 'PropertyDescription 1b',
                'check1' => 'check1 1b',
                'check4Explain' => 'Explain2 1b',
                'check2' => 'check2 1b'
            ],
            2 => [
                'name' => 'Creditors Name 1c',
                'desc' => 'PropertyDescription 1c',
                'check1' => 'check1 1c',
                'check4Explain' => 'Explain2 1c',
                'check2' => 'check2 1c'
            ],
            3 => [
                'name' => 'Creditors Name 1d',
                'desc' => 'PropertyDescription 1d',
                'check1' => 'check1 1d',
                'check4Explain' => 'Explain2 1d',
                'check2' => 'check2 1d'
            ]
        ];
    }

    public static function schedule_c_part2($key)
    {
        $arr = [
            1 => [
                'description' => 'B_106-description_4',
                'currentValue' => 'B_106-undefined_11',
                'claimCheckbox' => 'B_106-check 4',
                'claimValue' => 'B_106-undefined_12',
                'law' => 'B_106-3',
                'line' => 'B_106-Line from'
            ],
            2 => [
                'description' => 'B_106-description_5',
                'currentValue' => 'B_106-undefined_13',
                'claimCheckbox' => 'B_106-check 5',
                'claimValue' => 'B_106-undefined_26',
                'law' => 'B_106-4',
                'line' => 'B_106-Schedule AB_4'
            ],
            3 => [
                'description' => 'B_106-description_6',
                'currentValue' => 'B_106-undefined_27',
                'claimCheckbox' => 'B_106-check 6',
                'claimValue' => 'B_106-undefined_28',
                'law' => 'B_106-5',
                'line' => 'B_106-Schedule AB_5'
            ],
            4 => [
                'description' => 'B_106-description_7',
                'currentValue' => 'B_106-undefined_29',
                'claimCheckbox' => 'B_106-check 7',
                'claimValue' => 'B_106-undefined_30',
                'law' => 'B_106-6',
                'line' => 'LB_106-ine from_2'
            ],
            5 => [
                'description' => 'B_106-description_8',
                'currentValue' => 'B_106-undefined_31',
                'claimCheckbox' => 'B_106-check 8',
                'claimValue' => 'B_106-undefined_32',
                'law' => 'B_106-7',
                'line' => 'B_106-Schedule AB_6'
            ],
            6 => [
                'description' => 'B_106-description_9',
                'currentValue' => 'B_106-undefined_34',
                'claimCheckbox' => 'B_106-check 9',
                'claimValue' => 'B_106-undefined_35',
                'law' => 'B_106-8',
                'line' => 'B_106-Schedule AB_7'
            ],
            7 => [
                'description' => 'B_106-description_10',
                'currentValue' => 'B_106-undefined_36',
                'claimCheckbox' => 'cB_106-heck 10',
                'claimValue' => 'B_106-undefined_37',
                'law' => 'B_106-9',
                'line' => 'B_106-Line from_3'
            ],
            8 => [
                'description' => 'B_106-description_11',
                'currentValue' => 'B_106-undefined_38',
                'claimCheckbox' => 'B_106-check 11',
                'claimValue' => 'B_106-undefined_39',
                'law' => 'B_106-10',
                'line' => 'B_106-Schedule AB_8'
            ],
            9 => [
                'description' => 'B_106-description_12',
                'currentValue' => 'B_106-undefined_40',
                'claimCheckbox' => 'B_106-check 12',
                'claimValue' => 'B_106-undefined_41',
                'law' => 'B_106-11',
                'line' => 'B_106-Schedule AB_9'
            ],
            10 => [
                'description' => 'B_106-description_13',
                'currentValue' => 'B_106-undefined_42',
                'claimCheckbox' => 'B_106-check 13',
                'claimValue' => 'B_106-undefined_43',
                'law' => 'B_106-12',
                'line' => 'B_106-Line from_4'
            ],
            11 => [
                'description' => 'B_106-description_14',
                'currentValue' => 'B_106-undefined_44',
                'claimCheckbox' => 'B_106-check 14',
                'claimValue' => 'B_106-undefined_45',
                'law' => 'B_106-13',
                'line' => 'B_106-Schedule AB_10'
            ],
            12 => [
                'description' => 'B_106-description_15',
                'currentValue' => 'B_106-undefined_47',
                'claimCheckbox' => 'B_106-check 15',
                'claimValue' => 'B_106-undefined_48',
                'law' => 'B_106-14',
                'line' => 'B_106-Schedule AB_11'
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function schedule_c_part1($key)
    {
        $arr = [
            1 => [
                'description' => 'B_106-description',
                'currentValue' => 'B_106-undefined',
                'claimCheckbox' => 'check1.0.0',
                'claimValue' => 'B_106-undefined_2',
                'law' => 'B_106-2.1',
                'line' => 'B_106-Schedule AB'
            ],
            2 => [
                'description' => 'B_106-description_2',
                'currentValue' => 'B_106-undefined_6',
                'claimCheckbox' => 'B_106-check 2.2',
                'claimValue' => 'B_106-undefined_7',
                'law' => 'B_106-2.2',
                'line' => 'B_106-Schedule AB_2'
            ],
            3 => [
                'description' => 'B_106-description_3',
                'currentValue' => 'B_106-undefined_8',
                'claimCheckbox' => 'B_106-check 2.3',
                'claimValue' => 'B_106-undefined_9',
                'law' => 'B_106-2.3',
                'line' => 'B_106-Schedule AB_3'
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getEfArray()
    {
        return ['b106ef',
        'b106ef_part1_pdf1',
        'b106ef_part1_pdf2',
        'b106ef_part1_pdf3',
        'b106ef_part2',
        'b106ef_part2_pdf2',
        'b106ef_part2_pdf3',
        'b106ef_part2_pdf4',
        'b106ef_part2_pdf5',
        'b106ef_part2_pdf6',
        'b106ef_part2_pdf7',
        'b106ef_part2_pdf8',
        'b106ef_part2_pdf9',
        'b106ef_part2_pdf10',
        'b106ef_part2_pdf11',
        'b106ef_part2_pdf12',
        'b106ef_part2_pdf13',
        'b106ef_part2_pdf14',
        'b106ef_part2_pdf15',
        'b106ef_part2_pdf16',
        'b106ef_part2_pdf17',
        'b106ef_part2_pdf18',
        'b106ef_part3_pdf1',
        'b106ef_part3_pdf2',
        'b106ef_part3_pdf3',
        'b106ef_part3_pdf4',
        'b106ef_part3_pdf5',
        'b106ef_part3_pdf6',
        'b106ef_part3_pdf7',
        'b106ef_part3_pdf8',
        'b106ef_part3_pdf9',
        'b106ef_part4'];
    }

    public static function getHArray()
    {
        return ['b106h',
        "106h_pdf1",
        "106h_pdf2",
        "106h_pdf3",
        "106h_pdf4",
        "106h_pdf5",
        "106h_pdf6",
        "106h_pdf7",
        "106h_pdf8",
        "106h_pdf9",
        "106h_pdf10"];
    }

    public static function getStmtIntArray()
    {
        return ["b108",
        "b108_pdf1",
        "b108_pdf2",
        "b108_pdf3",
        "b108_pdf4",
        "b108_pdf5",
        "b108_pdf6",
        "b108_pdf7",
        "b108_pdf8",
        "b108_last"];
    }

    public static function getDarray()
    {
        return  ['b106d',
        'b106d_part1_add1',
        'b106d_part1_add2',
        'b106d_part1_add3',
        'b106d_part1_add4',
        'b106d_part1_add5',
        'b106d_part1_add6',
        'b106d_part1_add7',
        'b106d_part2_add1',
        'b106d_part2_add2',
        'b106d_part2_add3',
        'b106d_part2_add4',
        'b106d_part2_add5',
     ];
    }

    public static function getCarray()
    {
        return  [
            'b_106c',
            'b_106c_add_1',
            'b_106c_add_2',
            'b_106c_add_3',
            'b_106c_add_4',
            'b_106c_add_5',
            'b_106c_add_6',
            'b_106c_add_7',
            'b_106c_add_8',
            'b_106c_add_9'
        ];
    }

    public static function chapter13Hide($district_id)
    {
        return  self::isChapterThirteenEnabled($district_id) ? "" : 'hide-data';
    }

    public static function isChapterThirteenEnabled($district_id)
    {
        return \App\Models\Districts::where(['id' => $district_id, 'is_chapter_thirteen_enable' => 1])->exists();

    }



}
