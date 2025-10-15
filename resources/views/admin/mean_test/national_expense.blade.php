<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">National Expense - Details</h4>
               
            </div>
            <div class="modal-body">
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Expense Type
                                </th>
                                <th>
                                    One Person Cost
                                </th>
                                <th>
                                    Two Person Cost
                                </th>
                                <th>
                                    Three Person Cost
                                </th>
                                <th>
                                    Four Person Cost
                                </th>
                                <th>
                                    Additional Person Cost
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
                                <td><span>{{$row['Expense_Type']}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('OnePersonCost',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('TwoPersonCost',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('ThreePersonCost',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('FourPersonCost',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('AdditionalPersonCost',$row,'comma')}}</span></td>
                                <td><span>{{DateTimeHelper::dbDateToDisplay($row['updated_at'])}}</span></td>
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