<?php

namespace App\Helpers;

use App\Services\Client\CacheBasicInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ArrayHelper extends Helper
{
    public static function getSpacingTypeArray($key = null)
    {
        $arr = [
            self::TEXT_SPACING_SINGLE => "Single Line",
            self::TEXT_SPACING_TWO => "Two Lines",
            self::TEXT_SPACING_THREE => "Three Lines"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getFontSizeArray($key = null)
    {
        $arr = [
            self::FONT_SIZE_NORMAL => "Normal",
            self::FONT_SIZE_SMALL => "Small",
            self::FONT_SIZE_MEDIUM => "Medium",
            self::FONT_SIZE_LARGE => "Large"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getFontSizeSelection($code = '')
    {
        $sizearrayList = self::getFontSizeArray();

        return self::createSelectionFromArray($sizearrayList, $code);
    }

    public static function getTextSpacingSelection($code = '')
    {
        $spacingarrayList = self::getSpacingTypeArray();

        return self::createSelectionFromArray($spacingarrayList, $code);
    }

    public static function getFontStyleArray($key = null)
    {
        $arr = [
            self::FONT_STYLE_NORMAL => "Normal",
            self::FONT_STYLE_UPPERCASE => "Uppercase",
            self::FONT_STYLE_CAPITALIZE => "Capitalize",
            self::FONT_STYLE_LOWERCASE => "Lowercase"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getFontStyleSelection($code = '')
    {
        $stylearrayList = self::getFontStyleArray();

        return self::createSelectionFromArray($stylearrayList, $code);
    }

    public static function getClientTypeArray($key = null, $excludebasic = false, $ultimateType = false, $basicPlus = false, $premiumPlus = false, $ultimatePlus = false)
    {
        $str = '';
        if ($excludebasic == true) {
            $str = '(Additional $' . \App\Models\AttorneySubscription::JOINT_DEBTOR_ADDITIONAL_PRICE . ')';
        }
        if ($ultimateType == true) {
            $str = '(Additional $' . \App\Models\AttorneySubscription::JOINT_DEBTOR_ULTIMATE_ADDITIONAL_PRICE . ')';
        }
        if ($basicPlus == true) {
            $str = '(Additional $' . \App\Models\AttorneySubscription::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL_PRICE . ')';
        }
        if ($premiumPlus == true) {
            $str = '(Additional $' . \App\Models\AttorneySubscription::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL_PRICE . ')';
        }
        if ($ultimatePlus == true) {
            $str = '(Additional $' . \App\Models\AttorneySubscription::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL_PRICE . ')';
        }

        $string = "Married BOTH Spouses Filing " . $str;
        $arr = [
            static::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => "Single Not Married",
            static::CLIENT_TYPE_INDIVIDUAL_MARRIED => "Married NOT Filing with Spouse",
            static::CLIENT_TYPE_JOINT_MARRIED => $string
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPayrollAssistantArray($key = null)
    {
        $arr = [
            0 => "None",
            static::PAYROLL_ASSISTANT_TYPE_DEBTOR => "Debtor 1",
            static::PAYROLL_ASSISTANT_TYPE_CODEBTOR => "Debtor 2 - Spouse",
            static::PAYROLL_ASSISTANT_TYPE_BOTH => "Debtor 1 & 2"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getClientTypeLabelArray($key = null)
    {
        $arr = [
            static::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => "Single Not Married",
            static::CLIENT_TYPE_INDIVIDUAL_MARRIED => "Married NOT Filing with Spouse",
            static::CLIENT_TYPE_JOINT_MARRIED => "Married BOTH Spouses Filing"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getClientTypeSelection($code = '', $excludebasic = false, $ultimateType = false, $basicPlus = false, $premiumPlus = false, $ultimatePlusType = false)
    {
        $ctypearrayList = self::getClientTypeArray(null, $excludebasic, $ultimateType, $basicPlus, $premiumPlus, $ultimatePlusType);

        return self::createSelectionFromArray($ctypearrayList, $code);
    }

    public static function getActiveInactiveArray($key = null)
    {
        $arr = [
            static::ACTIVE => "Active",
            static::INACTIVE => "Archived"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function installmentPaymentArray($key = null)
    {
        $arr = [
            1 => "Car Payment for Vehicle 1",
            2 => "Car Payment for Vehicle 2",
            3 => "Car Payment for Vehicle 3",
            4 => "Car Payment for Vehicle 4",
            5 => "Car Payment for Recreational 1",
            6 => "Car Payment for Recreational 2",
            7 => "Other (Describe)",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function installmentPaymentSelection($code = null)
    {
        $installarrayList = self::installmentPaymentArray();

        return self::createSelectionFromArray($installarrayList, $code);
    }

    public static function getMartialStatus($key = null)
    {
        $arr = [
            self::SINGLE => 'Single',
            self::STATUS_MARRIED => 'Married',
            self::SEPERATED => 'Seperated',
            self::DIVORCED => 'Divorced',
            self::WIDOWED => 'Widowed'
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getMarriedArray($key = null)
    {
        $arr = [
            self::MARRIED => "Married",
            self::UNMARRIED => "Single not Married"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getYesNoArray($key = null)
    {
        $arr = [
            self::YES => "Yes",
            self::NO => "No"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getYesNoArrayNoneType($key = null)
    {
        $arr = [
            self::YES => "",
            self::NO => "None"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPaymentStatusArray($key = null)
    {
        $arr = [
            self::SUCCESS => "Success",
            self::FAILED => "Failed"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function securityDepositedArray($key = null, $return = 0)
    {
        $arr = [
            self::SECURITY_ELECTRONIC => "Electric",
            self::SECURITY_GAS => "Gas",
            self::SECURITY_HEATING_OIL => "Heating Oil",
            self::SECURITY_ON_RENTAL_UNIT => "Security deposit on rental unit",
            self::SECURITY_PREPAID_RENT => "Prepaid rent",
            self::SECURITY_TELEPHONE => "Telephone",
            self::SECURITY_WATER => "Water",
            self::SECURITY_RENTAL_FURNITURE => "Rented furniture",
            self::SECURITY_OTHER => "Other"
        ];
        if ($return) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function securityDepositedSelection($code = '')
    {
        $secdeparrayList = self::securityDepositedArray();

        return self::createSelectionFromArray($secdeparrayList, $code);
    }

    public static function accountTypeArray($key = null, $return = 0)
    {
        $arr = [
            self::ACT_TYPE_401K => "401(k) or similar plan",
            self::ACT_TYPE_PENSION_PLAN => "Pension plan",
            self::ACT_TYPE_IRA => "IRA",
            self::ACT_TYPE_RETIREMENT => 'Retirement account',
            self::ACT_TYPE_KEOGH => "Keogh",
            self::ACT_TYPE_ADDITIONAL => "Additional account"
        ];
        if ($return) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function accountTypeSelection($code = '')
    {
        $actypearrayList = self::accountTypeArray();

        return self::createSelectionFromArray($actypearrayList, $code);
    }

    public static function getSuffixArray($key = null)
    {
        $arr = [
            self::SUFFIX_SR => 'Sr.',
            self::SUFFIX_JR => 'Jr.',
            self::SUFFIX_II => 'II',
            self::SUFFIX_III => 'III'
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getExpenseTypeArray($key = null)
    {
        $arr = [
            self::GROSS_BUSINESS_INCOME => 'Gross business Income',
            self::COST_OF_GOODS_SOLD => 'Cost of goods sold',
            self::ADVERTISING_EXPENSE => 'Marketing and Advertising',
            self::SUBCONTRACTOR_PAY => 'Subcontractor Pay',
            self::PROFESSIONAL_SERVICE => 'Professional Services',
            self::CC_EXPENSE => 'Credit/Debit Card',
            self::EQUIPMENT_RENTAL_EXPENSE => 'Equipment Rental/Lease',
            self::INSURANCE_EXPENSE => 'Insurance Expense(s)',
            self::LICENSES_EXPENSE => 'Licenses/Permits',
            self::OFFICE_SUPPLIES_EXPENSE => 'Office Supplies',
            self::POSTAGE_EXPENSE => 'Postage and Delivery',
            self::RENT_OFFICE_EXPENSE => 'Repairs and Maintenance',
            self::BANK_FEE_AND_INTEREST => 'Bank Fees and Interest',
            self::SOFTWARE_AND_SUBSCRIPTION => 'Software and Subscriptions',
            self::SUPPLIES_MATERIAL_EXPENSE => 'Supplies/Materials Expense',
            self::TRAVEL_EXPENSE => 'Travel/Entertainment',
            self::UTILITY_EXPENSE => 'Utilities Expense',
            self::VEHICLE_EXPENSE => 'Vehicle Expense',
            self::OTHER_1 => 'Other Expense 1',
            self::OTHER_2 => 'Other Expense 2',
            self::OTHER_3 => 'Other Expense 3'
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getMajotLawFirmProfitLossLabels($attorney_id = null, $key = null)
    {
        if (!empty($attorney_id) && $attorney_id == 54695) {
            $arr = [
                self::GROSS_BUSINESS_INCOME => 'Part A- 1. ACTUAL GROSS MONTHLY INCOME',
                'monthly_expsens' => 'Part B- 2. ACTUAL MONTHLY EXPENSES',
                self::COST_OF_GOODS_SOLD => '3. Net Employee Payroll (Other than Debtor)',
                self::ADVERTISING_EXPENSE => '4. Payroll Taxes',
                self::SUBCONTRACTOR_PAY => '5. Unemployment Taxes',
                self::PROFESSIONAL_SERVICE => '6. Worker’s Compensation',
                self::CC_EXPENSE => '7. Other Taxes',
                self::EQUIPMENT_RENTAL_EXPENSE => '8. Inventory Purchases (Including raw materials)',
                self::INSURANCE_EXPENSE => '9. Purchase of Feed/Fertilizer/Seed/Spray',
                self::LICENSES_EXPENSE => '10. Rent (Other than debtor’s principal residence)',
                self::OFFICE_SUPPLIES_EXPENSE => '11. Utilities',
                self::POSTAGE_EXPENSE => '12. Office Expenses and Supplies',
                self::RENT_OFFICE_EXPENSE => '13. Repairs and Maintenance',
                self::BANK_FEE_AND_INTEREST => '14. Vehicle Expenses',
                self::SOFTWARE_AND_SUBSCRIPTION => '15. Travel and Entertainment',
                self::SUPPLIES_MATERIAL_EXPENSE => '16. Equipment Rental and Leasese',
                self::TRAVEL_EXPENSE => '17. Legal/Accounting/Other Professional Fees',
                self::UTILITY_EXPENSE => '18. Insurance',
                self::VEHICLE_EXPENSE => '19. Employee Benefits (e.g., pension, medical, etc.)',
                self::OTHER_1 => '20. Payments Made Directly by Debtor to Secured Creditors for Pre-Petition Business Debts (Specify)',
                self::OTHER_2 => '21. Other (Specify)',
                self::OTHER_3 => '',
                "total_monthly_expenses" => '22.Total Monthly Expenses (Add Items 3-21)',
                'net_monthly_income' => 'Part C- NET MONTHLY INCOME (Subtract #22 from #1)',
                'labels' => false
            ];
        } else {
            $arr = self::getExpenseTypeArray();
            $arr['monthly_expsens'] = 'Business Costs:';
            $arr['total_monthly_expenses'] = 'Total Operating Expenses';
            $arr['net_monthly_income'] = 'Profit and/or Loss from Business';
            $arr['labels'] = true;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getAccountArray($code = '', $return = 0)
    {
        $accntarray = [
            self::CHECKING_ACNT => "Checking account",
            self::SAVING_ACNT => "Saving account",
            self::CERTIF_DEPT => "Certificates of deposit",
            self::OTHER_FINANCIAL => "Other financial",
        ];
        if ($return) {
            return $accntarray;
        }
        $acclist = '';
        foreach ($accntarray as $key => $account) {
            $selected = !empty($code) && $code == $key ? 'selected' : '';
            $acclist .= "<option value='" . $key . "' " . $selected . ">" . $account . "</option>";
        }

        return $acclist;
    }

    public static function getIndex($property)
    {
        $property_type = 0;
        if (!empty($property['type_value'])) {
            $property_type = self::getPropertyType($property['type_value']);
        }

        return $property_type;
    }

    public static function getPropertyType($propertyTypeValue)
    {
        switch ($propertyTypeValue) {
            case 'cash':
                $property_type = 16;
                break;
            case 'bank':
            case 'venmo_paypal_cash':
            case 'brokerage_account':
            case 'savings_account':
            case 'other_financial_account':
                $property_type = 17;
                break;
            case 'mutual_funds':
                $property_type = 18;
                break;
            case 'traded_stocks':
                $property_type = 19;
                break;
            case 'government_corporate_bonds':
                $property_type = 20;
                break;
            case 'retirement_pension':
                $property_type = 21;
                break;
            case 'security_deposits':
                $property_type = 22;
                break;
            case 'annuities':
                $property_type = 23;
                break;
            case 'education_ira':
                $property_type = 24;
                break;
            case 'trusts_life_estates':
                $property_type = 25;
                break;
            case 'patents_copyrights':
                $property_type = 26;
                break;
            case 'licenses_franchises':
                $property_type = 27;
                break;
            case 'tax_refunds':
                $property_type = 28;
                break;
            case 'alimony_child_support':
                $property_type = 29;
                break;
            case 'unpaid_wages':
                $property_type = 30;
                break;
            case 'life_insurance':
            case 'insurance_policies':
                $property_type = 31;
                break;
            case 'inheritances':
                $property_type = 32;
                break;
            case 'injury_claims':
                $property_type = 33;
                break;
            case 'lawsuits':
                $property_type = 34;
                break;
            case 'other_claims':
                $property_type = 35;
                break;
            default:
                $property_type = 36;
                break;
        }

        return $property_type;
    }

    public static function getAccountKeyValue($key = '')
    {
        $arr = [
            self::CHECKING_ACNT => "Checking account",
            self::SAVING_ACNT => "Saving account",
            self::CHECKING_SAVING_ACNT => "Checking & Saving Account",
            self::CERTIF_DEPT => "Certificates of deposit",
            self::OTHER_FINANCIAL => "Other financial",
            self::BROKERAGE_ACCOUNT => "Brokerage account",
            self::CREDIT_UNION => "Credit Union",
            "paypal_account_1" => "PayPal - Account 1",
            "paypal_account_2" => "PayPal - Account 2",
            "paypal_account_3" => "PayPal - Account 3",
            "cash_account_1" => "Cash App - Account 1",
            "cash_account_2" => "Cash App - Account 2",
            "cash_account_3" => "Cash App - Account 3",
            "venmo_account_1" => "Venmo - Account 1",
            "venmo_account_2" => "Venmo - Account 2",
            "venmo_account_3" => "Venmo - Account 3",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPropertyAccountName($key = '', $desc = '')
    {
        $key = strtolower(self::getAccountKeyValue($key));
        if (!empty($desc)) {
            $key = str_replace('- account', $desc, $key);
        }
        $key = ucwords($key);

        return $key;
    }

    public static function getHouseholdItemsList($key = '')
    {
        $itemList = [
            self::BEDROOM_FURNITURE => "Bedroom Furniture",
            self::COOKING_UTENSILS => "Lawn Furniture",
            self::COOKWARE_POTS_AND_PANS => "Cookware (pots & pans)",
            self::DINING_ROOM_FURNITURE => "Dining Room Furniture",
            self::DRESSERS_NIGHTSTANDS => "Dishwasher",
            self::LAMPS_AND_ACCESSORIES => "Spa/Hot Tub",
            self::LAWN_MOVER => "Lawn Mower",
            self::LIVING_ROOM_FURNITURE => "Living Room Furniture",
            self::MICROWAVE => "Microwave",
            self::REFRIGERATOR => "Refrigerator",
            self::SILVERWARE_FLATWARE => "Silverware",
            self::STOVE_COOKING_UNIT => "Stove/Cooking Unit",
            self::TABLES_AND_CHAIRS => "Large Freezer",
            self::WASHER_DRYER => "Washer/Dryer",
            self::PLATES_CHINA => "Plates, China Etc.",
        ];
        if (!empty($key)) {
            return static::returnArrValue($itemList, $key);
        } else {
            return $itemList;
        }
    }

    public static function getElectronicItemsList($key = '')
    {
        $itemList = [
            self::CAMCORDER => "Camcorder",
            self::CELL_PHONES => "Cell Phone(s)",
            self::COMPACT_DISKS => "Power Tool(s)",
            self::COMPUTER_PRINTERS => "Computer Printers",
            self::COMPUTERS => "Computer(s)",
            self::DESK_OFFICE_FURNITURE => "Small Appliance(s)",
            self::DVD_PLAYERS => "DVD Players",
            self::DVDS => "Dvd's/CD's",
            self::OTHER_COMPUTER_EQUIPMENT => "Other Computer Equipment",
            self::PHOTOGRAPHY_EQUIPMENT => "Photography Equipment",
            self::SATELLITE_DISKS => "Household Tool(s)",
            self::STEREO_EQUIPMENT => "Stereo Equipment",
            self::TELEVISION => "Television(s)",
            self::VCRS => "VCR's",
            self::YARD_TOOLS_EQUIPMENTS => "Yard Tools/Equipment",
        ];

        if (!empty($key)) {
            return static::returnArrValue($itemList, $key);
        } else {
            return $itemList;
        }
    }

    public static function getCollectiblesList($key = '')
    {
        $itemList = [
            self::ARTWORK => "Artwork",
            self::ANTIQUES => "Antiques",
            self::PIANO => "Piano",
            self::PAINTINGS_PRINTS => "Paintings & Prints",
            self::MEMORABILIA => "Memorabilia",
            self::COLLECTIBLES => "Collectibles",
            self::STAMPS => "Stamps",
            self::COINS => "Coins",
            self::GOLD_SILVER_BULLION => "Gold/Silver/Bullion",
            self::FIGURINES => "Figurines",
            self::CARD_COLLECTIONS => "Card Collections",
            self::OTHER_COLLECTIONS => "Other Collectioons"
        ];

        if (!empty($key)) {
            return static::returnArrValue($itemList, $key);
        } else {
            return $itemList;
        }
    }

    public static function getHobbyEquipmentsList($key = '')
    {
        $itemList = [
            self::SPORTS_EQUIPMENT => "Sports Equipment",
            self::PHOTOGRAPHIC_EQUIP => "Photographic Equip.",
            self::EXERCISE_EQUIP => "Exercise Equip.",
            self::BICYCLES => "Bicycles",
            self::POOL_TABLE_GAMING_EQUIP => "Pool Tables/Gaming Equip.",
            self::CARPENTRY_TOOLS => "Carpentry Tools",
            self::MUSICAL_INSTRUMENTS => "Musical Instruments",
            self::PIANO_EQUIP => "Piano",
            self::OTHER_HOBBY_EQUIP => "Other Hobby Equipment"
        ];

        if (!empty($key)) {
            return static::returnArrValue($itemList, $key);
        } else {
            return $itemList;
        }
    }

    public static function getJewelryItemsList($key = '')
    {
        $itemList = [
            self::FURS => "Furs",
            self::OTHER_JEWELRY_WATCHES => "Other Jewelry/watches",
            self::WEDDING_RING => "Wedding Ring",
        ];

        if (!empty($key)) {
            return static::returnArrValue($itemList, $key);
        } else {
            return $itemList;
        }
    }

    public static function getVehiclesArray($code = '', $return = 0)
    {

        $arrayList = [
            self::VEHICLE_CARS_TK => "Vehicle (Cars, vans, trucks, tractors, sport utility vehicles)",
            self::VEHICLE_MOTORCYCLE => "Motorcycle",
            self::VEHICLE_WATERCRAFT => "Watercraft",
            self::VEHICLE_AIRCRAFT => "Aircraft",
            self::VEHICLE_MOTOR_HOME => "Motor Home",
            self::VEHICLE_RECREATINAL_VEHICLE => "Recreational Vehicles"
        ];
        if ($return) {
            return $arrayList;
        }

        return static::returnArrValue($arrayList, $code);
    }

    public static function getVehiclesTypeArray($code = '', $return = 0)
    {

        $arrayList = [
            self::VEHICLE_CARS_TK => "Vehicle",
            self::VEHICLE_RECREATINAL_VEHICLE => "Recreational"
        ];
        if ($return) {
            return $arrayList;
        }

        return static::returnArrValue($arrayList, $code);
    }

    public static function getDebtCardSelections()
    {
        return [
            '' => "Choose Debt",
            '2' => "Credit Card Debt (Such as Visa, Mastercard, American Express, etc.)",
            '3' => "Collection, Past Due, and/or Charged Off Account",
            '8' => "Medical Debt",
            '6' => "Law Suit (Pending or concluded as judgment)",
            '7' => "Cash Advance",
            '5' => "Student Loan",
            '4' => "Other Debt (Any type of unsecured debt not already listed)",
        ];
    }

    public static function getDebtCardSelectionsForAttorney($key = null)
    {
        $arr = [
            '1' => "Choose Debt",
            '2' => "Credit card purchases",
            '3' => "Collection Account",
            '8' => "Medical Debt",
            '6' => "Law Suit",
            '7' => "Cash Advances",
            '5' => "Student Loan",
            '4' => "Other Debt",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getFinancialPropArray()
    {
        return [
            self::FATYPE_SUPPORT => 'Child Support 1',
            self::FATYPE_SUPPORT_2 => 'Child Support 2',
            self::FATYPE_SUPPORT_3 => 'Child Support 3',
            self::FATYPE_ALIMONY => 'Alimony',
            self::FATYPE_MAINTENANCE => 'Maintenance',
            self::FATYPE_DIVORCE_SETTLEMENT => 'Divorce Settlement',
            self::FATYPE_PROPERTY_SETTLEMENT => 'Property Settlement'
        ];
        ;
    }

    public static function getFinancialProp($key = null)
    {
        $arr = self::getFinancialPropArray();
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getFinancialPropTypeSelection($code = '')
    {
        $mvarrayList = self::getFinancialPropArray();

        return self::createSelectionFromArray($mvarrayList, $code);
    }

    public static function getTaxesArrayForPaystub($key = null)
    {
        $arr = [
            1 => "Federal Income Tax",
            2 => "State Income Tax",
            3 => "Medicare Tax",
            4 => "Social Security Tax",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getDeductionArrayForPaystub($key = null)
    {
        $arr = [
            'deduction1' => "Mandatory Retirement",
            'deduction2' => "Voluntary Retirement",
            'deduction3' => "Life Insurance",
            'deduction4' => "Health Insurance",
            'deduction5' => "Disability Insurance",
            'deduction6' => "Health Savings Account",
            'deduction7' => "Child Support",
            'deduction8' => "Alimony",
            'deduction9' => "Union Dues",
            'deduction10' => "Retirement Loan Repayment"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPropertyFinancialOwedTypeArray($key = null)
    {
        $arr = [
            1 => 'Unpaid wages',
            // 2 => 'Disability insurance payments',
            3 => 'Disability benefits',
            4 => 'Sick pay',
            5 => 'Vacation pay',
            6 => 'Worker’s compensation',
            7 => 'Social Security benefits',
            8 => 'VA Benefits',
            9 => 'Unpaid loans someone else owes you',
            10 => 'Unemployment Benefits',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getBasicInfoBussinessTypeArray($key = null)
    {
        $arr = [
            1 => 'Limited Liability Company (LLC)',
            2 => 'S or C Corporation (Inc.)',
            3 => 'Sole Proprietorship',
            4 => 'Partnership',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getBasicInfoBussinessDescriptionArray($key = null)
    {
        $arr = [
            1 => 'Health Care Business (as defined in U.S.C 101(27A))',
            2 => 'Single Asset Real Estate (as defined in U.S.C 101(51B))',
            3 => 'Stockbroker (as defined in U.S.C 101(53A))',
            4 => 'Commodity Broker (as defined in U.S.C 101(6))',
            5 => 'None of the above',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getStreamingUtilities($key = null)
    {
        $arr = [
            1 => 'Amazon Prime Video',
            2 => 'Netflix',
            3 => 'Hulu',
            4 => 'Peacock',
            5 => 'Paramount+',
            6 => 'Apple TV+',
            7 => 'Fubo',
            8 => 'Sling TV',
            9 => 'Youtube TV',
            10 => 'Funimation',
            11 => 'DirecTV Stream',
            12 => 'ESPN',
            13 => 'HBO Max',
            14 => 'Pluto TV',
            15 => 'AMC+',
            16 => 'Disney Plus',
            17 => 'Hotstar',
            18 => 'Max',
            19 => 'Philo',
            20 => 'STARZ',
            21 => 'Tubi',
            22 => 'Xumo',
            23 => 'Acron TV',
            24 => 'Amazon Freevee',
            25 => 'Internet',
            26 => 'Cable',
            27 => 'Satellite',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getEmployerType($key = null)
    {
        $arr = [
            1 => 'Current Employer',
            2 => 'Previous Employer',
            99 => 'Additional Current Employer',
        ];
        if (array_key_exists($key, $arr)) {
            return $arr[$key];
        } else {
            return 'Employer';
        }
    }

    public static function getEmployerTypeArray($key = null)
    {
        $arr = [
            1 => 'Current Employer',
            2 => 'Previous Employer',
            99 => 'Add Additional Current Employer',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPayrollAssitantSelection($code = '')
    {
        $rollarrayList = self::getPayrollAssistantArray();

        return self::createSelectionFromArray($rollarrayList, $code);
    }

    public static function getManageNotificationArray($key = null)
    {
        $arr = [
            // attorney emails
            'attorney_onepage_que_submit_mail' => 'OnePage questionnaire request email',
            'attorney_client_first_login_mail' => 'Client first login email',
            'attorney_signed_document_viewed_by_client_mail' => 'Signed document viewed by client email',
            'attorney_signed_document_sent_by_client_mail' => 'Signed document sent by client email',
            'attorney_client_sent_requested_doc_mail' => 'Client sent requested document email',
            // paralegal emails
            // client emails
            'client_resend_invite_mail' => 'Resend invite to client email',
            'client_paralegal_assigned_mail' => 'Paralegal assigned email',
            'client_doc_status_mail' => 'Document status notification email',
            'client_signed_doc_sent_mail' => 'Signed document sent by attorney email',
            'client_requested_doc_mail' => 'Notify client for requested documents email',
            'client_que_edit_request_mail' => 'Question edit request email',
            'client_automated_process_overview_mail' => 'Automated Process Overview Call email',
            'client_automated_login_check_corn_mail' => 'Automated Login Check Corn email',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getManageNotificationAdminArray($key = null)
    {
        $arr = [
            // attorney emails
            'attorney_subscription_credited_mail' => 'Subscription credited to attorney email',
            'attorney_concierge_client_activate_mail' => 'Admin marked the concierge service done for your client email',
            'attorney_concierge_auto_generated_mail' => 'Admin sent message from email notification',
            // client emails
            'client_resend_invite_mail' => 'Resend invite to client email',
            'client_paralegal_assigned_mail' => 'Paralegal assigned email',
            'client_doc_status_mail' => 'Document status notification email',
            'client_signed_doc_sent_mail' => 'Signed document sent by attorney email',
            'client_requested_doc_mail' => 'Notify client for requested documents email',
            'client_que_edit_request_mail' => 'Question edit request email',
            'client_automated_process_overview_mail' => 'Automated Process Overview Call email',
            'client_automated_login_check_corn_mail' => 'Automated Login Check Corn email',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getManageNotificationForArray($key = null)
    {
        $arr = [
            // attorney emails
            'attorney_onepage_que_submit_mail' => 'Attorney',
            'attorney_client_first_login_mail' => 'Attorney',
            'attorney_signed_document_viewed_by_client_mail' => 'Attorney',
            'attorney_signed_document_sent_by_client_mail' => 'Attorney',
            'attorney_client_sent_requested_doc_mail' => 'Attorney',
            // attorney emails ADMIN SIDE
            'attorney_subscription_credited_mail' => 'Attorney',
            'attorney_concierge_client_activate_mail' => 'Attorney',
            'attorney_concierge_auto_generated_mail' => 'Attorney',
            // paralegal emails

            // client emails
            'client_resend_invite_mail' => 'Client',
            'client_paralegal_assigned_mail' => 'Client',
            'client_doc_status_mail' => 'Client',
            'client_signed_doc_sent_mail' => 'Client',
            'client_requested_doc_mail' => 'Client',
            'client_que_edit_request_mail' => 'Client',
            'client_automated_process_overview_mail' => 'Client',
            'client_automated_login_check_corn_mail' => 'Client',
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getAttorneySidebar($isParalegal = false)
    {

        $arr = [
            [
                'icon' => 'bi bi-house',
                'name' => 'Dashboard',
                'route' => 'attorney_dashboard',
            ],
            [
                'icon' => 'bi bi-briefcase',
                'name' => 'Client Management',
                'route' => 'attorney_client_management',
            ],
            [
                'icon' => 'bi bi-list-check',
                // 'name' => 'Initial Client Intake<br><small>(No Charge - Free)</small>',
                'name' => 'Initial Client Intake',
                'subtext' => '(No Charge - Free)',
                'route' => 'questionnaire_index',
            ],
            [
                'icon' => 'bi bi-person-circle',
                'name' => 'Manage Profile',
                'route' => 'attorney_profile',
            ],
            [
                'icon' => 'bi bi-gear',
                'name' => 'Manage Settings',
                'route' => 'attorney_settings',
            ],
            [
                'icon' => 'bi bi-people',
                'name' => 'Paralegal Management',
                'route' => 'attorney_paralegal_management',
            ],
            [
                'icon' => 'fa fa-usd',
                'name' => 'Transactions',
                'route' => 'attorney_transactions_consumed',
            ],
            [
                'icon' => 'bi bi-file-ruled',
                'name' => 'Customize Property Section',
                'route' => 'attorney_template_management',
            ],
            [
                'icon' => 'bi bi-bell',
                'name' => 'Notification Template',
                'route' => 'notification_template_list',
            ],
            [
                'icon' => 'bi bi-people',
                'name' => 'Law Firm Management',
                'route' => 'law_firm_associate_management',
            ],
        ];
        if ($isParalegal) {
            $routesToRemove = ['questionnaire_index', 'attorney_profile', 'attorney_settings', 'attorney_template_management', 'attorney_transactions_consumed', 'attorney_paralegal_management', 'notification_template_list', 'law_firm_associate_management'];

            $arr = array_filter($arr, function ($item) use ($routesToRemove) {
                return !in_array($item['route'], $routesToRemove);
            });
        }

        // Reset array keys if needed
        $arr = array_values($arr);

        return $arr;
    }

    public static function getClientSidebar()
    {
        $arr = [
            [
                'icon' => 'bi bi-person-circle',
                'name' => 'Basic Information',
                'route' => 'client_dashboard',
                'percentage_key' => 'tab1_percentage'
            ],
            [
                'icon' => 'bi bi-house-exclamation',
                'name' => 'Property',
                'route' => 'property_information',
                'percentage_key' => 'tab2_percentage'
            ],
            [
                'icon' => 'bi bi-coin',
                'name' => 'Debts',
                'route' => 'client_debts_step2_unsecured',
                'percentage_key' => 'tab3_percentage'
            ],
            [
                'icon' => 'bi bi-wallet',
                'name' => 'Current Income',
                'route' => 'client_income',
                'percentage_key' => 'tab4_percentage'
            ],
            [
                'icon' => 'bi bi-wallet2',
                'name' => 'Current Household Expenses',
                'route' => 'client_expenses',
                'percentage_key' => 'tab5_percentage'
            ],
            [
                'icon' => 'bi bi-file-earmark-medical',
                'name' => 'Statement of Financial Affairs',
                'route' => 'client_financial_affairs',
                'percentage_key' => 'tab6_percentage'
            ],
        ];

        return $arr;
    }

    public static function getClientName($client_id, $displayName, $incl_possive = false)
    {
        $basicInfo = CacheBasicInfo::getBasicInformationData($client_id);
        $data = Helper::validate_key_value('BasicInfoPartA', $basicInfo, 'array');

        if (!empty($data) && isset($data->name)) {
            $displayName = $data->name;
        }

        if ($incl_possive) {
            $displayName .= "'";
            if (strtolower(substr($displayName, -1)) != "s") {
                $displayName .= "s";
            }
        }

        return $displayName;
    }

    public static function getCoDebtorName($client_id, $displayName, $incl_possive = false)
    {
        $basicInfo = CacheBasicInfo::getBasicInformationData($client_id);
        $data = Helper::validate_key_value('BasicInfoPartB', $basicInfo, 'array');

        if (!empty($data) && isset($data->name)) {
            $displayName = $data->name;
        }

        if ($incl_possive) {
            $displayName .= "'";
            if (strtolower(substr($displayName, -1)) != "s") {
                $displayName .= "s";
            }
        }

        return $displayName;
    }

    public static function getUpdatedOtherIncomeTypeName($clientType, $documentType)
    {
        $initals = '';
        $coDebtorInitials = 'Co-Debtor';

        if ($clientType == 2) {
            $coDebtorInitials = "Non-Filing Spouse";
        }

        switch ($documentType) {
            case 'debtor_Social_Security_Annual_Award_Letter':
                $initals = 'Debtor SSI Award Letter';
                break;
            case 'codebtor_Social_Security_Annual_Award_Letter':
                $initals = $coDebtorInitials . ' SSI Award Letter';
                break;
            case 'debtor_VA_Benefit_Award_Letter':
                $initals = 'Debtor VA Benefit Award Letter';
                break;
            case 'codebtor_VA_Benefit_Award_Letter':
                $initals = $coDebtorInitials . ' VA Benefit Award Letter';
                break;
            case 'debtor_Unemployment_Payment_History_Last_7_Months':
                $initals = 'Debtor Unemployment Benefit Award Letter';
                break;
            case 'codebtor_Unemployment_Payment_History_Last_7_Months':
                $initals = $coDebtorInitials . ' Unemployment Benefit Award Letter';
                break;
        }

        return $initals;
    }


    public static function getHelpDocumentUrls($doc_type = null, $counseling_agency = '', $counseling_agency_site = '', $attorney_code = '')
    {
        $cacheKey = 'help_document_urls_' . ($doc_type ?? 'all');

        // Cache for 1 hour (adjust as needed)
        // return Cache::remember($cacheKey, now()->addMinutes(1), function () use ($doc_type, $counseling_agency, $counseling_agency_site, $attorney_code) {
        $staticDocumentData = [
            'Last_Year_Tax_Returns' => ['image' => asset('assets/img/tax_guide.png'), 'url' => 'https://www.irs.gov/individuals/get-transcript'],
            'Prior_Year_Tax_Returns' => ['image' => asset('assets/img/tax_guide.png'), 'url' => 'https://www.irs.gov/individuals/get-transcript'],
            'Prior_Year_Two_Tax_Returns' => ['image' => asset('assets/img/tax_guide.png'), 'url' => 'https://www.irs.gov/individuals/get-transcript'],
            'Prior_Year_Three_Tax_Returns' => ['image' => asset('assets/img/tax_guide.png'), 'url' => 'https://www.irs.gov/individuals/get-transcript'],
            'Other_Misc_Documents' => ['image' => asset('assets/img/Collection_Notice_Letter.png'), 'url' => ''],
            'Vehicle_Registration' => ['image' => asset('assets/img/popup-vehicle-registration.png'), 'url' => ''],
            'Insurance_Documents' => ['image' => asset('assets/img/popup-insurance-documents.png'), 'url' => ''],
            'debtor_VA_Benefit_Award_Letter' => ['image' => '', 'url' => 'https://www.va.gov/records/download-va-letters/'],
            'debtor_Social_Security_Annual_Award_Letter' => ['image' => '', 'url' => 'https://www.ssa.gov/manage-benefits/get-benefit-letter'],
            'Pre_Filing_Bankruptcy_Certificate_CCC' => [
                'image' => asset('assets/img/ccc-certificate.png'),
                'url' => '',
                'text_obj' => ['pre_filing_credit_counseling_agency' => $counseling_agency, 'pre_filing_credit_counseling_website' => $counseling_agency_site, 'atty_code_for_credit_counseling_website' => $attorney_code]
            ],
            'Miscellaneous_Documents' => ['image' => asset('assets/img/misc_doc_guide.png'), 'url' => '']
        ];

        $fileUploadTypes = Helper::getAllDocumentTypes();
        if ($doc_type) {
            $documents = \App\Models\AdminDocumentGuide::where('document_type', $doc_type)->get();
            $fileUploadTypes = [$doc_type => $doc_type];
        } else {
            $documents = \App\Models\AdminDocumentGuide::whereIn('document_type', array_keys($fileUploadTypes))->get();
        }

        $result = [];

        foreach ($fileUploadTypes as $type => $label) {
            $matchingDocument = $documents->firstWhere('document_type', $type);
            $documentEntry = ['type' => $type];

            if ($matchingDocument && Storage::disk('s3')->exists($matchingDocument->s3_path)) {
                $docname = $matchingDocument->s3_path;
                $extension = strtolower(pathinfo($docname, PATHINFO_EXTENSION));
                $documentEntry['ext'] = $extension == 'pdf' ? 'pdf' : '';

                $documentEntry['image'] = Storage::disk('s3')->temporaryUrl(
                    $matchingDocument->s3_path,
                    now()->addDays(2),
                    [
                        'ResponseContentDisposition' => 'inline; filename="' . rawurlencode($matchingDocument->original_name) . '"',
                    ]
                );
            } elseif (isset($staticDocumentData[$type])) {
                $documentEntry['image'] = $staticDocumentData[$type]['image'] ?? '';
                $documentEntry['ext'] = '';
            } else {
                $documentEntry['image'] = '';
                $documentEntry['ext'] = '';
            }

            if (isset($staticDocumentData[$type])) {
                $documentEntry['url'] = $staticDocumentData[$type]['url'] ?? '';
                if (isset($staticDocumentData[$type]['text_obj'])) {
                    $documentEntry['text_obj'] = $staticDocumentData[$type]['text_obj'];
                }
            }

            $result[] = $documentEntry;
        }

        return $result;
        // });
    }

    public static function getParentDocumentStyle($key = '')
    {
        $itemList = [
            "Post_submission_documents" => [
                "class" => "parent-doc-tab tab-gray text-black",
                "icon" => "assets/img/black_icons/attorney_docs.svg",
            ],
            "parentIdDocuments" => [
                "class" => "parent-doc-tab tab-gray text-black",
                "icon" => "assets/img/black_icons/license.svg",
            ],
            "parentSecuredDocuments" => [
                "class" => "parent-doc-tab tab-gray text-black",
                "icon" => "assets/img/black_icons/license.svg",
            ],
            "parentUnsecuredDocuments" => [
                "class" => "parent-doc-tab tab-gray text-black",
                "icon" => "assets/img/black_icons/credit_report.svg",
            ],
            "parentIncomeDocuments" => [
                "class" => "parent-doc-tab tab-green text-white",
                "icon" => "assets/img/white_icons/paystub.svg",
            ],
            "parentOtherIncomeDocuments" => [
                "class" => "parent-doc-tab tab-green-light text-black",
                "icon" => "assets/img/black_icons/bank_doc.svg",
            ],
            "parentTaxesDocuments" => [
                "class" => "parent-doc-tab tab-blue-light text-black",
                "icon" => "assets/img/black_icons/tax_return.svg",
            ],
            "parentRetirementDocuments" => [
                "class" => "parent-doc-tab tab-brown-light text-black",
                "icon" => "assets/img/black_icons/bank_doc.svg",
            ],
            "parentMiscAttorneyDocuments" => [
                "class" => "parent-doc-tab tab-gray text-black",
                "icon" => "assets/img/black_icons/attorney_docs.svg",
            ],
            "parentBankDocuments" => [
                "class" => "parent-doc-tab tab-blue text-white",
                "icon" => "assets/img/white_icons/bank_doc.svg",
            ],
            "parentPaypalVenmoCashDocuments" => [
                "class" => "parent-doc-tab tab-blue-dark text-white",
                "icon" => "assets/img/white_icons/bank_doc.svg",
            ],
            "parentBrokerageDocuments" => [
                "class" => "parent-doc-tab tab-black text-white",
                "icon" => "assets/img/white_icons/bank_doc.svg",
            ],
            "parentRequestedDocuments" => [
                "class" => "parent-doc-tab tab-red text-white",
                "icon" => "assets/img/white_icons/requested_doc_white.svg",
            ],
            "parentFormDocuments" => [
                "class" => "parent-doc-tab tab-gray text-black",
                "icon" => "assets/img/black_icons/attorney_docs.svg",
            ],
        ];

        if (!empty($key)) {
            return static::returnArrValue($itemList, $key);
        } else {
            return $itemList;
        }
    }

    public static function getMappingOfTaxrray($taxtype)
    {
        $taxArray = [
            "federalTaxes" => "Federal Income Tax",
            "stateTaxes" => "State Income Tax",
            "medicareTax" => "Medicare Tax",
            "socialSecurityTax" => "Social Security Tax"
        ];

        return $taxArray[$taxtype] ?? $taxtype;
    }

    public static function getValidatedDataForDummyEntry($data, $index = null, $keyType = null)
    {
        if (isset($data) && !empty($data)) {
            if (is_string($data)) {
                return $data;
            }
            if (is_array($data)) {
                if ($index) {
                    return $keyType ? Helper::validate_key_value($index, $data, $keyType) : Helper::validate_key_value($index, $data);
                }

                return reset($data); // Default to the first value in the array
            }
        }

        return null;
    }

    public static function getDebtTypeLabels($key = null)
    {
        $arr = [
            'secured' => "Secured Debt Creditor(s)",
            'unsecured' => "Unsecured Debt Creditor(s)",
            'state_back_tax' => "State Back Taxes Owed Creditor(s)",
            'irs' => "IRS Creditor",
            'domestic_support' => "Domestic Support Debt Creditor(s)",
        ];

        return static::returnArrValue($arr, $key);
    }
    public static function getAllowedFileExtensionArray()
    {
        $allowedfileExtension = [
            "heic",
            "jpeg",
            "png",
            "jpg",
            "pdf",
            "doc",
            "docx",
            'xltx',
            'vsdx',
            'dxf',
            'dot',
            'eml',
            'odt',
            'psd',
            'xlsx',
            'msg',
            'ppsx',
            'rtf',
            'numbers',
            'svg',
            'vsd',
            'eps',
            'md',
            'tiff',
            'ico',
            'json',
            'webp',
            'oxps',
            'pptx',
            'dwfx',
            'djvu',
            'dwf',
            'odp',
            'mobi',
            'xps',
            'ps',
            'xls',
            'dwg',
            'bmp',
            'csv',
            'html',
            'xlsb',
            'pages',
            'ods',
            'pps',
            'epub',
            'htm',
            'gif',
            'potx',
            'odg'
        ];

        return $allowedfileExtension;
    }

    public static function getExtFromMime(): array
    {
        $mimeToExt = [
            'vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'msword' => 'doc',
            'vnd.ms-excel' => 'xls',
            'vnd.ms-powerpoint' => 'ppt',
            'plain' => 'txt',
            'jpeg' => 'jpg',
            'svg+xml' => 'svg',
            'tiff' => 'tiff',
            'x-icon' => 'ico',
            'x-photoshop' => 'psd',
            'x-bitmap' => 'bmp',
            'x-csv' => 'csv',
            'x-xls' => 'xls',
            'x-xlsx' => 'xlsx',
            'x-pdf' => 'pdf',
            'x-rtf' => 'rtf',
            'x-json' => 'json',
            'x-zip-compressed' => 'zip',
            'vnd.ms-outlook' => 'msg',
            'vnd.ms-excel.sheet.binary.macroEnabled.12' => 'xlsb',
            'vnd.ms-excel.template.macroEnabled.12' => 'xltx',
            'vnd.ms-powerpoint.slideshow.macroEnabled.12' => 'ppsx',
            'vnd.ms-powerpoint.presentation.macroEnabled.12' => 'pptx',
            'vnd.ms-powerpoint.template.macroEnabled.12' => 'potx',
            'vnd.ms-visio.drawing' => 'vsd',
            'vnd.ms-visio.drawing.main+xml' => 'vsdx',
            'vnd.ms-xpsdocument' => 'xps',
            'vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dot',
            'vnd.openxmlformats-officedocument.spreadsheetml.template' => 'xltx',
            'vnd.openxmlformats-officedocument.presentationml.slideshow' => 'ppsx',
            'vnd.openxmlformats-officedocument.presentationml.template' => 'potx',
            'vnd.oasis.opendocument.text' => 'odt',
            'vnd.oasis.opendocument.spreadsheet' => 'ods',
            'vnd.oasis.opendocument.presentation' => 'odp',
            'vnd.oasis.opendocument.graphics' => 'odg',
            'x-dxf' => 'dxf',
            'x-dwg' => 'dwg',
            'x-dwf' => 'dwf',
            'x-dwfx' => 'dwfx',
            'x-eps' => 'eps',
            'x-mobipocket-ebook' => 'mobi',
            'epub+zip' => 'epub',
            'x-oxps' => 'oxps',
            'x-ps' => 'ps',
            'x-djvu' => 'djvu',
            'x-numbers' => 'numbers',
            'x-pages' => 'pages',
            'x-webp' => 'webp',
            'x-md' => 'md',
            // Add more as needed
        ];

        return $mimeToExt;
    }

    public static function getVehicleTypeArray($name)
    {
        $arr = [
           [
            'icon' => '&#x1F697;',
            'name' => 'Cars',
           ],
           [
            'icon' => '&#x1F3CD;&#xFE0F;',
            'name' => 'Motorcycles',
           ],
           [
            'icon' => '&#x1F690;',
            'name' => 'Vans',
           ],
           [
            'icon' => '&#x1F69A;',
            'name' => 'Trucks',
           ],
           [
            'icon' => '&#x1F699;',
            'name' => 'Sport utility vehicles',
           ],
           [
            'icon' => '&#x1F69C;',
            'name' => 'Tractors',
           ],
           [
            'icon' => '&#x1F6A4;',
            'name' => 'Watercraft',
           ],
           [
            'icon' => '&#x1F690;',
            'name' => 'Motor homes',
           ],
           [
            'icon' => '&#x1F6FB;',
            'name' => 'ATVs',
           ],
           [
            'icon' => '&#x1F6F8;',
            'name' => 'Other vehicles',
           ],
        ];

        if (empty($name)) {
            return '&#x1F697;'; // Default icon for Cars
        }

        foreach ($arr as $item) {
            if (strtolower($item['name']) === strtolower($name)) {
                return $item['icon'];
            }
        }

        return '&#x1F697;';
    }
    public static function getPreDashboardMainProgressClass($progress = 0)
    {
        if ($progress == 0) {
            return "progress-red";
        }
        if ($progress > 0 && $progress < 75) {
            return "progress-yellow";
        }
        if ($progress >= 75 && $progress <= 99) {
            return "progress-blue";
        }
        if ($progress == 100) {
            return "progress-green";
        }

        return "";
    }

    public static function getPreDashboardSubStepProgressClass($progress, $step)
    {
        if (empty($progress) || empty($step) || !isset($progress['step' . $step]['percentDone'])) {
            return "";
        }

        $progress_completeness = $progress['step' . $step]['percentDone'];

        return self::getPreDashboardMainProgressClass($progress_completeness);
    }

    public static function getEmergencyAssessmentArray()
    {
        return [
            1 => "No Emergency",
            2 => "Expect Foreclosure Soon on a Property I Want to Keep",
            3 => "Foreclosure Threatened on a Property I Want to Keep",
            4 => "Had Foreclosure Court on a Property I Want to Keep",
            5 => "Expect Repo Soon on a Vehicle Want to Keep",
            6 => "Repo Threatened on a Vehicle I Want to Keep",
            7 => "Vehicle Repoed in last 10 days & I Want to keep it.",
            8 => "Expect Eviction",
            9 => "Eviction Threatened",
            10 => "Have Eviction Notice",
            11 => "Expect Garnishment",
            12 => "Wages Garnished",
            13 => "Law Suit/Summons",
            14 => "Other (List below)"
        ];
    }

    public static function getFindUsArray()
    {
        return [
            1 => "Google",
            2 => "Facebook",
            3 => "YouTube",
            4 => "TikTok",
            5 => "Bing",
            6 => "ChatGPT",
            7 => "Lawyer.com",
            8 => "Online Influencer",
            9 => "Other Online",
            10 => "Friend / Family Member",
            11 => "John Orcutt Bankruptcy Law",
            12 => "Cousin Kera",
            13 => "Boost Credit Scores (Yates)",
            14 => "Referral from someone else",
        ];
    }

    public static function getSectionLogLabel($key = null)
    {
        $arr = [
            'debtor-basic-info' => "Debtor's Basic Information",
            'marital-info' => 'Marital Status',
            'spouse-basic-info' => "Co-Debtor's/Spouse's Information",
            'emergency-info' => 'Emergency Assessment Information',
            'discover-us-info' => 'Find Us Information',
            'debtor-income-info' => "Debtor's Income Information",
            'spouse-income-info' => "Co-Debtor's/Spouse's Income Info",
            'mortgage-info' => 'Mortgages',
            'vehicles-info' => 'Vehicles/ Motorcycles/ Boats etc.',
            'other-property-info' => 'Other Property',
            'secured-loan-info' => 'Other Secured Loans',
            'back-tax-info' => 'Back taxes owed',
            'other-debt-info' => 'Other Debts',
            'attorney-ques-info' => 'Additional Questions',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getIntakeFormKeyLabel($key = null, $dataFor = '')
    {
        if ($dataFor == 'attorney-ques-info') {
            $key = str_replace("concierge_question", "", $key);
        }

        if ($dataFor == 'emergency-info') {
            $key = str_replace("emergency_check", "Urgent Situations - ", $key);
        }

        if ($dataFor == 'discover-us-info' && $key != 'find_us_referred_by') {
            $key = str_replace("find_us", "How did you find us - ", $key);
        }

        $arr = [
            // 'debtor-basic-info' => "Debtor's Basic Information",
            'name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'suffix' => 'Suffix',
            'home' => 'Home',
            'cell' => 'Cell',
            'work' => 'Work',
            'date_of_birth' => 'Date Of Birth',
            'email' => 'Email',
            'Address' => 'Address',
            'City' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'country' => 'Country',
            'security_number' => 'Social Security Number',
            'itin' => 'ITIN',
            'lived_address_from_180' => 'Have you lived at this address for at least 180 days',
            'filed_in_last_8_yrs' => 'Have you ever filed a bankruptcy case before',
            'chapter' => 'Chapter',
            'date_filed' => 'Date Filed',
            'any_bankruptcy_filed_before_data' => 'Previous Case',
            'case_name' => 'Case Name',
            'data_field' => 'Date Filed',
            'data_field_unsure' => 'Date Filed (unsure)',
            'case_numbers' => 'Case Number',
            'case_numbers_unknown' => 'Case Number (unknown)',
            'district_if_known' => 'District if (known)',
            'family_members' => 'Family Members',
            'chapter_13_filed_info' => 'If you filed Chapter 13 in the last 2 years',
            'lived_in_nc_month' => 'How long have you lived in North Carolina: - Month',
            'lived_in_nc_year' => 'How long have you lived in North Carolina: - Year',
            // 'marital-info' => 'Marital Status',
            'martial_status' => 'Marital Status',
            // 'spouse-basic-info' => "Co-Debtor's/Spouse's Information",
            'spouse_name' => 'First Name',
            'spouse_middle_name' => 'Middle Name',
            'spouse_last_name' => 'Last Name',
            'spouse_suffix' => 'Suffix',
            'spouse_work' => 'Work',
            'spouse_date_of_birth' => 'Date Of Birth',
            'spouse_email' => 'Email',
            'spouse_cell' => 'Cell',
            'spouse_security_number' => 'Social Security Number',
            'spouse_itin' => 'ITIN',
            'spouse_address' => 'Address',
            'spouse_city' => 'City',
            'd2_state' => 'State',
            'spouse_zip' => 'Zip',
            'spouse_country' => 'Country',
            // 'emergency-info' => 'Emergency Assessment Information',
            'emergency_check' => 'Urgent Situations',
            'emergency_notes' => 'Notes',
            // 'discover-us-info' => 'Find Us Information',
            'find_us' => 'How did you find us',
            'find_us_referred_by' => 'If referred by some not listed, what is their name',
            'google_reviews' => 'Have you read our Google reviews',
            'zoom_exp' => 'Zoom Video Conference Experience',
            // 'debtor-income-info' => "Debtor's Income Information",
            'debtor_income_data' => "Debtor's Income Information",
            'debtor_gross_wages' => "Are you currently employed",
            'debtor_gross_wages_month' => "Gross Income Per Month",
            'self_employment_inc_debtor' => "Have you had any Self Employment Income",
            'income_net_profit' => "Self Employment - Avg. Monthly Inc.",
            'rental_inc_debtor' => "Rent and other real property income",
            'rental_inc_amt_debtor' => "Rent and other real property - Avg. Monthly Inc",
            'royality_inc_debtor' => "Interest, dividends, and royalties",
            'royality_inc_amt_debtor' => "Interest, dividends, and royalties - Avg. Monthly Inc",
            'retirement_inc_debtor' => "Pension and retirement income (NOT Social Security) (Retirement Income)",
            'retirement_inc_amt_debtor' => "Retirement - Avg. Monthly Inc",
            'regular_contributions_inc_debtor' => "Regular contributions from others to the household expenses, including child support",
            'regular_contributions_inc_amt_debtor' => "Regular - Avg. Monthly Inc",
            'unemployment_compensation_inc_debtor' => "Unemployment Compensation",
            'unemployment_compensation_inc_amt_debtor' => "Unemployment Compensation - Avg. Monthly Inc",
            'social_security_inc_debtor' => "Social Security income. (SSI Income)",
            'social_security_inc_amt_debtor' => "Social Security - Avg. Monthly Inc",
            'government_assistance_inc_debtor' => "Other government assistance you receive regularly",
            'government_assistance_inc_amt_debtor' => "Other government assistance you receive regularly - Avg. Monthly Inc",
            'other_sources_inc_debtor' => "Other sources of income not already mentioned",
            'other_sources_inc_amt_debtor' => "Other sources of income not already mentioned - Avg. Monthly Inc",
            'debtor_job_title' => 'Job Title',
            'debtor_total_family_income' => 'Total family income',
            'debtor_bussiness_name' => 'Business Name',
            'debtor_bussiness_type' => 'Business Type',
            'debtor_bussiness_nature' => 'Nature of your business',
            'debtor_money_owed_by_anyone' => 'How much money are you owed by anyone',
            'debtor_future_large_amount' => 'Future large amount of money or stuff (future)',
            'debtor_last_6_month_large_amount' => 'Large amounts of money or stuff (last 6 months)',
            'debtor_sued_details' => 'Suing/Sued',
            'debtor_retirement_life_insurance_date' => 'Retirement / LIFE Insurance Withdrawals (last 2 years) - Date',
            'debtor_retirement_life_insurance' => 'Retirement / LIFE Insurance Withdrawals (last 2 years) - Amount',
            // 'spouse-income-info' => "Co-Debtor's/Spouse's Income Info",
            'codebtor_income_data' => "Co-Debtor's/Spouse's Income Info",
            'spouse_filing_with_you' => "Is your Spouse filing with you",
            'joints_debtor_gross_wages' => "Are you currently employed",
            'joints_debtor_gross_wages_month' => "Gross Income Per Month",
            'self_employment_inc_spouse' => "Have you had any Self Employment Income",
            'income_net_profit_spouse' => "Self Employment - Avg. Monthly Inc.",
            'rental_inc_spouse' => "Rent and other real property income",
            'rental_inc_amt_spouse' => "Rent and other real property - Avg. Monthly Inc",
            'royality_inc_spouse' => "Interest, dividends, and royalties",
            'royality_inc_amt_spouse' => "Interest, dividends, and royalties - Avg. Monthly Inc",
            'retirement_inc_spouse' => "Pension and retirement income (NOT Social Security) (Retirement Income)",
            'retirement_inc_amt_spouse' => "Retirement - Avg. Monthly Inc",
            'regular_contributions_inc_spouse' => "Regular contributions from others to the household expenses, including child support",
            'regular_contributions_inc_amt_spouse' => "Regular - Avg. Monthly Inc",
            'unemployment_compensation_inc_spouse' => "Unemployment Compensation",
            'unemployment_compensation_inc_amt_spouse' => "Unemployment Compensation - Avg. Monthly Inc",
            'social_security_inc_spouse' => "Social Security income. (SSI Income)",
            'social_security_inc_amt_spouse' => "Social Security - Avg. Monthly Inc",
            'government_assistance_inc_spouse' => "Other government assistance you receive regularly",
            'government_assistance_inc_amt_spouse' => "Other government assistance you receive regularly - Avg. Monthly Inc",
            'other_sources_inc_spouse' => "Other sources of income not already mentioned",
            'other_sources_inc_amt_spouse' => "Other sources of income not already mentioned - Avg. Monthly Inc",
            'spouse_job_title' => 'Job Title',
            'spouse_total_family_income' => 'Total family income',
            'spouse_bussiness_name' => 'Business Name',
            'spouse_bussiness_type' => 'Business Type',
            'spouse_bussiness_nature' => 'Nature of your business',
            'spouse_money_owed_by_anyone' => 'How much money are you owed by anyone',
            'spouse_future_large_amount' => 'Future large amount of money or stuff (future)',
            'spouse_last_6_month_large_amount' => 'Large amounts of money or stuff (last 6 months)',
            'spouse_sued_details' => 'Suing/Sued',
            'spouse_retirement_life_insurance_date' => 'Retirement / LIFE Insurance Withdrawals (last 2 years) - Date',
            'spouse_retirement_life_insurance' => 'Retirement / LIFE Insurance Withdrawals (last 2 years) - Amount',
            // 'mortgage-info' => 'Mortgages',
            'rent_or_own' => 'Rent or Own',
            'mortgage_rent_1' => 'Monthly Rent',
            'loan_on_property' => 'Have a loan on this property',
            'mortgage_property_value_1' => 'Property Value',
            'mortgage_amount_owned_1' => 'Mortgage - 1 - Amount Owed',
            'mortgage_amount_owned_2' => 'Mortgage - 2 - Amount Owed',
            'mortgage_amount_owned_3' => 'Mortgage - 3 - Amount Owed',
            'mortgage_own_1' => 'Mortgage - 1 - Monthly Payment',
            'mortgage_own_2' => 'Mortgage - 2 - Monthly Payment',
            'mortgage_own_3' => 'Mortgage - 3 - Monthly Payment',
            'mortgage_past_payment_1' => 'Mortgage - 1 - Past Due Payments',
            'mortgage_past_payment_2' => 'Mortgage - 2 - Past Due Payments',
            'mortgage_past_payment_3' => 'Mortgage - 3 - Past Due Payments',
            'mortgage_additional_loans' => 'Do you have Mortgage 2nd',
            'mortgage_additional_loans_2' => 'Do you have Mortgage 3rd',
            'mortgages_creditor_name_1' => 'Mortgage - 1 - Creditor Name',
            'mortgages_creditor_address_1' => 'Mortgage - 1 - Creditor Address',
            'mortgages_creditor_city_1' => 'Mortgage - 1 - Creditor City',
            'mortgages_creditor_state_1' => 'Mortgage - 1 - Creditor State',
            'mortgages_creditor_zipcode_1' => 'Mortgage - 1 - Creditor Zipcode',
            'mortgages_creditor_name_2' => 'Mortgage - 2 - Creditor Name',
            'mortgages_creditor_address_2' => 'Mortgage - 2 - Creditor Address',
            'mortgages_creditor_city_2' => 'Mortgage - 2 - Creditor City',
            'mortgages_creditor_state_2' => 'Mortgage - 2 - Creditor State',
            'mortgages_creditor_zipcode_2' => 'Mortgage - 2 - Creditor Zipcode',
            'mortgages_creditor_name_3' => 'Mortgage - 3 - Creditor Name',
            'mortgages_creditor_address_3' => 'Mortgage - 3 - Creditor Address',
            'mortgages_creditor_city_3' => 'Mortgage - 3 - Creditor City',
            'mortgages_creditor_state_3' => 'Mortgage - 3 - Creditor State',
            'mortgages_creditor_zipcode_3' => 'Mortgage - 3 - Creditor Zipcode',
            'mortgage_foreclosure_property' => 'Property in foreclosure',
            'mortgage_foreclosure_date' => 'Foreclosure sale date been set',
            'mortgage_foreclosure_date_scheduled' => 'Date Foreclosure Scheduled',
            'mortgage_notes' => 'Notes',
            // 'vehicles-info' => 'Vehicles/ Motorcycles/ Boats etc.',
            'own_any_vehicle' => 'Do you own any vehicle',
            'vehicle_details' => 'Vehicle',
            'property_type' => 'Type',
            'property_estimated_value' => 'Property Value',
            'property_year' => 'Year',
            'property_make' => 'Make',
            'property_model' => 'Model',
            'property_mileage' => 'Mileage',
            'property_other_info' => 'Style of Vehicle',
            'loan_own_type_property' => 'Do you have a loan on this property',
            'vehicle_car_loan' => 'Loan',
            'past_due_amount' => 'Past due payment',
            'amount_own' => 'Amount Owed',
            'creditor_name' => 'Creditor Name',
            'creditor_name_addresss' => 'Address',
            'creditor_city' => 'City',
            'State' => 'State',
            'creditor_zip' => 'Zip',
            // 'other-property-info' => 'Other Property',
            'other_property_let_go_item' => 'Let go items',
            'other_property_new_stuff' => 'New stuff',
            'other_property_valued_possession' => 'Valued possessions',
            // 'secured-loan-info' => 'Other Secured Loans',
            'additional_liens' => 'Do you have any additional liens or loans secured against any real or personal property not already listed',
            'additional_liens_data' => 'Secured Loan',
            'domestic_support_name' => 'Creditor Name',
            'domestic_support_address' => 'Address',
            'domestic_support_city' => 'City',
            'creditor_state' => 'State',
            'domestic_support_zipcode' => 'Zip',
            'describe_secure_claim' => 'Property Description',
            'monthly_payment' => 'Monthly Payment',
            'additional_liens_due' => 'Amount Due',
            'additional_liens_date' => 'Date',
            // 'back-tax-info' => 'Back taxes owed',
            'last_5_year_taxes' => 'Have you filed all of your Federal & State Tax Returns over the last 5 years',
            'tax_owned_irs' => 'Do you owe any back taxes to the IRS',
            'back_taxes_owed' => 'Do you owe any back taxes owed to the State',
            'child_supp_or_alimony' => 'Do you owe Child Support/Alimony',
            'current_on_your_support_obligation' => 'Are you current on your support obiligation(s)',
            'taxes_internal_revenue_year' => 'IRS Year(s)',
            'taxes_irs_taxes_due' => 'IRS Total Taxes Due',
            'taxes_tax_state' => 'State Back Taxes - State',
            'taxes_franchise_tax_board' => 'State Back Taxes Year(s)',
            'taxes_state_tax_due' => 'Total State Taxes Due',
            'taxes_child_support_state' => 'Child Support/Alimony - State',
            'taxes_child_support_due' => 'Child Support/Alimony - Monthly Payment',
            'taxes_alimony_due' => 'Support obiligation(s) - Past Due Amount',
            // 'other-debt-info' => 'Other Debts',
            'credit_crd_debt' => 'Total Credit Card debt',
            'medical_debt' => 'Total Medical debt',
            'student_loans' => 'Total Student loans',
            'law_suit' => 'Law Suit / Judgement',
            'personal_loans' => 'Total Personal Loans',
            'credit_union_loans' => 'Total Credit Union Loans',
            'family_loans' => 'Total loans from family',
            'misc_loans' => 'Misc. loans',
            'made_purchases' => 'Have you made purchases in the last 3 months',
            'checking_account' => 'Do you have a checking account at a bank that issued the card',
            'vehicle_repoed_date' => 'Repo: I had a vehicle repoed in the last 10 days on this date (MM/DD/YYYY)',
            'borrowed_and_paid_back' => 'Borrowed & Paid back',
            'total_unsecured_loan' => 'Total unsecured debt',
            'total_utility_debt' => 'Total utility debt',
            'tolls_tickets_fines_owed' => 'Tolls, tickets, & fines owed',
            'eviction_or_back_rent' => 'Eviction or back rent',
            'foreclosure_debt' => 'Foreclosure debt',
            'repo_debt' => 'Repo debt',
            'money_you_have' => 'How much do you have?',
            // 'attorney-ques-info' => 'Additional Questions',
            'concierge_question' => 'Concierge Question',
            'being_sued' => 'Are you being sued',
            'wages_being_garnished' => 'Are your wages currently being garnished',
            'extra_notes' => 'Extra Notes',
            // extra
            'id' => 'ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];

        $output = static::returnArrValue($arr, $key);

        if (in_array($dataFor, ['debtor-basic-info', 'secured-loan-info', 'vehicles-info']) && str_contains($key, "-")) {
            $parts = explode('-', $key);
            if (!empty($parts)) {
                $output = '';
                foreach ($parts as $value) {
                    $text = static::returnArrValue($arr, $value);
                    if ($text != '') {
                        $output .= is_numeric($text) ? ((int) $text + 1) . ' - ' : $text . ' - ';
                    } else {
                        $output .= is_numeric($value) ? ((int) $value + 1) . ' - ' : $value . ' - ';
                    }
                }
                $output = rtrim($output, ' -');
            }
        }

        return $output == '' ? $key : $output;
    }

    public static function getIntakeFormKeyType($key = null)
    {
        if (str_contains($key, "data_field_unsure")) {
            $key = 'data_field_unsure';
        }
        if (str_contains($key, "case_numbers_unknown")) {
            $key = 'case_numbers_unknown';
        }
        if (str_contains($key, "emergency_check")) {
            $key = 'emergency_check';
        }
        if (str_contains($key, "find_us") && $key != 'find_us_referred_by') {
            $key = 'find_us';
        }
        if (
            str_contains($key, "additional_liens_data")
            || str_contains($key, "vehicle_details")
        ) {
            $parts = explode('-', $key);
            if (!empty($parts)) {
                $key = end($parts);
            }
        }
        if (str_contains($key, "concierge_question")) {
            $key = 'concierge_question';
        }

        $arr = [
            'id' => 'ID',
            // 'debtor-basic-info' => "Debtor's Basic Information",
            'name' => 'string',
            'middle_name' => 'string',
            'last_name' => 'string',
            'suffix' => 'suffix',
            'home' => 'string',
            'cell' => 'string',
            'work' => 'string',
            'date_of_birth' => 'string',
            'email' => 'string',
            'Address' => 'string',
            'City' => 'string',
            'state' => 'string',
            'zip' => 'string',
            'country' => 'county',
            'security_number' => 'string',
            'itin' => 'string',
            'lived_address_from_180' => 'yes_no',
            'filed_in_last_8_yrs' => 'yes_no_reverse',
            'chapter' => 'int',
            'date_filed' => 'string',
            'any_bankruptcy_filed_before_data' => 'json',
            'case_name' => 'string',
            'data_field' => 'string',
            'data_field_unsure' => 'checkbox_unsure',
            'case_numbers' => 'string',
            'case_numbers_unknown' => 'checkbox_unknown',
            'district_if_known' => 'string',
            'family_members' => 'int',
            'chapter_13_filed_info' => 'string',
            'lived_in_nc_month' => 'string',
            'lived_in_nc_year' => 'string',
            // 'marital-info' => 'Marital Status',
            'martial_status' => 'martial_status',
            // 'spouse-basic-info' => "Co-Debtor's/Spouse's Information",
            'spouse_filing_with_you' => 'yes_no_reverse',
            'spouse_name' => 'string',
            'spouse_middle_name' => 'string',
            'spouse_last_name' => 'string',
            'spouse_suffix' => 'suffix',
            'spouse_work' => 'string',
            'spouse_date_of_birth' => 'string',
            'spouse_email' => 'string',
            'spouse_cell' => 'string',
            'spouse_security_number' => 'string',
            'spouse_itin' => 'string',
            'spouse_address' => 'string',
            'spouse_city' => 'string',
            'd2_state' => 'string',
            'spouse_zip' => 'string',
            'spouse_country' => 'string',
            // 'emergency-info' => 'Emergency Assessment Information',
            'emergency_check' => 'added_not_added',
            'emergency_notes' => 'string',
            // 'discover-us-info' => 'Find Us Information',
            'find_us' => 'added_not_added',
            'google_reviews' => 'yes_no_custom_google',
            'zoom_exp' => 'yes_no_custom_zoom',
            'find_us_referred_by' => 'string',
            // 'debtor-income-info' => "Debtor's Income Information",
            'debtor_income_data' => "json",
            'debtor_gross_wages' => 'yes_no',
            'debtor_gross_wages_month' => 'price',
            'self_employment_inc_debtor' => 'yes_no',
            'income_net_profit' => 'price',
            'rental_inc_debtor' => 'yes_no',
            'rental_inc_amt_debtor' => 'price',
            'royality_inc_debtor' => 'yes_no',
            'royality_inc_amt_debtor' => 'price',
            'retirement_inc_debtor' => 'yes_no',
            'retirement_inc_amt_debtor' => 'price',
            'regular_contributions_inc_debtor' => 'yes_no',
            'regular_contributions_inc_amt_debtor' => 'price',
            'unemployment_compensation_inc_debtor' => 'yes_no',
            'unemployment_compensation_inc_amt_debtor' => 'price',
            'social_security_inc_debtor' => 'yes_no',
            'social_security_inc_amt_debtor' => 'price',
            'government_assistance_inc_debtor' => 'yes_no',
            'government_assistance_inc_amt_debtor' => 'price',
            'other_sources_inc_debtor' => 'yes_no',
            'other_sources_inc_amt_debtor' => 'price',
            'debtor_job_title' => 'string',
            'debtor_total_family_income' => 'string',
            'debtor_bussiness_name' => 'string',
            'debtor_bussiness_type' => 'string',
            'debtor_bussiness_nature' => 'string',
            'debtor_money_owed_by_anyone' => 'price',
            'debtor_future_large_amount' => 'string',
            'debtor_last_6_month_large_amount' => 'string',
            'debtor_sued_details' => 'string',
            'debtor_retirement_life_insurance_date' => 'string',
            'debtor_retirement_life_insurance' => 'price',
            // 'spouse-income-info' => "Co-Debtor's/Spouse's Income Info",
            'codebtor_income_data' => "json",
            'joints_debtor_gross_wages' => 'yes_no',
            'joints_debtor_gross_wages_month' => 'price',
            'self_employment_inc_spouse' => 'yes_no',
            'income_net_profit_spouse' => 'price',
            'rental_inc_spouse' => 'yes_no',
            'rental_inc_amt_spouse' => 'price',
            'royality_inc_spouse' => 'yes_no',
            'royality_inc_amt_spouse' => 'price',
            'retirement_inc_spouse' => 'yes_no',
            'retirement_inc_amt_spouse' => 'price',
            'regular_contributions_inc_spouse' => 'yes_no',
            'regular_contributions_inc_amt_spouse' => 'price',
            'unemployment_compensation_inc_spouse' => 'yes_no',
            'unemployment_compensation_inc_amt_spouse' => 'price',
            'social_security_inc_spouse' => 'yes_no',
            'social_security_inc_amt_spouse' => 'price',
            'government_assistance_inc_spouse' => 'yes_no',
            'government_assistance_inc_amt_spouse' => 'price',
            'other_sources_inc_spouse' => 'yes_no',
            'other_sources_inc_amt_spouse' => 'price',
            'spouse_job_title' => 'string',
            'spouse_total_family_income' => 'string',
            'spouse_bussiness_name' => 'string',
            'spouse_bussiness_type' => 'string',
            'spouse_bussiness_nature' => 'string',
            'spouse_money_owed_by_anyone' => 'price',
            'spouse_future_large_amount' => 'string',
            'spouse_last_6_month_large_amount' => 'string',
            'spouse_sued_details' => 'string',
            'spouse_retirement_life_insurance_date' => 'string',
            'spouse_retirement_life_insurance' => 'price',
            // 'mortgage-info' => 'Mortgages',
            'rent_or_own' => 'yes_no',
            'mortgage_rent_1' => 'price',
            'loan_on_property' => 'yes_no',
            'mortgage_property_value_1' => 'price',
            'mortgage_amount_owned_1' => 'price',
            'mortgage_amount_owned_2' => 'price',
            'mortgage_amount_owned_3' => 'price',
            'mortgage_own_1' => 'price',
            'mortgage_own_2' => 'price',
            'mortgage_own_3' => 'price',
            'mortgage_past_payment_1' => 'price',
            'mortgage_past_payment_2' => 'price',
            'mortgage_past_payment_3' => 'price',
            'mortgage_additional_loans' => 'yes_no',
            'mortgage_additional_loans_2' => 'yes_no',
            'mortgages_creditor_name_1' => 'string',
            'mortgages_creditor_address_1' => 'string',
            'mortgages_creditor_city_1' => 'string',
            'mortgages_creditor_state_1' => 'string',
            'mortgages_creditor_zipcode_1' => 'string',
            'mortgages_creditor_name_2' => 'string',
            'mortgages_creditor_address_2' => 'string',
            'mortgages_creditor_city_2' => 'string',
            'mortgages_creditor_state_2' => 'string',
            'mortgages_creditor_zipcode_2' => 'string',
            'mortgages_creditor_name_3' => 'string',
            'mortgages_creditor_address_3' => 'string',
            'mortgages_creditor_city_3' => 'string',
            'mortgages_creditor_state_3' => 'string',
            'mortgages_creditor_zipcode_3' => 'string',
            'mortgage_foreclosure_property' => 'yes_no',
            'mortgage_foreclosure_date' => 'yes_no_reverse',
            'mortgage_foreclosure_date_scheduled' => 'string',
            'mortgage_notes' => 'string',
            // 'vehicles-info' => 'Vehicles/ Motorcycles/ Boats etc.',
            'own_any_vehicle' => 'yes_no',
            'vehicle_details' => 'json',
            'property_type' => 'string',
            'property_estimated_value' => 'price',
            'property_year' => 'string',
            'property_make' => 'string',
            'property_model' => 'string',
            'property_mileage' => 'string',
            'property_other_info' => 'string',
            'loan_own_type_property' => 'yes_no_reverse',
            'vehicle_car_loan' => 'json',
            'past_due_amount' => 'price',
            'amount_own' => 'price',
            'creditor_name' => 'string',
            'creditor_name_addresss' => 'string',
            'creditor_city' => 'string',
            'State' => 'string',
            'creditor_zip' => 'string',
            // 'other-property-info' => 'Other Property',
            'other_property_let_go_item' => 'string',
            'other_property_new_stuff' => 'string',
            'other_property_valued_possession' => 'string',
            // 'secured-loan-info' => 'Other Secured Loans',
            'additional_liens' => 'yes_no',
            'additional_liens_data' => 'json',
            'domestic_support_name' => 'string',
            'domestic_support_address' => 'string',
            'domestic_support_city' => 'string',
            'creditor_state' => 'string',
            'domestic_support_zipcode' => 'string',
            'describe_secure_claim' => 'string',
            'monthly_payment' => 'price',
            'additional_liens_due' => 'price',
            'additional_liens_date' => 'Date',
            // 'back-tax-info' => 'Back taxes owed',
            'last_5_year_taxes' => 'yes_no',
            'tax_owned_irs' => 'yes_no',
            'back_taxes_owed' => 'yes_no',
            'child_supp_or_alimony' => 'yes_no_reverse',
            'current_on_your_support_obligation' => 'yes_no_reverse',
            'taxes_internal_revenue_year' => 'string',
            'taxes_irs_taxes_due' => 'price',
            'taxes_tax_state' => 'string',
            'taxes_franchise_tax_board' => 'string',
            'taxes_state_tax_due' => 'price',
            'taxes_child_support_state' => 'string',
            'taxes_child_support_due' => 'price',
            'taxes_alimony_due' => 'price',
            // 'other-debt-info' => 'Other Debts',
            'credit_crd_debt' => 'price',
            'medical_debt' => 'price',
            'student_loans' => 'price',
            'law_suit' => 'price',
            'personal_loans' => 'price',
            'credit_union_loans' => 'price',
            'family_loans' => 'price',
            'misc_loans' => 'price',
            'made_purchases' => 'yes_no_reverse',
            'checking_account' => 'yes_no_reverse',
            'vehicle_repoed_date' => 'string',
            'borrowed_and_paid_back' => 'string',
            'total_unsecured_loan' => 'price',
            'total_utility_debt' => 'price',
            'tolls_tickets_fines_owed' => 'price',
            'eviction_or_back_rent' => 'price',
            'foreclosure_debt' => 'price',
            'repo_debt' => 'price',
            'money_you_have' => 'price',
            // 'attorney-ques-info' => 'Additional Questions',
            'concierge_question' => 'yes_no_reverse',
            'being_sued' => 'yes_no_reverse',
            'wages_being_garnished' => 'yes_no_reverse',
            'extra_notes' => 'string',
        ];

        return static::returnArrValue($arr, $key);
    }
    public static function getNatureOfCase()
    {
        return [
            'Civil Case' => 'Civil Case',
            'Class Action Case' => 'Class Action Case',
            'Criminal Case' => 'Criminal Case',
            'Dissolution Case' => 'Dissolution Case',
            'Personal Injury Case' => 'Personal Injury Case',
            'Other Type of Case' => 'Other Type of Case'
        ];
    }

    public static function getPotentialClaimTypes()
    {
        return [
            'Car Accidents' => 'Car Accidents',
            'Slip and Falls Claims' => 'Slip and Falls Claims',
            'Medical Malpractice' => 'Medical Malpractice',
            'Workplace Injuries' => 'Workplace Injuries',
            'Employment Disputes' => 'Employment Disputes',
            'Unpaid Wages' => 'Unpaid Wages',
            'Product Liability' => 'Product Liability',
            'Dog Bites' => 'Dog Bites',
            'Insurance Claims' => 'Insurance Claims',
            'Animal Injuries' => 'Animal Injuries',
        ];
    }

    public static function getTimeFrameLabelFromArray($key = null)
    {
        $arr = [
            1 => "Weekly",
            2 => "Biweekly",
            3 => "Every Three Weeks",
            4 => "Monthly"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getMortgagePropertyType($variable)
    {
        $key = 8;
        switch ($variable) {
            case 'Single-family':    $key = 1;
                break;
            case 'Townhome':         $key = 2;
                break;
            case 'Multi-family':     $key = 2;
                break;
            case 'Condo':            $key = 3;
                break;
            case 'Manufactured':     $key = 4;
                break;
            case 'Vacant land':      $key = 5;
                break;
        }

        return $key;
    }
}
