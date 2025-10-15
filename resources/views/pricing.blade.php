@extends('layouts.landing-page')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v=1.2" />

@include("layouts.common_pricing")

<div class="modal fade" id="video_modal" tabindex="-1" role="dialog"  aria-hidden="true">
   <div class="modal-dialog" role="document">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <div class="modal-content">
            <div class="container absolute-swich-btn">
                <div class="col-md-12 ug english">
                    <div class="card popup-video bg-light">
                        <div class="card-body text-center">
                            <iframe class="embed-responsive-item" id="video"  allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5 phd spanish" style="display: none" >
                    <div class="card bg-primaryp popup-video spanish-desktop-video">
                        <div class="card-body text-center">
                            <iframe id="player1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

<div class="image-outer hide-data">
    <div class="image p-3">
      @include("pricing_table")
    </div>
</div>

<script src="{{ asset('assets/plugins/jquery/js/jquery.min.js' )}}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/facebox.js' )}}"></script>
<script src="{{ asset('assets/js/custom.js')}}?v=11"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>

<script>
    function openFullPricing(url){
        laws.updateFaceboxContent($(".image-outer").html(),'large-fb-width');
    }

    $(function(){
        $('#video_modal').on('hidden.bs.modal', function (e) {
            $iframe = $(this).find("iframe");
            $iframe.attr("src", $iframe.attr("src"));
        });
    });

    function run_tutorial_videos(obj,element){				
        $(element).modal('show');
        var video_src=$(obj).attr('data-video');
        var video_src2=$(obj).attr('data-video2');
        $("#video").attr('src',video_src);
        $("#player1").attr('src',video_src2);
    }
</script>
<style>
    .modal-dialog{
        max-width:900px;
    }
    .modal-content{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #video_modal .card.popup-video .card-body, #sub_video_modal .card.popup-video .card-body {
        padding-top: 56.14% !important;
        position: relative;
    }
    #video_modal .card.popup-video .card-body iframe, #sub_video_modal .card.popup-video .card-body iframe {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
    }
    .pricing .wraper{
  min-height: auto;
}
.pricing #pricing_sec {
    padding: 7% 0 70px 0;
}
</style>
@endsection