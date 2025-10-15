@extends('layouts.admin')
@section('content')
    @include('layouts.flash')
    <div class="row">
        <!--[ Recent Users ] start-->
        <div class="col-xl-12 col-md-12">
            <div class="card attorney-listing">
                <div class="card-header">
                    <div class="search-list">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 pl-0">
                                    <h4><?php

                                    use App\Helpers\VideoHelper;

                                    echo VideoHelper::getVideoTypes($selected_media_type); ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex float_right">
                                        <div class="">
                                            <form action="{{ route('admin_webvideos_index') }}" method="GET">
                                                <div class="input-group mb-0">
                                                    <select class="form-control" onchange="this.form.submit()"
                                                        name="media_type">
                                                        <?php echo VideoHelper::getVideoTypesSelection($selected_media_type); ?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="">
                                            <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12"
                                                data-bs-toggle="modal" data-bs-target="#add_company">
                                                <i class="feather icon-plus"></i>
                                                <span class="card-title-text">Add</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th>Section Name</th>
                                    <th>English Video</th>
                                    <th>Spanish Video</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                            $videos = [];
                                    $list = $webvideos->toArray()['data'];

                                    if ($selected_media_type == 'website') {
                                        if (!empty($list)) { ?>
                                <?php foreach ($list as $val) {
                                    if (in_array($val['section'], VideoHelper::getBasicInfoVideos())) {
                                        $videos['A'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getPropertyVodeos())) {
                                        $videos['B'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getDebtVideos())) {
                                        $videos['C'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getIncomeVideos())) {
                                        $videos['D'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getExpenseVideos())) {
                                        $videos['E'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getSofaVideos())) {
                                        $videos['F'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getClientDocumentPageVideos())) {
                                        $videos['G'][] = $val;
                                    }
                                    if (in_array($val['section'], VideoHelper::getVimeoCashAppVideos())) {
                                        $videos['H'][] = $val;
                                    }
                                }

                                        }
                                        ksort($videos);


                                        ?>
                                <?php foreach ($videos as $key => $videos) { ?>
                                <tr class="unread trheading {{ $key }}">
                                    <td colspan="4"><strong><?php echo VideoHelper::getTitleByKey($key); ?></strong></td>
                                </tr>

                                <?php
                                        usort($videos, function ($a, $b) {
                                            return strnatcasecmp($a['section'], $b['section']);
                                        });
                                    foreach ($videos as $val) { ?>
                                <tr class="unread state-<?php echo $val['id']; ?>">
                                    <td><span><?php echo VideoHelper::getAllVideosTypes($val['section']); ?></span></td>
                                    <td>
                                        <?php if (!empty($val['english_video'])) {?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['english_video'], $val['video_type']) }}"><i
                                                    class="fas fa-desktop fa-lg"></i></a></span>
                                        <?php } ?>
                                        <?php if (!empty($val['webview_english_video'])) {?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['webview_english_video'], $val['video_type']) }}"><i
                                                    class="fas fa-mobile fa-lg"></i></a></span>
                                        <?php } ?>


                                    </td>
                                    <td>
                                        <?php if (!empty($val['spanish_video'])) {?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['spanish_video'], $val['video_type']) }}"><i
                                                    class="fas fa-desktop fa-lg"></i></a></span>
                                        <?php } ?>
                                        <?php if (!empty($val['webview_spanish_video'])) {?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['webview_spanish_video'], $val['video_type']) }}"><i
                                                    class="fas fa-mobile fa-lg"></i></a></span>
                                        <?php } ?>

                                    </td>
                                    <td>
                                        <a onclick='editForm("<?php echo route('admin_webvideos_edit', ['id' => $val['id']]); ?>")' href="javascript:void(0)"
                                            class="label theme-bg text-white f-12">Edit</a>
                                        <a href="javascript:void(0)"
                                            onclick='deleteCourthouses("<?php echo route('admin_webvideos_delete', $val['id']); ?>", "<?php echo $val['id']; ?>")'><i
                                                class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title=""
                                                data-original-title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                    } else {

                                        if (!empty($list)) {
                                            $order = array_keys(VideoHelper::getMiscVideosTypes());
                                            usort($list, function ($a, $b) use ($order) {
                                                $pos_a = array_search($a['section'], $order);
                                                $pos_b = array_search($b['section'], $order);

                                                return $pos_a - $pos_b;
                                            });

                                            foreach ($list as $val) { ?>
                                <tr class="unread state-<?php echo $val['id']; ?>">
                                    <td><span><?php echo VideoHelper::getAllVideosTypes($val['section']); ?></span></td>
                                    <td>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['english_video'], $val['video_type']) }}"><?php if ($selected_media_type == 'mobile') { ?><i
                                                    class="fas fa-mobile fa-lg"></i> <?php } else { ?> <i
                                                    class="fas fa-desktop fa-lg"></i><?php } ?></a></span>
                                        <?php if (!empty($val['iphone_english_video'])) { ?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['iphone_english_video'], $val['video_type']) }}"><i
                                                    class="fab fa-apple"></i></a></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($val['spanish_video'])) {?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['spanish_video'], $val['video_type']) }}"><?php if ($selected_media_type == 'mobile') { ?><i
                                                    class="fas fa-mobile fa-lg"></i> <?php } else { ?> <i
                                                    class="fas fa-desktop fa-lg"></i><?php } ?></a></span>
                                        <?php } ?>

                                        <?php if (!empty($val['iphone_spanish_video'])) {?>
                                        <span><a title="click to play" target="_blank"
                                                href="{{ VideoHelper::stopRelativeVideo($val['iphone_spanish_video'], $val['video_type']) }}"><i
                                                    class="fab fa-apple"></i></a></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a onclick='editForm("<?php echo route('admin_webvideos_edit', ['id' => $val['id']]); ?>")' href="javascript:void(0)"
                                            class="label theme-bg text-white f-12">Edit</a>
                                        <a href="javascript:void(0)"
                                            onclick='deleteCourthouses("<?php echo route('admin_webvideos_delete', $val['id']); ?>", "<?php echo $val['id']; ?>")'><i
                                                class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title=""
                                                data-original-title="Delete"></i></a>
                                    </td>
                                </tr>

                                <?php } ?>


                                <?php }
                                        }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination px-2">
                        <?php if (!empty($webvideos)) {?>
                        {{ $webvideos->appends(['q' => $keyword])->links() }}
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!--[ Recent Users ] end-->
    </div>
    @if (session('type') === 'edit' && session('error'))
        
    @else
      @if ($errors->any())
         <script>
               $(document).ready(function() {
                  $("#add_company").modal('show');
               });
         </script>
      @endif
    @endif
    <!-- Modal -->
    @include('modal.admin.manage_videos.add')


    <style>
        label.error {
            color: red;
            font-style: italic;
        }

        .trheading td:hover {
            background: #dfe7ff;
            color: #012cae !important;
        }

        .trheading td {
            color: #012cae !important;
        }

        .trheading {
            background: #dfe7ff;
            color: #012cae !important;
        }

        #facebox {
            top: 70px !important;
        }

        i.fa-desktop,
        i.fa-mobile {
            color: #012cae;
        }

        i.fab.fa-apple {
            color: #012cae;
            font-size: 24px;
            ;
        }

        .btn-theme-black:hover {
            background-color: #000 !important;
            color: #fff !important;
        }

        .btn-default:hover {
            background-color: #f8f9fa !important;
            color: #333 !important;
            border-color: #dee2e6 !important;
        }
    </style>
    <script>
        editForm = function(ajaxurl) {
            laws.ajax(ajaxurl, '', function(response) {
                // Create or update the dynamic modal
                showBootstrapModal(response, 'Edit Video');
            });
        }

        // Function to show Bootstrap modal with dynamic content
        function showBootstrapModal(content) {
            // Remove existing dynamic modal if it exists
            $('#dynamicModal').remove();

            // Create modal HTML with full content (since the edit view is a complete page)
            var modalHtml = `
                <div class="modal fade" id="dynamicModal" role="dialog">
                  ${content}
                </div>
            `;

            // Append modal to body
            $('body').append(modalHtml);

            // Show the modal
            $('#dynamicModal').modal('show');

            // Clean up when modal is hidden
            $('#dynamicModal').on('hidden.bs.modal', function() {
                $(this).remove();
            });
        }
        $(document).ready(function() {
            $("#media_type").val('{{ $selected_media_type }}');
            $("#media_type").trigger('change');
            $("#add_stax").validate({

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

        changeVideoMediaType = function(thisobj) {
            var val = thisobj.value;
            if (val == 'mobile') {
                $(".mobile_types").removeClass('hide-data');
                $(".website_types").addClass('hide-data');
                $(".website_misc_types").addClass('hide-data');
                $(".website_payroll_types").addClass('hide-data');
                $(".website_videolp_types").addClass('hide-data');
                $(".website_attorny_types").addClass('hide-data');
            }
            if (val == 'website') {
                $(".mobile_types").addClass('hide-data');
                $(".website_types").removeClass('hide-data');
                $(".website_misc_types").addClass('hide-data');
                $(".website_videolp_types").addClass('hide-data');
                $(".website_payroll_types").addClass('hide-data');
                $(".website_attorny_types").addClass('hide-data');
            }
            if (val == 'attorney') {
                $(".mobile_types").addClass('hide-data');
                $(".website_types").addClass('hide-data');
                $(".website_misc_types").addClass('hide-data');
                $(".website_payroll_types").addClass('hide-data');
                $(".website_videolp_types").addClass('hide-data');
                $(".website_attorny_types").removeClass('hide-data');
            }
            if (val == 'misc') {
                $(".mobile_types").addClass('hide-data');
                $(".website_types").addClass('hide-data');
                $(".website_attorny_types").addClass('hide-data');
                $(".website_payroll_types").addClass('hide-data');
                $(".website_videolp_types").addClass('hide-data');
                $(".website_misc_types").removeClass('hide-data');
            }
            if (val == 'payroll') {
                $(".mobile_types").addClass('hide-data');
                $(".website_types").addClass('hide-data');
                $(".website_attorny_types").addClass('hide-data');
                $(".website_videolp_types").addClass('hide-data');
                $(".website_payroll_types").removeClass('hide-data');
                $(".website_misc_types").addClass('hide-data');
            }
            if (val == 'videolp') {
                $(".mobile_types").addClass('hide-data');
                $(".website_types").addClass('hide-data');
                $(".website_attorny_types").addClass('hide-data');
                $(".website_videolp_types").removeClass('hide-data');
                $(".website_payroll_types").addClass('hide-data');
                $(".website_misc_types").addClass('hide-data');
            }


        }

        // Function to handle video type selection (URL vs Upload)
        function setVideoType(type) {
            if (type == 1) {
                // URL selected - show URL input fields, hide upload fields
                $('.input-video-file-url').removeClass('hide-data');
                $('.input-video-file-upload').addClass('hide-data');

                // Update radio button state
                $('#video_type_no').prop('checked', true);
                $('#video_type_yes').prop('checked', false);
            } else if (type == 2) {
                // Upload selected - hide URL input fields, show upload fields
                $('.input-video-file-url').addClass('hide-data');
                $('.input-video-file-upload').removeClass('hide-data');

                // Update radio button state
                $('#video_type_no').prop('checked', false);
                $('#video_type_yes').prop('checked', true);
            }
        }

        $(document).ready(function() {
            function toggleVideoFields(mediaType) {
                if (mediaType === 'mobile') {
                    $('.iphone_videos').removeClass('hide-data');
                } else {
                    $('.iphone_videos').addClass('hide-data');
                }
            }

            // When the modal is triggered or page is loaded
            toggleVideoFields("{{ $selected_media_type }}");

            // Add onchange handler for media type select if not already done
            $('select[name="media_type"]').on('change', function() {
                toggleVideoFields($(this).val());
            });

            // Initialize video type selection (default to URL)
            setVideoType(1);
        });
    </script>

    <!-- [ Main Content ] end -->
@endsection
