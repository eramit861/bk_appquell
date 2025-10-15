@include('emails.email_common', ['logo' => asset('assets/img/client_email.jpeg')])
<div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:9px 0px 9px 0px;text-align:center;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:598px;">
                                <div class="mj-column-per-100 outlook-group-fix"
                                    style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        width="100%">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="background-color:transparent;border-radius:0px;vertical-align:top;padding:2px 2px 2px 2px;">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation" style="" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td align="left"
                                                                    style="font-size:0px;padding:10px 2px 10px 13px;word-break:break-word;">
                                                                    <div
                                                                        style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;margin-bottom:15px">
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify; margin-bottom:15px;">
                                                                            <span style="font-size: 14px;">Hello
                                                                                <strong>
                                                                                    {{ $user['name'] ?? '' }},</strong>
                                                                            </span>
                                                                        </p>
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                        </p>
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                        </p>
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                            <span style="font-size: 14px;">
                                                                                Welcome to BK Questionnaire.com. You
                                                                                have been added as a user in our system.
                                                                                This will allow your office to assign
                                                                                you cases that you can fully access and
                                                                                work on only.
                                                                            </span>
                                                                        </p>

                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                            <span style="font-size: 14px;">
                                                                                Please use the log in ID and password
                                                                                below to access your
                                                                                {{ isset($isLawFirmAssigned) && $isLawFirmAssigned ? 'law firm' : 'paralegal' }}
                                                                                portal.
                                                                            </span>
                                                                        </p>
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" vertical-align="middle"
                                                                    style="font-size:0px;padding:5px 20px 5px 20px;word-break:break-word;">
                                                                    <div
                                                                        style="border:1px solid black;border-radius:10px;padding:10px;padding-bottom:20px;text-align:center;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;color:#000000;">
                                                                        <h3 style="margin-bottom: 15px;">Your credential
                                                                            information</h3>
                                                                        <p style="margin-bottom: 15px;">
                                                                            <label>Your login ID:</label>
                                                                            <span
                                                                                style="color: #0560FD; font-weight: 600;">{{ $user['email'] ?? '' }}</span>
                                                                        </p>
                                                                        <p
                                                                            style="color: #475569;text-align: center;border-radius: 6px;padding: 10px;background: #F1F3F8;margin-bottom: 15px;">
                                                                            <span>Your first time password:
                                                                                <b>{{ $user['password'] ?? '' }}</b>
                                                                            </span>
                                                                        </p>
                                                                        <a style="text-align:center;background-color: #0000EE;padding:10px;font-weight:bold;color:#fff;"
                                                                            href="https://www.bkquestionnaire.com/login">Login
                                                                            account now</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"
                                                                    style="font-size:0px;padding:10px 2px 10px 13px;word-break:break-word;">
                                                                    <div
                                                                        style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;">
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                            <span style="font-size: 14px;">If you have
                                                                                any questions or need any help
                                                                                navigating the system please contact:
                                                                            </span>
                                                                            <br>
                                                                            <span style="font-size: 14px;">Phone:
                                                                                <a target="_blank"
                                                                                    style="color: #0000EE;"
                                                                                    href="tel:1-888-356-5777">(888)
                                                                                    356-5777</a>
                                                                            </span>
                                                                        </p>
                                                                        <p
                                                                            style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                            <span style="font-size: 14px;">Email:
                                                                                <a href="mailto:info@bkquestionnaire.com"
                                                                                    style="color: #0000EE;">info@bkquestionnaire.com</a>
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" vertical-align="middle"
                                                                    style="font-size:0px;padding:5px 20px 5px 20px;word-break:break-word;">
                                                                    <p
                                                                        style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial; text-align: center;">
                                                                        <span>If you prefer not to receive emails like
                                                                            this, you may</span>
                                                                        <a href=""
                                                                            style="font-size: 14px;text-decoration: underline;font-weight: 600; color: #0560FD;">unsubcribe</a>
                                                                    </p>
                                                                    <p style="font-size: 14px;margin-top: 4px">Copyright
                                                                        © {{ date('Y') }} BK
                                                                        Assistant</p>
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
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
</body>

</html>
