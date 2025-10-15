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
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Great news,
                                                                    {{ $attorneyName }}!{!! '&nbsp;' !!}</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">The BK Questionnaire
                                                                    concierge service has been successfully completed
                                                                    for your client, ({{ $clientName }})
                                                                    <strong>(Client
                                                                        ID:{{ $clientId }})</strong>.{!! '&nbsp;' !!}</span><br>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">To view the details,
                                                                    please log into your portal on BK Questionnaire and
                                                                    navigate to the Client Management screen. This
                                                                    client is now highlighted in green, indicating that
                                                                    their questionnaire has been completed and submitted
                                                                    to your firm.{!! '&nbsp;' !!}</span><br>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Thank you for using BK
                                                                    Questionnaire!{!! '&nbsp;' !!}</span><br>
                                                            </p>
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
                                                                {!! '&nbsp;' !!}</p>
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
