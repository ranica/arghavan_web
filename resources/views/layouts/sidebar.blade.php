<div class="sidebar-wrapper f-BYekan">
    <div class="user">
        <div class="photo">
            <img   src="{{ \Auth::user()->people->pictureThumbUrl }}" />
        </div>

        <div class="info">
            <a class="collapsed" data-toggle="collapse" href="#collapseExample">
				<span>
					@if (\Auth::check())
                        {{ \Auth::user()->people->name .' '. \Auth::user()->people->lastname }}
					@endif
					<b class="caret"></b>
				</span>
			</a>

            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
                <ul class="nav">
                    <li>
                        <a href="{{ route('profile_show') }}">
							{{-- <span class="sidebar-mini">
								MP
							</span> --}}
							<span class="sidebar-normal">
								پروفایل کاربری
							</span>
						</a>
                    </li>

                    <li>
                        <a href= "{{ route('lock_page') }}">
							{{-- <span class="sidebar-mini">
								ق.ص
							</span> --}}
							<span class="sidebar-normal">
								قفل صفحه
							</span>
						</a>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}" onclick="logoutUser(event)">
							{{-- <span class="sidebar-mini">
								E
							</span> --}}
							<span class="sidebar-normal">
								خروج
							</span>
						</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <ul class="nav">
        <li class="active">
            <a href="{{ route("home") }}">
				<i class="material-icons">dashboard</i>
				<p>
					داشبورد من
				</p>
			</a>
        </li>
        @isRoot
            <li class="active">
                <a href="{{ route("dashboard_car") }}">
                    <i class="fas fa-car"> </i>
                    <p>
                        داشبورد خودرو
                    </p>
                </a>
            </li>
        @endisRoot

		<!-- Menu Base -->
		@include('layouts.managementStrcture.sidebar-menu-base')
		<!--  /Menu Base -->

        <!-- Menu User -->
        @include('layouts.managementUser.sidebar-menu-user')
        <!--  /Menu User -->
        
        <!-- Gate Management Menu  -->
        @include('layouts.managementGate.sidebar-menu-gate')
        <!--  /Gate Management Menu  -->

        <!-- Menu Setting -->
        @include('layouts.managementSetting.sidebar-menu-setting')
        <!-- /Menu Setting -->

		<!-- Report Menu  -->
        @include('layouts.managementReport.sidebar-menu-report')
        <!--  /Report Menu  -->

        <!-- Referral Menu -->
        @include('layouts.managementReferral.sidebar-menu-referral')
        <!-- /Referral Menu -->

        <!-- Dormitory Management Menu  -->
        @include('layouts.managementDormitory.sidebar-menu-dormitory')
        <!--  /Dormitory Management Menu  -->

        <!-- Request Comment Vacation Manager Menu -->
        @include('layouts.managementRequest.sidebar-menu-request')
        <!-- /Request Comment Vaction Manager Menu -->

        <!-- SMS Menu -->
        @include('layouts.managementSMS.sidebar-menu-sms')
        <!-- /SMS Menu -->
      
        <!-- Parking Menu -->
        @include('layouts.managementParking.sidebar-menu-parking')
        <!-- /Parking Menu -->
       
    </ul>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
