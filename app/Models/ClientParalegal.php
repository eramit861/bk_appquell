<?php

namespace App\Models;

use App\Helpers\AddressHelper;
use App\Helpers\Helper;
use App\Mail\ParalegalInfoToClientMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class ClientParalegal extends Model
{
    use HasFactory;
    protected $table = 'tbl_clients_paralegal';
    protected $fillable = ['client_id', 'paralegal_id'];

    public static function send_paralegal_info_to_client($request)
    {

        $client_id = $request->input('client_id');
        $attorney_id = $request->input('attorney_id');
        $paralegal_id = $request->input('paralegal_id');

        if (empty($client_id)) {
            return redirect()->back()->with('error', 'Client ID is required');
        }

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)
            || !ClientsAttorney::where(['client_id' => $client_id, "attorney_id" => $attorney_id])->exists()
            || !self::where(['client_id' => $client_id, "paralegal_id" => $paralegal_id])->exists()
        ) {
            return redirect()->back()->with('error', 'Invalid Request');
        }

        $client = User::where('id', $client_id)->select(['phone_no','name','email'])->first();

        if (!$client) {
            return redirect()->back()->with('error', 'Client not found.');
        }

        $paralegal_name = $request->input('name');
        $paralegal_phone_no = $request->input('phone_no');
        $paralegal_email = $request->input('email');
        $paralegal_appointment_link = $request->input('appointment_link');
        $extra_message = $request->input('extra_message');

        if (!empty($client->email)) {
            Mail::to($client->email)->send(new ParalegalInfoToClientMail($client->name, $paralegal_name, $paralegal_email, $paralegal_phone_no, $paralegal_appointment_link, $extra_message));
        }
        if (!empty($client->phone_no)) {
            $paralegal_appointment_link = !empty($paralegal_appointment_link) ? '[url='.$paralegal_appointment_link.']' : $paralegal_appointment_link;
            $msg_body = 'Hi '.$client->name.', 
Here are the details of the paralegal assigned to your case:
Name: '.$paralegal_name.'
Email: '.$paralegal_email.'
Phone: '.$paralegal_phone_no.'
Appointment Link: '.$paralegal_appointment_link.'
Let us know if you have any questions!';
            AddressHelper::sendSakariMobileTextMessage($client, $msg_body);
        }

        return redirect()->back()->with('success', 'Client has been notified with paralegal information.');
    }

    public static function get_paralegal_info_to_client_popup_data($client_id, $attorney_id, $paralegal_id, $route)
    {

        $client = User::where('id', $client_id)->select(columns: ['name'])->first();

        $paralegal = User::where('users.id', $paralegal_id)->leftJoin(
            'tbl_paralegal_settings',
            'users.id',
            '=',
            'tbl_paralegal_settings.paralegal_id'
        )->select(['users.phone_no','users.name','users.email','tbl_paralegal_settings.appointment_link'])->first();

        $formLabel = $client->name ? "Send Paralegal Info - ".$client->name : "Paralegal Info";

        return [
                'client_id' => $client_id,
                'attorney_id' => $attorney_id,
                'paralegal_id' => $paralegal_id,
                'paralegal' => $paralegal,
                'formRoute' => route($route),
                'formLabel' => $formLabel,
                'client' => $client,
        ];
    }
}
