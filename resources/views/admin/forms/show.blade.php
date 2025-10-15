@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
            <div class="card-header">
                <div class="search-list">
                    <div class="col-md-12">
                        <form action="{{route('admin_forms_index')}}" method="GET">
                            <div class="row">   
                                <div class="col-md-4">
                                    <h4>Forms</h4>
                                </div>
                                <?php $groups = []; ?>
                                <div class="col-md-8"> 
                                    <div class="d-flex float_right">
                                        <div class="input-group mb-0 width_fit_content">
                                            <select class="form-control " onchange="this.form.submit()" name="district" >
                                            <?php foreach ($district_names as $thisdistrict) {

                                                if (!in_array($thisdistrict->short_name, $groups)) {?>
                                            <optgroup label="{{$thisdistrict->short_name}}"></optgroup><?php array_push($groups, $thisdistrict->short_name); ?><?php } ?>
                                            <option <?php if ($district == $thisdistrict->id) {
                                                echo "selected";
                                            } ?> value="{{$thisdistrict->id}}">{{$thisdistrict->district_name}}</option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="">
                                            <a href="{{route('admin_forms_create')}}" class="m-l-30 btn font-weight-bold border-blue f-12 mr-0">
                                                <i class="feather icon-plus"></i>
                                                <span class="card-title-text">Add</span>
                                            </a>
                                        </div>
                                        <div class="">
                                            <a href="javascript:void(0)" onclick="openAdditionalFormPopup()" class="m-l-30 btn font-weight-bold border-blue f-12">
                                                <span class="card-title-text">Additional form url</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-block px-0 py-0">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Form Name
                                </th>
                                <th>
                                    Form Type
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (!$forms->isEmpty())
                            @foreach ($forms as $form)
                            <tr class="unread">
                                <td><span>{{$form->form_name}}</span></td>
                                <td>
                                    <span>{{$form->type}} <?php if ($form->type == 'local') {
                                        echo "(Chapter-".$form->chapter_type.')';
                                    } if ($form->is_uppliment == 1) {
                                        echo " - Supplimental";
                                    }?></span>
                                </td>
                                <td>
                                    <a href="{{route('admin_forms_edit',$form->form_id)}}"
                                        class="label theme-bg text-white f-12">Edit</a>
                                    <a href="javascript:void(0)" onclick="confirmDeleteForm(this)" id="{{route('admin_forms_delete',$form->form_id)}}"  >
                                        <i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    <h3>No forms registered yet.</h3>
                                </td>
                            </tr>
                            @endif

                         
                        </tbody>


                    </table>
                </div>
               


            </div>
        </div>
    </div>
    <!--[ Recent Users ] end-->

</div>
<style>
    #facebox .content.fbminwidth {
min-width: 550px;
min-height: 150px;
}

    </style>
<script>
      confirmDeleteForm = function(objs){
            var url =objs.id;
            if (!confirm(langLbl.confirmDelete)) {
                return;
            }
            window.location = url;
        }

        openAdditionalFormPopup = function(){
            
            var district = "<?php echo $district; ?>";
			ajaxurl = "<?php echo route('openAdditionalFormPopup'); ?>";
			laws.ajax(ajaxurl, {
				district_id: district
			}, function(response) {
				laws.updateFaceboxContent(response, 'large-fb-width');
			});
        }
    </script>
<!-- [ Main Content ] end -->
@endsection
