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
                                                                <span style="font-size: 14px;">Great news
                                                                    {{ $attorneyName }},</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Your Client
                                                                    ({{ $clientName }}) sent documents back to you via
                                                                    the attorney client portal in BK
                                                                    Questionnaire.</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Their client ID is: {{ $clientId }}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                            </p>
                                                            <p
                                                                style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Please log into BK Questionnaire and go to
                                                                Attorney/Client DOC Portal to view them.</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">If you have
                                                                    any{!! '&nbsp;' !!} technical </span><span
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
                                                                        href="mailto:support@bkquestionnaire.com"
                                                                        style="color: #0000EE;">support@bkquestionnaire.com</a></span>
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
