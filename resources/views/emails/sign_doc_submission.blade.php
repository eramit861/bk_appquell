@include('emails.email_common', ['logo' => asset('assets/img/attorney_email.jpeg')])

<div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td
                    style="border:1px #828282 solid;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;text-align:center;">
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
                                                                <span style="font-size: 14px;">Great news,
                                                                    <u>({{ $client->name }})</u></span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Your attorney,
                                                                    <u>({{ $attorney_name }})</u> sent documents for you
                                                                    to sign in BK Questionnaire. </span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">To view them log back
                                                                    into your questionnaire. Select the blinking red
                                                                    link: </span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;"><strong
                                                                        style="color: #ff0000;border:2px solid red;border-radius:10px;padding:3px;">Your
                                                                        Attorney Sent You Doc(s) Click Here To
                                                                        View</strong> in the top right corner of the
                                                                    screen.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Review them carefully to
                                                                    make sure you don't miss any pages.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">If they require any
                                                                    signature print them out and sign ALL pages that
                                                                    require your signature.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Simply scan them back
                                                                    into the system using the same link or the
                                                                    Additional or Unlisted Documents in the documents
                                                                    sections of the questionnaire and notify your
                                                                    <u>({{ $attorney_name }})</u>.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: center;">
                                                                <a href="{{ route('client_login') }}"
                                                                    style="text-align:center;background-color: #0000EE;padding:10px;font-weight:bold;color:#fff;">Log
                                                                    Into BK Questionnaire</a></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">If you have any question
                                                                    about your bankruptcy case, please contact your
                                                                    attorney</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Attorney:
                                                                </span><strong><span
                                                                        style="font-size: 14px;"><u>({{ $attorney_company->name }})</u></span></strong>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Phone:
                                                                </span><strong><span style="font-size: 14px;"><a
                                                                            target="_blank" style="color: #0000EE;"
                                                                            href="tel:{{ $attorney_company->attorneyCompany->attorney_phone }}"><u>({{ $attorney_company->attorneyCompany->attorney_phone }})</u></a></span></strong>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span
                                                                    style="font-size: 14px;">Email:</span><strong><span
                                                                        style="font-size: 14px;"><a target="_blank"
                                                                            style="color: #0000EE;"
                                                                            href="mailto:{{ $attorney_company->email }}"><u>({{ $attorney_company->email }})</u></a></span></strong>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">If you have
                                                                    any{!! '&nbsp;' !!} technical </span><span
                                                                    style="font-size: 14px;">questions or concerns you
                                                                    may reach us at:</span><br><span
                                                                    style="font-size: 14px;">Phone: <a
                                                                        title="(888) 356-5777" target="blank"
                                                                        href="tel:1-888-356-5777"
                                                                        style="color: #0000EE;">(888)
                                                                        356-5777</a></span></p>
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
</div>
</body>

</html>
