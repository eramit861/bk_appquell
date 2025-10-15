<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card p-3">

            <div class="card-block px-0 py-0">
                <form id="add_trustee_form" action="{{route('add_trustee_to_state',$state_code)}}" method="post">
                    @csrf
                    <div class="container">
                        <div class="form-group mt-3">
                            <h4 class="mb-3">Trustee Name</h4>
                            <input type="text"
                                class="form-control" required
                                placeholder="Enter New Trustee Name" name="trustee_name"
                                value="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-theme-black">Save</button>
                        </div>
                    </div>

                </form>
            </div>
            <?php if (!empty($trustee)) { ?>
                <div class="card-block">
                    <h4>List of Divisions</h4>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="95%">Division Name</th>
                            </tr>
                        </thead>
                        <?php $i = 1;
                foreach ($trustee as $data) { ?>
                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['trustee_name']}}</td>
                                </tr>
                            </tbody>

                        <?php $i++;
                } ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<style>
    label.error {
        color: red;
        font-style: italic;
    }

    th {
        border-top: 1px solid #eaeaea;
        border-bottom: 1px solid #eaeaea;
        color: #414141;
    }

    table thead {
        background-color: #EDEEF0;
    }

    table thead th {
        padding: 5px 10px 5px 10px;
    }

    table tbody td {
        padding: 5px 10px 5px 10px;
    }

    table tbody td {
        border-top: 1px solid #eaeaea;
    }

    .id-control {
        padding: 3px 12px;
    }

    #facebox .content.fbminwidth {
        min-width: 550px;
        min-height: 400px;
    }

    .card .card-block,
    .card .card-body {
        padding: 30px 15px;
    }

    .update {
        color: #012cae;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function() {

        $("#add_trustee_form").validate({
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