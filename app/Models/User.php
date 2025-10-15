<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use App\Helpers\DateTimeHelper;
use App\Helpers\Helper;
use App\Mail\PasswordResetToClientMail;
use App\Models\EditQuestionnaire\QuestionnaireUser;
use App\Notifications\PasswordReset;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    public const ATTORNEY = 2;
    public const CLIENT = 3;

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company',
        'client_type',
        'role',
        'retainer_agreement_box',
        'socket_token',
        'user_status',
        'socket_id',
        'device_type',
        'device_token',
        'client_subscription',
        'client_payroll_assistant',
        'petition_prepration_package',
        'peralegal_check_package',
        'additional_joint_package',
        'subscription_discount_percent',
        'hide_questionnaire',
        'document_email_notification',
        'document_pushed_notification',
        'onepage_questionnaire_request_id',
        'detailed_property',
        'argyle_self_token_id',
        'argyle_spouse_token_id',
        'two_factor_code',
        'two_factor_expires_at',
        'concierge_service',
        'phone_no',
        'mastercard_customer_id',
        'mastercard_customer_id_codebtor',
        'client_bank_statements',
        'client_profit_loss_assistant',
        'debtor_add_profit_loss_to_client_zip',
        'co_debtor_add_profit_loss_to_client_zip',
        'attorney_notice_email_1',
        'attorney_notice_email_2',
        'in_queue',
        'invite_document_selection',
        'parent_attorney_id',
        'enable_free_payroll_assistant',
        'tax_return_day_month',
        'client_bank_statements_premium',
        'client_credit_report',
        'paralegal_law_firm_id',
        'logged_in_ever',
        'recommned_password_update',
        'date_marked_delete'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const USER_DETAILS = [
        'id',
        'name',
        'socket_token',
        'device_type',
        'device_token',
    ];
    public const DEFAULT_USER_AVTAR = "user.png";

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function createLoginLink($userId)
    {

        $plaintext = Str::random(32);
        $logintoken = new LoginToken();
        $tokenTosave = hash('sha256', $plaintext);
        $expiredAt = now()->addMinutes(150000);
        $logintoken->create([
         'user_id' => $userId,
         'token' => $tokenTosave,
         'expires_at' => $expiredAt,
        ]);

        $link = URL::temporarySignedRoute('verify-login', $expiredAt, [
            'token' => $tokenTosave,
        ]);

        return $link;
    }

    /**
     * Get all of the subscriptions for the User
     *
     */
    public function subscriptions()
    {
        return $this->hasMany(AttorneySubscription::class, 'attorney_id')->orderBy('created_on', 'desc');
    }

    /**
     * Get all attorneyCards for the User
     *
     */
    public function attorneyCards()
    {
        return $this->hasMany(AttorneyCards::class, 'attorney_id');
    }

    /**
     * Get all attorneyCards for the User
     *
     */
    public function attorneyCompany()
    {
        return $this->hasOne(AttorneyCompany::class, 'attorney_id');
    }

    /**
    * Get all attorneyCards for the User
    *
    */
    public function attorneyDocuments()
    {
        return $this->hasMany(AttorneyDocuments::class, 'attorney_id');
    }

    /**
    * Get all clientRetainerDocuments for the User
    *
    */
    public function clientRetainerDocuments()
    {
        return $this->hasOne(ClientRetainerDocuments::class, 'attorney_id');
    }

    /**
    * Get attorneyPayments for the User
    *
    */
    public function attorneyPayments()
    {
        return $this->hasOne(AttorneyPayments::class, 'attorney_id');
    }

    /**
    * Get all attorneyCards for the User
    *
    */
    public function clientApplicationPayment()
    {
        return $this->hasMany(ClientApplicationPayment::class, 'attorney_id');
    }

    /**
    * Get all AnyOtherName for the User
    *
    */
    public function clientAnyOtherNameData()
    {
        return $this->hasOne(ClientAnyOtherNameData::class, 'client_id');
    }

    /**
    * Get all ClientBasicInfoPartA for the User
    *
    */
    public function clientBasicInfoPartA()
    {
        return $this->hasOne(ClientBasicInfoPartA::class, 'client_id');
    }

    public function questionnaireBasicInfoPartA()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartA::class, 'client_id');
    }

    public function getBasicInfo($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('DebtorInfo', $this)) {
            $questionnaireData = $this->questionnaireBasicInfoPartA()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        return $this->clientBasicInfoPartA()->first();
    }

    /**
    * Get all ClientBasicInfoPartB for the User
    *
    */
    public function clientBasicInfoPartB()
    {
        return $this->hasOne(ClientBasicInfoPartB::class, 'client_id');
    }

    public function questionnaireBasicInfoPartB()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartB::class, 'client_id');
    }

    public function questionnaireBasicInfoPartC()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartC::class, 'client_id');
    }

    public function questionnaireBasicInfoPartRest()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartRest::class, 'client_id');
    }

    public function getBasicInfoPartB($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('CoDebtorInfo', $this)) {
            // Attempt to fetch data from QuestionnaireBasicInfoPartB
            $questionnaireData = $this->questionnaireBasicInfoPartB()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        // Fall back to ClientBasicInfoPartB
        return $this->clientBasicInfoPartB()->first();
    }

    public function getBasicInfoPartC($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('BusinessInfo', $this)) {
            // Attempt to fetch data from QuestionnaireBasicInfoPartC
            $questionnaireData = $this->questionnaireBasicInfoPartC()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        // Fall back to ClientBasicInfoPartC
        return $this->clientBasicInfoPartC()->first();
    }

    public function getBasicInfoPartRest($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('BusinessInfo', $this)) {
            // Attempt to fetch data from QuestionnaireBasicInfoPartRest
            $questionnaireData = $this->questionnaireBasicInfoPartRest()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        // Fall back to ClientBasicInfoPartC
        return $this->clientBasicInfoPartRest()->first();
    }

    /********************* */
    public function questionnaireBasicInfoAnyOtherName()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireBasicInfoAnyOtherName::class, 'client_id');
    }

    public function getBasicInfoAnyOtherName($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('BusinessInfo', $this)) {
            // Attempt to fetch data from QuestionnaireBasicInfoAnyOtherName
            $questionnaireData = $this->questionnaireBasicInfoAnyOtherName()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        // Fall back to ClientAnyOtherNameData
        return $this->clientAnyOtherNameData()->first();
    }


    /*************************** */

    /**
    * Get all clientBasicInfoPartC for the User
    *
    */
    public function clientBasicInfoPartC()
    {
        return $this->hasOne(ClientBasicInfoPartC::class, 'client_id');
    }

    /**
    * Get all clientLivedAddressFrom730Data for the User
    *
    */
    public function clientLivedAddressFrom730Data()
    {
        return $this->hasOne(ClientLivedAddressFrom730Data::class, 'client_id');
    }

    /**
    * Get all clientBasicInfoPartRest for the User
    *
    */
    public function clientBasicInfoPartRest()
    {
        return $this->hasOne(ClientBasicInfoPartRest::class, 'client_id');
    }

    /**
    * Get all clientsPropertyResident for the User
    *
    */
    public function clientsPropertyResident()
    {
        return $this->hasMany(ClientsPropertyResident::class, 'client_id');
    }

    public function questionnairePropertyResident()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyResident::class, 'client_id');
    }

    public function getPropertyResident($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyResidenceInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyResident
            $questionnaireData = $this->questionnairePropertyResident()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        // Fall back to clientsPropertyResident
        return $this->clientsPropertyResident()->get();
    }

    /**
    * Get all ClientsPropertyVehicle for the User
    *
    */
    public function clientsPropertyVehicle()
    {
        return $this->hasMany(ClientsPropertyVehicle::class, 'client_id');
    }

    public function questionnairePropertyVehicle()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyVehicle::class, 'client_id');
    }

    public function getPropertyVehicle($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyVehicleInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyVehicle
            $questionnaireData = $this->questionnairePropertyVehicle()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        // Fall back to clientsPropertyResident
        return $this->clientsPropertyVehicle()->get();
    }

    /**
    * Get all clientsPropertyHousehold for the User
    *
    */
    public function clientsPropertyHousehold()
    {
        return $this->hasMany(ClientsPropertyHousehold::class, 'client_id');
    }

    public function questionnairePropertyHousehold()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyHousehold::class, 'client_id');
    }

    public function getPropertyHousehold($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyHouseholdInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyHousehold
            $questionnaireData = $this->questionnairePropertyHousehold()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        // Fall back to clientsPropertyResident
        return $this->clientsPropertyHousehold()->get();
    }

    /**
    * Get all ClientsPropertyFinancialAssets for the User
    *
    */
    public function clientsPropertyFinancialAssets()
    {
        return $this->hasMany(ClientsPropertyFinancialAssets::class, 'client_id');
    }

    public function questionnairePropertyFinancialAssets()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::class, 'client_id');
    }

    public function getPropertyFinancialAssets($fromAttorney = false, $keys = [])
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyFinancialAssetInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyFinancialAssets

            $query = $this->questionnairePropertyFinancialAssets();
            if (!empty($keys)) {
                $query = $query->whereIn('type', $keys);
            }

            $questionnaireData = $query->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }

        }

        // Fall back to clientsPropertyResident
        $query = $this->clientsPropertyFinancialAssets();
        if (!empty($keys)) {
            $query = $query->whereIn('type', $keys);
        }

        return $query->get();

    }

    /**
    * Get all ClientsPropertyBusinessAssets for the User
    *
    */
    public function clientsPropertyBusinessAssets()
    {
        return $this->hasMany(ClientsPropertyBusinessAssets::class, 'client_id');
    }

    public function questionnairePropertyBusinessAssets()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyBusinessAssets::class, 'client_id');
    }

    public function getPropertyBusinessAssets($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyBusinessAssetInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyBusinessAssets
            $questionnaireData = $this->questionnairePropertyBusinessAssets()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        // Fall back to clientsPropertyResident
        return $this->clientsPropertyBusinessAssets()->get();
    }

    /**
    * Get all ClientsPropertyFarmCommercial for the User
    *
    */
    public function clientsPropertyFarmCommercial()
    {
        return $this->hasMany(ClientsPropertyFarmCommercial::class, 'client_id');
    }

    public function questionnairePropertyFarmCommercial()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyFarmCommercial::class, 'client_id');
    }

    public function getPropertyFarmCommercial($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyFarmCommercialInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyFarmCommercial
            $questionnaireData = $this->questionnairePropertyFarmCommercial()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        // Fall back to clientsPropertyResident
        return $this->clientsPropertyFarmCommercial()->get();
    }

    /**
    * Get all ClientsPropertyMiscellaneous for the User
    *
    */
    public function clientsPropertyMiscellaneous()
    {
        return $this->hasMany(ClientsPropertyMiscellaneous::class, 'client_id');
    }

    public function questionnairePropertyMiscellaneous()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnairePropertyMiscellaneous::class, 'client_id');
    }

    public function getPropertyMiscellaneous($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('PropertyMiscellaneousInfo', $this)) {
            // Attempt to fetch data from questionnairePropertyMiscellaneous
            $questionnaireData = $this->questionnairePropertyMiscellaneous()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        // Fall back to clientsPropertyResident
        return $this->clientsPropertyMiscellaneous()->get();
    }

    /**
    * Get all Debts for the User
    *
    */
    public function debts()
    {
        return $this->hasMany(Debts::class, 'client_id');
    }

    /**
    * Get all DebtsTax for the User
    *
    */
    public function debtsTax()
    {
        return $this->hasMany(DebtsTax::class, 'client_id');
    }

    /**
    * Get all IncomeDebtorEmployer for the User
    *
    */
    public function incomeDebtorEmployer()
    {
        return $this->hasOne(IncomeDebtorEmployer::class, 'client_id');
    }

    /**
    * Get all IncomeDebtorSpouseEmployer for the User
    *
    */
    public function incomeDebtorSpouseEmployer()
    {
        return $this->hasOne(IncomeDebtorSpouseEmployer::class, 'client_id');
    }

    /**
    * Get all IncomeDebtorMonthlyIncome for the User
    *
    */
    public function incomeDebtorMonthlyIncome()
    {
        return $this->hasOne(IncomeDebtorMonthlyIncome::class, 'client_id');
    }

    /**
    * Get all IncomeDebtorSpouseMonthlyIncome for the User
    *
    */
    public function incomeDebtorSpouseMonthlyIncome()
    {
        return $this->hasOne(IncomeDebtorSpouseMonthlyIncome::class, 'client_id');
    }

    /**
    * Get all SpouseExpenses for the User
    *
    */
    public function expenses()
    {
        return $this->hasOne(Expenses::class, 'client_id');
    }

    public function questionnaireExpenses()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireExpenses::class, 'client_id');
    }

    public function getExpenses($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('ExpenseDebtor', $this)) {
            // Attempt to fetch data from QuestionnaireExpenses
            $questionnaireData = $this->questionnaireExpenses()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        // Fall back to expenses
        return $this->expenses()->first();
    }

    /**
    * Get all SpouseExpenses for the User
    *
    */
    public function spouseExpenses()
    {
        return $this->hasOne(SpouseExpenses::class, 'client_id');
    }


    public function questionnaireSpouseExpenses()
    {
        return $this->hasOne(\App\Models\EditQuestionnaire\QuestionnaireSpouseExpenses::class, 'client_id');
    }

    public function getSpouseExpenses($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('ExpenseDebtor', $this)) {
            // Attempt to fetch data from QuestionnaireSpouseExpenses
            $questionnaireData = $this->questionnaireSpouseExpenses()->first();
            if ($questionnaireData) {
                return $questionnaireData;
            }
        }

        // Fall back to spouseExpenses
        return $this->spouseExpenses()->first();
    }

    /**
    * Get all FinancialAffairs for the User
    *
    */
    public function financialAffairs()
    {
        return $this->hasOne(FinancialAffairs::class, 'client_id');
    }


    public function questionnaireFinancialAffairs()
    {
        return $this->hasMany(\App\Models\EditQuestionnaire\QuestionnaireFinancialAffairs::class, 'client_id');
    }

    public function getFinancialAffairs($fromAttorney = false)
    {
        if ($fromAttorney && QuestionnaireUser::isAddedByAttorney('FinancialAffairs', $this)) {
            $questionnaireData = $this->questionnaireFinancialAffairs()->get();
            if ($questionnaireData->isNotEmpty()) {
                return $questionnaireData;
            }
        }

        return $this->financialAffairs()->get();
    }


    /**
    * Get all ClientDocumentUploaded for the User
    *
    */
    public function clientDocumentUploaded()
    {
        return $this->hasMany(ClientDocumentUploaded::class, 'client_id');
    }

    /**
    * Get all ClientApplicationPayment for the User
    *
    */
    public function clientsApplicationPayment()
    {
        return $this->hasMany(ClientApplicationPayment::class, 'client_id');
    }

    /**
    * Get all DebtsDocuments for the User
    *
    */
    public function debtsDocuments()
    {
        return $this->hasMany(DebtsDocuments::class, 'client_id');
    }

    /**
    * Get all SignedDocuments for the User
    *
    */
    public function signedDocuments()
    {
        return $this->hasOne(SignedDocuments::class, 'client_id');
    }

    /**
    * Get all FormsStepsCompleted for the User
    *
    */
    public function formsStepsCompleted()
    {
        return $this->hasOne(FormsStepsCompleted::class, 'client_id');
    }

    /**
     * Get all CrsCreditReport for the User
     *
     */
    public function crsCreditReport()
    {
        return $this->hasOne(CrsCreditReport::class, 'client_id');
    }

    /**
    * Get all CrsLienJudgmentsReport for the User
    *
    */
    public function crsLienJudgmentsReport()
    {
        return $this->hasOne(CrsLienJudgmentsReport::class, 'client_id');
    }

    /**
    * Get all ClientsAttorney for the User
    *
    */
    public function ClientsAttorneybyclient()
    {
        return $this->hasOne(ClientsAttorney::class, 'client_id', 'id')->with('getuserattorney');
    }

    /**
     * Get all ClientsAttorney for the User
     *
     */

    public function ClientsAttorneybyattorney()
    {
        return $this->hasOne(ClientsAttorney::class, 'attorney_id', 'id');
    }

    /**
     * Get all Notifications for the User
     *
     */
    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'client_id');
    }

    public function getNotificationsCountAttribute()
    {
        return $this->notifications->where('unotification_is_read', 0)->count();
    }

    public static function mark_doc_not_own($client_id, $document_type)
    {
        $post = [
           'document_type' => $document_type,
           'created_at' => date("Y-m-d H:i:s"),
           'updated_at' => date("Y-m-d H:i:s")
     ];
        \App\Models\NotOwnDocuments::updateOrCreate(['client_id' => $client_id,'document_type' => $document_type], $post);
    }


    public static function mark_doc_own($client_id, $document_type)
    {
        $resident = Helper::DEBTOR_RESIDENTARRAY;
        array_push($resident, 'Current_Mortgage_Statement');
        if (in_array($document_type, $resident)) {
            $document_type = $resident;
        }
        if (!is_array($document_type)) {
            $document_type = [$document_type];
        }
        \App\Models\NotOwnDocuments::where(['client_id' => $client_id])->whereIn('document_type', $document_type)->delete();
    }


    /**
     * Get the attorney that the paralegal belongs to.
     */
    public function paralegalAttorney()
    {
        return $this->belongsTo(User::class, 'parent_attorney_id');
    }

    /**
     * Get the paralegals for the attorney.
     */
    public function paralegals()
    {
        return $this->hasMany(User::class, 'parent_attorney_id');
    }

    public static function getClientType($id)
    {
        $client = User::where('id', '=', $id)->first();
        if ($client) {
            return $client->client_type;
        }

        return null;
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\SimpleTextWebhook::class, 'client_id', 'id');
    }

    public function loginActivities()
    {
        return $this->hasMany(LoginActivity::class)->latest();
    }

    /**
    * Get the client's info
    *
    * @param mixed $clientId
    * @return array
    */
    public static function getClientInfo($clientId)
    {
        $sqlQuery = "select 
              concat(coalesce(client_info_a.name, 'Debtor'), ' ', coalesce(client_info_a.last_name, '')) as client_name,
              concat(coalesce(client_info_b.name, ''), ' ', coalesce(client_info_b.last_name, '')) as spouse_name
          from client_basic_info_part_a client_info_a
          left join client_basic_info_part_b client_info_b
              on client_info_b.client_id = client_info_a.client_id
          where client_info_a.client_id = ?";

        $results = DB::select($sqlQuery, [$clientId]);

        // Convert the result to an array
        $resultsArray = json_decode(json_encode($results), true);

        // Access the first result if you expect only one row
        $result = $resultsArray[0] ?? null;

        $clientFullname = "";
        $coDebtorFullname = "";

        if (!empty($result)) {
            $clientFullname = $result['client_name'];
            $coDebtorFullname = $result['spouse_name'];
        }

        $toReturn = [
            'client_id' => $clientId,
            'client_fullname' => $clientFullname,
            'co-debtor_fullname' => $coDebtorFullname,
        ];

        return $toReturn;
    }

    public static function getClientManagementCommonDataNew($ids, $attorney_id, $isAdmin = false)
    {
        $htmlBlocks = [];

        $client = User::whereIn('id', $ids)->get();
        $attorneyWise = 'all';
        $queueClientCount = 0;

        if ($isAdmin) {

            $queueClient = \App\Models\User::where('in_queue', 1)
                ->where('users.user_status', Helper::ACTIVE)
                ->leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id');

            if ($attorneyWise != 'all') {
                $queueClient->where(function ($query) use ($attorneyWise) {
                    $query->where('attorney_id', 'like', '%' . $attorneyWise . '%');
                });
            }

            $queueClientCount = $queueClient->groupBy('users.id')->get()->count();
        }

        $unreadMsg = '';

        foreach ($client as $val) {

            $unreadCount = CalendlyWebhook::where('event_read', 0)->count();

            $eventdata = CalendlyWebhook::where('client_id', $val['id'])
            ->where('scheduled_event_end_time', '>', date("Y-m-d\TH:i:s\Z", strtotime('now')))
            ->first();
            $clendlyData = !empty($eventdata) ? $eventdata->toArray() : [];


            if ($unreadCount > 0) {
                $unreadMsg = $unreadCount;
            }
            $displayEvent = false;
            if (!empty($clendlyData)) {
                $displayEvent = true;
            }
            $eventrowclass = 'no-calendy-data';
            $displayMsg = '';
            //\Log::info('event id'.$clendlyData['id'].'display event for client id'.$val['id'].' status ='.$displayEvent.' end at'.($clendlyData['scheduled_event_end_time']??'').' current compare with '.date("Y-m-d\TH:i:s\Z", strtotime('now')));
            if ($displayEvent && isset($clendlyData['scheduled_event_name'])) {
                $eventName = str_replace('/', ' ', $clendlyData['scheduled_event_name'] ?? '');
                $eventrowclass = 'calendyEventRow statuc_' . $eventName . ' status_' . ($clendlyData['event_status'] ?? '');

                if (($clendlyData['event_status'] ?? '') === 'active') {

                    $sdate = explode("T", $clendlyData['scheduled_event_end_time']);
                    $time = explode(".", $sdate[1]);

                    $stdate = explode("T", $clendlyData['scheduled_event_start_time']);
                    $sttime = explode(".", $stdate[1]);

                    $start = Carbon::createFromFormat('Y-m-d H:i:s', $stdate[0] . ' ' . $sttime[0], 'UTC')->setTimezone('America/Los_Angeles');
                    $end = Carbon::createFromFormat('Y-m-d H:i:s', $sdate[0] . ' ' . $time[0], 'UTC')->setTimezone('America/Los_Angeles');

                    $displayMsg = '<div class="appointment-item"><div class="d-flex justify-content-between align-items-center mb-1">
                        <strong class="text-primary">'.$clendlyData['scheduled_event_name'].'</strong>
                    </div>
                    <div><span class="text-muted d-block mb-0 fs-13px">
                        <i class="fas fa-calendar me-1 mr-1"></i>' . $start->format('l jS \of F Y  h:i:s a') . ' -  ' . $end->format(' h:i:s a')
                        . '</span></div></div>';

                }
            }

            $client_percent = [];
            $client_percent[$val['id']] = FormsStepsCompleted::getStepCompletionData($val['id'], $val['client_type']);
            $attorney_id = Helper::getCurrentAttorneyId();

            $attorney = \App\Models\ClientsAttorney::where("client_id", $val['id'])->first();

            if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
                $attorney_id = $attorney->attorney_id;
            }
            $documentProgress = ClientHelper::get_uploaded_docs_progress($val, $val['id'], $attorney_id);
            if (!empty($client_percent[$val['id']]['submitted_to_att_at'])) {
                $htmlBlocks['submitted-on-div-' . $val['id']] =
                    '<div class="document-submission-info">
                        <span class="submission-timestamp">Submitted By Client on:' .
                    DateTimeHelper::dbDateToDisplay($client_percent[$val['id']]['submitted_to_att_at'], true) .
                    '</span>
                    </div>';
            }
            $htmlBlocks['progress-td-' . $val['id']] = view('attorney.client_management.progress', [
                'val' => $val,
                'client_percent' => $client_percent,
                'documentProgress' => $documentProgress,
            ])->render();


            $htmlBlocks['client-'. $val['id']] = $eventrowclass;

            if ($isAdmin) {
                $htmlBlocks['clandely_msg-'. $val['id']] = !empty($displayMsg) ? '<div class="info-section-title">Recent Appointments</div>'.$displayMsg : '';
            } else {
                $htmlBlocks['clandely_msg-'. $val['id']] = $displayMsg;
            }
            $htmlBlocks['event_color_class-'. $val['id']] = (!$displayEvent) ? 'text-c-blue' : 'text-c-white';

        }

        $newDocsData = self::getNewDocumentUnreadCount($attorney_id, $ids);
        $htmlList = Helper::validate_key_value('htmlList', $newDocsData, 'array');

        $htmlBlocks = array_merge($htmlBlocks, $htmlList);

        if (!$isAdmin) {
            $newDocsCount = Helper::validate_key_value('count', $newDocsData, 'radio');
            $newDocsCount = !empty($newDocsCount) ? $newDocsCount : 0;
            $htmlBlocks['new-docs-recieved-tab-class'] = ($newDocsCount > 0)
                ? 'New Document Received (' . $newDocsCount . ')'
                : 'New Document Received';
        }

        if ($isAdmin) {
            $htmlBlocks['queue_client_count'] = ($queueClientCount > 0) ? 'Queue (' . $queueClientCount . ')' : 'Queue';
            $htmlBlocks['unreadMsg'] = $unreadMsg ?? '';
        }

        return $htmlBlocks;
    }

    public static function getNewDocumentUnreadCount($attorney_id, $ids)
    {
        $count = DB::table('tbl_client_document_uploaded as cdu')
            ->join('tbl_clients_attorney as ca', 'ca.client_id', '=', 'cdu.client_id')
            ->leftJoin('tbl_client_settings as cs', 'cs.client_id', '=', 'ca.client_id')
            ->where('ca.attorney_id', $attorney_id)
            ->where('cdu.is_viewed_by_attorney', 0)
            ->whereNotIn('cdu.document_type', ['document_sign', 'signed_document'])
            ->where(function ($query) {
                $query->whereNull('cs.is_case_filed')
                    ->orWhere('cs.is_case_filed', '!=', 1);
            })
            ->distinct('cdu.client_id')
            ->count('cdu.client_id');

        $unreadClientIds = DB::table('tbl_client_document_uploaded as cdu')
            ->whereIn('cdu.client_id', $ids)
            ->where('cdu.is_viewed_by_attorney', 0)
            ->distinct()
            ->pluck('cdu.client_id')
            ->toArray();

        $htmlList = [];
        foreach ($unreadClientIds as $id) {
            $htmlList["doc-recieved-div-{$id}"] = '<span class="client-new-doc-badge blink">New Document(s) Received</span>';
        }

        return ['count' => $count, 'htmlList' => $htmlList];
    }

    public static function client_password_reset_save($client_id, $attorney_id, $request)
    {

        if (empty($client_id)) {
            return redirect()->back()->with('error', 'Client ID is required');
        }

        $password = $request->input('password', '');
        $password_confirmation = $request->input('password_confirmation', '');

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)
           || !ClientsAttorney::where(['client_id' => $client_id, "attorney_id" => $attorney_id])->exists()
           || ($password !== $password_confirmation)
           || empty($password)
           || empty($password_confirmation)
        ) {
            return redirect()->back()->with('error', 'Invalid Request.');
        }

        $client = User::where('id', $client_id)->select(columns: ['name', 'email'])->first();

        if (!$client) {
            return redirect()->back()->with('error', 'Client not found.');
        }

        DB::beginTransaction();
        try {
            $passwordHash = Hash::make($password);

            User::where('id', $client_id)->update(['password' => $passwordHash]);

            InviteData::where(['client_id' => $client_id])->update([
                  'client_hash' => base64_encode($password),
                  'updated_at' => now()
               ]);

            $clientLoginUrl = AttorneySettings::getClientLoginUrl(attorneyId: $attorney_id);

            if (!empty($client->email)) {
                Mail::to($client->email)->send(new PasswordResetToClientMail($client->name, $client->email, $password, $clientLoginUrl));
            }

            DB::commit();

            return redirect()->back()->with('success', 'Client password has been reset successfully.');
        } catch (\Exception $e) {
            \Log::info("Reset error:". $e->getMessage());
            DB::rollBack();

            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
    }

    public function clientsAttorney()
    {
        return $this->hasOne(ClientsAttorney::class, 'client_id');
    }

    public function clientsParalegal()
    {
        return $this->hasOne(ClientParalegal::class, 'client_id');
    }

    public function clientsAssociate()
    {
        return $this->hasOne(ClientsAssociate::class, 'client_id');
    }

    public function clientsAppointmentReminder()
    {
        return $this->hasOne(ClientAppointmentReminder::class, 'client_id');
    }


    public function clientsSettings()
    {
        return $this->hasOne(ClientSettings::class, 'client_id');
    }

    public function assignedAttorney()
    {
        return $this->hasOneThrough(
            User::class,
            ClientsAttorney::class,
            'client_id',
            'id',
            'id',
            'attorney_id'
        );
    }
    public function simpleTextWebhookMessages()
    {
        return $this->hasOne(\App\Models\SimpleTextWebhook::class, 'client_id', 'id');
    }

    public function scopeUserSearch($query, $search)
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                ->orWhere('users.email', 'like', "%{$search}%")
                ->orWhere('users.phone_no', 'like', "%{$search}%")
                ->orWhere('users.id', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function scopeUserFilterByType($query, $type, $unreadMessageCount = 0, $notIn = [], $authUser = null, $filterParalegalId = null, $filterAssociateId = null)
    {
        if (empty($type)) {
            return $query;
        }

        $loggedInUserId = $authUser->id ?? null;

        if ($type != 'filed_case') {
            $query->where(function ($q) {
                $q->whereNull('tbl_client_settings.is_case_filed')
                ->orWhere('tbl_client_settings.is_case_filed', '!=', 1);
            });
        }

        switch ($type) {
            case 'active':
                $query->where('users.user_status', Helper::ACTIVE)
                      ->where('users.logged_in_ever', Helper::YES);
                break;

            case 'archived':
                $query->where('users.user_status', Helper::INACTIVE);
                break;

            case 'invited':
                $query->where('users.logged_in_ever', Helper::NO);
                break;

            case 'removed':
                $query->where('users.user_status', Helper::REMOVED);
                break;

            case 'assigned_to_me':
                if (!empty($authUser->paralegal_law_firm_id)) {
                    $query->leftJoin('tbl_clients_associate', 'users.id', '=', 'tbl_clients_associate.client_id')
                          ->where('tbl_clients_associate.associate_id', $authUser->paralegal_law_firm_id);
                } else {
                    $query->leftJoin('tbl_clients_paralegal', 'users.id', '=', 'tbl_clients_paralegal.client_id')
                          ->where('tbl_clients_paralegal.paralegal_id', $loggedInUserId);
                }
                break;



            case 'unread_message':
                $query->leftJoin('tbl_simpletext_message_webhook', 'users.id', '=', 'tbl_simpletext_message_webhook.client_id');
                $isParalegal = !empty($authUser->parent_attorney_id);

                if ($unreadMessageCount > 0) {
                    $query->where('tbl_simpletext_message_webhook.seen_by_attorney', 0);

                    if ($isParalegal) {
                        $query->leftJoin('tbl_clients_paralegal', 'users.id', '=', 'tbl_clients_paralegal.client_id')
                             ->where('tbl_clients_paralegal.paralegal_id', $authUser->id);
                    }
                } else {
                    $query->whereNotNull('tbl_simpletext_message_webhook.seen_by_attorney')
                        ->whereNotNull('tbl_simpletext_message_webhook.json');
                    if ($isParalegal) {
                        $query->leftJoin('tbl_clients_paralegal', 'users.id', '=', 'tbl_clients_paralegal.client_id')
                             ->where('tbl_clients_paralegal.paralegal_id', $authUser->id);
                    }
                }
                break;

            case 'all_firm_clients':
                $query->where(function ($q) {
                    $q->where(function ($q2) {
                        $q2->where('users.user_status', Helper::ACTIVE)
                           ->where('users.logged_in_ever', Helper::YES);
                    })
                    ->orWhere('users.logged_in_ever', Helper::NO);
                });
                break;

            case 'new_docs':
                $query->leftJoin('tbl_client_document_uploaded', 'users.id', '=', 'tbl_client_document_uploaded.client_id')
                      ->where('tbl_client_document_uploaded.is_viewed_by_attorney', 0)
                      ->whereNotIn('tbl_client_document_uploaded.document_type', $notIn);
                break;

            case 'reminder':
                $query->leftJoin('client_appointment_reminder_logs', 'users.id', '=', 'client_appointment_reminder_logs.client_id');
                $query->leftJoin('tbl_calendly_webhook', 'users.id', '=', 'tbl_calendly_webhook.client_id');
                $query->where(function ($q) {
                    $q->where(function ($subQ) {
                        $subQ->whereNotNull('client_appointment_reminder_logs.reminder_time')
                              ->where('client_appointment_reminder_logs.reminder_time', '!=', '');
                    })->orWhere(function ($subQ) {
                        $subQ->whereNotNull('tbl_calendly_webhook.scheduled_event_end_time')
                              ->where('tbl_calendly_webhook.scheduled_event_end_time', '>', date("Y-m-d\TH:i:s\Z", strtotime('now')));
                    });
                });
                $query->orderByRaw("
                     CASE 
                           WHEN STR_TO_DATE(client_appointment_reminder_logs.reminder_time, '%m/%d/%Y %H:%i:%s') >= NOW() THEN 0 
                           ELSE 1 
                     END,
                     STR_TO_DATE(client_appointment_reminder_logs.reminder_time, '%m/%d/%Y %H:%i:%s') ASC
                  ");

                break;
            case 'filed_case':
                $query->where(function ($q) {
                    $q->where(function ($subQ) {
                        $subQ->whereIn('is_case_filed', ['1']);
                    });
                });
                $query->orderByRaw("
                     CASE 
                        WHEN tbl_client_settings.case_filed_timestamp >= NOW() THEN 0 
                        ELSE 1 
                     END,
                     tbl_client_settings.case_filed_timestamp DESC
                  ");

                break;
            case 'unsubscribed':
                $query->where('tbl_client_settings.auto_mail_unsubscribed', 1);
                break;
        }

        if (!empty($filterParalegalId)) {
            $query->whereHas('clientsParalegal', function ($q) use ($filterParalegalId) {
                $q->where('paralegal_id', $filterParalegalId);
            });
        }

        if (!empty($filterAssociateId)) {
            $query->whereHas('clientsAssociate', function ($q) use ($filterAssociateId) {
                $q->where('associate_id', $filterAssociateId);
            });
        }


        return $query;
    }

    public static function isCreditReportEnabledByClientId($client_id)
    {
        $client = User::where('id', $client_id)->first();
        if (!$client) {
            return [
                'debtor' => false,
                'codebtor' => false,
             ];
        }

        $attorney_id = null;
        $clientsAttorney = \App\Models\ClientsAttorney::where('client_id', $client_id)->first();
        if ($clientsAttorney && !empty($clientsAttorney->attorney_id)) {
            $attorney_id = $clientsAttorney->attorney_id;
        }
        if (empty($attorney_id)) {
            return [
                 'debtor' => false,
                 'codebtor' => false,
              ];
        }

        // If attorney_id is 54695 (Dominic Majors), always enabled for both for next 60 days
        if ($attorney_id == 54695) {
            // Use a fixed date window: from 2025-06-26 to 2025-08-25 (60 days from today)
            $startDate = Carbon::create(2025, 6, 26)->startOfDay();
            $enableUntil = $startDate->copy()->addDays(60)->endOfDay();
            if (now()->lessThanOrEqualTo($enableUntil)) {
                return [
                   'debtor' => true,
                   'codebtor' => true,
                ];
            }
        }
        // If client_subscription is in any of the PLUS subscriptions, enable for both
        $plusSubscriptions = [
           AttorneySubscription::BASIC_PLUS_SUBSCRIPTION,
           AttorneySubscription::ULTIMATE_PLUS_SUBSCRIPTION,
        ];



        // Check if client_subscription is PREMIUM_PLUS_SUBSCRIPTION and per_package_price != 89.99
        if ((int)$client->client_subscription == AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION) {
            $subscription = \App\Models\SubscriptionToclient::where('client_id', $client->id)
            ->where('package_id', AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION)
            ->first();
            if ($subscription && $subscription->per_package_price != 89.99) {
                return [
                    'debtor' => true,
                    'codebtor' => true,
                ];
            }
        }

        if (in_array((int)$client->client_subscription, $plusSubscriptions)) {
            return [
            'debtor' => true,
            'codebtor' => true,
            ];
        }
        // Default logic based on client_credit_report value
        $creditReport = (int)($client->client_credit_report ?? 0);

        return [
           'debtor' => in_array($creditReport, [1, 3]),
           'codebtor' => in_array($creditReport, [2, 3]),
        ];

    }

    /**
    * Checks if the credit report feature is enabled for a specific client and document type.
    *
    * This method determines whether the credit report functionality is enabled for either
    * the debtor or co-debtor, based on the provided client ID and document type.
    *
    * @param int $clientId The ID of the client to check.
    * @param int $documentType The type of document (e.g., debtor or co-debtor credit report).
    * @return bool Returns true if the credit report is enabled for the specified client and document type, false otherwise.
    */
    public static function isCreditReportEnabledForClient($clientId, $documentType)
    {
        $creditReportEnabled = \App\Models\User::isCreditReportEnabledByClientId($clientId);
        if (
            ($creditReportEnabled['debtor'] && $documentType == \App\Models\ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT) ||
            ($creditReportEnabled['codebtor'] && $documentType == \App\Models\ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT)
        ) {
            return true;
        }

        return false;
    }

    public static function getFiledCaseCount($attorney_id)
    {
        return self::with([
               'clientsAttorney',
           ])->leftJoin('tbl_client_settings', 'users.id', '=', 'tbl_client_settings.client_id')
           ->where('users.role', User::CLIENT)
           ->whereHas('clientsAttorney', function ($q) use ($attorney_id) {
               $q->where('attorney_id', $attorney_id);
           })->where(function ($q) {
               $q->where(function ($subQ) {
                   $subQ->whereIn('is_case_filed', ['1']);
               });
           })->count();
    }
    public static function getFiledCaseCountForAdmin($type)
    {
        $client = self::leftJoin('tbl_client_settings', 'users.id', '=', 'tbl_client_settings.client_id')
           ->where(['users.role' => User::CLIENT, 'users.concierge_service' => 1])
           ->where(function ($q) {
               $q->where(function ($subQ) {
                   $subQ->whereIn('is_case_filed', ['1']);
               });
           });

        if ($type == 6) {
            $client->where('users.user_status', '=', Helper::INACTIVE);
        } else {
            $client->where('users.user_status', '=', Helper::ACTIVE);
        }

        return $client->count();
    }

    public static function getSelectedColumnsFromArray($data, $columns)
    {
        return collect($data)->only($columns)->toArray();
    }

    public static function getUserNameById($id)
    {
        return self::where('id', $id)->value('name') ?? '';
    }

}
