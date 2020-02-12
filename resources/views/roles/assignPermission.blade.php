<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">
   {{--   <tree
        :data="tree"
        :options="{ checkbox: true }">
        :options="treeOptions">
    </tree> --}}
    <div class="card ">
        <div class="card-body ">
            <ul class="nav nav-pills nav-pills-warning" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" data-toggle="tab" href="#pageMain" role="tablist">
                        صفحه اصلی
                    </a>
                </li>
               {{--  <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menuMain" role="tablist">
                   منوهای اصلی
                  </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menuStructure" role="tablist">
                        منوی مدیریت ساختار سازمانی
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menuUser" role="tablist">
                        مدیریت کاربران
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menuGate" role="tablist">
                        مدیریت تردد
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menuSettingGate" role="tablist">
                        مدیریت تنظیمات - تردد
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menuSettingSystem" role="tablist">
                        مدیریت تنظیمات - سیستم
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menuReport" role="tablist">
                        مدیریت گزارشات
                    </a>
                </li>

                @isRoot
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menuReferral" role="tablist">
                        مدیریت مراجعه کنندگان
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menuDormitory" role="tablist">
                            مدیریت خوابگاه
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menuRequest" role="tablist">
                            مدیریت درخواست ها
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menuSMS" role="tablist">
                           سامانه پیامک
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menuParking" role="tablist">
                            مدیریت پارکینگ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#listButton" role="tablist">
                            مجوز دکمه ها
                        </a>
                    </li>
                @endisRoot
            </ul>
            <div class="tab-content tab-space">
                <div class="tab-pane active" id="pageMain">
                    <!-- List Dashboard Permissions  -->
                        <div v-for = "(dashboard, index) in dashboards"
                            :key="index"
                            class="checkbox col-md-6">
                            <label class="form-check-label" :title="dashboard.description" :for="'chkBox' + dashboard.id" class="upper-case">
                                <input class="form-check-input permission-flag"
                                          :id="'chkBox' + dashboard.id"
                                          v-model="dashboard.checked"
                                          type="checkbox"
                                          name="rolePermissionDashboards">
                                    @{{ dashboard.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Dashboard Permissions  -->
                </div>

                <div class="tab-pane" id="menuMain">
                    <!-- List Dashboard Permissions  -->
                       {{--  <div v-for = "(menuMain, index) in menuMains" :key="index" class="form-check col-md-6">
                            <label :title="menuMain.description" :for="'chkBox' + menuMain.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuMain.id"
                                      v-model="menuMain.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuMains">
                                @{{ menuMain.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div> --}}
                    <!-- /List Dashboard Permissions  -->
                </div>



                <div class="tab-pane" id="menuStructure">
                    <!-- List Menu Structure Permissions  -->
                        <div v-for = "(menuStructure, index) in menuStructures" :key="index" class="checkbox col-md-6">
                            <label :title="menuStructure.description" :for="'chkBox' + menuStructure.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuStructure.id"
                                      v-model="menuStructure.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuStructures">
                                @{{ menuStructure.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Structure Permissions  -->
                </div>


                <div class="tab-pane" id="menuUser">
                    <!-- List Menu User Permissions  -->
                        <div v-for = "(menuUser, index) in menuUsers" :key="index" class="checkbox col-md-6">
                            <label :title="menuUser.description" :for="'chkBox' + menuUser.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuUser.id"
                                      v-model="menuUser.checked"
                                      type="checkbox"
                                      name="rolePermissionMenUsers">
                                @{{ menuUser.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu User Permissions  -->
                </div>


                <div class="tab-pane" id="menuGate">
                    <!-- List Menu Gate Permissions  -->
                        <div v-for = "(menuGate, index) in menuGates" :key="index" class="checkbox col-md-6">
                            <label :title="menuGate.description" :for="'chkBox' + menuGate.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuGate.id"
                                      v-model="menuGate.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuUsers">
                                @{{ menuGate.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Gate Permissions  -->
                </div>

                <div class="tab-pane" id="menuSettingGate">
                    <!-- List Menu Setting Gate Permissions  -->
                        <div v-for = "(menuSettingGate, index) in menuSettingGates" :key="index" class="checkbox col-md-6">
                            <label :title="menuSettingGate.description" :for="'chkBox' + menuSettingGate.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuSettingGate.id"
                                      v-model="menuSettingGate.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuSettingGates">
                                @{{ menuSettingGate.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Setting Gate Permissions  -->
                </div>

                <div class="tab-pane" id="menuSettingSystem">
                    <!-- List Menu Setting GateSystem Permissions  -->
                        <div v-for = "(menuSettingSystem, index) in menuSettingSystems" :key="index" class="checkbox col-md-6">
                            <label :title="menuSettingSystem.description" :for="'chkBox' + menuSettingSystem.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuSettingSystem.id"
                                      v-model="menuSettingSystem.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuSettingSystems">
                                @{{ menuSettingSystem.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Setting System Permissions  -->
                </div>

                <div class="tab-pane" id="menuReport">
                    <!-- List Menu Report Permissions  -->
                        <div v-for = "(menuReport, index) in menuReports" :key="index" class="checkbox col-md-6">
                            <label :title="menuReport.description" :for="'chkBox' + menuReport.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuReport.id"
                                      v-model="menuReport.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuReports">
                                @{{ menuReport.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Report Permissions  -->
                </div>

                <div class="tab-pane" id="menuReferral">
                    <!-- List Menu Refferal Permissions  -->
                        <div v-for = "(menuReferral, index) in menuReferrals" :key="index" class="checkbox col-md-6">
                            <label :title="menuReferral.description" :for="'chkBox' + menuReferral.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuReferral.id"
                                      v-model="menuReferral.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuReferrals">
                                @{{ menuReferral.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Refferal Permissions  -->
                </div>

                <div class="tab-pane" id="menuDormitory">
                    <!-- List Menu Dormitory Permissions  -->
                        <div v-for = "(menuDormitory, index) in menuDormitories" :key="index" class="checkbox col-md-6">
                            <label :title="menuDormitory.description" :for="'chkBox' + menuDormitory.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuDormitory.id"
                                      v-model="menuDormitory.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuDormitories">
                                @{{ menuDormitory.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Dormitory Permissions  -->
                </div>

                <div class="tab-pane" id="menuRequest">
                    <!-- List Menu Request Permissions  -->
                        <div v-for = "(menuRequest, index) in menuRequests" :key="index" class="checkbox col-md-6">
                            <label :title="menuRequest.description" :for="'chkBox' + menuRequest.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + menuRequest.id"
                                      v-model="menuRequest.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuRequest">
                                @{{ menuRequest.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Request Permissions  -->
                </div>

                <div class="tab-pane" id="menuSMS">
                    <!-- List Menu SMS Permissions  -->
                        <div v-for = "(sms, index) in menuSMS" :key="index" class="checkbox col-md-6">
                            <label :title="sms.description" :for="'chkBox' + sms.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + sms.id"
                                      v-model="sms.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuSMS">
                                @{{ sms.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Request Permissions  -->
                </div>

                <div class="tab-pane" id="menuParking">
                    <!-- List Menu Parking Permissions  -->
                        <div v-for = "(parking, index) in menuParking" :key="index" class="checkbox col-md-6">
                            <label :title="parking.description" :for="'chkBox' + parking.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + parking.id"
                                      v-model="parking.checked"
                                      type="checkbox"
                                      name="rolePermissionMenuParking">
                                @{{ parking.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Menu Request Permissions  -->
                </div>

                  <div class="tab-pane" id="listButton">
                    <!-- List Button Permissions  -->
                        <div v-for = "(listButton, index) in listButtons" :key="index" class="checkbox col-md-6">
                            <label :title="listButton.description" :for="'chkBox' + listButton.id" class="upper-case">
                            <input class="form-check-input permission-flag"
                                      :id="'chkBox' + listButton.id"
                                      v-model="listButton.checked"
                                      type="checkbox"
                                      name="rolePermissionListButton">
                                @{{ listButton.name }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    <!-- /List Button Permissions  -->
                </div>
            </div>

            <span class="pull-left">
                <input type="submit"
                        value="ذخیره"
                        class="btn btn-round btn-fill btn-rose"
                        @click.prevent="savePermissionRecord">
                <input type="button"
                        value="انصراف"
                        class="btn btn-round btn-fill btn-default"
                        @click.prevent="registerCancel">
            </span>
        </div>
    </div>
	{{-- <div class="card">

		<div class="card-header card-header-icon" data-background-color="rose">
			@{{ tempRecord.name }}
        </div>

        <div class="card-content f-BYekan">
         	<h3 class="card-title f-BYekan">

         	</h3>

         	<form class="pd-top-35em pd-bottom-2em">

                <div class = "input-group" :class="{'has-error' :errors.has('allSelect')}">
                        <div class="togglebutton">
                            <label>
                                <input class="form-check-input"
                                        type="checkbox"
                                        v-model="toggleAllBoolean"
                                        name="myCheckbox"
                                        id ="myCheckbox">
                                انتخاب همه
                            </label>
                        </div>
                   </div>

         		<div v-for = "(permission, index) in permissions" :key="index" class="form-check col-md-6">
         			<label :title="permission.description" :for="'chkBox' + permission.id" class="upper-case">
         				<input class="form-check-input permission-flag"
                            :id="'chkBox' + permission.id"
                            v-model="permission.checked"
                            type="checkbox"
                            name="rolePermissions">
         				@{{ permission.name }}
         			</label>
         			<span class="form-check-sign">
         				<span class="check"></span>
         			</span>
         		</div>

                <span class="pull-left">
                    <input type="submit" value="ذخیره" class="btn btn-fill btn-rose" @click.prevent="savePermissionRecord">
                    <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                </span>
         	</form>

        </div>
    </div> --}}
</div>


