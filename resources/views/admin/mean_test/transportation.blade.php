<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transportation Expense Standards - Details</h4>
               
            </div>
            <div class="modal-body">
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Region
                                </th>
                                <th>
                                    One Car Amount
                                </th>
                                <th>
                                    Two Car Amount
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
                                    <td><span>{{$row['region']}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('one_car_cost',$row,'comma')}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('two_car_cost',$row,'comma')}}</span></td>
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