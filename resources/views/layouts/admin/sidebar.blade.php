<nav class="pcoded-navbar d-flex h-100" style="width: 245px;">
	<div class="navbar-wrapper">
		<div class="navbar-brand header-logo">
			<a href="{{ route('admin_dashboard')}}" className="b-brand">
				<img src="{{ asset('assets/images/logo.png')}}" alt="logo" />
			</a>
			<a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
		</div>
		<div class="navbar-content scroll-div h-100">

			<ul class="nav pcoded-inner-navbar mb-3">
				<li class="nav-item pcoded-menu-caption">
					<label>Navigation</label>
				</li>
				<li class="nav-item  {{ request()->routeIs('admin_dashboard') ? 'active' : ''}}">
					<a href="{{ route('admin_dashboard')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-home"></i></span>
						<span class="pcoded-mtext">Dashboard Navigation</span>
					</a>
				</li>
				<li class="nav-item {{ request()->routeIs('admin_attorney_list') ? 'active' : ''}}">
					<a href="{{ route('admin_attorney_list')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-box"></i></span>
						<span class="pcoded-mtext">Attorney Management</span>
					</a>
				</li>
				<li class="nav-item {{ request()->routeIs('userLoginHistory') ? 'active' : ''}}">
					<a href="{{ route('userLoginHistory')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-box"></i></span>
						<span class="pcoded-mtext">Login History</span>
					</a>
				</li>
				<li class="nav-item {{ request()->routeIs('admin_paralegal_list') ? 'active' : ''}}">
					<a href="{{ route('admin_paralegal_list')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-box"></i></span>
						<span class="pcoded-mtext">Paralegal Management</span>
					</a>
				</li>
				
				<!--li class="nav-item {{ request()->routeIs('attorneychat') ? 'active' : ''}}">
					<a href="{{ route('attorneychat')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-box"></i></span>
						<span class="pcoded-mtext">Chat Management (Attorney) <span class="{{ request()->routeIs('attorneychat') ? '' : 'badge_active'}} badge"></span></span>
					</a>
				</li-->
				
				<li class="nav-item   {{ request()->routeIs('admin_guide_documents') ? 'active' : ''}}">
					<a href="{{ route('admin_guide_documents')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Document Guide</span>
					</a>
				</li>
				<li class="nav-item   {{ request()->routeIs('admin_client_list') ? 'active' : ''}}">
					<a href="{{ route('admin_client_list')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Client Management</span>
					</a>
				</li>
				<li class="nav-item   {{ (request()->routeIs('admin_concierge_service_list') || request()->routeIs('getclendlywebhook'))  ? 'active' : ''}}">
					<a href="{{ route('admin_concierge_service_list')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Concierge Service Clients</span>
					</a>
				</li>
				<li class="nav-item  {{ request()->routeIs('admin_email_notification_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_email_notification_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Email Notifications</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_manage_notification_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_manage_notification_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-server" aria-hidden="true"></i>
                        </span><span class="pcoded-mtext">Manage Notifications</span>
                    </a>
                </li>
				<li class="nav-item   {{ request()->routeIs('admin_zipcode_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_zipcode_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Zip Codes</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_state_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_state_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">State Management</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_fips_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_fips_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">County FIPS Management</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_loancompanies_index') || request()->routeIs('admin_loancompanies_edit') ? 'active' : ''}}">
                    <a href="{{ route('admin_loancompanies_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Auto Loan Companies</span>
                    </a>
                </li>

				<li class="nav-item  {{ request()->routeIs('admin_creditors_index') || request()->routeIs('admin_creditors_edit') ? 'active' : ''}}">
                    <a href="{{ route('admin_creditors_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Master Creditors</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_govt_creditors_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_govt_creditors_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Govt Creditors</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_courthouses_index') || request()->routeIs('admin_courthouses_edit') ? 'active' : ''}}">
                    <a href="{{ route('admin_courthouses_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Courthouse List</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_mortgages_index') || request()->routeIs('admin_mortgages_edit') ? 'active' : ''}}">
                    <a href="{{ route('admin_mortgages_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Mortgage List</span>
                    </a>
                </li>
				<li class="nav-item {{ request()->routeIs('admin_deduction_index') ? 'active' : ''}}">
					<a href="{{ route('admin_deduction_index')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Payroll Tax/Deduction List</span>
					</a>
				</li>
                <li class="nav-item  {{ request()->routeIs('admin_forms_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_forms_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-box"></i>
                        </span><span class="pcoded-mtext">Forms</span>
                    </a>
                </li>
				<!--li class="nav-item  {{ request()->routeIs('admin_common_notes_category_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_common_notes_category_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-box"></i>
                        </span><span class="pcoded-mtext">Common Notes Category</span>
                    </a>
                </li-->

				<li class="nav-item  {{ request()->routeIs('admin_district_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_district_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-box"></i>
                        </span><span class="pcoded-mtext">District Order</span>
                    </a>
                </li>
				
				<li class="nav-item   {{ request()->routeIs('admin_domestic_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_domestic_index')}}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-box"></i>
                        </span><span class="pcoded-mtext">Domestic Addresses</span>
                    </a>
                </li>
				<li class="nav-item {{ request()->routeIs('admin_payment_settings') ? 'active' : ''}}">
					<a href="{{ route('admin_payment_settings')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Payment settings</span>
					</a>
				</li>
				<li class="nav-item {{ request()->routeIs('exemption_list') || request()->routeIs('exemption_edit') ? 'active' : ''}}">
					<a href="{{ route('exemption_list')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext"> Exemption list</span>
					</a>
				</li>
				<li class="nav-item {{ request()->routeIs('admin_reports') ? 'active' : ''}}">
					<a href="{{ route('admin_reports')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Atty Quest. Reports</span>
					</a>
				</li>
				
                <li class="nav-item {{ request()->routeIs('admin_means_test_settings') ? 'active' : ''}}">
                    <a href="{{ route('admin_means_test_settings')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Means Test settings</span>
                    </a>
                </li>

				<li class="nav-item {{ request()->routeIs('admin_districtform_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_districtform_index')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">District Form Order</span>
                    </a>
                </li>

				<li class="nav-item {{ request()->routeIs('district_crediter_setting_index') ? 'active' : ''}}">
                    <a href="{{ route('district_crediter_setting_index')}}" class="nav-link ">
						<span class="pcoded-micon"><i class="feather icon-server"></i>
						</span><span class="pcoded-mtext">Creditor Matrix Settings</span>
                    </a>
                </li>
				<li class="nav-item  {{ request()->routeIs('admin_debtstaxes_index') || request()->routeIs('admin_debtstaxes_edit') ? 'active' : ''}}">
                    <a href="{{ route('admin_debtstaxes_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">State Taxes List</span>
                    </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('admin_webvideos_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_webvideos_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Manage Videos</span>
                    </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('admin_property_request_index') ? 'active' : ''}}">
                    <a href="{{ route('admin_property_request_index')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i>
                        </span><span class="pcoded-mtext">Property Requests</span>
                    </a>
                </li>
			</ul>
		</div>
	</div>
</nav>
