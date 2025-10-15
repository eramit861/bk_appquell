<div class="row">
    <div class="col-md-12">
        <div class="navbar-collapse navbar-border-shaddow d-flex mt-3 p-3">
            <div class="language-select">
                <div id="google_translate_element"></div>
            </div>

             <ul class="navbar-nav ml-auto align_a_video">
                <li>
                    <div class="dropdown drp-user">
                    <a href="javascript:void(0)" class="download-forms close-modal text-black" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="<?php echo $video['en']; ?>" data-video2="<?php echo $video['sp']; ?>">
                       <img src="{{ asset('assets/img/video_logo1.png') }}" alt="Logo" style="height: 35px;">
                    </a>
                    </div>
                </li>
            </ul> 

            <?php
                $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', Auth::user()->id)->first();
                    $attorney_company = !empty($attorney_company) ? $attorney_company : [];
                    $company_logo = (isset($attorney_company) && !empty($attorney_company['company_logo'])) ? $attorney_company['company_logo'] : '';
                    ?>
            <ul class="navbar-nav w-100">
          
               
                <li>
              
                    <div class="float-right">
                    
                       <a class="black-border text-black blue-btn" href="<?php echo route('attorney_logout');?>"><i class="icon feather icon-user"></i>&nbsp;Logout</a>
                            <?php if (!empty($company_logo) && file_exists(public_path().'/'.$company_logo)) { ?>
                            <img src="{{url($company_logo)}}" alt="Logo" class="ml-2 avtar-img" />
                        <?php } else { ?>
                            <img src="{{ asset('assets/img/avtar.png')}}" alt="Logo" class="ml-2 avtar-img" />
                        <?php } ?>
                        <span class="online-indicator"></span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>