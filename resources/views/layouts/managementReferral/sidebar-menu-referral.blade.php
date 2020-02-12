@can('menu_referral')
    <li class ="active">
        <a data-toggle="collapse" href="#referralMenu">
            <i class="fa fa-users"></i>
            <p>
               مدیریت مراجعه کنندگان
                <b class="caret"></b>
            </p>
        </a>
        @isRoot
            <div class="collapse" id="referralMenu">
                <ul class="nav">

                    @can('referral_warranty')
                        <li>
                            <a href="{{ url('/warranties') }}">
                                <span class="sidebar-normal">
                                    ثبت ضمانت نامه
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('referral_type')
                        <li>
                            <a href="{{ url('/referralTypes') }}">
                                <span class="sidebar-normal">
                                    نوع مراجعه کننده
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('referral_referral')
                        <li>
                            <a href="{{ url('/referrals') }}">
                                <span class="sidebar-normal">
                                    مراجعه کنندگان
                                </span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        @endisRoot
    </li>
@endcan
