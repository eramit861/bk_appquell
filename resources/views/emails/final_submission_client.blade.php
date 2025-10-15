@include('emails.email_common', ['logo' => asset('assets/img/client_email.jpeg')])

<div style="margin:0px auto;max-width:600px;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:9px 0px 9px 0px;text-align:center;">
                    <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               class="" style="vertical-align:top;width:600px;"
            >
          <![endif]-->

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
                                                                Great News {{ $user->name }},{!! '&nbsp;' !!}
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Your attorney has received your submitted questionnaire.
                                                                They are going to start preparing your case to file.
                                                                Your attorney will reach out to you
                                                                shortly.<br>{!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                If you have any question about your bankruptcy case
                                                                please contact your attorney</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Attorney: <b>{{ $attorney_company->company_name }}</b>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Phone: <b><a target="_blank" style="color: #0000EE;"
                                                                        href="tel:{{ $attorney_company->attorney_phone }}">{{ $attorney_company->attorney_phone }}</a></b>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Email: <b><a target="_blank" style="color: #0000EE;"
                                                                        href="mailto:{{ $attorney->email }}">{{ $attorney->email }}</a></b>
                                                            </p><br>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                If you have any{!! '&nbsp;' !!} technical
                                                                questions or concerns you may reach us at:<br>Phone:
                                                                <span style="color: #0000EE;"><a target="_blank"
                                                                        style="color: #0000EE;"
                                                                        href="tel:1-888-356-5777">(888)
                                                                        356-5777</a></span></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                Email: <a href="mailto:info@bkassistant.net"
                                                                    style="color: #0000EE;">info@bkassistant.net</a></p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                {!! '&nbsp;' !!}</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;text-align:center;">
                                                                If you prefer not to receive emails like this, you may<a
                                                                    href="http://unsubscribe.com/"
                                                                    style="color: #0000EE;">
                                                                    unsubscribe</a><br>Copyright © {{ date('Y') }}
                                                                BK Assistant</p>
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

                    <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
                </td>
            </tr>
        </tbody>
    </table>

</div>


<!--[if mso | IE]>
          </td>
        </tr>
      </table>
      <![endif]-->


</div>



</body>

</html>
