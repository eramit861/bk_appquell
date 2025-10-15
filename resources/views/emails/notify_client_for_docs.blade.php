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
                                                                <span style="font-size: 14px;">Dear
                                                                    {{ $clientName }},&nbsp;</span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                &nbsp;</p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">You are requested to
                                                                    submit the following documents in order to complete
                                                                    your questionnaire:&nbsp;</span><br>
                                                            </p>

                                                            <p
                                                                style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial;">
                                                            <ul
                                                                style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial; list-style-type: none; ">
                                                                @php
                                                                    $parts = preg_split(
                                                                        '/\n(?=\d+\.)/',
                                                                        $notifyMessage,
                                                                        -1,
                                                                        PREG_SPLIT_NO_EMPTY,
                                                                    );
                                                                    $parts = array_Slice($parts, 1);
                                                                @endphp
                                                                @foreach ($parts as $key => $label)
                                                                    <li>{!! $label !!}</li>
                                                                @endforeach
                                                            </ul>
                                                            </p>

                                                            @php
                                                                $videos = VideoHelper::getAdminVideos();
                                                                $tutorialIphone =
                                                                    $videos[Helper::DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE] ??
                                                                    [];
                                                                $videoiPhone = VideoHelper::getVideos($tutorialIphone);

                                                                $tutorialAndroid =
                                                                    $videos[
                                                                        Helper::DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE
                                                                    ] ?? [];
                                                                $videoAndroid = VideoHelper::getVideos(
                                                                    $tutorialAndroid,
                                                                );

                                                                $tutorialDesktop =
                                                                    $videos[
                                                                        Helper::DOCUMENT_PAGE_DESKTOP_VIDEO_GUIDE
                                                                    ] ?? [];
                                                                $videoDesktop = VideoHelper::getVideos(
                                                                    $tutorialDesktop,
                                                                );
                                                            @endphp

                                                            <p
                                                                style="margin-top:10px;font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">Here is a short video on
                                                                    how to upload the requested documents:</span><br>
                                                            </p>
                                                            <table style="margin-top:5px;">
                                                                <tr>
                                                                    <td align="center"
                                                                        style="padding:0px 15px 15px 15px;word-break:break-word;">
                                                                        <a style="color: #0000EE;" target="_blank"
                                                                            href="{{ $videoiPhone['en'] }}"><img
                                                                                alt="Apple" width="50"
                                                                                src="{{ url('assets/img/iphone.png') }}"><br />Apple</a>
                                                                    </td>
                                                                    <td align="center"
                                                                        style="padding:0px 15px 15px 15px;word-break:break-word;">
                                                                        <a style="color: #0000EE;" target="_blank"
                                                                            href="{{ $videoAndroid['en'] }}"><img
                                                                                alt="Android" width="50"
                                                                                src="{{ url('assets/img/android.png') }}">
                                                                            <br />Android</a></td>
                                                                    <td align="center"
                                                                        style="padding:0px 15px 15px 15px;word-break:break-word;">
                                                                        <a style="color: #0000EE;" target="_blank"
                                                                            href="{{ $videoDesktop['en'] }}"><img
                                                                                alt="Website" width="80"
                                                                                src="{{ url('assets/img/desktop_laptop.png') }}">
                                                                            <br />Website</a></td>
                                                                </tr>
                                                            </table>

                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="color:red;font-size: 14px;">Don't reply to
                                                                    this email, as it is unattended and doesn't accept
                                                                    incoming emails!!!</span><br>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                <span style="font-size: 14px;">For technical assistance,
                                                                    please reach out to BK Questionnaire Support
                                                                    at:</span><br>
                                                                <span style="font-size: 14px;">Phone:
                                                                    <a href="(888)%20356-5777"
                                                                        style="color: #0000EE;">(888) 356-5777</a>
                                                                </span>
                                                            </p>
                                                            <p
                                                                style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">
                                                                &nbsp;</p>
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
