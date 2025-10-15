<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Schedule of Actual Admins Expenses - Details</h4>
                
            </div>
            <div class="modal-body">
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Judicial District
                                </th>
                                <th>
                                    Multiplier
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
                                <td><span>{{$row['judicial_district']}}</span></td>
                                <td><span>{{$row['multiplier'] * 100}}%</span></td>
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