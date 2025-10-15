<div class="row">
    <div class="col-12">
        <h3 class="mb-0 text-center text-c-green bradly-heading">How to Easily upload Documents using Our App or Website
        </h3>
        <p class="text-center">(click on the video below to see how to upload your docs using the apps or website)</p>
        <div class="row">
            <div class="col-md-12 text-center">
                @php
                    $videos = VideoHelper::getAdminVideos();
                    $tutorialIphone = $videos[Helper::DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE] ?? [];
                    $videoiPhone = VideoHelper::getVideos($tutorialIphone);

                    $tutorialAndroid = $videos[Helper::DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE] ?? [];
                    $videoAndroid = VideoHelper::getVideos($tutorialAndroid);

                    $tutorialDesktop = $videos[Helper::DOCUMENT_PAGE_DESKTOP_VIDEO_GUIDE] ?? [];
                    $videoDesktop = VideoHelper::getVideos($tutorialDesktop);
                @endphp
                <div style="width:150px;display:inline-block;">
                    <a id="videoanchor" href="javascript:void(0)" data-bs-toggle="modal"
                        onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video"
                        data-video="{{ $videoiPhone['en'] }}" data-video2="{{ $videoiPhone['sp'] }}">
                        <img src="{{ url('assets/img/iphone.png') }}" width="100px" alt="Apple"><br>
                        <span>Apple</span>
                    </a>
                </div>
                <div style="width:150px;display:inline-block;">
                    <a id="videoanchor" href="javascript:void(0)" data-bs-toggle="modal"
                        onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video"
                        data-video="{{ $videoAndroid['en'] }}" data-video2="{{ $videoAndroid['sp'] }}">
                        <img src="{{ url('assets/img/android.png') }}" width="100px" alt="Android"><br>
                        <span>Android</span>
                    </a>
                </div>
                <div style="width:150px;display:inline-block;">
                    <a id="videoanchor" href="javascript:void(0)" data-bs-toggle="modal"
                        onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video"
                        data-video="{{ $videoDesktop['en'] }}" data-video2="{{ $videoDesktop['sp'] }}">
                        <img src="{{ url('assets/img/desktop_laptop.png') }}" width="160px"
                            alt="Website"><br><span>Website</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="hide-data document-guide-popup">
            <p>
                Here are <span class=" text-c-blue text-bold">Quick Tips</span> to get required documents very quickly
                with very little hassle:
            </p>
            <p>
                <span class="text-bold">iPhone:</span> In order to share a document on any iPhone open the document you
                wish to share select the <img style="width: 13px;" src="{{ asset('assets/img/share_iphone.png') }}"
                    alt="img" /> button this will be on the top right corner
                of your phone or the bottom left part of the screen depending on what size phone you have. This will
                allow you to email the document, to yourself
                or anybody else. You can email these documents to yourself and then upload them into the system.
            </p>
            <p>
                <span class="text-bold">Android:</span> In order to make this easy go to the google play store download
                pdf reader
                <a href="https://play.google.com/store/apps/details?id=com.pdf.reader.pdfviewer.pdfbookreader.readpdf&hl=en_US"
                    target="_blank">
                    <img style="width: 18px;" src="{{ asset('assets/img/pdf_reader.png') }}" alt="PDF Reader" />
                </a> its free. This allows you to share any PDF easily.
                Once you have downloaded this app. In the top right corner of any document, you open it. This icon will
                appear <img style="width: 18px;" src="{{ asset('assets/img/share_corner.png') }}" alt="img" />,
                this allows you to
                email these document to yourself or anybody else. You can email these documents to yourself and then
                upload them into the system.
            </p>
            <p class="mb-2"><span class="text-bold border-bottom-light-blue ">Pay Stubs:</span></p>
            <p>
                Around 83% of employers give employees online access to their pay stubs and benefits. We recommend
                downloading your pay stubs
                from your employee portal and uploading them into the website or app. You will need your last 7 months
                of pay stubs.
            </p>
            <p class="mb-2"><span class="text-bold border-bottom-light-blue ">Tax Returns:</span></p>
            <p class="mb-2">
                <span class="text-bold">Online Access:</span> Tax returns can be accessed easily in two ways. The first
                is if you used an online tax company such as H&R Block, Turbo Tax,
                Jackson Hewitt etc. you can simply log into your account and download your returns, then upload them
                onto the documents page.
            </p>
            <p>
                <span class="text-bold">Tax Preparer:</span> This is the 2nd way. You can simply email and/or call and
                ask them to email you your tax returns. They must keep copies of your returns for 8 years
                in electronic form. They generally are required to do this for free. You can find how this was on page 2
                of your federal 1040 tax return.
                This is quicker than printing them out and scanning them in.
            </p>
            <p class="mb-2"><span class="text-bold border-bottom-light-blue ">Auto Loan & Mortgage Statements:</span>
            </p>
            <p>
                Its best if you log into your mortgage and/or auto loan accounts and download a copy of your most recent
                statement, then upload that into your
                document portal. You can also screen shot the screen that shows your balance, payment amount and account
                # and upload that IF you can't
                find and/or get a statement.
            </p>
            <p class="mb-2"><span class="text-bold border-bottom-light-blue ">Bank Statements:</span></p>
            <p>
                If you have online access, you can simply log into your bank account go to your documents and/or
                statements page once logged into your bank
                you can then download and upload the statements into the document portal. This is quicker than printing
                them out and scanning them in.
            </p>
            <p class="mb-2"><span class="text-bold border-bottom-light-blue ">Cash App:</span></p>
            <p class="mb-2">
                <span class="text-bold">Website:</span> Select documents on the left side of your screen, Then select
                Account statements. You can then simply download each statement in PDF.
            </p>
            <p>
                <span class="text-bold">On App:</span> On the top right corner tap the profile picture, then scroll down
                and tap documents, then tap account statements. You can then simply download each statement in PDF.
            </p>
            <p class="mb-2"><span class="text-bold border-bottom-light-blue ">Venmo:</span></p>
            <p class="mb-2">
                <span class="text-bold">Go to Transactions:</span> View your transaction history on the Venmo website.
                You can also download your transaction history as a CSV file by clicking the “Download CSV” button next
                to the "View" button.
                Or you can screenshot the last 3 months of history and upload that into the document portal.
            </p>
            <p>
                <span class="text-bold">PayPal:</span> To view and download your monthly statements on the web:
            </p>
            <p class="pt-3 text-secondary text-center">
                Most if not ALL of the documents needed for your bankruptcy case will be sent over to the Court. So its
                important they are very clear and legible<br>
                <span class="text-c-blue">If you don't have a professional scanner you can download one of our free apps
                    to scan in all of your
                    documents.</span><br>
                Simply go to your app store and type in: <span class="text-c-blue">BK Questionnaire</span>
            </p>
            <div class="questionnaire-logo text-center">
                <a target="_blank" href="{{ Helper::IOS_APP_URL }}">
                    <img width="150" src="{{ url('assets/img/app-store.png') }}" alt="App Store">
                </a>
                <a target="_blank" href="{{ Helper::ANDROID_APP_URL }}">
                    <img width="150" src="{{ url('assets/img/play-store.png') }}" alt="Play Store">
                </a>
            </div>
        </div>

        <p class="text-center mt-3">The documents you haven't uploaded will start out as:
            <span class="font-weight-bold text-c-light-blue">LIGHT BLUE</span>, when you upload a document it will turn
            <span class="font-weight-bold color-yellow">DARK BLUE</span>, when the document is accepted by the law firm
            it
            will turn
            <span class="font-weight-bold color-green">GREEN</span>, if its rejected by the law firm it will turn
            <span class="font-weight-bold color-red">RED.</span>
        </p>
    </div>
</div>
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/doc_upload_layout.css') }}">
@endpush
@push('tab_scripts')
    <script src="{{ asset('assets/js/doc_upload_layout.js') }}"></script>
@endpush