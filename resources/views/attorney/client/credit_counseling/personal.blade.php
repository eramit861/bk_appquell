<div class="row g-3">
    <!-- User Credentials + Course Information Section -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-primary text-white">
                User Credentials & Course Information
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="ReqUser" class="form-label">ReqUser</label>
                        <input type="text" class="form-control" id="ReqUser" name="clientRecordData[ReqUser]" value="{{ Helper::validate_key_value('ReqUser', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ReqPass" class="form-label">ReqPass</label>
                        <input type="password" class="form-control" id="ReqPass" name="clientRecordData[ReqPass]" value="{{ Helper::validate_key_value('ReqPass', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="UserName" class="form-label">UserName</label>
                        <input type="text" class="form-control" id="UserName" name="clientRecordData[UserName]" value="{{ Helper::validate_key_value('UserName', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CourseType" class="form-label">CourseType</label>
                        <input type="text" class="form-control required" id="CourseType" name="clientRecordData[CourseType]" value="{{ Helper::validate_key_value('CourseType', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ClassType" class="form-label">ClassType</label>
                        <input type="text" class="form-control" id="ClassType" name="clientRecordData[ClassType]" value="{{ Helper::validate_key_value('ClassType', $clientRecordData, 'radio') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MarriedCourse" class="form-label">MarriedCourse</label>
                        <input type="text" class="form-control required" id="MarriedCourse" name="clientRecordData[MarriedCourse]" value="{{ Helper::validate_key_value('MarriedCourse', $clientRecordData) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Information Section -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-primary text-white">
                Personal Information
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="FirstName" class="form-label">FirstName</label>
                        <input type="text" class="form-control required" id="FirstName" name="clientRecordData[FirstName]" value="{{ Helper::validate_key_value('FirstName', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MiddleInit" class="form-label">MiddleInit</label>
                        <input type="text" class="form-control" id="MiddleInit" name="clientRecordData[MiddleInit]" value="{{ Helper::validate_key_value('MiddleInit', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="LastName" class="form-label">LastName</label>
                        <input type="text" class="form-control required" id="LastName" name="clientRecordData[LastName]" value="{{ Helper::validate_key_value('LastName', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Suffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="Suffix" name="clientRecordData[Suffix]" value="{{ Helper::validate_key_value('Suffix', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="EMail" class="form-label">EMail</label>
                        <input type="email" class="form-control required" id="EMail" name="clientRecordData[EMail]" value="{{ Helper::validate_key_value('EMail', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="DOB" class="form-label">DOB</label>
                        <input type="text" class="form-control required" id="DOB" name="clientRecordData[DOB]" value="{{ Helper::validate_key_value('DOB', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="SSN" class="form-label">SSN</label>
                        <input type="text" class="form-control required" id="SSN" name="clientRecordData[SSN]" value="{{ Helper::validate_key_value('SSN', $clientRecordData) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($clientType == 3)
    <!-- Spouse Information Section -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-primary text-white">
                Spouse Information
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="FirstNameSpouse" class="form-label">FirstNameSpouse</label>
                        <input type="text" class="form-control required" id="FirstNameSpouse" name="clientRecordData[FirstNameSpouse]" value="{{ Helper::validate_key_value('FirstNameSpouse', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MiddleInitSpouse" class="form-label">MiddleInitSpouse</label>
                        <input type="text" class="form-control" id="MiddleInitSpouse" name="clientRecordData[MiddleInitSpouse]" value="{{ Helper::validate_key_value('MiddleInitSpouse', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="LastNameSpouse" class="form-label">LastNameSpouse</label>
                        <input type="text" class="form-control required" id="LastNameSpouse" name="clientRecordData[LastNameSpouse]" value="{{ Helper::validate_key_value('LastNameSpouse', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="SuffixSpouse" class="form-label">SuffixSpouse</label>
                        <input type="text" class="form-control" id="SuffixSpouse" name="clientRecordData[SuffixSpouse]" value="{{ Helper::validate_key_value('SuffixSpouse', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="DOBSpouse" class="form-label">DOBSpouse</label>
                        <input type="text" class="form-control required" id="DOBSpouse" name="clientRecordData[DOBSpouse]" value="{{ Helper::validate_key_value('DOBSpouse', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="SSNSpouse" class="form-label">SSNSpouse</label>
                        <input type="text" class="form-control required" id="SSNSpouse" name="clientRecordData[SSNSpouse]" value="{{ Helper::validate_key_value('SSNSpouse', $clientRecordData) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Address + Contact Information Section -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-primary text-white">
                Address & Contact Information
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-3 mb-3">
                        <label for="Address1" class="form-label">Address</label>
                        <input type="text" class="form-control required" id="Address1" name="clientRecordData[Address1]" value="{{ Helper::validate_key_value('Address1', $clientRecordData) }}">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="Address2" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="Address2" name="clientRecordData[Address2]" value="{{ Helper::validate_key_value('Address2', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="City" class="form-label">City</label>
                        <input type="text" class="form-control required" id="City" name="clientRecordData[City]" value="{{ Helper::validate_key_value('City', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="State" class="form-label">State</label>
                        <input type="text" class="form-control required" id="State" name="clientRecordData[State]" value="{{ Helper::validate_key_value('State', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Zip" class="form-label">Zip</label>
                        <input type="text" class="form-control required" id="Zip" name="clientRecordData[Zip]" value="{{ Helper::validate_key_value('Zip', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="County" class="form-label">County</label>
                        <input type="text" class="form-control" id="County" name="clientRecordData[County]" value="{{ Helper::validate_key_value('County', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="FState" class="form-label">FState</label>
                        <input type="text" class="form-control" id="FState" name="clientRecordData[FState]" value="{{ Helper::validate_key_value('FState', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="HomePhone" class="form-label">HomePhone</label>
                        <input type="text" class="form-control" id="HomePhone" name="clientRecordData[HomePhone]" value="{{ Helper::validate_key_value('HomePhone', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CellPhone" class="form-label">CellPhone</label>
                        <input type="text" class="form-control" id="CellPhone" name="clientRecordData[CellPhone]" value="{{ Helper::validate_key_value('CellPhone', $clientRecordData) }}">
                    </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Attorney + System Information Section -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-primary text-white">
                Attorney & System Information
            </div>
            <div class="card-body pb-0">
                @php $AccessCode = Helper::validate_key_value('AccessCode', $clientRecordData); @endphp
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="AttorneyName" class="form-label">AttorneyName</label>
                        <input type="text" class="form-control {{ empty($AccessCode) ? 'required' : '' }}" id="AttorneyName" name="clientRecordData[AttorneyName]" value="{{ Helper::validate_key_value('AttorneyName', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AttorneyPhone" class="form-label">AttorneyPhone</label>
                        <input type="text" class="form-control {{ empty($AccessCode) ? 'required' : '' }}" id="AttorneyPhone" name="clientRecordData[AttorneyPhone]" value="{{ Helper::validate_key_value('AttorneyPhone', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AccessCode" class="form-label">AccessCode</label>
                        <input type="text" class="form-control {{ empty($AccessCode) ? '' : 'required' }}" id="AccessCode" name="clientRecordData[AccessCode]" value="{{ Helper::validate_key_value('AccessCode', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="District" class="form-label">District</label>
                        <input type="text" class="form-control" id="District" name="clientRecordData[District]" value="{{ Helper::validate_key_value('District', $clientRecordData, 'radio') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AttorneyEmail" class="form-label">AttorneyEmail</label>
                        <input type="text" class="form-control {{ empty($AccessCode) ? 'required' : '' }}" id="AttorneyEmail" name="clientRecordData[AttorneyEmail]" value="{{ Helper::validate_key_value('AttorneyEmail', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="BCase" class="form-label">BCase</label>
                        <input type="text" class="form-control" id="BCase" name="clientRecordData[BCase]" value="{{ Helper::validate_key_value('BCase', $clientRecordData) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AutoRegID" class="form-label">AutoRegID</label>
                        <input type="text" class="form-control" id="AutoRegID" name="clientRecordData[AutoRegID]" value="{{ Helper::validate_key_value('AutoRegID', $clientRecordData, 'radio') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CustID" class="form-label">CustID</label>
                        <input type="text" class="form-control" id="CustID" name="clientRecordData[CustID]" value="{{ Helper::validate_key_value('CustID', $clientRecordData, 'radio') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="SpCustID" class="form-label">SpCustID</label>
                        <input type="text" class="form-control" id="SpCustID" name="clientRecordData[SpCustID]" value="{{ Helper::validate_key_value('SpCustID', $clientRecordData, 'radio') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>