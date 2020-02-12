<!-- First Tab : user -->
<tab-content title="جستجوی گزارش"
             icon="fas fa-search"
             :before-change="tabSwitchSearch">
    <div class="card">

        <!-- Card Header -->
        <div class="card-header card-header-icon" data-background-color="rose">
              <i class="fas fa-chart-pie fa-2x"></i>
        </div>
        <!-- /Card Header -->

        <!-- Card Content -->
        <div class="card-content f-BYekan">

            <form>
              <!--  <h3 class="card-title f-BYekan">
                    گزارش تردد

                    <span class="pull-left">
                        <input type="submit" value="مشاهده" class="btn btn-fill btn-rose" @click.prevent="showRecord(1)">
                        <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                    </span>
                </h3> -->
               <div class="col-lg-6 col-lg-offset-3">

                    <!-- Code field -->
                    <div class="row">
                        <div class="form-group label-floating mrg-top-2em"
                            :class="{'has-error' : errors.has('code')}">
                            <label class="control-label">کد شخص
                                <small>(اختیاری)</small>
                            </label>
                            <input autofocus required class="form-control"
                                type="text"
                                name="name"
                                minlength="2"
                                maxlength="50"
                                v-model="tempRecord.code"
                                v-validate="'required|min:2|max:50'"
                                data-vv-delay="250"
                                data-vv-as ="کد شخص" />
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <!-- /Code field -->

                   <!-- Group field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('group_id')}">
                                <label class="control-label">نام گروه</label>
                                <select v-model="tempRecord.group.id" class="form-control" name="group_id"
                                    data-vv-as ="نام گروه">
                                    <option v-for="group in groups" :value="group.id"
                                    :selected="tempRecord.group_id == group.id">
                                    @{{ group.name }}
                                     </option>
                                 </select>
                                <span class="material-input"></span>
                            </div>
                        </div>

                    </div>
                   <!-- /Group field -->

                    <!-- radio  field -->
                    <div class="row">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input"
                                        type="radio"
                                        name="exampleRadios"
                                        :value="true"
                                        v-model="selectFilterRadio"
                                        id= "timeItem">
                                         فیلتر براساس بازه زمانی
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div v-show="selectFilterRadio">
                        <div class="row">
                            <div class= "col-md-6">
                                <persian-calendar color="#ec407a"
                                                    type= "datetime"
                                                    placeholder= "تاریخ و ساعت شروع "
                                                    name = "startDate"
                                                    v-model="tempRecord.startDate"
                                                    data-vv-as ="تاریخ شروع"
                                                    :editable="true"
                                                    v-validate="{ required: true, is_not: 'null' }">
                                </persian-calendar>
                            </div>
                            <div class="col-md-6">
                                <persian-calendar color="#ec407a"
                                                    type= "datetime"
                                                    placeholder= "تاریخ و ساعت پایان"
                                                    name = "endDate"
                                                    v-model="tempRecord.endDate"
                                                    data-vv-as ="تاریخ پایان"
                                                    :editable="true"
                                                    v-validate="{ required: true, is_not: 'null' }">
                                </persian-calendar>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                            id= "dayItem"
                                            type="radio"
                                            name="exampleRadios"
                                            :value="false"
                                            v-model="selectFilterRadio">
                                           فیلتر براساس بازه متداول
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                    </div>


                    <div v-show="! selectFilterRadio">
                        <div class="row pad-rem-left">
                           <!-- <div class="col-md-6 col-sm-12"> -->
                                <div class="form-group label-floating"  :class="{'has-error' : errors.has('commonrange_id')}">
                                    <label class="control-label">بازه متداول</label>
                                    <select class="form-control"
                                        v-model="tempRecord.commonrange.id"
                                        name="commonrange_id" required
                                        data-vv-as ="بازه متداول">
                                        <option v-for="commonrange in commonranges" :value="commonrange.id"
                                            :selected="tempRecord.commonrange.id == commonrange.id">
                                            @{{ commonrange.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                           <!-- </div> -->
                        </div>
                    </div>

                   <!--  Gender-->
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                            v-model="selectGenderBoolean"
                                            id= "fullGender"
                                            type="checkbox"
                                            value=""> تمام جنسیت ها
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group label-floating"  :class="{'has-error' : errors.has('gender_id')}">
                                <label class="control-label">نام جنسیت </label>
                                <select class="form-control"
                                    id = "gender_id"
                                    v-model="tempRecord.gender.id"
                                    name="gender_id"
                                    required
                                    data-vv-as ="جنسیت">

                                    <option v-for="gender in genders" :value="gender.id"
                                        :selected="tempRecord.gender.id == gender.id">
                                        @{{ gender.gender }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                   <!-- / Gender -->

                   <!--  Gate Device-->
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                            v-model="selectDeviceBoolean"
                                            id= "fullDevice"
                                            type="checkbox"
                                            value=""> تمام دستگاه ها
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group label-floating"  :class="{'has-error' : errors.has('gatedevice_id')}">
                                <label class="control-label">نام دستگاه</label>
                                <select class="form-control"
                                    id = "gateDevice_id"
                                    v-model="tempRecord.gatedevice.id"
                                    name="gateDevice_id"
                                    required
                                    data-vv-as ="نام دستگاه">

                                    <option v-for="gatedevice in gatedevices" :value="gatedevice.id"
                                        :selected="tempRecord.gatedevice.id == gatedevice.id">
                                        @{{ gatedevice.name }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                   <!-- /Gate Device-->

                   <!-- Gate Direct-->
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                            v-model="selectDirectBoolean"
                                            id= "fullDirect"
                                            type="checkbox"
                                            value=""> تمام تردد ها
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group label-floating"  :class="{'has-error' : errors.has('gatedirect_id')}">
                                <label class="control-label">نام تردد</label>
                                <select class="form-control"
                                    v-model="tempRecord.gatedirect.id"
                                    id="gatedirect_id"
                                    name="gatedirect_id"
                                    required
                                    data-vv-as ="نام تردد">
                                    <option v-for="gatedirect in gatedirects" :value="gatedirect.id"
                                        :selected="tempRecord.gatedirect.id == gatedirect.id">
                                        @{{ gatedirect.name }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                  <!-- /Gate Direct-->

                   <!-- Gate Message-->
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                            v-model="selectMessageBoolean"
                                            id= "fullMessage"
                                            type="checkbox"
                                            value=""> تمام پیام ها
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group label-floating"  :class="{'has-error' : errors.has('gatemessage_id')}">
                                <label class="control-label">نام پیام</label>
                                <select class="form-control"
                                    v-model="tempRecord.gatemessage.id"
                                    id="gatemessage_id"
                                    name="gatemessage_id"
                                    equired
                                    data-vv-as ="نام پیام">
                                    <option v-for="gatemessage in gatemessages" :value="gatemessage.id"
                                        :selected="tempRecord.gatemessage.id == gatemessage.id">
                                        @{{ gatemessage.message }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                   <!-- /Full Gate Message-->
                </div>
            </form>

        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /First Tab : user -->
