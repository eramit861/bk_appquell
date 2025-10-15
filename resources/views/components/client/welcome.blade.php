<div id="welcome" class="hide-data">
   <div class="row no-border-elements mt-3">
      <div class="col-md-12 align-center">
         <div class="col-md-12 title-h mt-1">
            <h4><strong>Welcome, {{ auth()->user()->name }} to your Online Bankruptcy Questionnaire </strong></h4>
         </div>
         <div class="col-md-12 mt-3">
            <iframe frameBorder="0" class="mt-1" width="100%" height="400"
               src="">
            </iframe>
         </div>
         <div class="col-md-12 align-left mt-3">
            <p class="mt-3">Please watch the welcome video then download our app. It is best if you gather the documents required first as the APP will read your documents and fill out the questionnaire in all the relevant portions for you from the information in your documents. This will make the data entry on your end minimal and will get you through the process very quickly. If you have any questions and/or concerns, just ask the law firm in the chat portion of the APP once downloaded and signed in. </p>
         </div>
      </div>
      <div class="col-md-12 page-flex__right">
         <div class="page-footer -align-center">
            <div class="btn-download">
               <span class="btn-download__code"><img src="{{ asset('assets/images/apple-qr-code.png')}}" alt="Apple QR"></span>
               <a href="https://play.google.com/store/apps/details?id=com.thegrizzlylabs.geniusscan.free&hl=en_IN&gl=US" target="_blank" class="btn-download__link"><img src="{{ asset('assets/images/google-play-badge.svg')}}" alt="Play Store Badge"></a>
            </div>
            <div class="btn-download">
               <span class="btn-download__code"><img src="{{ asset('assets/images/android-qr-code.png')}}" alt="Android QR"></span>
               <a href="https://apps.apple.com/us/app/scanner-pro-document-scanning/id333710667" target="_blank" class="btn-download__link"><img src="{{ asset('assets/images/app_store_badge.svg')}}" alt="App Store Badge"></a>
            </div>
         </div>
      </div>
   </div>
</div>


