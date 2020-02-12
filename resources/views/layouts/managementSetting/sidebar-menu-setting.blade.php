@can('menu_setting')
    <li>
        <a data-toggle="collapse" href="#settingManagementMenu">
            <i class="material-icons">settings_applications</i>
            <p>
                مديريت تنظيمات
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="settingManagementMenu">
            <ul class="nav">

                <!--  Gate Setting Menu  -->
                @include('layouts.managementSetting.menu-gate')
                <!--/ Gate Setting  Menu  -->

                <!-- Permission System Manager Menu -->
                @include('layouts.managementSetting.menu-user')
                <!-- /Permission System Manager Menu -->

            </ul>
        </div>
    </li>
@endcan
