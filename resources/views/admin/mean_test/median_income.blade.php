<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Median Income - Details</h4>
               
            </div>
            <div class="modal-body">
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    State
                                </th>
                                <th>
                                    One Person Amount
                                </th>
                                <th>
                                    Two Person Amount
                                </th>
                                <th>
                                    Three Person Amount
                                </th>
                                <th>
                                    Four Person Amount
                                </th>
                                <th>
                                    Additional Amount Per Person
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
                                    <td><span>{{$row['state']}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('one_earner',$row,'comma')}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('two_person',$row,'comma')}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('three_person',$row,'comma')}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('four_person',$row,'comma')}}</span></td>
                                    <td>$<span>{{Helper::validate_key_value('additional_person_amount',$row,'comma')}}</span></td>
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