<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bankruptcy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/font-awesome.min.css') }}">


    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
	<script src="{{ asset('assets/plugins/jquery/js/jquery.min.js' )}}?v=19.1"></script>
	<script src="{{ asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js' )}}"></script>
    <script src="{{ asset('assets/js/facebox.js' )}}"></script>
    <script src="{{ asset('assets/js/jquery.multi-select.js' )}}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}?v=19.2"></script>
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css')}}?v=19.1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
     <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js' )}}?v=19.1"></script>
    <!-- vendor css -->

    <script src="{{ asset('assets/js/jquery.tablednd.js' )}}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}?v=19.13">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}?v=1.6">
    <link rel="stylesheet" href="{{ asset('assets/css/multi-select.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="h-100 admin_side_body">
<style>
       @media screen and (min-width: 1024px) {
  body {
    zoom: 0.75; /* Scales the page to 75% */
  }
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.pcoded-mtext .badge{
    background-color: #012cae;
    color: white!important;
    width: 21px;
    height: 21px;
    line-height: 15px;
    border-radius: 100%;
    /* margin-left: 20px; */
    display:none;
}
.pcoded-mtext .badge.badge_active{
    display:none;
}

.pcoded-navbar .pcoded-inner-navbar li>a {
    text-align: left;
    padding: 3px 0px;
    /* margin: 5px 0 0; */
    display: block;
    border-radius: 0;
    position: relative;
}
.pcoded-navbar .pcoded-inner-navbar li>a>.pcoded-micon {
    font-size: 13px;
    padding: 8px 8px 0px;
    margin-right: 7px;
    border-radius: 4px;
    width: 30px;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    height: 30px;
    text-align: center;
}
li.nav-item.pcoded-menu-caption {
    display: none;
}
.navbar-wrapper {
    height: 100% !important; /* Ensure the wrapper div takes the full height */
    display: flex !important;
    flex-direction: column !important; /* Stack its child elements vertically */
}
.slimScrollDiv{
    height: 100% !important;
}
</style>
    <!-- [ navigation menu ] start -->
    @include("layouts.admin.sidebar")
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    @include("layouts.admin.navbar")
    <!-- [ Header ] end -->
	<!-- [ pcoded-main-container ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                           @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>
    <!-- [ pcoded-main-container ] end -->
	<!-- Required Js -->
    <script src="{{ asset('assets/js/new/dashboard.js') }}?v=19.14"></script>
	<script src="{{ asset('assets/js/custom.js')}}?v=14.10"></script>
    <script src="{{ asset('assets/js/admin.js')}}?v=1.43"></script>


	<script src="{{ asset('assets/js/pcoded.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
       $('.assign-forms').select2({
         placeholder: "Select Forms",
         allowClear: true
        });
   });
   </script>

<script>

    $(document).on('input', ".allow-5digit", function(e) {
        var firstFive = this.value.substring(0, 5);
        var self = $(this);
        self.val(self.val().replace(/\D/g, ""));
        if ((e.which < 48 || e.which > 57)) {
            e.preventDefault();
        }
        if (this.value.length > 5) {
            this.value = firstFive;
        }
    });

    $(document).on("input", ".phone-field", function(evt){

    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
    var first10 = $(this).val().substring(0, 14);
    if (this.value.length > 14) {
        this.value = first10;
    }


    });


   $(document).on("blur", ".price-field", function(evt){
                        evt.target.value = parseFloat(evt.target.value).toFixed(2);
                    });

                    $(document).on('keyup', ".price-field", function(e) {
                        var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode != 35 && charCode != 36 && charCode != 190 && charCode != 37 && charCode != 38 && charCode != 39 && charCode != 40) &&
          (charCode < 48 || charCode > 57))
          e.target.value ='';
    if ( e.target.value <0) {

        e.target.value = '';
        return;
     }
                        var count = 2;
                        if (e.target.value.indexOf('.') == -1  && e.keyCode != 8) {
                            if(e.target.value.length >=7){
                                e.target.value = parseFloat(e.target.value).toFixed(count);
                            }
                            return; }



        if (((e.target.value.length - e.target.value.indexOf('.')) > count)  && e.keyCode != 8) {

            if(e.target.value.length >=7){
                var firstseven = e.target.value.substring(0, 7);
                e.target.value = parseFloat(firstseven).toFixed(count);
            }else{
                e.target.value = parseFloat(e.target.value).toFixed(count);
            }

        }
    });
    $(".price-field").each(function() {
    var count = 2;
    var convertedValue = parseFloat($(this).val()).toFixed(count) ;
    $(this).val( convertedValue ); // 555.00
});
    $(document).ready(function() {
        $('#district_name').on('change', function() {
        var district_id = this.value;
        $("#division_name").html('');
        $("#zip_code_div").html('');
        $("#div_btn").html('');
        $.ajax({
        url:"{{url('admin/get-divisions')}}",
        type: "GET",
        data: {
            district_id: district_id
        },
        dataType : 'json',
        success: function(result){
        $('#division_name').html('<option value="">Select Division</option>');
        $.each(result,function(key,value){
        $("#division_name").append('<option value="'+value.division_name+'">'+value.division_name+'</option>');
        });
        }
        });
        });

        $('#division_name').on('change', function() {
        var division_name = this.value;
        var district_name = $("#district_name").val();
        $("#zip_code_div").html('');
        $("#div_btn").html('');
        $.ajax({
        url:"{{url('admin/get-zip-codes')}}",
        type: "GET",
        data: {
            division_name: division_name, district_id:district_name
        },
        dataType : 'json',
        success: function(result){

        $.each(result,function(key,value){

            $.each(value.zip_code,function(key,value){

                $("#zip_code_div").append('<h2 class="badge badge-success badge-secondary" style="margin-left:3px;">'+value+'</h2>');


         });
        //    $("#zip_code_div").append('<h2 class="badge badge-success badge-secondary">'+value.zip_code+'</h2><br>');
        // $("#zip_code_div").append('<h2 class="badge badge-success badge-secondary">'+value.zip_code+'</h2><br>');

        });

        edit_url = "{{url('admin/zipcode/edit')}}";
        edit_final_url = edit_url+"/"+result[0]["id"];
        delete_url = "{{url('admin/zipcode/delete')}}";
        delete_final_url = delete_url+"/"+result[0]["id"];

        $("#div_btn").append('<a href='+edit_final_url+' class="btn label theme-bg text-white f-12">Edit</a>');
        $("#div_btn").append('<a href="javascript:void(0)" onclick="confirmDeleteZip(this)" id="'+delete_final_url+'" class="btn label theme-bg text-white f-12">Delete</a>');

        }
        });
        });

        confirmDeleteZip = function(objs){
            var url =objs.id;
            if (!confirm(langLbl.confirmDelete)) {
                return;
            }
            window.location = url;
        }

    });

</script>

<!-- Chat SOCKET START -->


<script src="https://cdn.socket.io/4.4.1/socket.io.min.js" integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

               
</body>
</html>
