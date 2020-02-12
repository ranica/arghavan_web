@can('menu_sms')
    <li class ="active">
        <a data-toggle="collapse" href="#smsMenu">
                <i class="material-icons">message</i>
                <p>
                    مدیریت  اطلاع رسانی
                    <b class="caret"></b>
                </p>
            </a>
            @isRoot
                <div class="collapse" id="smsMenu">
                    <ul class="nav">

                        {{-- SMS IR --}}
                        @can('sms_manager')
                            <li>
                                <a href="{{ url('/sms') }}">
                                    <span class="sidebar-normal">
                                         مدیریت پیامک
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can('sms_send')
                            <li>
                              <a href="{{ url('/sms') . '?send_sms=1' }}">
                                    <span class="sidebar-normal">
                                         ارسال پیامک
                                    </span>
                                </a>
                            </li>
                        @endcan
                        {{-- /SMS IR --}}
                    </ul>
                </div>
            @endisRoot
    </li>
@endcan
