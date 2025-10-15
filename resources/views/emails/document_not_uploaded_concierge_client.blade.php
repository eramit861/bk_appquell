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
                                        <!--  -->
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                            width="100%">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="font-size:0px;padding:10px 2px 10px 13px;word-break:break-word;">
                                                        <div
                                                            style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;">
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Hey
                                                                    {{ $username }},</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Here is a list of
                                                                    documents we need to get your case started:
                                                                </span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                            <ul>
                                                                @foreach ($document_list['main'] as $data)
                                                                    @if ($data['document_status'] == 1)
                                                                        <li style="font-size: 14px; color: green;">
                                                                            {{ $data['document_name'] }}<small>
                                                                                (Uploaded)</small>
                                                                        </li>
                                                                    @else
                                                                        <li style="font-size: 14px; color: red;">
                                                                            {{ $data['document_name'] }}<small> (Not
                                                                                Uploaded)</small>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                &nbsp;</p>
                                                            @if (!empty($document_list['additional']))
                                                                <p
                                                                    style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                    <span style="font-size: 14px;">Additional Documents:
                                                                    </span></p>
                                                                <p
                                                                    style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <ul>
                                                                    @foreach ($document_list['additional'] as $data)
                                                                        @if ($data['document_status'] == 1)
                                                                            <li style="font-size: 14px; color: green;">
                                                                                {{ $data['document_name'] }}<small>
                                                                                    (Uploaded)</small>
                                                                            </li>
                                                                        @else
                                                                            <li style="font-size: 14px; color: red;">
                                                                                {{ $data['document_name'] }}<small> (Not
                                                                                    Uploaded)</small>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                                </p>
                                                                <p
                                                                    style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                    &nbsp;</p>
                                                            @endif
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;">Once you have these
                                                                    documents(infront of you or in electronic form),
                                                                    please setup an appoinment here so we can do most of
                                                                    the work for you:
                                                                </span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                <span style="font-size: 14px;"><u><a
                                                                            style="color: #0000EE;" target="_blank"
                                                                            href="{{ $url }}">{{ $url }}</a></u>
                                                                </span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                                                &nbsp;</p>
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
</body>

</html>
