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
                                                                <span style="font-size: 14px;">Hi
                                                                    <strong>{{ $name }}</strong>,</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">My name is Mike, and I’m
                                                                    the founder of BK Questionnaire. Thank you for
                                                                    taking the time to sign up and explore our
                                                                    program.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">I noticed your
                                                                    registration and wanted to personally reach out in
                                                                    case you had questions or needed more information.
                                                                    I'm happy to walk you through how BK Questionnaire
                                                                    can support your firm and streamline your bankruptcy
                                                                    workflow.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">A bit about me: I've been
                                                                    a bankruptcy paralegal in California for the past 15
                                                                    years and have personally prepared over 9,000
                                                                    Chapter 7 and 13 cases. I've also spent the last few
                                                                    years handling creditor defense and creditor work. I
                                                                    developed BK Questionnaire not just as a software
                                                                    product, but as a real-world solution informed by
                                                                    the daily challenges legal professionals
                                                                    face.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">If you'd like to have a
                                                                    quick conversation, feel free to call me directly at
                                                                    <a target="_blank" style="color: #0000EE;"
                                                                        href="tel:1-714-791-4106">(714){!! '&nbsp;' !!}791-4106</a>.</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Or, if you prefer to book
                                                                    a demo at a time that works for you, you can
                                                                    schedule here:</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">&#x1F449;&#x1F3FB; <a
                                                                        target="_blank" style="color: #0000EE;"
                                                                        href="{{ env('CALENDLY_CONSULTATION_URL', 'https://calendly.com/bkquestionnaire/consultation') }}">{{ env('CALENDLY_CONSULTATION_URL', 'https://calendly.com/bkquestionnaire/consultation') }}</a></span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Looking forward to
                                                                    connecting and seeing how BK Questionnaire can
                                                                    support your practice.</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Best regards,</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Mike Croak</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Founder, BK
                                                                    Questionnaire</span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;"><a target="_blank"
                                                                        style="color: #0000EE;"
                                                                        href="https://www.bkquestionnaire.com/">www.bkquestionnaire.com</a></span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;"><a target="_blank"
                                                                        style="color: #0000EE;"
                                                                        href="tel:1-714-791-4106">(714)
                                                                        791-4106</a></span></p>
                                                        </div>
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
