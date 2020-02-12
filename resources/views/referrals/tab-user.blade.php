<!-- Second Tab : person -->
<tab-content title="مشخصات فردی"
             icon="fa fa-user">
    <div class="card">
        <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <h4 class="info-text f-BYekan"> مشخصات فردی را با دقت کامل نمایید</h4>
                <form>
                    <div class="col-lg-10 col-lg-offset-1">
                        <!-- Nantional field -->
                        <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">portrait</i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('nationalId')}">
                                    <label class="control-label">کد ملی
                                        <small>(ضروری)</small>
                                    </label>
                                    <input name="nationalId"
                                            autofocus required
                                            type="text"
                                            class="form-control"
                                            minlength="5"
                                            maxlength="10"
                                            v-validate="{ required: true, is_not: 'null' }"
                                            data-vv-delay="250"
                                            data-vv-as = "کد ملی "
                                            v-model="tempRecord.nationalId">
                                </div>
                            </div>
                        </div>
                        <!-- /Nantional field -->
                        <div class="row">
                            <!-- Name field -->
                            <div class="col-sm-6" :class="{'has-error' : errors.has('name')}">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('name')}">
                                        <label class="control-label">نام
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="name"
                                                type="text"
                                                class="form-control"
                                                minlength="2"
                                                maxlength="50"
                                                autofocus required
                                                v-validate="{ required: true, is_not: 'null' }"
                                                data-vv-delay="250"
                                                data-vv-as = "نام شخص "
                                                v-model="tempRecord.name">
                                    </div>
                                </div>
                            </div>

                            <!-- /Name field -->

                            <!-- lastname field -->
                            <div class="col-sm-6" :class="{'has-error' : errors.has('lastname')}">
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('lastname')}">
                                        <label class="control-label">نام خانوادگی
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="name"
                                                type="text"
                                                class="form-control"
                                                minlength="2"
                                                maxlength="50"
                                                autofocus required
                                                v-validate="{ required: true, is_not: 'null' }"
                                                data-vv-delay="250"
                                                data-vv-as = "نام خانوادگی "
                                                v-model="tempRecord.lastname">
                                    </div>
                                </div>
                            </div>
                            <!-- /lastname field -->
                        </div>
                        <div class="row">
                            <!-- Gender field -->
                            <div class="col-sm-6">
                                <div class="col-md-1 ml-auto mr-auto col-sm-offset-1" v-for="gender in genders">
                                    <div class="radio" :class="{'has-error' : errors.has('gender_id')}">
                                        <label>
                                            <input type="radio"
                                                    name="gender_id"
                                                    :value="gender.id"
                                                    :checked="tempRecord.gender.id == gender.id"
                                                    v-model="tempRecord.gender.id"
                                                    v-validate="'required'"
                                                    data-vv-as ="جنسیت"/>

                                            <span class="circle"></span>
                                            <span class="check"></span>
                                            @{{ gender.gender }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /Gender field -->

                            <!-- Mobile field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone_android</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('mobile')}">
                                        <label class="control-label">موبایل</label>
                                        <input name="mobile"
                                                type="number"
                                                class="form-control"
                                                minlength="11" maxlength="11" autofocus
                                                v-validate="{required: true}"
                                                data-vv-delay="250"
                                                data-vv-as ="موبایل "
                                                v-model="tempRecord.mobile">
                                    </div>
                                </div>
                            </div>
                            <!-- /Mobile field -->
                        </div>

                        <div class="row">
                            <!-- Warranty field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons"> person_pin</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('warranty_id')}">
                                        <label class="control-label">ضمانت</label>
                                        <select class="form-control"
                                                v-model="tempRecord.warranty.id"
                                                name="warranty_id"
                                                v-validate="{ required: true,  is_not: 0 }"
                                                data-vv-as ="ضمانت">
                                            <option v-for="warranty in warranties" :value="warranty.id"
                                            :selected="tempRecord.warranty_id == warranty.id">
                                            @{{ warranty.name }}
                                            </option>
                                        </select>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- /Warranty field -->

                            <!-- Referral Type field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons"> person_pin</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('referralType_id')}">
                                        <label class="control-label">نوع مراجعه کننده</label>
                                        <select class="form-control"
                                                v-model="tempRecord.referralType.id"
                                                name="referralType_id"
                                                v-validate="{ required: true,  is_not: 0 }"
                                                data-vv-as ="نوع مراجعه کننده">
                                            <option v-for="referralType in referralTypes" :value="referralType.id"
                                            :selected="tempRecord.referralType_id == referralType.id">
                                            @{{ referralType.name }}
                                            </option>
                                        </select>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                             <!-- /Referral Type field -->
                        </div>

                    </div>

                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /Second Tab : Person -->

