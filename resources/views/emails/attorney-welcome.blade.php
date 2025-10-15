@include('emails.email_common', ['logo' => asset('assets/img/attorney_email.jpeg')])
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
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Hello
                                                                    {{ $user->name }}</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Thank you for choosing BK
                                                                    Questionnaire.com for your bankruptcy client needs.
                                                                    We appreciate your business and value your feedback.
                                                                    If you encounter any issues or have suggestions on
                                                                    how we can improve our services to better assist you
                                                                    or your clients, please do not hesitate to share
                                                                    your thoughts with us using the attorney chat or
                                                                    email us at <a
                                                                        href="mailto:suggestions@bkquestionnaire.com."
                                                                        style="color: #0000EE;">suggestions@bkquestionnaire.com.</a>
                                                                    Your feedback is crucial to our ongoing efforts to
                                                                    be a better partner.</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <br><span style="font-size: 14px;">Please note that you
                                                                    can upload your law firm logo to our site to
                                                                    personalize your experience.</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">We created this site from
                                                                    14 years of hands-on bankruptcy experience. My goal
                                                                    is to create the best bankruptcy software and
                                                                    interface in the bankruptcy marketplace. If you have
                                                                    any questions or concerns you can always reach out
                                                                    to me to directly at <a
                                                                        href="mailto:mike.croak@bkquestionnaire.com"
                                                                        style="color: #0000EE;">mike.croak@bkquestionnaire.com</a></span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <br><span style="font-size: 14px;">Below you will find
                                                                    your login information.</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <br><span style="font-size: 14px;">Mike Croak</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">If you have any
                                                                    technical </span><span
                                                                    style="font-size: 14px;">questions or concerns you
                                                                    may reach us at:</span><br><span
                                                                    style="font-size: 14px;">Phone: <a
                                                                        style="color: #0000EE;" target="_blank"
                                                                        title="(888) 356-5777" href="tel:1-888-356-5777"
                                                                        style="color: #0000EE;">(888)
                                                                        356-5777</a></span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Email: <a
                                                                        href="mailto:info@bkassistant.net"
                                                                        style="color: #0000EE;">info@bkassistant.net</a></span>
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

<div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;text-align:center;">

                    <div class="mj-column-per-100 outlook-group-fix"
                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <div class="bk-ss-5">
                            <div class="ss-content">
                                <h3 style="margin-bottom: 15px;">Your credential information</h3>
                                @php use Illuminate\Support\Facades\Hash; @endphp
                                @if ($user->email)
                                    <p style="margin-bottom: 15px;"><label>Your login ID:</label> <span
                                            style="color: #0560FD; font-weight: 600;">{{ $user->email }}</span></p>
                                @endif
                                @if (!Hash::info($user->password)['algo'])
                                    <div class="bk-pw-area">
                                        <span>Your first time password: <b>{{ $user->password }}</b></span>
                                    </div>
                                @endif
                                <a class="bk-btn-login-now" href="{{ route('login') }}">Login account now</a>
                            </div>
                        </div>
                        <div class="bk-ss-6">
                            <div class="ss-content">
                                <p style="font-size: 14px;"><span>If you prefer not to receive emails like this, you
                                        may</span> <a href=""
                                        style="font-size: 14px;text-decoration: underline;font-weight: 600; color: #0560FD;">unsubcribe</a>
                                </p>
                                <p style="font-size: 14px;margin-top: 4px">Copyright © {{ date('Y') }} BK Assistant
                                </p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</div>
</div>
</body>

</html>
