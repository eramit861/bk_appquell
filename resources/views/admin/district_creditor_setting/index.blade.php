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
                        <div class="row">
                            <div class="col-md-6 pl-0">
                                <h4>Creditor Matrix Settings</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="float_right">
                                    <a href="{{route('district_crediter_setting_create')}}" class="m-l-30 btn font-weight-bold border-blue f-12">
                                        <i class="feather icon-plus"></i>
                                        <span class="card-title-text">Add</span>
                                    </a>
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
                                <th>
                                    #
                                </th>
                                <th>
                                    District ID
                                </th>
                                <th>
                                    Text Content
                                </th>
                                <th>
                                    Text Align
                                </th>
                                <th>
                                Line Spacing
                                </th>
                                <th>
                                Font Size
                                </th>
                                <th>
                                Font Style
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (!$settings->isEmpty())
                                @foreach ($settings as $key => $setting)
                                <tr class="unread">
                                    <td><span>{{($key+1)}}</span></td>
                                    <td><span>{{$setting->district->district_name}}</span></td>
                                    <td>
                                        <span>{{ucfirst($setting->text_content_field)}}</span>
                                    </td>
                                    <td>
                                        <span>{{ucfirst($setting->text_align_field)}}</span>
                                    </td>
                                    <td>
                                        <span><?php echo ArrayHelper::getSpacingTypeArray($setting->text_spacing); ?></span>
                                    </td>
                                    <td>
                                        <span><?php echo ArrayHelper::getFontSizeArray($setting->font_size); ?></span>
                                    </td>
                                    <td>
                                        <span><?php echo ArrayHelper::getFontStyleArray($setting->text_capitalize); ?></span>
                                    </td>
                                    <td>
                                        <a href="{{route('district_crediter_setting_edit',$setting->id)}}"
                                            class="label theme-bg text-white f-12">Edit</a>
                                        <a href="javascript:void(0)" onclick="confirmDeleteForm(this)" id="{{route('district_crediter_setting_delete',$setting->id)}}"  >
                                            <i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td>
                                    <h3>No settings registered yet.</h3>
                                </td>
                            </tr>
                            @endif
                            {{$settings->links()}}
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--[ Recent Users ] end-->

</div>
<script>
    confirmDeleteForm = function(objs){
        var url =objs.id;
        if (!confirm(langLbl.confirmDelete)) {
            return;
        }
        window.location = url;
    }
</script>
@endsection