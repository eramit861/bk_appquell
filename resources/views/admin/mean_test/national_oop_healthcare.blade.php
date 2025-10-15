<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">National OOP HealthCare - Details</h4>
               
            </div>
            <div class="modal-body">
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Age
                                </th>
                                <th>
                                   Out of Pocket Cost
                                </th>

                                <th>
                                    Update At
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($datalist)) {
                                foreach ($datalist as $key => $row) {
                                    ?>
                            <tr>
                                <td><span>{{$row['Age']}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('Out_of_Pocket_Costs',$row,'comma')}}</span></td>
                                <td><span>{{DateTimeHelper::dbDateToDisplay($row['updated_at'],true)}}</span></td>
                            </tr>

                            <?php
                                }
                            }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination px-2">

                    </div>
                </div>

            </div>
        </div>