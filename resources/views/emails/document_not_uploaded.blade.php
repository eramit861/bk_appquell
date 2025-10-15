@include("emails.email_common",['logo' => asset('assets/img/client_email.jpeg')])
<div style="margin:0px auto;max-width:600px;"> 
  <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:9px 0px 9px 0px;text-align:center;">
          <div class="mj-column-per-100 outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
              <tbody>
                <tr>
                  <td style="background-color:transparent;border-radius:0px;vertical-align:top;padding:2px 2px 2px 2px;">
                    <!--  -->
                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="" width="100%">
                      <tbody>
                        <tr>
                          <td align="left" style="font-size:0px;padding:10px 2px 10px 13px;word-break:break-word;">
                            <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;">
                              @if ($day == 7)
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">Hey {{$username}},</span>
                                </p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">
                                    Let's get right to it! The NEXT STEP is to provide information about your financial situtaion and assets.
                                  </span>
                                </p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">The Bankruptcy Code requires that you list all of your assets and debts. In order
                                  for us to be able to do this we need your help by uploading the documents requested
                                  on the documents tab of the app/website AND the questionnaire filled out so we can
                                  prepare your case. Please select one of the links below:
                                  </span>
                                </p>
                              @elseif ($day == 10)
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">Hey {{$username}},</span>
                                </p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">Just to let you know, we are serious about helping YOU! We know this is a very stressful time.</span>
                                </p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">We want to help you through this. Please select one of the links below and finish the items 
                                  we need or just shoot us a quick follow up email letting us know if you need help or some more time to get us the information. </span>
                                </p>
                              @elseif ($day == 15)
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">Hey {{$username}},</span>
                                </p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">Would you like me to help you with the paperwork so you can wipe out your debts, stop a lawsuit or garnishment?</span>
                                </p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                                <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">
                                  <span style="font-size: 14px;">We are happy to schedule an appointment to walk you through the paperwork and documents. Just let us know.
                                  </span>
                                </p>
                              @endif
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">
                              If you wish to use the app:
                              </span></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                                  
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify; width: 100%; display: flex; justify-content: center;">
                                <a target="_blank" href="{{ Helper::IOS_APP_URL }}"><img class="w-150px ios_btn" src="{{ asset('assets/img/app-store.png') }}" alt="ios" /></a>
                                {!! '&nbsp;&nbsp;' !!}
                                <a target="_blank" href="{{ Helper::ANDROID_APP_URL }}"><img  class="w-150px android_btn ml-3" src="{{ asset('assets/img/play-store.png') }}" alt="android" /></a>
                              </p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">If you wish to use the website version: <u><a style="color: #0000EE;" target="_blank" href="https://www.bkquestionnaire.com/client/login">https://www.bkquestionnaire.com/client/login</a></u>
                              </span></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">Before you start the questionnaire here is a short video to make the process as short &
                              easy for you as possible.
                              </span></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>

                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify; width: 100%; display: flex; justify-content: center;">
                              @php
                              $videos = VideoHelper::getAdminVideos();
                              $mainTutorial = $videos[Helper::MAIN_DOCUMENT_TUTORIAL_VIDEO] ?? [];
                              @endphp
                                <a target="_blank" href="{{$mainTutorial['english_video']}}" style="color: #0000EE;"><img  class="w-150px android_btn ml-3" src="{{ asset('assets/img/mobile_video.png') }}" alt="document_video" /></a>
                              </p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;"><strong><u>The app version reads your uploaded documents and import most of the required information from your
                              docs into the questionnaire for you.</u></strong> This will save you a lot of data entry time.
                              Give us a call if you have any questions along the way.
                              </span></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">If you have any question about your bankruptcy case</span><strong><span style="font-size: 14px;"> </span></strong><span style="font-size: 14px;">please contact your attorney{!! '&nbsp;' !!}</span></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;">{!! '&nbsp;' !!}</p>
                              @php
                                $attorney = $attorney->toArray();
                              $attorney_phone = substr($attorney['phone_no'], 0, 3).'-'.substr($attorney['phone_no'], 3, 3).'-'.substr($attorney['phone_no'], 6);
                              $attorney_company = $attorney_company->toArray();
                              @endphp
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">Attorney: </span><strong><span style="font-size: 14px;">{{$attorney_company['company_name']}}</span></strong></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">Phone: </span><strong><span style="font-size: 14px;"><a target="_blank" style="color: #0000EE;" href="tel:{{$attorney_company['attorney_phone']}}">{{$attorney_company['attorney_phone']}}</a></span></strong></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: justify;"><span style="font-size: 14px;">Email: </span><strong><span style="font-size: 14px;"><a target="_blank" style="color: #0000EE;" href="mailto:{{$attorney['email']}}">{{$attorney['email']}}</a></span></strong></p>
                              <p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial;">{!! '&nbsp;' !!}</p>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td align="center" vertical-align="middle" style="font-size:0px;padding:5px 20px 5px 20px;word-break:break-word;">
                            <p style="font-size: 14px; font-family: Ubuntu, Helvetica, Arial; text-align: center;"><span>If you prefer not to receive emails like this, you may</span> <a
                              href="" style="font-size: 14px;text-decoration: underline;font-weight: 600; color: #0560FD;">unsubcribe</a>
                            </p>
                            <p style="font-size: 14px;margin-top: 4px">Copyright © {{date('Y')}} BK Assistant</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--  -->
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