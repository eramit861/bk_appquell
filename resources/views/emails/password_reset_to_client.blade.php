@include('emails.email_common', ['logo' => asset('assets/img/client_email.jpeg')])

<div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:9px 0px 9px 0px;text-align:center;">
                    <div class="mj-column-per-100 outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                            <tbody>
                                <tr>
                                    <td style="border-radius:0px;vertical-align:top;padding:0px 0px 0px 0px;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                            style="" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="font-size:0px;padding:0px 15px 15px 15px;word-break:break-word;">
                                                        <div
                                                            style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;">
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Hello
                                                                    {{ $name }},{!! '&nbsp;' !!}</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Your password was updated
                                                                    successfully! You can now log in using the
                                                                    information below.</span><br>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <div
                                                                style="border:1px solid black;border-radius:10px;padding:10px;padding-bottom:20px;text-align:center;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;color:#000000;">
                                                                <h3 style="margin-bottom: 15px;">Your credential
                                                                    information</h3>
                                                                @php
                                                                    use Illuminate\Support\Facades\Hash;
                                                                @endphp
                                                                @if ($email)
                                                                    <p style="margin-bottom: 15px;"><label>Your login
                                                                            ID:</label> <span
                                                                            style="color: #0560FD; font-weight: 600;">{{ $email }}</span>
                                                                    </p>
                                                                @endif
                                                                @if (!Hash::info($password)['algo'])
                                                                    <p
                                                                        style="color: #475569;text-align: center;border-radius: 6px;padding: 10px;background: #F1F3F8;margin-bottom: 15px;">
                                                                        <span>Your password:
                                                                            <b>{{ trim($password) }}</b></span>
                                                                    </p>
                                                                @endif
                                                                <a style="text-align:center;background-color: #0000EE;padding:10px;font-weight:bold;color:#fff;"
                                                                    href="{{ !empty($clientLoginUrl) ? $clientLoginUrl : 'https://www.bkquestionnaire.com/client/login' }}">Login
                                                                    account now</a>
                                                            </div>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">If you have any technical
                                                                    questions or concerns you may reach us
                                                                    at:</span><br>
                                                                <span style="font-size: 14px;">Phone:
                                                                    <a href="(888)%20356-5777"
                                                                        style="color: #0000EE;">(888) 356-5777</a>
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Email:
                                                                    <a href="mailto:info@bkassistant.net"
                                                                        style="color: #0000EE;">info@bkassistant.net</a>
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;text-align:center;">
                                                                <span style="font-size: 14px;">If you prefer not to
                                                                    receive emails like this, you may
                                                                    <a href="unsubscribe.com"
                                                                        style="color: #0000EE;">unsubscribe</a>
                                                                </span><br>
                                                                <span style="font-size: 14px;">Copyright © {{ date('Y') }} BK
                                                                    Assistant</span>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
</body>

</html>
