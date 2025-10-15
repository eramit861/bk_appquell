<div style="margin:0; padding:0;background: #ecf0f1;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ecf0f1"
        style="font-family:Arial; color:#333; line-height:26px;">
        <tbody>
            <tr>
                <td style="background:#0c00aa;padding:30px 0 10px;">
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="text-align:center">
                                    <a href="https://www.bkquestionnaire.com/">
                                        <img src="{{ asset('assets/img/logo-white.png') }}" alt="Logo" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background:#0c00aa;">
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="background:#ffffff;padding:20px 0 10px; text-align:center;">
                                    <h4
                                        style="font-weight:normal; text-transform:uppercase; color:#999;margin:0; padding:10px 0; font-size:18px;">
                                    </h4>
                                    <h2
                                        style="margin:0; color: #999999; font-size:16px; text-transform: uppercase;padding:0;">
                                        Hello Admin</h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td
                                    style="background:#fff;padding:0 20px; text-align:center; color:#999;vertical-align:top;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="padding:0 10px; line-height:1.3; text-align:center; color:#333333;vertical-align:top; font-size: 30px;">
                                                    You received an email from :<span style="font-weight:bold;">
                                                        {{ $name }} </span><br>Below are the details:</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:30px 0; ">
                                                    <table style="width:100%; padding:30px 0;border:1px solid #ddd;">
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>{{ $name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Company Name</th>
                                                            <td>{{ $company }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>{{ $email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone No.</th>
                                                            <td>{{ $phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Message</th>
                                                            <td>{{ $comment }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="height:30px;"></td>
                            </tr>
                            <tr>
                                <td
                                    style="background:rgba(0,0,0,0.04);padding:0 30px; text-align:center; color:#999;vertical-align:top;">
                            </tr>
                            <tr>
                                <td style="padding:0; color:#999;vertical-align:top; line-height:20px;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="padding:20px 0 30px; text-align:center; font-size:13px; color:#999;">
                                                    <br />
                                                    <br /> Copyright © {{ date('Y') }} BK Questionnaire.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0; height:50px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
