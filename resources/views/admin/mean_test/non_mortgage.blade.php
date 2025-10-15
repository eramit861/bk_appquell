<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Non Mortgage - Details</h4>
              
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
                                    County
                                </th>
                                <th>
                                    FIPS Code
                                </th>
                                <th>
                                    One Person Cost
                                </th>
                                <th>
                                    Two Persons Cost
                                </th>
                                <th>
                                    Three Persons Cost
                                </th>
                                <th>
                                    Four Persons Cost
                                </th>
                                <th>
                                    Five Or More Persons Cost
                                </th>
                                <th>
                                    Update At
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($datalist)) {
                                foreach ($datalist as $key => $row) {
                                    if ($row['state'] != 'State Name') {
                                        ?>
                            <tr>
                                <td><span>{{$row['state']}}</span></td>
                                <td><span>{{$row['county']}}</span></td>
                                <td><span>{{$row['FIPS_Code']}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('OnePerson_amount',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('TwoPerson_amount',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('ThreePerson_amount',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('FourPerson_amount',$row,'comma')}}</span></td>
                                <td>$<span>{{Helper::validate_key_value('FiveorMorePerson_amount',$row,'comma')}}</span></td>
                                <td><span>{{$row['updated_at']}}</span></td>
                            </tr>

                            <?php
                                    }
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