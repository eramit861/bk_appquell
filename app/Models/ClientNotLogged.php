<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\LoginCheckCornMail;
use App\Mail\WelcomeAboardDescriptionCronMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ClientNotLogged extends Model
{
    public function index()
    {
        $listOfClients = \App\Models\User::where(['users.role' => \App\Models\User::CLIENT,'users.logged_in_ever' => 0])
                       ->where('users.created_at', '<=', \Carbon\Carbon::now()->subDays(2)->toDateTimeString())
                       ->where('users.created_at', '>=', \Carbon\Carbon::now()->subDays(17)->toDateTimeString())
                       ->select(['tbl_attorney_company.company_name','tbl_attorney_company.attorney_phone','attorney.id as attorney_id','attorney.email as attorney_email','users.id as client_id','attorney.name as attorney_name','users.password','users.email as client_email','users.phone_no as client_phone','users.name as client_name'])
                       ->leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
                       ->leftJoin('users as attorney', 'attorney.id', '=', 'tbl_clients_attorney.attorney_id')
                       ->leftjoin('tbl_attorney_company', 'attorney.id', '=', 'tbl_attorney_company.attorney_id')
                       ->get();

        if (!empty($listOfClients)) {
            foreach ($listOfClients as $client) {
                self::sendemail($client);
            }
        }

        $today = \Carbon\Carbon::today();
        $threeDaysAgo = $today->subDays(3)->toDateTimeString();
        $list = \App\Models\User::where(['users.role' => \App\Models\User::CLIENT,'users.logged_in_ever' => 0])
                 ->where('users.created_at', '<=', $threeDaysAgo)
                 ->select(['tbl_attorney_company.company_name', 'tbl_attorney_company.attorney_phone', 'attorney.id as attorney_id', 'attorney.email as attorney_email', 'users.id as client_id', 'attorney.name as attorney_name', 'users.password', 'users.email as client_email', 'users.phone_no as client_phone', 'users.name as client_name', 'users.created_at as joined_date' ])
                 ->leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
                 ->leftJoin('users as attorney', 'attorney.id', '=', 'tbl_clients_attorney.attorney_id')
                 ->leftjoin('tbl_attorney_company', 'attorney.id', '=', 'tbl_attorney_company.attorney_id')
                 ->whereNotExists(function ($query) {
                     $query->select(DB::raw(1))
                           ->from('tbl_notification_template')
                           ->whereColumn('tbl_notification_template.attorney_id', 'attorney.id')
                           ->where('tbl_notification_template.noti_tenp_body', \App\Models\NotificationTemplate::NOTLOGGEDINUSER);
                 })
                 ->get();

        if (!empty($list)) {
            foreach ($list as $user) {
                if (self::clientExist($user->client_id, $user->attorney_id)) {
                    $startDate = \Carbon\Carbon::parse($user['joined_date']);
                    $today = \Carbon\Carbon::now();
                    $numberOfDays = $startDate->diffInDays($today);
                    if ($numberOfDays % 7 == 3) {
                        self::sendLoginCheckEmail($user);
                    }
                }
            }
        }
    }

    private function sendemail($client)
    {
        $attorneyuser = json_encode(['company_name' => $client['company_name'],'attorney_phone' => $client['attorney_phone'],'email' => $client['attorney_email'],'attorney_id' => $client['attorney_id']]);
        $attorney = json_decode($attorneyuser);
        $user = \App\Models\User::where('id', $client->client_id)->first();
        if ($user && self::clientExist($client->client_id, $attorney->attorney_id)) {
            $password = random_int(100000, 999999);
            $user->update(["password" => Hash::make($password)]);
            $user->password = $password;
        }

        try {
            $clientLoginUrl = AttorneySettings::getClientLoginUrl($attorney->attorney_id);
            Mail::to($user->email)->send(new WelcomeAboardDescriptionCronMail($user, $attorney, $clientLoginUrl));
            Log::info("Client never logged-in email sent---".$user->email."&id=".$user->id.'&name='.$user->name.'&email='.$user->email.'&phone='.$user->phone_no.'&password='.$user->password.'&clientLoginUrl='.$clientLoginUrl);
        } catch (\Exception $e) {

        }
    }

    private static function sendLoginCheckEmail($user)
    {
        $attorney_name = $user->attorney_name;
        $client_name = $user->client_name;
        try {
            if (AttorneySettings::isEmailEnabled($user->attorney_id, 'client_automated_login_check_corn_mail', $user->client_id)) {
                Mail::to($user->email)->send(new LoginCheckCornMail($client_name, $attorney_name));
            }
        } catch (\Exception $e) {
        }
    }

    public static function clientExist($client_id, $attorney_id): bool
    {
        return \App\Models\ClientsAttorney::where(['client_id' => $client_id, "attorney_id" => $attorney_id])->exists();
    }
}
