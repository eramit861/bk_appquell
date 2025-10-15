@include('emails.email_common', ['logo' => $data['logo']])

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
                                                                <span style="font-size: 14px;">Great News,
                                                                    {{ $data['client_name'] }}. Your bankruptcy case has
                                                                    been assigned to {{ $data['paralegal_name'] }}
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">
                                                                    {{ $data['paralegal_name'] }} has been assigned your
                                                                    case. If you need anything, please reach out to
                                                                    {{ $data['paralegal_first_name'] }}.
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">
                                                                    Here is {{ $data['paralegal_first_name'] }}'s
                                                                    contact info:
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Email address: <a
                                                                        href="mailto:{{ $data['paralegal_email'] }}"
                                                                        style="color: #0000EE;">{{ $data['paralegal_email'] }}</a></span>
                                                                <br>
                                                                <span style="font-size: 14px;">Phone number: <a
                                                                        href="tel:{{ $data['paralegal_phone'] }}"
                                                                        style="color: #0000EE;">{{ $data['paralegal_phone'] }}</a></span>
                                                                @if (!empty($data['paralegal_link']))
                                                                    <br>
                                                                    <span style="font-size: 14px;">Appointment link: <a
                                                                            href="{{ $data['paralegal_link'] }}"
                                                                            target='_blank'
                                                                            style="color: #0000EE;">{{ $data['paralegal_link'] }}</a></span>
                                                                @endif
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">
                                                                    Save this email so you have the direct contact of
                                                                    {{ $data['paralegal_name'] }}, they are directly
                                                                    working on your case.
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;text-align:center;">
                                                                <span style="font-size: 14px;">If you prefer not to
                                                                    receive emails like this, you may <a
                                                                        href="unsubscribe.com"
                                                                        style="color: #0000EE;">unsubscribe</a>
                                                                </span>
                                                                <br>
                                                                <span style="font-size: 14px;">Copyright ©
                                                                    {{ date('Y') }} BK Assistant</span>
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

</body>

</html>
