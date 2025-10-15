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
                                    <td
                                        style="background-color:transparent;border-radius:0px;vertical-align:top;padding:2px 2px 2px 2px;">

                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                            style="" width="100%">

                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="font-size:0px;padding:10px 2px 10px 13px;word-break:break-word;">

                                                        <div
                                                            style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;">
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Hello<strong>
                                                                        {{ $user->name }},</strong></span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">We understand this is a
                                                                    very stressful time for you, and we’ve worked hard
                                                                    to make this process as smooth and simple as
                                                                    possible.</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Before you begin, please
                                                                    take a moment to watch the short video available on
                                                                    one of our apps or our website. It walks you through
                                                                    the quickest and most efficient way to provide all
                                                                    the information your attorney needs and to upload
                                                                    the documents required by the Court into our system.
                                                                    Following this method will save you time and allow
                                                                    us to assist you more effectively if any issues
                                                                    arise.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">If you have any questions
                                                                    about your bankruptcy case, please contact your
                                                                    attorney:</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Attorney:
                                                                </span><strong><span
                                                                        style="font-size: 14px;">{{ $attorney->company_name }}</span></strong><br><span
                                                                    style="font-size: 14px;">Phone: </span><strong><span
                                                                        style="font-size: 14px;"><a target="_blank"
                                                                            style="color: #0000EE;"
                                                                            href="tel:{{ $attorney->attorney_phone }}">{{ $attorney->attorney_phone }}</a></span></strong><br><span
                                                                    style="font-size: 14px;">Email: </span><strong><span
                                                                        style="font-size: 14px;"><a target="_blank"
                                                                            style="color: #0000EE;"
                                                                            href="mailto:{{ $attorney->email }}">{{ $attorney->email }}</a></span></strong>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">For any technical issues
                                                                    or questions about the system, feel free to reach
                                                                    out to us:</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Phone: <a target="_blank"
                                                                        style="color: #0000EE;"
                                                                        href="tel:1-888-356-5777">(888)
                                                                        356-5777</a></span><br><span
                                                                    style="font-size: 14px;">Email: <a
                                                                        href="mailto:info@bkassistant.net"
                                                                        style="color: #0000EE;">info@bkassistant.net</a></span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">We know that even the
                                                                    simplest technology can feel frustrating when you’re
                                                                    already dealing with so much. We're here to
                                                                    help—every step of the way.</span></p>

                                                        </div>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" vertical-align="middle"
                                                        style="font-size:0px;padding:5px 20px 15px 20px;word-break:break-word;">

                                                        <div
                                                            style="border:1px solid black;border-radius:10px;padding:10px;padding-bottom:20px;text-align:center;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;color:#000000;">
                                                            <h3 style="margin-bottom: 15px;">Your credential information
                                                            </h3>

                                                            @php
                                                                use Illuminate\Support\Facades\Hash;
                                                            @endphp

                                                            @if ($user->email)
                                                                <p style="margin-bottom: 15px;"><label>Your login
                                                                        ID:</label> <span
                                                                        style="color: #0560FD; font-weight: 600;">{{ $user->email }}</span>
                                                                </p>
                                                            @endif
                                                            @if (!Hash::info($user->password)['algo'])
                                                                <p
                                                                    style="color: #475569;text-align: center;border-radius: 6px;padding: 10px;background: #F1F3F8;margin-bottom: 15px;">
                                                                    <span>Your first time password:
                                                                        <b>{{ trim($user->password) }}</b></span>
                                                                </p>
                                                            @endif
                                                            <a style="text-align:center;background-color: #0000EE;padding:10px;font-weight:bold;color:#fff;"
                                                                href="{{ !empty($clientLoginUrl) ? $clientLoginUrl : 'https://www.bkquestionnaire.com/client/login' }}">Login
                                                                account now</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size:0px;padding:10px 2px 10px 13px;word-break:break-word;">
                                                        <p
                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify; color:#000000;">
                                                            <span style="font-size: 14px;">Warm regards,<br>The BK
                                                                Questionnaire Team</span></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" vertical-align="middle"
                                                        style="font-size:0px;padding:5px 20px 5px 20px;word-break:break-word;">

                                                        <p
                                                            style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial; text-align: center;">
                                                            <span>If you prefer not to receive emails like this, you
                                                                may</span> <a href=""
                                                                style="font-size: 14px;text-decoration: underline;font-weight: 600; color: #0560FD;">unsubcribe</a>
                                                        </p>
                                                        <p style="font-size: 14px;margin-top: 4px">Copyright ©
                                                            {{ date('Y') }} BK Assistant</p>

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
