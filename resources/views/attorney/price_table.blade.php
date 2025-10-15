@extends('layouts.app')
@section('content')
@include("layouts.flash")


<div class="container">
  <div class="trm-section-class">
  </div>
  <table class="mt-5 table table-hover pricing_tb" style="text-align:center;">
    <thead>
      <tr class="active">
        <th style="background:#fff; border-right: none;">
          <a class="btn download-form" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{$video['en']}}" data-video2="{{$video['sp']}}" style="display: inherit;">
            <img src="{{ asset('assets/img/subscription_video_logo.png') }}" style="height: 36px;display: block;margin: 1px auto;" alt="Video Logo">
          </a>
        </th>

        <th colspan='2' style="background:#fff; border-right: none; border-left: none;">
          <h2 style="color:#aaa;text-align:center !important;font-size:24px;">{{ __('Questionnaires never expire') }}</h2>
        </th>
        <th style="background:#fff; border-left: none; text-align:right;vertical-align: middle;">
          <div style="padding: 8px;">
            Itemized List of Full Features
            <a class="hove" onclick="openFullPricing('<?php echo url('assets/img/Website_List_of_features_image.png'); ?>')">
              <!-- <a href="javascript:void(0)" class="hove" onclick="openProfitForm('<?php echo route('client_profit_loss_popup'); ?>')"> -->
              <img src="{{ asset('assets/images/tip.png')}}" alt="Features">
            </a>
          </div>
        </th>
      </tr>
    </thead>
  </table>

  @include("layouts.common_pricing",['is_price_table' => true])


  <!-- 
  Terms of Service&nbsp;
  <input required class="required" id="agreement" type="checkbox" name="agreed" value="1"  />
  &nbsp;
  <label for="agreement">{{ __("By checking the box, you confirm that you've read and accepted our Terms of Service") }}</label>


                    -->

  <div class="image-outer hide-data">
    <div class="image p-3">
      @include("pricing_table")
    </div>
  </div>
  @include('attorney.subscription_form')

  <script>

    function openFullPricing(url) {
      laws.updateFaceboxContent($(".image-outer").html(), 'large-fb-width');
    }

    function setSubscription(button, packageId, price, name, color) {
      $(".last_row a").removeClass('active_btn');
      if (!$(button).hasClass('active_btn')) {
        $(button).addClass('active_btn');
      }
      $("select[name='no_of_clients']").val(1);
      $(".subscription-form").removeClass("hide-data");
      $("#package_id").val(packageId);
      $("#pprice").text(price);
      $("#pname").text(name);

      $(".selected-price").css('backgroundColor', color);

      $(".total-price").text("$" + price);
      $(".discount-price").text("$0");
      $(".pay-price").text("$" + price);

      $('html,body').animate({
          scrollTop: $("#bottom-form").offset().top
        },
        'slow');
      // $("select[name='no_of_clients']").val(1);
      $("select[name='no_of_clients']").trigger('change');
    }

    function caluclatetotal() {
      var no = 1;
      var price = $("#pprice").text();
      var payprice = price * no;
      var totalprice = price * no;
      var discprice = 0;
      if (no >= 3 && no < 5) {
        totalprice = price * no;
        totalprice = totalprice.toFixed(2);
        payprice = totalprice - (totalprice * (5 / 100));
        payprice = payprice.toFixed(2);
        discprice = (totalprice - payprice);
        discprice = discprice.toFixed(2) + " (5%)";

      }
      if (no >= 5) {
        totalprice = price * no;
        totalprice = totalprice.toFixed(2);
        payprice = totalprice - (totalprice * (10 / 100));
        payprice = payprice.toFixed(2);
        discprice = (totalprice - payprice);
        discprice = discprice.toFixed(2) + " (10%)";
      }
      $(".total-price").text("$" + totalprice);
      $(".discount-price").text("$" + discprice);
      $(".pay-price").text("$" + payprice);
    }

    function run_tutorial_videos(obj, element) {
      var video_src = $(obj).attr('data-video');
      var video_src2 = $(obj).attr('data-video2');
      $("#video").attr('src', video_src);
      $("#player1").attr('src', video_src2);
      $(element).modal('show');
    }
    $(function() {
      $('#BasicSubscription').trigger('click');
    });

    $(document).ready(function() {

      $("#sub_form").validate({

        errorPlacement: function(error, element) {
          if ($(element).parents(".form-group").next('label').hasClass('error')) {

            $(element).parents(".form-group").next('label').remove();
            $(element).parents(".form-group").after($(error)[0].outerHTML);
          } else {

            $(element).parents(".form-group").after($(error)[0].outerHTML);
          }
        },
        success: function(label, element) {
          label.parent().removeClass('error');

          $(element).parents(".form-group").next('label').remove();
        },
      });
    });

  </script>
  @if (isset($package_id) && !empty($package_id))
  <script>
    $(function() {
      $('.package_id_{{ $package_id }}').trigger('click');
    });
  </script>
  @endif
  <style>
    .table td,
    .table th {
      white-space: normal !important;
    }

    center h3 {
      line-height: 1;
      padding-top: 10px;
      padding-bottom: 5px;
    }

    label.error {
      color: red;
      font-style: italic;
    }

    .input-group {
      background: none;
    }

    .container {
      max-width: 1600px;
    }

    .cstm-width-containers {
      max-width: 98% !important;
    }

    .hove {
      cursor: pointer;
    }

    #facebox .content.large-fb-width {
      max-width: 1100px !important;
    }

    /*21  10 21*/
    @media screen and (min-width: 320px) and (max-width: 767px) {
      #video_modal .modal-content {
        width: 98% !important;
      }

      #video_modal .modal-dialog {
        width: 100% !important;
      }

      .text-center.btn-cstm-toggle iframe {
        width: 100% !important;
        height: 190px !important;
      }

      body .upload-documents-wrapper a.btn.shadow-2.mb-4.download-form {
        width: 22%;
        font-size: 13px;
        padding: 10px 0;
      }

      .optional-document a.btn.btn-primary.shadow-2.mb-4 {
        width: 100% !important;
      }

      body .upload-documents-wrapper a.doc-card-main {
        width: 73%;
        float: left;
        white-space: normal;
        word-break: break-word;
      }

      body .upload-documents-wrapper span.doc-type.d-block h4 {
        word-break: break-word;
        width: 74%;
      }
    }

    span.text-gray {
      right: 10px;
    }

    span.text-primary {
      left: 10px;
    }

    span.text-gray,
    span.text-primary {
      position: relative;
      bottom: 22px;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .text-center.btn-cstm-toggle {
      position: absolute;
      top: 11px;
      z-index: 9;
      width: 100%;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    /*TOGGLE END*/

    input[type="radio"] {
      width: 18px;
      height: 18px;
      vertical-align: middle;
      margin: 0 4px;
    }

    .tab-content .download-form {
      right: 280px;
    }

    #video_modal .modal-dialog {
      height: 90%;
      /* = 90% of the .modal-backdrop block = %90 of the screen */
      width: 900px;
    }

    #video_modal .modal-content {
      width: 900px;
    }

    .modal {
      text-align: center;
    }

    input[type=checkbox],
    input[type=radio] {
      font-size: 21px;
    }

    @media screen and (min-width: 768px) {
      #video_modal.modal:before {
        display: inline-block;
        vertical-align: middle;
        content: " ";
        height: 100%;
      }
    }

    #video_modal .modal-dialog {
      max-width: 100%;
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }

    /* style 1 */
    .box {
      margin-top: 2.5rem;
    }

    .inputfile-1+label {
      color: #f1e5e6;
      background-color: #012cae;
    }

    .inputfile-1:focus+label,
    .inputfile-1.has-focus+label,
    .inputfile-1+label:hover {
      background-color: #722040;
    }

    .js .inputfile {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }

    .inputfile+label {
      max-width: 80%;
      font-size: 1.25rem;
      /* 20px */
      font-weight: 700;
      text-overflow: ellipsis;
      white-space: nowrap;
      cursor: pointer;
      display: inline-block;
      overflow: hidden;
      padding: 0.625rem 1.25rem;
      /* 10px 20px */
    }

    .no-js .inputfile+label {
      display: none;
    }

    .inputfile:focus+label,
    .inputfile.has-focus+label {
      outline: 1px dotted #000;
      outline: -webkit-focus-ring-color auto 5px;
    }


    .inputfile+label svg {
      width: 1em;
      height: 1em;
      vertical-align: middle;
      fill: currentColor;
      margin-top: -0.25em;
      /* 4px */
      margin-right: 0.25em;
      /* 4px */
    }

    .inputfile {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }

    .documents-modal .modal-dialog {
      max-width: 630px;
    }

    .documents-modal .modal-body {
      padding: 30px 25px;
    }

    .documents-modal .modal-footer {
      padding: 0.4rem 1rem;
    }

    .subtitle-modal-head {
      font-size: 16px;
      padding-top: 6px;
    }

    #facebox {
      top: 65px;
    }
  </style>

  <div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">{{ __('&times;') }}</span></button>
      <div class="modal-content">
        <div class="container absolute-swich-btn">
          <div class="col-md-12 ug">
            <div class="card bg-light">
              <div class="card-body text-center">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Jfrjeg26Cwk" id="video" allowscriptaccess="always" allow="autoplay" style="width: 100%;height: 390px"></iframe>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-5 phd" style="display: none">
            <div class="card bg-primaryp">
              <div class="card-body text-center">
                <iframe id="player1" style="width: 100%;height: 390px" src="https://www.youtube.com/embed/mtvASE3jjxI" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="modal-body">-->
        <!--  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">{{ __('&times;') }}</span></button> -->
        <!--<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Jfrjeg26Cwk" id="video"  allowscriptaccess="always" allow="autoplay" style="width: 100%;height: 80%"></iframe>-->
        <!-- </div>-->
      </div>
    </div>
  </div>



  @endsection