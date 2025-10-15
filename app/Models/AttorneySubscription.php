<?php

namespace App\Models;

use App\Helpers\DateTimeHelper;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttorneySubscription extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_attorney_subscription';
    public $timestamps = false;

    /** Subscription Plans */
    public const BASIC_SUBSCRIPTION = 100;
    public const BASIC_PLUS_SUBSCRIPTION = 148;
    public const PREMIUM_SUBSCRIPTION = 101;
    public const PREMIUM_PLUS_SUBSCRIPTION = 121;
    public const BLACK_LABEL_SUBSCRIPTION = 102;
    public const ULTIMATE_SUBSCRIPTION = 135;
    public const ULTIMATE_PLUS_SUBSCRIPTION = 164;


    public const PAYROLL_ASSISTANT_SUBSCRIPTION = 103;
    public const JOINT_DEBTOR_ADDITIONAL = 114;
    public const JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL = 149;
    public const JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL = 150;
    public const JOINT_DEBTOR_ULTIMATE_ADDITIONAL = 125;
    public const JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL = 165;
    public const STANDARD_CONCIERGE_SERVICE_PACKAGE = 119;
    public const STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE = 157;
    public const PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE = 120;


    public const PACKAGE_IDS = [self::BASIC_SUBSCRIPTION, self::BASIC_PLUS_SUBSCRIPTION, self::PREMIUM_SUBSCRIPTION,self::PREMIUM_PLUS_SUBSCRIPTION,self::BLACK_LABEL_SUBSCRIPTION,self::ULTIMATE_SUBSCRIPTION, self::ULTIMATE_PLUS_SUBSCRIPTION, self::PAYROLL_ASSISTANT_SUBSCRIPTION];

    /** Subscription Plan Pricing */
    public const BASIC_SUBSCRIPTION_PLAN_PRICE = 39.99;
    public const BASIC_PLUS_SUBSCRIPTION_PRICE = 55.98;
    public const PREMIUM_SUBSCRIPTION_PLAN_PRICE = 89.99;
    public const PREMIUM_PLUS_SUBSCRIPTION_PLAN_PRICE = 105.98;
    public const BLACK_LABEL_SUBSCRIPTION_PLAN_PRICE = 99.99;
    public const ULTIMATE_SUBSCRIPTION_PLAN_PRICE = 129.99;
    public const ULTIMATE_PLUS_SUBSCRIPTION_PLAN_PRICE = 145.98;
    public const PAYROLL_ASSISTANT_SUBSCRIPTION_PLAN_PRICE = 24.99;
    public const JOINT_DEBTOR_ADDITIONAL_PRICE = 12.95;
    public const JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL_PRICE = 15.99;
    public const JOINT_DEBTOR_ULTIMATE_ADDITIONAL_PRICE = 00.00;
    public const JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL_PRICE = 00.00;
    public const JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL_PRICE = 15.99;
    public const STANDARD_CONCIERGE_SERVICE_PACKAGE_PRICE = 50.00;
    public const STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE_PRICE = 50.00;
    public const PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE_PRICE = 0.00;

    /** Paralegal Addons */
    public const BASIC_PARALEGAL_ADDON = 110;
    public const BASIC_PLUS_PARALEGAL_ADDON = 151;
    public const PREMIUM_PARALEGAL_ADDON = 111;
    public const PREMIUM_PLUS_PARALEGAL_ADDON = 124;
    public const BLACK_LABEL_PARALEGAL_ADDON = 140;
    public const ULTIMATE_PARALEGAL_ADDON = 141;
    public const ULTIMATE_PLUS_PARALEGAL_ADDON = 166;
    /** Paralegal Addon Pricing */
    public const BASIC_PARALEGAL_ADDON_PRICE = 9.99;
    public const BASIC_PLUS_PARALEGAL_ADDON_PRICE = 9.99;
    public const PREMIUM_PARALEGAL_ADDON_PRICE = 9.99;
    public const PREMIUM_PLUS_PARALEGAL_ADDON_PRICE = 9.99;
    public const BLACK_LABEL_PARALEGAL_ADDON_PRICE = 0.00;
    public const ULTIMATE_PARALEGAL_ADDON_PRICE = 0.00;
    public const ULTIMATE_PLUS_PARALEGAL_ADDON_PRICE = 0.00;

    /** Petition Preparation Addons */
    public const BASIC_PETITION_PREPARATION = 112;
    public const BASIC_PLUS_PETITION_PREPARATION = 152;
    public const PREMIUM_PETITION_PREPARATION = 113;
    public const PREMIUM_PLUS_PETITION_PREPARATION = 123;
    public const BLACK_LABEL_PETITION_PREPARATION = 126;
    public const ULTIMATE_PETITION_PREPARATION = 136;
    public const ULTIMATE_PLUS_PETITION_PREPARATION = 167;

    /** Petition Preparation Addons Pricing*/
    public const BASIC_PETITION_PREPARATION_PRICE = 16.99;
    public const BASIC_PLUS_PETITION_PREPARATION_PRICE = 16.99;
    public const PREMIUM_PETITION_PREPARATION_PRICE = 12.99;
    public const PREMIUM_PLUS_PETITION_PREPARATION_PRICE = 12.99;
    public const BLACK_LABEL_PETITION_PREPARATION_PRICE = 10.99;
    public const ULTIMATE_PETITION_PREPARATION_PRICE = 10.99;
    public const ULTIMATE_PLUS_PETITION_PREPARATION_PRICE = 10.99;

    /** Payroll Addons*/
    public const BASIC_SUBSCRIPTION_PAYROLL = 115;
    public const BASIC_PLUS_SUBSCRIPTION_PAYROLL = 153;
    public const PREMIUM_SUBSCRIPTION_PAYROLL = 116;
    public const PREMIUM_PLUS_SUBSCRIPTION_PAYROLL = 122;
    public const BLACK_LABEL_SUBSCRIPTION_PAYROLL = 117;
    public const ULTIMATE_SUBSCRIPTION_PAYROLL = 137;
    public const ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL = 168;
    public const WELCOME_VIDEO_SUBSCRIPTION = 118;

    /** Payroll Addons Pricing*/
    public const BASIC_SUBSCRIPTION_PAYROLL_PRICE = 16.99;
    public const BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE = 19.99;
    public const PREMIUM_SUBSCRIPTION_PAYROLL_PRICE = 14.99;
    public const PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE = 14.99;
    public const BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE = 10.99;
    public const ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE = 0.00;
    public const ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE = 0.00;
    public const WELCOME_VIDEO_SUBSCRIPTION_PRICE = 30;

    /** Payroll Addons Pricing*/
    public const BASIC_SUBSCRIPTION_PAYROLL_NAME = "Standard Questionnaire";
    public const BASIC_PLUS_SUBSCRIPTION_PAYROLL_NAME = "Standard Plus Questionnaire";
    public const PREMIUM_SUBSCRIPTION_PAYROLL_NAME = "Premium Questionnaire";
    public const PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_NAME = "Premium Plus Questionnaire";
    public const BLACK_LABEL_SUBSCRIPTION_PAYROLL_NAME = "Black Label Questionnaire";
    public const ULTIMATE_SUBSCRIPTION_PAYROLL_NAME = "Ultimate Questionnaire";
    public const ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_NAME = "Ultimate PLUS Questionnaire";

    /** Bank Statements Addons */
    public const BASIC_BANK_STATEMENT = 127;
    public const BASIC_PLUS_BANK_STATEMENT = 154;
    public const PREMIUM_BANK_STATEMENT = 128;
    public const PREMIUM_PLUS_BANK_STATEMENT = 129;
    public const BLACK_LABEL_BANK_STATEMENT = 130;
    public const ULTIMATE_BANK_STATEMENT = 138;
    public const ULTIMATE_PLUS_BANK_STATEMENT = 169;

    /** Bank Statements Addons Pricing*/
    public const BASIC_BANK_STATEMENT_PRICE = 19.99;
    public const BASIC_PLUS_BANK_STATEMENT_PRICE = 19.99;
    public const PREMIUM_BANK_STATEMENT_PRICE = 14.99;
    public const PREMIUM_PLUS_BANK_STATEMENT_PRICE = 14.99;
    public const BLACK_LABEL_BANK_STATEMENT_PRICE = 0.00;
    public const ULTIMATE_BANK_STATEMENT_PRICE = 0.00;
    public const ULTIMATE_PLUS_BANK_STATEMENT_PRICE = 0.00;

    /** Bank Statement Premium Addons */

    public const BASIC_BANK_STATEMENT_PREMIUM = 142;
    public const BASIC_PLUS_BANK_STATEMENT_PREMIUM = 155;
    public const PREMIUM_BANK_STATEMENT_PREMIUM = 143;
    public const PREMIUM_PLUS_BANK_STATEMENT_PREMIUM = 144;
    public const BLACK_LABEL_BANK_STATEMENT_PREMIUM = 145;
    public const ULTIMATE_BANK_STATEMENT_PREMIUM = 146;
    public const ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM = 170;
    public const STAND_ALONE_BANK_STATEMENT_PREMIUM = 147;


    public const BASIC_CREDIT_REPORT = 158;
    public const BASIC_PLUS_CREDIT_REPORT = 159;
    public const PREMIUM_CREDIT_REPORT = 160;
    public const PREMIUM_PLUS_CREDIT_REPORT = 161;
    public const BLACK_LABEL_CREDIT_REPORT = 162;
    public const ULTIMATE_CREDIT_REPORT = 163;
    public const ULTIMATE_PLUS_CREDIT_REPORT = 171;


    /** Bank Statement Assistant Pricing */

    public const BASIC_BANK_STATEMENT_PREMIUM_PRICE = 25.99;
    public const BASIC_PLUS_BANK_STATEMENT_PREMIUM_PRICE = 25.99;
    public const PREMIUM_BANK_STATEMENT_PREMIUM_PRICE = 19.99;
    public const PREMIUM_PLUS_BANK_STATEMENT_PREMIUM_PRICE = 19.99;
    public const BLACK_LABEL_BANK_STATEMENT_PREMIUM_PRICE = 6.00;
    public const ULTIMATE_BANK_STATEMENT_PREMIUM_PRICE = 6.00;
    public const ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM_PRICE = 6.00;
    public const STAND_ALONE_BANK_STATEMENT_PREMIUM_PRICE = 28.99;

    /** Tax Dishchargability Assistant PRICING */

    // public const TAX_DISCHARGABILITY_ASSISTANT =

    /** Profit Loss Assistant Addons */
    public const BASIC_PROFIT_LOSS_ASSISTANT = 131;
    public const BASIC_PLUS_PROFIT_LOSS_ASSISTANT = 156;
    public const PREMIUM_PROFIT_LOSS_ASSISTANT = 132;
    public const PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT = 133;
    public const BLACK_LABEL_PROFIT_LOSS_ASSISTANT = 134;
    public const ULTIMATE_PROFIT_LOSS_ASSISTANT = 139;
    public const ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT = 172;

    /** Profit Loss Assistant Addons Pricing*/
    public const BASIC_PROFIT_LOSS_ASSISTANT_PRICE = 45.99;
    public const BASIC_PLUS_PROFIT_LOSS_ASSISTANT_PRICE = 45.99;
    public const PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE = 35.99;
    public const PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE = 35.99;
    public const BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE = 29.99;
    public const ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE = 29.99;
    public const ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE = 29.99;

    /** Credit Report Addons Pricing*/
    public const BASIC_CREDIT_REPORT_PRICE = 15.99;
    public const BASIC_PLUS_CREDIT_REPORT_PRICE = 0.00;
    public const PREMIUM_CREDIT_REPORT_PRICE = 15.99;
    public const PREMIUM_PLUS_CREDIT_REPORT_PRICE = 0.00;
    public const BLACK_LABEL_CREDIT_REPORT_PRICE = 15.99;
    public const ULTIMATE_CREDIT_REPORT_PRICE = 15.99;
    public const ULTIMATE_PLUS_CREDIT_REPORT_PRICE = 0.00;



    public static function payrollPriceArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION_PAYROLL => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE,
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::PREMIUM_SUBSCRIPTION_PAYROLL => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE,
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function payrollNameArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION_PAYROLL => self::BASIC_SUBSCRIPTION_PAYROLL_NAME,
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_NAME,
            self::PREMIUM_SUBSCRIPTION_PAYROLL => self::PREMIUM_SUBSCRIPTION_PAYROLL_NAME,
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_NAME,
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_NAME,
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => self::ULTIMATE_SUBSCRIPTION_PAYROLL_NAME,
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_NAME,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function payrollBySubscriptionArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_SUBSCRIPTION_PAYROLL,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_SUBSCRIPTION_PAYROLL,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_SUBSCRIPTION_PAYROLL,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function bankStatementBySubscriptionArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_BANK_STATEMENT,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_BANK_STATEMENT,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_BANK_STATEMENT,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_BANK_STATEMENT,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_BANK_STATEMENT,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_BANK_STATEMENT,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_BANK_STATEMENT,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function bankStatementPremiumBySubscriptionArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_BANK_STATEMENT_PREMIUM,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_BANK_STATEMENT_PREMIUM,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_BANK_STATEMENT_PREMIUM,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_BANK_STATEMENT_PREMIUM,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_BANK_STATEMENT_PREMIUM,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function profitLossBySubscriptionArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_PROFIT_LOSS_ASSISTANT,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_PROFIT_LOSS_ASSISTANT,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_PROFIT_LOSS_ASSISTANT,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function creditReortBySubscriptionArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_CREDIT_REPORT,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_CREDIT_REPORT,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_CREDIT_REPORT,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_CREDIT_REPORT,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_CREDIT_REPORT,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_CREDIT_REPORT,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_CREDIT_REPORT,
        ];

        return static::returnArrValue($arr, $key);
    }

    public const NON_DISCOUNT_PACKAGE = [
        self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL,
        self::JOINT_DEBTOR_ADDITIONAL,
        self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL,
        self::BASIC_PLUS_PETITION_PREPARATION,
        self::BASIC_PETITION_PREPARATION,
        self::PREMIUM_PETITION_PREPARATION,
        self::PREMIUM_PLUS_PETITION_PREPARATION,
        self::BLACK_LABEL_PETITION_PREPARATION,
        self::ULTIMATE_PETITION_PREPARATION,
        self::ULTIMATE_PLUS_PETITION_PREPARATION,
        self::BASIC_PARALEGAL_ADDON,
        self::BASIC_PLUS_PARALEGAL_ADDON,
        self::PREMIUM_PARALEGAL_ADDON,
        self::PREMIUM_PLUS_PARALEGAL_ADDON,
        self::BLACK_LABEL_PARALEGAL_ADDON,
        self::ULTIMATE_PARALEGAL_ADDON,
        self::ULTIMATE_PLUS_PARALEGAL_ADDON,
        self::BASIC_SUBSCRIPTION_PAYROLL,
        self::BASIC_PLUS_SUBSCRIPTION_PAYROLL,
        self::PREMIUM_SUBSCRIPTION_PAYROLL,
        self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL,
        self::BLACK_LABEL_SUBSCRIPTION_PAYROLL,
        self::ULTIMATE_SUBSCRIPTION_PAYROLL,
        self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL,
    ];
    public static function packageNameArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Subscription ($".self::packagePriceArray(self::BASIC_SUBSCRIPTION).")",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus Subscription ($".self::packagePriceArray(self::BASIC_PLUS_SUBSCRIPTION).")",
            self::PREMIUM_SUBSCRIPTION => "Premium Subscription ($".self::packagePriceArray(self::PREMIUM_SUBSCRIPTION).")",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus Subscription ($".self::packagePriceArray(self::PREMIUM_PLUS_SUBSCRIPTION).")",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label Subscription ($".self::packagePriceArray(self::BLACK_LABEL_SUBSCRIPTION).")",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate Subscription ($".self::packagePriceArray(self::ULTIMATE_SUBSCRIPTION).")",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus Subscription ($".self::packagePriceArray(self::ULTIMATE_PLUS_SUBSCRIPTION).")",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only ($".self::packagePriceArray(self::PAYROLL_ASSISTANT_SUBSCRIPTION)." per Individual)"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function classByPackageName($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "gray", //cecece
            self::BASIC_PLUS_SUBSCRIPTION => "gray", //cecece
            self::PREMIUM_SUBSCRIPTION => "light-blue", //00bdd1
            self::PREMIUM_PLUS_SUBSCRIPTION => "dark-blue", //0c00aa
            self::BLACK_LABEL_SUBSCRIPTION => "black", //000000
            self::ULTIMATE_SUBSCRIPTION => "green", //008000
            self::ULTIMATE_PLUS_SUBSCRIPTION => "green", //008000
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "standard" //
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function packageNameForClient($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Subscription",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus Subscription",
            self::PREMIUM_SUBSCRIPTION => "Premium Subscription",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus Subscription",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label Subscription",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate Subscription",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus Subscription",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function inviteClientpackageNameArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Questionnaire ($".self::packagePriceArray(self::BASIC_SUBSCRIPTION).")",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard + Credit Report ($".self::packagePriceArray(self::BASIC_PLUS_SUBSCRIPTION).")",
            self::PREMIUM_SUBSCRIPTION => "Premium Questionnaire ($".self::packagePriceArray(self::PREMIUM_SUBSCRIPTION).")",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium + Credit Report ($".self::packagePriceArray(self::PREMIUM_PLUS_SUBSCRIPTION).")",
            // self::BLACK_LABEL_SUBSCRIPTION => "Black Label Questionnaire ($".self::packagePriceArray(self::BLACK_LABEL_SUBSCRIPTION).")",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate Questionnaire ($".self::packagePriceArray(self::ULTIMATE_SUBSCRIPTION).")",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate + Credit Report ($".self::packagePriceArray(self::ULTIMATE_PLUS_SUBSCRIPTION).")",

            // self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only ($".self::packagePriceArray(self::PAYROLL_ASSISTANT_SUBSCRIPTION)." per Individual)"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function packageNameLandingPageArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus",
            self::PREMIUM_SUBSCRIPTION => "Premium",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function packageNameAttorneySettingPageArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::BASIC_SUBSCRIPTION)."</span>",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::BASIC_PLUS_SUBSCRIPTION)."</span>",
            self::PREMIUM_SUBSCRIPTION => "Premium<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::PREMIUM_SUBSCRIPTION)."</span>",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::PREMIUM_PLUS_SUBSCRIPTION)."</span>",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::BLACK_LABEL_SUBSCRIPTION)."</span>",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::ULTIMATE_SUBSCRIPTION)."</span>",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus<br> Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::ULTIMATE_PLUS_SUBSCRIPTION)."</span>",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant<br> Only<br> <span style='font-family:arial;font-size: 16px;'>$".self::packagePriceArray(self::PAYROLL_ASSISTANT_SUBSCRIPTION)." per Individual</span>",
            self::JOINT_DEBTOR_ADDITIONAL => "Add Joint Married<br> to Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>$".self::JOINT_DEBTOR_ADDITIONAL_PRICE."</span>",
            self::BASIC_SUBSCRIPTION_PAYROLL => [
                "debtor" => "Payroll assistant<br> to Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>Additional $" .self::BASIC_SUBSCRIPTION_PAYROLL_PRICE."</span><br><small class='smp'>Debtor</small>",
                "spouse" => "Payroll assistant<br> to Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>Additional $" .self::BASIC_SUBSCRIPTION_PAYROLL_PRICE."</span><br><small class='smp'>Co-Debtor/Non-Filling Spouse</small>"
            ],
            self::PREMIUM_SUBSCRIPTION_PAYROLL => [
                "debtor" => "Payroll assistant<br> to Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>Additional $" .self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE."</span><br><small class='smp'>Debtor</small>",
                "spouse" => "Payroll assistant<br> to Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>Additional $" .self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE."</span><br><small class='smp'>Co-Debtor/Non-Filling Spouse</small>"
            ]

        ];

        return static::returnArrValue($arr, $key);
    }

    public static function settingsPageAllPackageNameArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => [
                self::STANDARD_CONCIERGE_SERVICE_PACKAGE => self::STANDARD_CONCIERGE_SERVICE_PACKAGE_PRICE,
                self::BASIC_SUBSCRIPTION_PAYROLL => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE,
                self::BASIC_BANK_STATEMENT => self::BASIC_BANK_STATEMENT_PRICE,
                self::BASIC_BANK_STATEMENT_PREMIUM => self::BASIC_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_ADDITIONAL => self::JOINT_DEBTOR_ADDITIONAL_PRICE,
                self::BASIC_PROFIT_LOSS_ASSISTANT => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE,
                self::BASIC_CREDIT_REPORT => self::BASIC_CREDIT_REPORT_PRICE,
                self::BASIC_PETITION_PREPARATION => self::BASIC_PETITION_PREPARATION_PRICE,
                self::BASIC_PARALEGAL_ADDON => self::BASIC_PARALEGAL_ADDON_PRICE,
                self::BASIC_SUBSCRIPTION => self::BASIC_SUBSCRIPTION_PLAN_PRICE
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE => self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE_PRICE,
                self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                self::BASIC_PLUS_BANK_STATEMENT => self::BASIC_BANK_STATEMENT_PRICE,
                self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => self::BASIC_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL_PRICE,
                self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE,
                self::BASIC_PLUS_CREDIT_REPORT => self::BASIC_PLUS_CREDIT_REPORT_PRICE,
                self::BASIC_PLUS_PETITION_PREPARATION => self::BASIC_PETITION_PREPARATION_PRICE,
                self::BASIC_PLUS_PARALEGAL_ADDON => self::BASIC_PARALEGAL_ADDON_PRICE,
                self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_SUBSCRIPTION_PRICE
            ],
            self::PREMIUM_SUBSCRIPTION => [
                self::PREMIUM_SUBSCRIPTION_PAYROLL => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE,
                self::PREMIUM_BANK_STATEMENT => self::PREMIUM_BANK_STATEMENT_PRICE,
                self::PREMIUM_BANK_STATEMENT_PREMIUM => self::PREMIUM_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_ADDITIONAL => self::JOINT_DEBTOR_ADDITIONAL_PRICE,
                self::PREMIUM_PROFIT_LOSS_ASSISTANT => self::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE,
                self::PREMIUM_CREDIT_REPORT => self::PREMIUM_CREDIT_REPORT_PRICE,
                self::PREMIUM_PETITION_PREPARATION => self::PREMIUM_PETITION_PREPARATION_PRICE,
                self::PREMIUM_PARALEGAL_ADDON => self::PREMIUM_PARALEGAL_ADDON_PRICE,
                self::PREMIUM_SUBSCRIPTION => self::PREMIUM_SUBSCRIPTION_PLAN_PRICE,
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                self::PREMIUM_PLUS_BANK_STATEMENT => self::PREMIUM_PLUS_BANK_STATEMENT_PRICE,
                self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL_PRICE,
                self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                self::PREMIUM_PLUS_CREDIT_REPORT => self::PREMIUM_PLUS_CREDIT_REPORT_PRICE,
                self::PREMIUM_PLUS_PETITION_PREPARATION => self::PREMIUM_PLUS_PETITION_PREPARATION_PRICE,
                self::PREMIUM_PLUS_PARALEGAL_ADDON => self::PREMIUM_PLUS_PARALEGAL_ADDON_PRICE,
                self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_SUBSCRIPTION_PLAN_PRICE,
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE,
                self::BLACK_LABEL_BANK_STATEMENT => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
                self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => self::BLACK_LABEL_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_ADDITIONAL => self::JOINT_DEBTOR_ADDITIONAL_PRICE,
                self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE,
                self::BLACK_LABEL_CREDIT_REPORT => self::BLACK_LABEL_CREDIT_REPORT_PRICE,
                self::BLACK_LABEL_PETITION_PREPARATION => self::BLACK_LABEL_PETITION_PREPARATION_PRICE,
                self::BLACK_LABEL_PARALEGAL_ADDON => self::BLACK_LABEL_PARALEGAL_ADDON_PRICE,
                self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_SUBSCRIPTION_PLAN_PRICE,
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                self::ULTIMATE_SUBSCRIPTION_PAYROLL => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE,
                self::ULTIMATE_BANK_STATEMENT => self::ULTIMATE_BANK_STATEMENT_PRICE,
                self::ULTIMATE_BANK_STATEMENT_PREMIUM => self::ULTIMATE_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL_PRICE,
                self::ULTIMATE_PROFIT_LOSS_ASSISTANT => self::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE,
                self::ULTIMATE_CREDIT_REPORT => self::ULTIMATE_CREDIT_REPORT_PRICE,
                self::ULTIMATE_PETITION_PREPARATION => self::ULTIMATE_PETITION_PREPARATION_PRICE,
                self::ULTIMATE_PARALEGAL_ADDON => self::ULTIMATE_PARALEGAL_ADDON_PRICE,
                self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_SUBSCRIPTION_PLAN_PRICE,
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                self::ULTIMATE_PLUS_BANK_STATEMENT => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
                self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
                self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL_PRICE,
                self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                self::ULTIMATE_PLUS_CREDIT_REPORT => self::ULTIMATE_PLUS_CREDIT_REPORT_PRICE,
                self::ULTIMATE_PLUS_PETITION_PREPARATION => self::ULTIMATE_PLUS_PETITION_PREPARATION_PRICE,
                self::ULTIMATE_PLUS_PARALEGAL_ADDON => self::ULTIMATE_PLUS_PARALEGAL_ADDON_PRICE,
                self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_SUBSCRIPTION_PLAN_PRICE,
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                self::PAYROLL_ASSISTANT_SUBSCRIPTION => self::PAYROLL_ASSISTANT_SUBSCRIPTION_PLAN_PRICE,
            ],
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function addSubscriptionRecord($attorney_id, $packageId, $packagePrice, $noOfClients, $productId)
    {

        $subscription = [
            'attorney_id' => $attorney_id,
            'type' => $packageId,
            'amount' => $packagePrice,
            'payment_status' => Helper::SUCCESS,
            'payment_remark' => "Payment made successfully.",
            'total_paid' => $packagePrice,
            'subscribe' => 1,
            'package_name' => AttorneySubscription::allPackageNameWithParamForTransactionArray($packageId),
            'discount_percentage' => AttorneySubscription::getdiscountPercentage($attorney_id),
            'discount_amount' => AttorneySubscription::getdiscountAmount($noOfClients, $packagePrice, $attorney_id),
            'stripe_subscription_id' => $productId,
            'no_of_questionnaire' => $noOfClients
        ];
        AttorneySubscription::create($subscription);
    }

    public static function settingsPageAllPackageClassArray($key = null)
    {



        $arr = [
            self::BASIC_SUBSCRIPTION => [
                self::BASIC_SUBSCRIPTION => self::BASIC_SUBSCRIPTION_PLAN_PRICE,
                self::BASIC_PARALEGAL_ADDON => "paralegal-amount",
                self::BASIC_PETITION_PREPARATION => "petition-amount",
                self::BASIC_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::BASIC_BANK_STATEMENT => "bank-statement-amount",
                self::BASIC_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::BASIC_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::BASIC_CREDIT_REPORT => "credit-report-amount",
                self::STANDARD_CONCIERGE_SERVICE_PACKAGE => "concierge-service-amount",
                self::JOINT_DEBTOR_ADDITIONAL => "joint-married-amount"
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_SUBSCRIPTION_PRICE,
                self::BASIC_PLUS_PARALEGAL_ADDON => "paralegal-amount",
                self::BASIC_PLUS_PETITION_PREPARATION => "petition-amount",
                self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::BASIC_PLUS_BANK_STATEMENT => "bank-statement-amount",
                self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::BASIC_PLUS_CREDIT_REPORT => "credit-report-amount",
                self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE => "concierge-service-amount",
                self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => "joint-married-amount"
            ],
            self::PREMIUM_SUBSCRIPTION => [
                self::PREMIUM_SUBSCRIPTION => self::PREMIUM_SUBSCRIPTION_PLAN_PRICE,
                self::PREMIUM_PARALEGAL_ADDON => "paralegal-amount",
                self::PREMIUM_PETITION_PREPARATION => "petition-amount",
                self::PREMIUM_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::PREMIUM_BANK_STATEMENT => "bank-statement-amount",
                self::PREMIUM_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::PREMIUM_CREDIT_REPORT => "credit-report-amount",
                self::PREMIUM_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::JOINT_DEBTOR_ADDITIONAL => "joint-married-amount"
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_SUBSCRIPTION_PLAN_PRICE,
                self::PREMIUM_PLUS_PARALEGAL_ADDON => "paralegal-amount",
                self::PREMIUM_PLUS_PETITION_PREPARATION => "petition-amount",
                self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::PREMIUM_PLUS_BANK_STATEMENT => "bank-statement-amount",
                self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::PREMIUM_PLUS_CREDIT_REPORT => "credit-report-amount",
                self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::JOINT_DEBTOR_ADDITIONAL => "joint-married-amount"
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_SUBSCRIPTION_PLAN_PRICE,
                self::BLACK_LABEL_PARALEGAL_ADDON => "paralegal-amount",
                self::BLACK_LABEL_PETITION_PREPARATION => "petition-amount",
                self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::BLACK_LABEL_BANK_STATEMENT => "bank-statement-amount",
                self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::BLACK_LABEL_CREDIT_REPORT => "credit-report-amount",
                self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::JOINT_DEBTOR_ADDITIONAL => "joint-married-amount"
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_SUBSCRIPTION_PLAN_PRICE,
                self::ULTIMATE_PARALEGAL_ADDON => "paralegal-amount",
                self::ULTIMATE_PETITION_PREPARATION => "petition-amount",
                self::ULTIMATE_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::ULTIMATE_BANK_STATEMENT => "bank-statement-amount",
                self::ULTIMATE_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::ULTIMATE_CREDIT_REPORT => "credit-report-amount",
                self::ULTIMATE_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "joint-married-amount"
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_SUBSCRIPTION_PLAN_PRICE,
                self::ULTIMATE_PLUS_PARALEGAL_ADDON => "paralegal-amount",
                self::ULTIMATE_PLUS_PETITION_PREPARATION => "petition-amount",
                self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => "payroll-amount",
                self::ULTIMATE_PLUS_BANK_STATEMENT => "bank-statement-amount",
                self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => "bank-statement-premium-amount",
                self::ULTIMATE_PLUS_CREDIT_REPORT => "credit-report-amount",
                self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => "profit-loss-amount",
                self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => "joint-married-amount"
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                self::PAYROLL_ASSISTANT_SUBSCRIPTION => "payroll-amount",
            ],
        ];

        return static::returnArrValue($arr, $key);
    }
    public static function allPackageNameByIdArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Questionnaire",
            self::BASIC_PETITION_PREPARATION => "Petition Preparation",
            self::BASIC_PARALEGAL_ADDON => "Paralegal Assistant",
            self::BASIC_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::BASIC_BANK_STATEMENT => "Bank Statement Assistant",
            self::BASIC_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::BASIC_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::BASIC_CREDIT_REPORT => "Credit Report",

            self::BASIC_PLUS_SUBSCRIPTION => "Standard Questionnaire",
            self::BASIC_PLUS_PETITION_PREPARATION => "Petition Preparation",
            self::BASIC_PLUS_PARALEGAL_ADDON => "Paralegal Assistant",
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::BASIC_PLUS_BANK_STATEMENT => "Bank Statement Assistant",
            self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::BASIC_PLUS_CREDIT_REPORT => "Credit Report",

            self::PREMIUM_SUBSCRIPTION => "Premium Questionnaire",
            self::PREMIUM_PETITION_PREPARATION => "Petition Preparation",
            self::PREMIUM_PARALEGAL_ADDON => "Paralegal Assistant",
            self::PREMIUM_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::PREMIUM_BANK_STATEMENT => "Bank Statement Assistant",
            self::PREMIUM_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::PREMIUM_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::PREMIUM_CREDIT_REPORT => "Credit Report",

            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus Questionnaire",
            self::PREMIUM_PLUS_PETITION_PREPARATION => "Petition Preparation",
            self::PREMIUM_PLUS_PARALEGAL_ADDON => "Paralegal Assistant",
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::PREMIUM_PLUS_BANK_STATEMENT => "Bank Statement Assistant",
            self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::PREMIUM_PLUS_CREDIT_REPORT => "Credit Report",

            self::BLACK_LABEL_SUBSCRIPTION => "Black Label Questionnaire",
            self::BLACK_LABEL_PETITION_PREPARATION => "Petition Preparation",
            self::BLACK_LABEL_PARALEGAL_ADDON => "Paralegal Assistant",
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::BLACK_LABEL_CREDIT_REPORT => "Credit Report",

            self::ULTIMATE_SUBSCRIPTION => "Ultimate Questionnaire",
            self::ULTIMATE_PETITION_PREPARATION => "Petition Preparation",
            self::ULTIMATE_PARALEGAL_ADDON => "Paralegal Assistant",
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::ULTIMATE_BANK_STATEMENT => "Bank Statement Assistant",
            self::ULTIMATE_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::ULTIMATE_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::ULTIMATE_CREDIT_REPORT => "Credit Report",

            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Questionnaire",
            self::ULTIMATE_PLUS_PETITION_PREPARATION => "Petition Preparation",
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => "Paralegal Assistant",
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => "Payroll Assistant",
            self::ULTIMATE_PLUS_BANK_STATEMENT => "Bank Statement Assistant",
            self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium",
            self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant",
            self::ULTIMATE_PLUS_CREDIT_REPORT => "Credit Report",

            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only",

            self::JOINT_DEBTOR_ADDITIONAL => "Joint Married",
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "Joint Married",

            self::STANDARD_CONCIERGE_SERVICE_PACKAGE => "Standard Concierge Service",
            self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE => "Premium Concierge Service",
            self::JOINT_DEBTOR_ADDITIONAL => "Joint Debtor Additional",
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "Joint Debtor Additional",
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => "Joint Debtor Additional"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function packagePriceArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_SUBSCRIPTION_PLAN_PRICE,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_SUBSCRIPTION_PRICE,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_SUBSCRIPTION_PLAN_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_SUBSCRIPTION_PLAN_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_SUBSCRIPTION_PLAN_PRICE,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_SUBSCRIPTION_PLAN_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_SUBSCRIPTION_PLAN_PRICE,
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => self::PAYROLL_ASSISTANT_SUBSCRIPTION_PLAN_PRICE,
            self::JOINT_DEBTOR_ADDITIONAL => self::JOINT_DEBTOR_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL_PRICE,
            self::BASIC_SUBSCRIPTION_PAYROLL => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE,
            self::PREMIUM_SUBSCRIPTION_PAYROLL => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE,
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::BASIC_BANK_STATEMENT => self::BASIC_BANK_STATEMENT_PRICE,
            self::BASIC_PLUS_BANK_STATEMENT => self::BASIC_PLUS_BANK_STATEMENT_PRICE,
            self::PREMIUM_BANK_STATEMENT => self::PREMIUM_BANK_STATEMENT_PRICE,
            self::PREMIUM_PLUS_BANK_STATEMENT => self::PREMIUM_PLUS_BANK_STATEMENT_PRICE,
            self::BLACK_LABEL_BANK_STATEMENT => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
            self::ULTIMATE_BANK_STATEMENT => self::ULTIMATE_BANK_STATEMENT_PRICE,
            self::ULTIMATE_PLUS_BANK_STATEMENT => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
            self::BASIC_PROFIT_LOSS_ASSISTANT => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE,
            self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
            self::PREMIUM_PROFIT_LOSS_ASSISTANT => self::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE,
            self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
            self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE,
            self::ULTIMATE_PROFIT_LOSS_ASSISTANT => self::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE,
            self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
            self::BASIC_CREDIT_REPORT => self::BASIC_CREDIT_REPORT_PRICE,
            self::BASIC_PLUS_CREDIT_REPORT => self::BASIC_PLUS_CREDIT_REPORT_PRICE,
            self::PREMIUM_CREDIT_REPORT => self::PREMIUM_CREDIT_REPORT_PRICE,
            self::PREMIUM_PLUS_CREDIT_REPORT => self::PREMIUM_PLUS_CREDIT_REPORT_PRICE,
            self::BLACK_LABEL_CREDIT_REPORT => self::BLACK_LABEL_CREDIT_REPORT_PRICE,
            self::ULTIMATE_CREDIT_REPORT => self::ULTIMATE_CREDIT_REPORT_PRICE,
            self::ULTIMATE_PLUS_CREDIT_REPORT => self::ULTIMATE_PLUS_CREDIT_REPORT_PRICE,


        ];

        return static::returnArrValue($arr, $key);
    }


    public static function allPackagePriceArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_SUBSCRIPTION_PLAN_PRICE,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_SUBSCRIPTION_PRICE,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_SUBSCRIPTION_PLAN_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_SUBSCRIPTION_PLAN_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_SUBSCRIPTION_PLAN_PRICE,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_SUBSCRIPTION_PLAN_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_SUBSCRIPTION_PLAN_PRICE,
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => self::PAYROLL_ASSISTANT_SUBSCRIPTION_PLAN_PRICE,
            self::BASIC_PETITION_PREPARATION => self::BASIC_PETITION_PREPARATION_PRICE,
            self::BASIC_PLUS_PETITION_PREPARATION => self::BASIC_PLUS_PETITION_PREPARATION_PRICE,
            self::PREMIUM_PETITION_PREPARATION => self::PREMIUM_PETITION_PREPARATION_PRICE,
            self::PREMIUM_PLUS_PETITION_PREPARATION => self::PREMIUM_PLUS_PETITION_PREPARATION_PRICE,
            self::BLACK_LABEL_PETITION_PREPARATION => self::BLACK_LABEL_PETITION_PREPARATION_PRICE,
            self::ULTIMATE_PETITION_PREPARATION => self::ULTIMATE_PETITION_PREPARATION_PRICE,
            self::ULTIMATE_PLUS_PETITION_PREPARATION => self::ULTIMATE_PLUS_PETITION_PREPARATION_PRICE,
            self::BASIC_PARALEGAL_ADDON => self::BASIC_PARALEGAL_ADDON_PRICE,
            self::BASIC_PLUS_PARALEGAL_ADDON => self::BASIC_PLUS_PARALEGAL_ADDON_PRICE,
            self::PREMIUM_PARALEGAL_ADDON => self::PREMIUM_PARALEGAL_ADDON_PRICE,
            self::PREMIUM_PLUS_PARALEGAL_ADDON => self::PREMIUM_PLUS_PARALEGAL_ADDON_PRICE,
            self::BLACK_LABEL_PARALEGAL_ADDON => self::BLACK_LABEL_PARALEGAL_ADDON_PRICE,
            self::ULTIMATE_PARALEGAL_ADDON => self::ULTIMATE_PARALEGAL_ADDON_PRICE,
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => self::ULTIMATE_PLUS_PARALEGAL_ADDON_PRICE,
            self::JOINT_DEBTOR_ADDITIONAL => self::JOINT_DEBTOR_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL_PRICE,
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL_PRICE,
            self::BASIC_SUBSCRIPTION_PAYROLL => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE,
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::PREMIUM_SUBSCRIPTION_PAYROLL => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE,
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
            self::WELCOME_VIDEO_SUBSCRIPTION => self::WELCOME_VIDEO_SUBSCRIPTION_PRICE,
            self::STANDARD_CONCIERGE_SERVICE_PACKAGE => self::STANDARD_CONCIERGE_SERVICE_PACKAGE_PRICE,
            self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE => self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE_PRICE,
            self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE => self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE_PRICE,
            self::BASIC_BANK_STATEMENT => self::BASIC_BANK_STATEMENT_PRICE,
            self::BASIC_PLUS_BANK_STATEMENT => self::BASIC_PLUS_BANK_STATEMENT_PRICE,
            self::PREMIUM_BANK_STATEMENT => self::PREMIUM_BANK_STATEMENT_PRICE,
            self::PREMIUM_PLUS_BANK_STATEMENT => self::PREMIUM_PLUS_BANK_STATEMENT_PRICE,
            self::BLACK_LABEL_BANK_STATEMENT => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
            self::ULTIMATE_BANK_STATEMENT => self::ULTIMATE_BANK_STATEMENT_PRICE,
            self::ULTIMATE_PLUS_BANK_STATEMENT => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
            self::BASIC_BANK_STATEMENT_PREMIUM => self::BASIC_BANK_STATEMENT_PREMIUM_PRICE,
            self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => self::BASIC_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
            self::PREMIUM_BANK_STATEMENT_PREMIUM => self::PREMIUM_BANK_STATEMENT_PREMIUM_PRICE,
            self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
            self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => self::BLACK_LABEL_BANK_STATEMENT_PREMIUM_PRICE,
            self::ULTIMATE_BANK_STATEMENT_PREMIUM => self::ULTIMATE_BANK_STATEMENT_PREMIUM_PRICE,
            self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
            self::BASIC_PROFIT_LOSS_ASSISTANT => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE,
            self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
            self::PREMIUM_PROFIT_LOSS_ASSISTANT => self::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE,
            self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
            self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE,
            self::ULTIMATE_PROFIT_LOSS_ASSISTANT => self::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE,
            self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
            self::BASIC_CREDIT_REPORT => self::BASIC_CREDIT_REPORT_PRICE,
            self::BASIC_PLUS_CREDIT_REPORT => self::BASIC_PLUS_CREDIT_REPORT_PRICE,
            self::PREMIUM_CREDIT_REPORT => self::PREMIUM_CREDIT_REPORT_PRICE,
            self::PREMIUM_PLUS_CREDIT_REPORT => self::PREMIUM_PLUS_CREDIT_REPORT_PRICE,
            self::BLACK_LABEL_CREDIT_REPORT => self::BLACK_LABEL_CREDIT_REPORT_PRICE,
            self::ULTIMATE_CREDIT_REPORT => self::ULTIMATE_CREDIT_REPORT_PRICE,
            self::ULTIMATE_PLUS_CREDIT_REPORT => self::ULTIMATE_PLUS_CREDIT_REPORT_PRICE,

        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPetitionPricePackageWise($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_PETITION_PREPARATION_PRICE,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_PETITION_PREPARATION_PRICE,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_PETITION_PREPARATION_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_PETITION_PREPARATION_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_PETITION_PREPARATION_PRICE,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_PETITION_PREPARATION_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_PETITION_PREPARATION_PRICE,
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => 0.00
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getParalegalPricePackageWise($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => self::BASIC_PARALEGAL_ADDON_PRICE,
            self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_PARALEGAL_ADDON_PRICE,
            self::PREMIUM_SUBSCRIPTION => self::PREMIUM_PARALEGAL_ADDON_PRICE,
            self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_PARALEGAL_ADDON_PRICE,
            self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_PARALEGAL_ADDON_PRICE,
            self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_PARALEGAL_ADDON_PRICE,
            self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_PARALEGAL_ADDON_PRICE,
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => 0.00
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPetitionPackageArray($key = null)
    {
        $arr = [
            self::BASIC_PETITION_PREPARATION => "Petition Preparation<br>With Standard Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::BASIC_PETITION_PREPARATION_PRICE."</span>",
            self::BASIC_PLUS_PETITION_PREPARATION => "Petition Preparation<br>With Standard PLus Questionnaire<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::BASIC_PLUS_PETITION_PREPARATION_PRICE."</span>",
            self::PREMIUM_PETITION_PREPARATION => "Petition Preparation<br>With Premium Questionnaire<br> <span style='font-family:arial;font-size: 16px;'> ".'$'.self::PREMIUM_PETITION_PREPARATION_PRICE."</span>",
            self::PREMIUM_PLUS_PETITION_PREPARATION => "Petition Preparation<br>With Premium Plus Questionnaire<br> <span style='font-family:arial;font-size: 16px;'> ".'$'.self::PREMIUM_PLUS_PETITION_PREPARATION_PRICE."</span>",
            self::BLACK_LABEL_PETITION_PREPARATION => "Petition Preparation<br>With Black Label Questionnaire<br> <span style='font-family:arial;font-size: 16px;'> ".'$'.self::BLACK_LABEL_PETITION_PREPARATION_PRICE."</span>",
            self::ULTIMATE_PETITION_PREPARATION => "Petition Preparation<br>With Ultimate Questionnaire<br> <span style='font-family:arial;font-size: 16px;'> ".'$'.self::ULTIMATE_PETITION_PREPARATION_PRICE."</span>",
            self::ULTIMATE_PLUS_PETITION_PREPARATION => "Petition Preparation<br>With Ultimate Plus Questionnaire<br> <span style='font-family:arial;font-size: 16px;'> ".'$'.self::ULTIMATE_PLUS_PETITION_PREPARATION_PRICE."</span>"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getPetitionPriceArray($key = null)
    {
        $arr = [
            self::BASIC_PETITION_PREPARATION => self::BASIC_PETITION_PREPARATION_PRICE,
            self::BASIC_PLUS_PETITION_PREPARATION => self::BASIC_PLUS_PETITION_PREPARATION_PRICE,
            self::PREMIUM_PETITION_PREPARATION => self::PREMIUM_PETITION_PREPARATION_PRICE,
            self::PREMIUM_PLUS_PETITION_PREPARATION => self::PREMIUM_PLUS_PETITION_PREPARATION_PRICE,
            self::BLACK_LABEL_PETITION_PREPARATION => self::BLACK_LABEL_PETITION_PREPARATION_PRICE,
            self::ULTIMATE_PETITION_PREPARATION => self::ULTIMATE_PETITION_PREPARATION_PRICE,
            self::ULTIMATE_PLUS_PETITION_PREPARATION => self::ULTIMATE_PLUS_PETITION_PREPARATION_PRICE,
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getParalegalArray($key = null)
    {
        $arr = [
            self::BASIC_PARALEGAL_ADDON => "Paralegal Check<br>(Standard Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::BASIC_PARALEGAL_ADDON_PRICE."</span>",
            self::BASIC_PLUS_PARALEGAL_ADDON => "Paralegal Check<br>(Standard Plus Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::BASIC_PLUS_PARALEGAL_ADDON_PRICE."</span>",
            self::PREMIUM_PARALEGAL_ADDON => "Paralegal Check<br>(Premium Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::PREMIUM_PARALEGAL_ADDON_PRICE."</span>",
            self::PREMIUM_PLUS_PARALEGAL_ADDON => "Paralegal Check<br>(Premium Plus Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::PREMIUM_PLUS_PARALEGAL_ADDON_PRICE."</span>",
            self::BLACK_LABEL_PARALEGAL_ADDON => "Paralegal Check<br>(Black Label Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::BLACK_LABEL_PARALEGAL_ADDON_PRICE."</span>",
            self::ULTIMATE_PARALEGAL_ADDON => "Paralegal Check<br>(Ultimate Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::ULTIMATE_PARALEGAL_ADDON_PRICE."</span>",
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => "Paralegal Check<br>(Ultimate Plus Questionnaire)<br> <span style='font-family:arial;font-size: 16px;'>".'$'.self::ULTIMATE_PLUS_PARALEGAL_ADDON_PRICE."</span>"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function allPackageNameArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Subscription ($".self::allPackagePriceArray(self::BASIC_SUBSCRIPTION).")",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus Subscription ($".self::allPackagePriceArray(self::BASIC_PLUS_SUBSCRIPTION).")",
            self::PREMIUM_SUBSCRIPTION => "Premium Subscription ($".self::allPackagePriceArray(self::PREMIUM_SUBSCRIPTION).")",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus Subscription ($".self::allPackagePriceArray(self::PREMIUM_PLUS_SUBSCRIPTION).")",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label Subscription ($".self::allPackagePriceArray(self::BLACK_LABEL_SUBSCRIPTION).")",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate Subscription ($".self::allPackagePriceArray(self::ULTIMATE_SUBSCRIPTION).")",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus Subscription ($".self::allPackagePriceArray(self::ULTIMATE_PLUS_SUBSCRIPTION).")",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only ($".self::allPackagePriceArray(self::PAYROLL_ASSISTANT_SUBSCRIPTION)." per Individual)",
            self::BASIC_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::BASIC_PETITION_PREPARATION)." per Individual for standard subscription client)",
            self::BASIC_PLUS_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::BASIC_PLUS_PETITION_PREPARATION)." per Individual for standard plus subscription client)",
            self::PREMIUM_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::PREMIUM_PETITION_PREPARATION)." per Individual for premium subscription client)",
            self::PREMIUM_PLUS_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::PREMIUM_PLUS_PETITION_PREPARATION)." per Individual for premium plus subscription client)",
            self::BLACK_LABEL_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::BLACK_LABEL_PETITION_PREPARATION)." per Individual for black label subscription client)",
            self::ULTIMATE_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::ULTIMATE_PETITION_PREPARATION)." per Individual for ultimate subscription client)",
            self::ULTIMATE_PLUS_PETITION_PREPARATION => "Petition Preparation ($".self::allPackagePriceArray(self::ULTIMATE_PLUS_PETITION_PREPARATION)." per Individual for ultimate plus subscription client)",
            self::BASIC_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::BASIC_PARALEGAL_ADDON)." per Individual for standard subscription client)",
            self::BASIC_PLUS_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::BASIC_PLUS_PARALEGAL_ADDON)." per Individual for standard plus subscription client)",
            self::PREMIUM_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::PREMIUM_PARALEGAL_ADDON)." per Individual for premium subscription client)",
            self::PREMIUM_PLUS_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::PREMIUM_PLUS_PARALEGAL_ADDON)." per Individual for premium plus subscription client)",
            self::BLACK_LABEL_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::BLACK_LABEL_PARALEGAL_ADDON)." per Individual for black label subscription client)",
            self::ULTIMATE_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::ULTIMATE_PARALEGAL_ADDON)." per Individual for ultimate subscription client)",
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => "Paralegal check ($".self::allPackagePriceArray(self::ULTIMATE_PLUS_PARALEGAL_ADDON)." per Individual for ultimate plus subscription client)",
            self::JOINT_DEBTOR_ADDITIONAL => "Joint Married (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_ADDITIONAL)." for premium subscription client)",
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => "Joint Married (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL)." for standard plus subscription client)",
            self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => "Joint Married (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL)." for premium plus subscription client)",
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "Joint Married (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL)." for ultimate subscription client)",
            self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => "Joint Married (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL)." for ultimate plus subscription client)",
            self::BASIC_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::BASIC_SUBSCRIPTION_PAYROLL)." per Individual for standard subscription client",
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::BASIC_PLUS_SUBSCRIPTION_PAYROLL)." per Individual for standard plus subscription client",
            self::PREMIUM_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::PREMIUM_SUBSCRIPTION_PAYROLL)." per Individual for premium subscription client",
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL)." per Individual for premium plus subscription client",
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::BLACK_LABEL_SUBSCRIPTION_PAYROLL)." per Individual for black label subscription client",
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::ULTIMATE_SUBSCRIPTION_PAYROLL)." per Individual for ultimate subscription client",
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => "Payroll assistant $" .self::allPackagePriceArray(self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL)." per Individual for ultimate plus subscription client",
            self::WELCOME_VIDEO_SUBSCRIPTION => "Welcome Video",
            self::STANDARD_CONCIERGE_SERVICE_PACKAGE => "Standard Concierge Service $" .self::allPackagePriceArray(self::STANDARD_CONCIERGE_SERVICE_PACKAGE)." for standard subscription client",
            self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE => "Standard Concierge Service $" .self::allPackagePriceArray(self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE)." for standard plus subscription client",
            self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE => "Premium Concierge Service $" .self::allPackagePriceArray(self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE)." for premium subscription client",
            self::BASIC_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::BASIC_BANK_STATEMENT)." per Individual for standard subscription client",
            self::BASIC_PLUS_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::BASIC_PLUS_BANK_STATEMENT)." per Individual for standard plus subscription client",
            self::PREMIUM_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::PREMIUM_BANK_STATEMENT)." per Individual for premium subscription client",
            self::PREMIUM_PLUS_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::PREMIUM_PLUS_BANK_STATEMENT)." per Individual for premium plus subscription client",
            self::BLACK_LABEL_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::BLACK_LABEL_BANK_STATEMENT)." per Individual for black label subscription client",
            self::ULTIMATE_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::ULTIMATE_BANK_STATEMENT)." per Individual for ultimate subscription client",
            self::ULTIMATE_PLUS_BANK_STATEMENT => "Bank Statement Assistant $" .self::allPackagePriceArray(self::ULTIMATE_PLUS_BANK_STATEMENT)." per Individual for ultimate plus subscription client",
            self::BASIC_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::BASIC_BANK_STATEMENT_PREMIUM)." per Individual for standard subscription client",
            self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::BASIC_PLUS_BANK_STATEMENT_PREMIUM)." per Individual for standard plus subscription client",
            self::PREMIUM_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::PREMIUM_BANK_STATEMENT_PREMIUM)." per Individual for premium subscription client",
            self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM)." per Individual for premium plus subscription client",
            self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::BLACK_LABEL_BANK_STATEMENT_PREMIUM)." per Individual for black label subscription client",
            self::ULTIMATE_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::ULTIMATE_BANK_STATEMENT_PREMIUM)." per Individual for ultimate subscription client",
            self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium $" .self::allPackagePriceArray(self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM)." per Individual for ultimate plus subscription client",
            self::BASIC_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::BASIC_PROFIT_LOSS_ASSISTANT)." per Individual for standard subscription client",
            self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT)." per Individual for standard plus subscription client",
            self::PREMIUM_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::PREMIUM_PROFIT_LOSS_ASSISTANT)." per Individual for premium subscription client",
            self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT)." per Individual for premium plus subscription client",
            self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT)." per Individual for black label subscription client",
            self::ULTIMATE_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::ULTIMATE_PROFIT_LOSS_ASSISTANT)." per Individual for ultimate subscription client",
            self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant $" .self::allPackagePriceArray(self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT)." per Individual for ultimate plus subscription client",
            self::BASIC_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::BASIC_CREDIT_REPORT)." per Individual for standard subscription client",
            self::BASIC_PLUS_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::BASIC_PLUS_CREDIT_REPORT)." per Individual for standard plus subscription client",
            self::PREMIUM_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::PREMIUM_CREDIT_REPORT)." per Individual for premium subscription client",
            self::PREMIUM_PLUS_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::PREMIUM_PLUS_CREDIT_REPORT)." per Individual for premium plus subscription client",
            self::BLACK_LABEL_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::BLACK_LABEL_CREDIT_REPORT)." per Individual for black label subscription client",
            self::ULTIMATE_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::ULTIMATE_CREDIT_REPORT)." per Individual for ultimate subscription client",
            self::ULTIMATE_PLUS_CREDIT_REPORT => "Credit Report $" .self::allPackagePriceArray(self::ULTIMATE_PLUS_CREDIT_REPORT)." per Individual for ultimate plus subscription client",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function addPackageToUserTable($client_id, $package_id, $package_type = null)
    {
        if (in_array($package_id, array_keys(AttorneySubscription::getParalegalArray()))) {
            User::where('id', $client_id)->update(['peralegal_check_package' => $package_id]);
        }

        if (in_array($package_id, array_keys(AttorneySubscription::getPetitionPackageArray()))) {
            User::where('id', $client_id)->update(['petition_prepration_package' => $package_id]);
        }

        if (in_array($package_id, array_keys(AttorneySubscription::payrollPriceArray()))) {
            User::where('id', $client_id)->update(['client_payroll_assistant' => $package_type]);
        }
        if (in_array($package_id, array_values(AttorneySubscription::bankStatementBySubscriptionArray()))) {
            User::where('id', $client_id)->update(['client_bank_statements' => $package_type]);
        }
        if (in_array($package_id, array_values(AttorneySubscription::bankStatementPremiumBySubscriptionArray()))) {
            User::where('id', $client_id)->update(['client_bank_statements_premium' => $package_type]);
        }
        if (in_array($package_id, [self::STANDARD_CONCIERGE_SERVICE_PACKAGE,self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE,self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE])) {
            User::where('id', $client_id)->update(['concierge_service' => 1]);
        }
        if (in_array($package_id, array_values(AttorneySubscription::profitLossBySubscriptionArray()))) {
            User::where('id', $client_id)->update(['client_profit_loss_assistant' => $package_type]);
        }
        if (in_array($package_id, array_values(AttorneySubscription::creditReortBySubscriptionArray()))) {
            User::where('id', $client_id)->update(['client_credit_report' => $package_type]);
        }

        if (in_array($package_id, [self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL, self::JOINT_DEBTOR_ADDITIONAL,self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL,self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL,self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL])) {
            User::where('id', $client_id)->update(['client_type' => Helper::CLIENT_TYPE_JOINT_MARRIED]);
        }


    }

    public static function addonNameArrayForBuyPopup($key = null)
    {
        $arr = [
            self::BASIC_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::BASIC_PETITION_PREPARATION)." for standard per client questionnaire)",
            self::BASIC_PLUS_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::BASIC_PLUS_PETITION_PREPARATION)." for standard plus per client questionnaire)",
            self::PREMIUM_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::PREMIUM_PETITION_PREPARATION)." for premium per client questionnaire)",
            self::PREMIUM_PLUS_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::PREMIUM_PLUS_PETITION_PREPARATION)." for premium plus per client questionnaire)",
            self::BLACK_LABEL_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::BLACK_LABEL_PETITION_PREPARATION)." for black label per client questionnaire)",
            self::ULTIMATE_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::ULTIMATE_PETITION_PREPARATION)." for ultimate per client questionnaire)",
            self::ULTIMATE_PLUS_PETITION_PREPARATION => "Petition Preparation (Additional $".self::allPackagePriceArray(self::ULTIMATE_PLUS_PETITION_PREPARATION)." for ultimate plus per client questionnaire)",
            self::BASIC_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::BASIC_PARALEGAL_ADDON)." for standard per client questionnaire)",
            self::BASIC_PLUS_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::BASIC_PLUS_PARALEGAL_ADDON)." for standard plus per client questionnaire)",
            self::PREMIUM_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::PREMIUM_PARALEGAL_ADDON)." for premium per client questionnaire)",
            self::PREMIUM_PLUS_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::PREMIUM_PLUS_PARALEGAL_ADDON)." for premium plus per client questionnaire)",
            self::BLACK_LABEL_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::BLACK_LABEL_PARALEGAL_ADDON)." for black label per client questionnaire)",
            self::ULTIMATE_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::ULTIMATE_PARALEGAL_ADDON)." for ultimate per client questionnaire)",
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => "Paralegal check (Additional $".self::allPackagePriceArray(self::ULTIMATE_PLUS_PARALEGAL_ADDON)." for ultimate plus per client questionnaire)",
            self::JOINT_DEBTOR_ADDITIONAL => "Married BOTH Spouses Filing (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_ADDITIONAL)." for premium or premiun plus per client questionnaire)",
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => "Married BOTH Spouses Filing (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL)." for standard plus per client questionnaire)",
            self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => "Married BOTH Spouses Filing (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL)." for premiun plus per client questionnaire)",
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "Married BOTH Spouses Filing (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL)." for ultimate per client questionnaire)",
            self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => "Married BOTH Spouses Filing (Additional $".self::allPackagePriceArray(self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL)." for ultimate plus per client questionnaire)",

    ];

        return static::returnArrValue($arr, $key);
    }

    public static function petitionAddons($key = null)
    {
        $arr = [self::BASIC_SUBSCRIPTION => self::BASIC_PETITION_PREPARATION,
                self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_PETITION_PREPARATION,
                self::PREMIUM_SUBSCRIPTION => self::PREMIUM_PETITION_PREPARATION,
                self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_PETITION_PREPARATION,
                self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_PETITION_PREPARATION,
                self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_PETITION_PREPARATION,
                self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_PETITION_PREPARATION];

        return static::returnArrValue($arr, $key);
    }

    public static function paralegalAddons($key = null)
    {
        $arr = [self::BASIC_SUBSCRIPTION => self::BASIC_PARALEGAL_ADDON,
        self::BASIC_PLUS_SUBSCRIPTION => self::BASIC_PLUS_PARALEGAL_ADDON,
        self::PREMIUM_SUBSCRIPTION => self::PREMIUM_PARALEGAL_ADDON,
        self::PREMIUM_PLUS_SUBSCRIPTION => self::PREMIUM_PLUS_PARALEGAL_ADDON,
        self::BLACK_LABEL_SUBSCRIPTION => self::BLACK_LABEL_PARALEGAL_ADDON,
        self::ULTIMATE_SUBSCRIPTION => self::ULTIMATE_PARALEGAL_ADDON,
        self::ULTIMATE_PLUS_SUBSCRIPTION => self::ULTIMATE_PLUS_PARALEGAL_ADDON];

        return static::returnArrValue($arr, $key);
    }


    public static function selectPetitionPackage($packageType, $include = '')
    {
        $package = 0;
        if ($include == 1) {
            if (in_array($packageType, array_keys(self::petitionAddons()))) {
                $package = self::petitionAddons($packageType);
            }
        }

        return $package;
    }

    private static function checkPackageCount($packages, $package)
    {
        return $packages[$package] ?? 0;
    }

    public static function getConsumeSubscription($attorneyId)
    {
        $packages = \App\Models\SubscriptionToclient::where('attorney_id', $attorneyId)->select('package_id', DB::raw('SUM(quantity) as  itemused'))->groupBy('package_id')->orderBy('package_id', 'asc')->pluck('itemused', 'package_id');
        $packages = !empty($packages) ? $packages->toArray() : [];
        $consumedPackages = [];
        foreach (array_keys(self::allPackageNameArray()) as $package) {
            if ($package != self::WELCOME_VIDEO_SUBSCRIPTION) {
                $consumedPackages[$package] = self::checkPackageCount($packages, $package);
            }
        }

        return $consumedPackages;
    }

    public static function getAttorneySubscriptions($attorney)
    {

        $subscriptions = $attorney->subscriptions()->where('type', '!=', self::WELCOME_VIDEO_SUBSCRIPTION)->select('type', DB::raw('SUM(no_of_questionnaire) as  item_purchased'))->groupBy('type')->orderBy('type', 'asc')->pluck('item_purchased', 'type');

        return !empty($subscriptions) ? $subscriptions->toArray() : [];
    }

    public static function isSubscriptionAvailable($attorney, $packageId)
    {
        $avilable = self::getAvailablePackage($attorney, $packageId);

        return $avilable;
    }

    public static function getAvailablePackage($attorney, $packageId)
    {
        $consumed = self::getConsumeSubscription($attorney->id);
        $consumed = $packageId > 0 ? $consumed[$packageId] : 0;
        $purchased = self::getAttorneySubscriptions($attorney);
        $purchasedcount = 0;
        $purchasedcount = $purchased[$packageId] ?? 0;
        $avilable = 0;
        $avilable = max(($purchasedcount - $consumed), 0);

        return $avilable;
    }

    private static function getPackageIdBasesOnType($client_subscription, $type, $ispremiumbankassistant = false)
    {
        if ($type == 'payroll') {
            $packageId = self::payrollBySubscriptionArray($client_subscription);
        }
        if ($type == 'bank_assistant') {
            $packageId = self::bankStatementBySubscriptionArray($client_subscription);
            if ($ispremiumbankassistant) {
                $packageId = self::bankStatementPremiumBySubscriptionArray($client_subscription);
            }
        }
        if ($type == 'profit_loss') {
            $packageId = self::profitLossBySubscriptionArray($client_subscription);
        }
        if ($type == 'credit_report') {
            $packageId = self::creditReortBySubscriptionArray($client_subscription);
        }

        return $packageId;
    }

    public static function isAddonAvailable($attorney, $client_subscription, $payrollType, $type = '', $ispremiumbankassistant = false)
    {
        $consumed = self::getConsumeSubscription($attorney->id);

        $packageId = 0;
        $packageId = self::getPackageIdBasesOnType($client_subscription, $type, $ispremiumbankassistant);
        $unit = 1;
        if ($payrollType == 3) {
            $unit = 2;
        }
        $consumed = $consumed[$packageId] ?? 0;

        $purchased = self::getAttorneySubscriptions($attorney);
        $purchasedcount = $purchased[$packageId] ?? 0;
        $avilable = 0;
        $avilable = $purchasedcount - $consumed;

        return max(($avilable - $unit), 0);
    }



    public static function selectJointPackage($packageType, $clientType)
    {
        $package = 0;
        if (!in_array($packageType, [self::PAYROLL_ASSISTANT_SUBSCRIPTION,self::BASIC_SUBSCRIPTION]) && $clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
            $package = self::JOINT_DEBTOR_ADDITIONAL;
            if ($packageType == self::ULTIMATE_SUBSCRIPTION && $clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
                $package = self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL;
            }
            if ($packageType == self::ULTIMATE_PLUS_SUBSCRIPTION && $clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
                $package = self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL;
            }
            if ($packageType == self::BASIC_PLUS_SUBSCRIPTION && $clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
                $package = self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL;
            }
            if ($packageType == self::PREMIUM_PLUS_SUBSCRIPTION && $clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
                $package = self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL;
            }
        }

        return $package;
    }


    public static function selectParalegalPackage($packageType, $include = '')
    {
        $package = 0;
        if ($include == 1) {
            if (in_array($packageType, array_keys(self::paralegalAddons()))) {
                $package = self::paralegalAddons($packageType);
            }
        }

        return $package;
    }

    public static function allPackageNameWithParamArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Questionnaire",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus Questionnaire",
            self::PREMIUM_SUBSCRIPTION => "Premium Questionnaire",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus Questionnaire",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label Questionnaire",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate Questionnaire",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus Questionnaire",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only",
            self::BASIC_PETITION_PREPARATION => "Petition Preparation <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_PETITION_PREPARATION => "Petition Preparation <small><i>(Standard Plus)</i></small>",
            self::PREMIUM_PETITION_PREPARATION => "Petition Preparation <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_PETITION_PREPARATION => "Petition Preparation <small><i>(Premium Plus)</i></small>",
            self::BLACK_LABEL_PETITION_PREPARATION => "Petition Preparation <small><i>(Black label)</i></small>",
            self::ULTIMATE_PETITION_PREPARATION => "Petition Preparation <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_PETITION_PREPARATION => "Petition Preparation <small><i>(Ultimate Plus)</i></small>",
            self::BASIC_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Standard Plus)</i></small>",
            self::PREMIUM_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Premium Plus)</i></small>",
            self::BLACK_LABEL_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Black label)</i></small>",
            self::ULTIMATE_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => "Paralegal Assistant <small><i>(Ultimate Plus)</i></small>",
            self::JOINT_DEBTOR_ADDITIONAL => "Joint Married <small><i>(Premium)</i></small>",
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => "Joint Married <small><i>(Standard Plus)</i></small>",
            self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => "Joint Married <small><i>(Premium Plus)</i></small>",
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "Joint Married <small><i>(Ultimate)</i></small>",
            self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => "Joint Married <small><i>(Ultimate Plus)</i></small>",

            self::BASIC_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Standard Plus)</i></small>",
            self::PREMIUM_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Premium Plus)</i></small>",
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Black Label)</i></small>",
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => "Payroll Assistant <small><i>(Ultimate Plus)</i></small>",
            self::WELCOME_VIDEO_SUBSCRIPTION => "Welcome Video Subscription",
            self::STANDARD_CONCIERGE_SERVICE_PACKAGE => "Standard Concierge Service",
            self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE => "Standard Plus Concierge Service",
            self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE => "Premium Concierge Service",
            self::BASIC_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Standard Plus)</i></small>",
            self::PREMIUM_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Premium plus)</i></small>",
            self::BLACK_LABEL_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Black Label)</i></small>",
            self::ULTIMATE_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_BANK_STATEMENT => "Bank Statement Assistant <small><i>(Ultimate Plus)</i></small>",
            self::BASIC_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Standard Plus)</i></small>",
            self::PREMIUM_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Premium plus)</i></small>",
            self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Black Label)</i></small>",
            self::ULTIMATE_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant Premium <small><i>(Ultimate Plus)</i></small>",

            self::BASIC_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Standard Plus)</i></small>",
            self::PREMIUM_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Premium Plus)</i></small>",
            self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Black Label)</i></small>",
            self::ULTIMATE_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <small><i>(Ultimate Plus)</i></small>",

            self::BASIC_CREDIT_REPORT => "Credit Report <small><i>(Standard)</i></small>",
            self::BASIC_PLUS_CREDIT_REPORT => "Credit Report<small><i>(Standard Plus)</i></small>",
            self::PREMIUM_CREDIT_REPORT => "Credit Report <small><i>(Premium)</i></small>",
            self::PREMIUM_PLUS_CREDIT_REPORT => "Credit Report <small><i>(Premium Plus)</i></small>",
            self::BLACK_LABEL_CREDIT_REPORT => "Credit Report <small><i>(Black Label)</i></small>",
            self::ULTIMATE_CREDIT_REPORT => "Credit Report <small><i>(Ultimate)</i></small>",
            self::ULTIMATE_PLUS_CREDIT_REPORT => "Credit Report <small><i>(Ultimate Plus)</i></small>",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function allPackageNameWithParamForTransactionArray($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => "Standard Questionnaire",
            self::BASIC_PLUS_SUBSCRIPTION => "Standard Plus Questionnaire",
            self::PREMIUM_SUBSCRIPTION => "Premium Questionnaire",
            self::PREMIUM_PLUS_SUBSCRIPTION => "Premium Plus Questionnaire",
            self::BLACK_LABEL_SUBSCRIPTION => "Black Label Questionnaire",
            self::ULTIMATE_SUBSCRIPTION => "Ultimate Questionnaire",
            self::ULTIMATE_PLUS_SUBSCRIPTION => "Ultimate Plus Questionnaire",
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => "Payroll Assistant Only",
            self::BASIC_PETITION_PREPARATION => "Petition Preparation<br><small>(for Standard Questionnaire)</small>",
            self::BASIC_PLUS_PETITION_PREPARATION => "Petition Preparation<br><small>(for Standard Plus Questionnaire)</small>",
            self::PREMIUM_PETITION_PREPARATION => "Petition Preparation<br><small>(for Premium Questionnaire)</small>",
            self::PREMIUM_PLUS_PETITION_PREPARATION => "Petition Preparation<br><small>(for Premium Plus Questionnaire)</small>",
            self::BLACK_LABEL_PETITION_PREPARATION => "Petition Preparation<br><small>(for Black Label Questionnaire)</small>",
            self::ULTIMATE_PETITION_PREPARATION => "Petition Preparation<br><small>(for Ultimate Questionnaire)</small>",
            self::ULTIMATE_PLUS_PETITION_PREPARATION => "Petition Preparation<br><small>(for Ultimate Plus Questionnaire)</small>",
            self::BASIC_PARALEGAL_ADDON => "Paralegal check<br><small>(for Standard Questionnaire)</small>",
            self::BASIC_PLUS_PARALEGAL_ADDON => "Paralegal check<br><small>(for Standard Plus Questionnaire)</small>",
            self::PREMIUM_PARALEGAL_ADDON => "Paralegal check<br><small>(for Premium Questionnaire)</small>",
            self::PREMIUM_PLUS_PARALEGAL_ADDON => "Paralegal check<br><small>(for Premium Plus Questionnaire)</small>",
            self::BLACK_LABEL_PARALEGAL_ADDON => "Paralegal check<br><small>(for Black Label Questionnaire)</small>",
            self::ULTIMATE_PARALEGAL_ADDON => "Paralegal check<br><small>(for Ultimate Questionnaire)</small>",
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => "Paralegal check<br><small>(for Ultimate Plus Questionnaire)</small>",
            self::JOINT_DEBTOR_ADDITIONAL => "Joint Married<br><small>(Additional $".self::packagePriceArray(self::JOINT_DEBTOR_ADDITIONAL).")</small>",
            self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL => "Joint Married<br><small>(Additional $".self::packagePriceArray(self::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL).")</small>",
            self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL => "Joint Married<br><small>(Additional $".self::packagePriceArray(self::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL).")</small>",
            self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL => "Joint Married<br><small>(Additional $".self::packagePriceArray(self::JOINT_DEBTOR_ULTIMATE_ADDITIONAL).")</small>",
            self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL => "Joint Married<br><small>(Additional $".self::packagePriceArray(self::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL).")</small>",

            self::BASIC_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Standard Questionnaire)</small)",
            self::BASIC_PLUS_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Standard Plus Questionnaire)</small)",
            self::PREMIUM_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Premium Questionnaire)</small>",
            self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Premium Plus Questionnaire)</small>",
            self::BLACK_LABEL_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Black Label Questionnaire)</small>",
            self::ULTIMATE_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Ultimate Questionnaire)</small>",
            self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL => "Payroll assistant <br><small>(for Ultimate Plus Questionnaire)</small>",

            self::WELCOME_VIDEO_SUBSCRIPTION => "Welcome video subscription",
            self::STANDARD_CONCIERGE_SERVICE_PACKAGE => "Standard Concierge Service",
            self::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE => "Standard Plus Concierge Service",
            self::PREMIUM_AND_BLACKLABEL_CONCIERGE_SERVICE_PACKAGE => "Premium Concierge Service",
            self::BASIC_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Standard)</small>",
            self::BASIC_PLUS_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Standard Plus)</small>",
            self::PREMIUM_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Premium)</small>",
            self::PREMIUM_PLUS_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Premium plus)</small>",
            self::BLACK_LABEL_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Black Label)</small>",
            self::ULTIMATE_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Ultimate)</small>",
            self::ULTIMATE_PLUS_BANK_STATEMENT => "Bank Statement Assistant <br><small>(Ultimate Plus)</small>",
            self::BASIC_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Standard)</small>",
            self::BASIC_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Standard Plus)</small>",
            self::PREMIUM_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Premium)</small>",
            self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Premium plus)</small>",
            self::BLACK_LABEL_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Black Label)</small>",
            self::ULTIMATE_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Ultimate)</small>",
            self::ULTIMATE_PLUS_BANK_STATEMENT_PREMIUM => "Bank Statement Assistant premium <br><small>(Ultimate Plus)</small>",

            self::BASIC_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Standard)</small>",
            self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Standard Plus)</small>",
            self::PREMIUM_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Premium)</small>",
            self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Premium Plus)</small>",
            self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Black Label)</small>",
            self::ULTIMATE_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Ultimate)</small>",
            self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT => "Profit/Loss Assistant <br><small>(Ultimate Plus)</small>",

            self::BASIC_CREDIT_REPORT => "Credit Report <br><small>(Standard)</small>",
            self::BASIC_PLUS_CREDIT_REPORT => "Credit Report <br><small>(Standard Plus)</small>",
            self::PREMIUM_CREDIT_REPORT => "Credit Report <br><small>(Premium)</small>",
            self::PREMIUM_PLUS_CREDIT_REPORT => "Credit Report<br><small>(Premium Plus)</small>",
            self::BLACK_LABEL_CREDIT_REPORT => "Credit Report <br><small>(Black Label)</small>",
            self::ULTIMATE_CREDIT_REPORT => "Credit Report <br><small>(Ultimate)</small>",
            self::ULTIMATE_PLUS_CREDIT_REPORT => "Credit Report <br><small>(Ultimate Plus)</small>",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getdiscountPercentage($attorney_id)
    {
        $attorney = User::find($attorney_id);

        return $attorney['subscription_discount_percent'] ?? 0;
    }

    public static function getdiscountAmount($noOfClient, $perClientPrice, $attorney_id)
    {

        $discountPercentage = self::getdiscountPercentage($attorney_id);
        if ($discountPercentage == 0) {
            return 0;
        }
        $totalprice = $perClientPrice * $noOfClient;
        $payprice = $totalprice - ($totalprice * ($discountPercentage / 100));

        return ($totalprice - $payprice);
    }

    public static function getPeralegalPriceArray($key = null)
    {
        $arr = [
            self::BASIC_PARALEGAL_ADDON => self::BASIC_PARALEGAL_ADDON_PRICE,
            self::BASIC_PLUS_PARALEGAL_ADDON => self::BASIC_PLUS_PARALEGAL_ADDON_PRICE,
            self::PREMIUM_PARALEGAL_ADDON => self::PREMIUM_PARALEGAL_ADDON_PRICE,
            self::PREMIUM_PLUS_PARALEGAL_ADDON => self::PREMIUM_PLUS_PARALEGAL_ADDON_PRICE,
            self::BLACK_LABEL_PARALEGAL_ADDON => self::BLACK_LABEL_PARALEGAL_ADDON_PRICE,
            self::ULTIMATE_PARALEGAL_ADDON => self::ULTIMATE_PARALEGAL_ADDON_PRICE,
            self::ULTIMATE_PLUS_PARALEGAL_ADDON => self::ULTIMATE_PLUS_PARALEGAL_ADDON_PRICE,
        ];

        return static::returnArrValue($arr, $key);
    }
    // payroll price array
    public static function packagePriceClientTypeWise($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_SUBSCRIPTION_PAYROLL_PRICE * 2,
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_PLUS_SUBSCRIPTION_PAYROLL_PRICE * 2,
        ],
            self::PREMIUM_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_SUBSCRIPTION_PAYROLL_PRICE * 2,
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_PLUS_SUBSCRIPTION_PAYROLL_PRICE * 2,
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BLACK_LABEL_SUBSCRIPTION_PAYROLL_PRICE * 2,
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_SUBSCRIPTION_PAYROLL_PRICE * 2,
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_PLUS_SUBSCRIPTION_PAYROLL_PRICE * 2,
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => 49.98,
            ]
        ];

        return static::returnArrValue($arr, $key);
    }
    // bankstatement price array
    public static function packageBankStatementPriceClientTypeWise($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_BANK_STATEMENT_PRICE * 2,
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_PLUS_BANK_STATEMENT_PRICE,
                Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_PLUS_BANK_STATEMENT_PRICE,
                Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_PLUS_BANK_STATEMENT_PRICE * 2,
            ],
            self::PREMIUM_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_BANK_STATEMENT_PRICE * 2,
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_PLUS_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_PLUS_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_PLUS_BANK_STATEMENT_PRICE * 2,
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BLACK_LABEL_BANK_STATEMENT_PRICE * 2,
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_BANK_STATEMENT_PRICE * 2,
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE * 2,
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => 49.98,
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function packageBankStatementPriceClientTypeWisePremium($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_BANK_STATEMENT_PREMIUM_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_BANK_STATEMENT_PREMIUM_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_BANK_STATEMENT_PREMIUM_PRICE * 2,
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
                Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
                Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_PLUS_BANK_STATEMENT_PREMIUM_PRICE * 2,
        ],
            self::PREMIUM_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_BANK_STATEMENT_PREMIUM_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_BANK_STATEMENT_PREMIUM_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_BANK_STATEMENT_PREMIUM_PRICE * 2,
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_PLUS_BANK_STATEMENT_PREMIUM_PRICE * 2,
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BLACK_LABEL_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BLACK_LABEL_BANK_STATEMENT_PRICE * 2,
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_BANK_STATEMENT_PRICE * 2,
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_PLUS_BANK_STATEMENT_PRICE * 2,
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => 49.98,
            ]
        ];

        return static::returnArrValue($arr, $key);
    }


    // profitloss price array
    public static function packageProfitLossPriceClientTypeWise($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_PLUS_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::PREMIUM_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_PLUS_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BLACK_LABEL_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_PLUS_PROFIT_LOSS_ASSISTANT_PRICE * 2,
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => 24.99,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => 49.98,
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function packageCreditReportPriceClientTypeWise($key = null)
    {
        $arr = [
            self::BASIC_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_CREDIT_REPORT_PRICE * 2,
            ],
            self::BASIC_PLUS_SUBSCRIPTION => [
                Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BASIC_PLUS_CREDIT_REPORT_PRICE,
                Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BASIC_PLUS_CREDIT_REPORT_PRICE,
                Helper::CLIENT_TYPE_JOINT_MARRIED => self::BASIC_PLUS_CREDIT_REPORT_PRICE * 2,
            ],
            self::PREMIUM_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_CREDIT_REPORT_PRICE * 2,
            ],
            self::PREMIUM_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::PREMIUM_PLUS_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::PREMIUM_PLUS_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::PREMIUM_PLUS_CREDIT_REPORT_PRICE * 2,
            ],
            self::BLACK_LABEL_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::BLACK_LABEL_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::BLACK_LABEL_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::BLACK_LABEL_CREDIT_REPORT_PRICE * 2,
            ],
            self::ULTIMATE_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_CREDIT_REPORT_PRICE * 2,
            ],
            self::ULTIMATE_PLUS_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => self::ULTIMATE_PLUS_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => self::ULTIMATE_PLUS_CREDIT_REPORT_PRICE,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => self::ULTIMATE_PLUS_CREDIT_REPORT_PRICE * 2,
            ],
            self::PAYROLL_ASSISTANT_SUBSCRIPTION => [
                    Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED => 15.99,
                    Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED => 15.99,
                    Helper::CLIENT_TYPE_JOINT_MARRIED => 31.98,
            ]
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function returnArrValue($arr, $key)
    {
        if ($key === null) {
            return $arr;
        } elseif (array_key_exists($key, $arr)) {
            return $arr[$key];
        } else {
            return '';
        }
    }

    public static function addPackages($attorneyId, $clientId, $packageId, $quantity = 1)
    {
        if (empty($packageId)) {
            return [];
        }

        return [
            'client_id' => $clientId,
            'attorney_id' => $attorneyId,
            'package_id' => $packageId,
            'quantity' => $quantity,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
    }
    public static function getSubscriptionArray($attorneyId, $clientId, $input)
    {
        $subscription = $input['client_subscription'];
        $packages = [];
        $clientPackage = self::addPackages($attorneyId, $clientId, $input['client_subscription'], 1);
        $joinMarriedPackage = self::addPackages($attorneyId, $clientId, $input['additional_joint_package'], 1);

        $payrollAddon = [];
        if ($input['client_payroll_assistant'] > 0) {
            $packageId = self::payrollBySubscriptionArray($subscription);
            $quantity = 1;
            if ($input['client_payroll_assistant'] == 3) {
                $quantity = 2;
            }
            $payrollAddon = self::addPackages($attorneyId, $clientId, $packageId, $quantity);
        }

        if ($input['concierge_service'] == 1 && $input['client_subscription'] == \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION) {
            $packageId = \App\Models\AttorneySubscription::STANDARD_CONCIERGE_SERVICE_PACKAGE;
            $conserve = self::addPackages($attorneyId, $clientId, $packageId, 1);
            array_push($packages, $conserve);
        }

        if ($input['concierge_service'] == 1 && $input['client_subscription'] == \App\Models\AttorneySubscription::BASIC_PLUS_SUBSCRIPTION) {
            $packageId = \App\Models\AttorneySubscription::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE;
            $conserve = self::addPackages($attorneyId, $clientId, $packageId, 1);
            array_push($packages, $conserve);
        }

        $client_bank_statements = $input['client_bank_statements'];
        $is_bankassistantPremium = 0;
        if (str_contains($client_bank_statements, '_')) {
            $is_bankassistantPremium = 1;
            $client_bank_statements = explode('_', $client_bank_statements);
            if (isset($client_bank_statements[0]) && $client_bank_statements[0] == 'premium') {
                $client_bank_statements = $client_bank_statements[1];
            }
        }

        if ($is_bankassistantPremium) {
            if ($client_bank_statements > 0 && AttorneySubscription::bankStatementPremiumBySubscriptionArray($input['client_subscription']) > 0) {
                $packageId = AttorneySubscription::bankStatementPremiumBySubscriptionArray($input['client_subscription']);
                $unit = 1;
                if ($client_bank_statements == 3) {
                    $unit = 2;
                }

                $bankAddon = self::addPackages($attorneyId, $clientId, $packageId, $unit);

            }
        } else {

            if ($client_bank_statements > 0 && AttorneySubscription::bankStatementBySubscriptionArray($input['client_subscription']) > 0) {
                $packageId = AttorneySubscription::bankStatementBySubscriptionArray($input['client_subscription']);
                $unit = 1;
                if ($client_bank_statements == 3) {
                    $unit = 2;
                }
                $bankAddon = self::addPackages($attorneyId, $clientId, $packageId, $unit);
            }
        }

        array_push($packages, $clientPackage);
        array_push($packages, $joinMarriedPackage);
        array_push($packages, $payrollAddon);
        if (isset($bankAddon) && !empty($bankAddon)) {
            array_push($packages, $bankAddon);
        }
        $packages = array_filter($packages);

        return $packages;

    }

    public static function isParalegalAvailable($clientId)
    {
        $isExist = \App\Models\SubscriptionToclient::where('client_id', $clientId)->whereIn('package_id', array_keys(\App\Models\AttorneySubscription::getParalegalArray()))->exists();
        $user = User::where('id', $clientId)->select('client_subscription')->first();
        $isExist = $user['client_subscription'] == self::BLACK_LABEL_SUBSCRIPTION ? 1 : $isExist;
        if (!$isExist) {
            return 0;
        }

        return 1;
    }

    public static function isPetitionPackageAvailable($clientId)
    {
        if ($clientId == 58041) {
            return 1;
        }
        $isExist = \App\Models\SubscriptionToclient::where('client_id', $clientId)->whereIn('package_id', array_keys(\App\Models\AttorneySubscription::getPetitionPackageArray()))->exists();
        $user = User::where('id', $clientId)->select('client_subscription')->first();
        $isExist = $user['client_subscription'] == self::BLACK_LABEL_SUBSCRIPTION ? 1 : $isExist;
        if (!$isExist) {
            return 0;
        }

        return 1;
    }

    public static function checkFinishedPackageArray($attorney, $subscription_package, $clientType, $client_payroll_assistant = 0, $client_bank_statements = 0, $client_profit_loss_assistant = 0, $client_credit_report = 0)
    {
        $NotAvailablePackages = [];
        $subscription_package = (int)$subscription_package;
        $clientType = (int)$clientType;
        $client_payroll_assistant = (int)$client_payroll_assistant;
        $is_bankassistantPremium = 0;
        if (str_contains($client_bank_statements, '_')) {
            $is_bankassistantPremium = 1;
            $client_bank_statements = explode('_', $client_bank_statements);
            if (isset($client_bank_statements[0]) && $client_bank_statements[0] == 'premium') {
                $client_bank_statements = $client_bank_statements[1];
            }
        }
        $client_bank_statements = (int)$client_bank_statements;
        $client_profit_loss_assistant = (int)$client_profit_loss_assistant;
        $client_credit_report = (int)$client_credit_report;

        $unit = 1;
        if ($subscription_package == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $client_payroll_assistant == 3) {
            $unit = 2;
        }
        $joinPackageId = AttorneySubscription::selectJointPackage($subscription_package, $clientType);
        if ($subscription_package > 0 && AttorneySubscription::isSubscriptionAvailable($attorney, $subscription_package) < $unit) {
            $needobuy = $unit - AttorneySubscription::isSubscriptionAvailable($attorney, $subscription_package);
            if ($needobuy > 0) {
                array_push($NotAvailablePackages, ['id' => $subscription_package, 'name' => AttorneySubscription::allPackageNameArray($subscription_package), 'unit' => $needobuy]);
            }
        }

        $NotAvailablePackages = self::jointAccount($attorney, $subscription_package, $joinPackageId, $NotAvailablePackages);
        $NotAvailablePackages = self::checkPayroll($attorney, $subscription_package, $client_payroll_assistant, $NotAvailablePackages);
        $NotAvailablePackages = self::checkBankAssistant($attorney, $subscription_package, $client_bank_statements, $NotAvailablePackages, $is_bankassistantPremium);
        $NotAvailablePackages = self::checkProfitLoss($attorney, $subscription_package, $client_profit_loss_assistant, $NotAvailablePackages);
        $NotAvailablePackages = self::checkCreditReport($attorney, $subscription_package, $client_credit_report, $NotAvailablePackages);

        return $NotAvailablePackages;
    }

    private static function jointAccount($attorney, $subscription_package, $joinPackageId, $NotAvailablePackages)
    {
        $unit = 1;
        if ($joinPackageId > 0 && AttorneySubscription::isSubscriptionAvailable($attorney, $joinPackageId) < $unit) {
            $needobuy = $unit - AttorneySubscription::isSubscriptionAvailable($attorney, $joinPackageId);

            if ($needobuy > 0) {
                array_push($NotAvailablePackages, ['id' => $joinPackageId, 'name' => AttorneySubscription::allPackageNameArray($joinPackageId), 'unit' => $needobuy]);
            }
        }

        return $NotAvailablePackages;
    }

    private static function checkPayroll($attorney, $subscription_package, $client_payroll_assistant, $NotAvailablePackages)
    {
        $availabePayroll = AttorneySubscription::isAddonAvailable($attorney, $subscription_package, $client_payroll_assistant, 'payroll');
        if ($subscription_package != AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $client_payroll_assistant > 0 && AttorneySubscription::payrollBySubscriptionArray($subscription_package) > 0) {
            $packageId = AttorneySubscription::payrollBySubscriptionArray($subscription_package);
            $unit = 1;
            if ($client_payroll_assistant == 3) {
                $unit = 2;
            }
            if ($availabePayroll < $unit) {
                array_push($NotAvailablePackages, ['id' => $packageId, 'name' => AttorneySubscription::allPackageNameArray($packageId), 'unit' => ($unit - $availabePayroll)]);
            }

        }

        return $NotAvailablePackages;
    }

    private static function checkBankAssistant($attorney, $subscription_package, $client_bank_statements, $NotAvailablePackages, $is_bankassistantPremium)
    {

        $availabeBankStatement = AttorneySubscription::isAddonAvailable($attorney, $subscription_package, $client_bank_statements, 'bank_assistant', $is_bankassistantPremium);


        if ($is_bankassistantPremium) {

            if ($client_bank_statements > 0 && AttorneySubscription::bankStatementPremiumBySubscriptionArray($subscription_package) > 0) {
                $packageId = AttorneySubscription::bankStatementPremiumBySubscriptionArray($subscription_package);
                $unit = 1;
                if ($client_bank_statements == 3) {
                    $unit = 2;
                }

                if ($availabeBankStatement < $unit) {
                    array_push($NotAvailablePackages, ['id' => $packageId, 'name' => AttorneySubscription::allPackageNameArray($packageId), 'unit' => ($unit - $availabeBankStatement)]);
                }

            }
        } else {

            if ($client_bank_statements > 0 && AttorneySubscription::bankStatementBySubscriptionArray($subscription_package) > 0) {
                $packageId = AttorneySubscription::bankStatementBySubscriptionArray($subscription_package);
                $unit = 1;
                if ($client_bank_statements == 3) {
                    $unit = 2;
                }
                if ($availabeBankStatement < $unit) {
                    array_push($NotAvailablePackages, ['id' => $packageId, 'name' => AttorneySubscription::allPackageNameArray($packageId), 'unit' => ($unit - $availabeBankStatement)]);
                }

            }
        }

        return $NotAvailablePackages;
    }

    private static function checkProfitLoss($attorney, $subscription_package, $client_profit_loss, $NotAvailablePackages)
    {
        $availabeProfitLoss = AttorneySubscription::isAddonAvailable($attorney, $subscription_package, $client_profit_loss, 'profit_loss');
        if ($client_profit_loss > 0 && AttorneySubscription::profitLossBySubscriptionArray($subscription_package) > 0) {
            $packageId = AttorneySubscription::profitLossBySubscriptionArray($subscription_package);
            $unit = 1;
            if ($client_profit_loss == 3) {
                $unit = 2;
            }
            if ($availabeProfitLoss < $unit) {
                array_push($NotAvailablePackages, ['id' => $packageId, 'name' => AttorneySubscription::allPackageNameArray($packageId), 'unit' => ($unit - $availabeProfitLoss)]);
            }

        }

        return $NotAvailablePackages;
    }

    private static function checkCreditReport($attorney, $subscription_package, $client_credit_report, $NotAvailablePackages)
    {
        $availabeCR = AttorneySubscription::isAddonAvailable($attorney, $subscription_package, $client_credit_report, 'credit_report');
        if ($client_credit_report > 0 && AttorneySubscription::creditReortBySubscriptionArray($subscription_package) > 0) {
            $packageId = AttorneySubscription::creditReortBySubscriptionArray($subscription_package);
            $unit = 1;
            if ($client_credit_report == 3) {
                $unit = 2;
            }
            if ($availabeCR < $unit) {
                array_push($NotAvailablePackages, ['id' => $packageId, 'name' => AttorneySubscription::allPackageNameArray($packageId), 'unit' => ($unit - $availabeCR)]);
            }

        }

        return $NotAvailablePackages;
    }

    public static function getPaymentWithDigit($packageId, $packagePrice, $noOfClients, $attorney_id)
    {
        $payamount = round($packagePrice * $noOfClients, 2);
        $discount = AttorneySubscription::getdiscountAmount($noOfClients, $packagePrice, $attorney_id);
        $payble = $payamount - $discount;

        return (float)number_format($payble, 2, '.', '');
    }

    public static function getTransactionData($listing, $all_attorney)
    {
        $packagesArray = [];
        $transactions = [];

        if (!empty($listing) && count($listing) > 0) {
            foreach ($listing as $val) {
                $packageString = $val->package_name ?? '';
                $attorneyName = $all_attorney[$val->attorney_id] ?? '';
                $transactionTime = DateTimeHelper::dbDateToDisplay($val->created_at, true);
                $quantity = $val->quantity;

                // Calculate total amount based on discounted price if available, otherwise use per_package_price
                $unitPrice = ($val->per_package_price);
                $totalAmount = $unitPrice * $quantity;

                // Calculate discount amount if discount_percentage is available
                $discountAmount = 0.00;
                if ($val->discount_percentage) {
                    $discountAmount = $totalAmount - (($unitPrice - $val->discounted_price) * $quantity);
                }
                $amountPaid = $totalAmount - $discountAmount;

                $transactions[] = [
                    'attorney' => $attorneyName,
                    'questionnaire_type' => strip_tags($packageString),
                    'package_id' => $val->package_id,
                    'transaction_details' => [
                        'client_name' => $val->name,
                        'client_id' => $val->client_id,
                        'status' => 'Success',
                        'transaction_time' => $transactionTime
                    ],
                    'units' => $quantity,
                    'payment_details' => [
                        'total_amount' => $totalAmount,
                        'discount' => $discountAmount,
                        'amount_paid' => $amountPaid
                    ]
                ];

                $packagesArray[$val->package_id][] = $unitPrice;
            }
        }

        // Summary Data
        $totalPricing = 0;
        $groupedPackages = [];
        $totalUnits = count($listing);

        $allowedPackageIds = [100, 121, 135];

        foreach ($packagesArray as $packageId => $prices) {
            $totalPricing += array_sum($prices); // Always sum all prices

            // Only count if packageId is in the allowed list
            if (in_array($packageId, $allowedPackageIds)) {
                $countPrices = count($prices);
                // Get package name from first transaction with this package_id
                $packageName = '';
                foreach ($listing as $item) {
                    if ($item->package_id == $packageId) {
                        $packageName = $item->package_name;
                        break;
                    }
                }

                $groupedPackages[$packageId] = [
                    'package_name' => strip_tags($packageName),
                    'count' => $countPrices,
                    'package_id' => $packageId
                ];
            }
        }

        $summary = [
            'total_units' => $totalUnits,
            'total_price' => $totalPricing,
            'grouped_packages' => $groupedPackages
        ];

        return [
            'transactions' => $transactions,
            'summary' => $summary
        ];
    }

}
