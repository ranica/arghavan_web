<!-- Second Tab : person -->
<tab-content title="مشخصات فردی"
             icon="fa fa-user"
             :before-change="tabSwitchPerson">
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
                                             required
                                            type="text"
                                            class="form-control"
                                            minlength="5"
                                            maxlength="10"
                                            v-validate="{ required: true, is_not: 'null' }"
                                            data-vv-delay="250"
                                            data-vv-as = "کد ملی "
                                            v-model="tempRecord.people.nationalId">
                                </div>
                            </div>
                        </div>
                        <!-- /Nantional field -->

                        <!-- Name field -->
                        <div class="row">
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
                                             required
                                            v-validate="{ required: true, is_not: 'null' }"
                                            data-vv-delay="250"
                                            data-vv-as = "نام شخص "
                                            v-model="tempRecord.people.name">
                                </div>
                            </div>
                        </div>
                        <!-- /Name field -->

                        <!-- Lastname field -->
                        <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">record_voice_over</i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('lastname')}">
                                    <label class="control-label">نام خانوادگی
                                        <small>(ضروری)</small>
                                    </label>
                                    <input name="lastname"
                                        type="text"
                                        class="form-control"
                                        minlength="2"
                                        maxlength="50"
                                         required
                                        v-validate="{ required: true, is_not:'null' }"
                                        data-vv-delay="250"
                                        data-vv-as = "نام خانوادگی"
                                        v-model="tempRecord.people.lastname">

                                </div>
                            </div>
                        </div>
                        <!-- /Lastname field -->

                        <!-- Gender field -->
                        <div class="row">
                            <div class="col-md-1 ml-auto mr-auto col-sm-offset-1" v-for="gender in genders">
                                <div class="radio" :class="{'has-error' : errors.has('gender_id')}">
                                    <label>
                                        <input type="radio"
                                                name="gender_id"
                                                :value="gender.id"
                                                :checked="tempRecord.people.gender.id == gender.id"
                                                v-model="tempRecord.people.gender.id"
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

                        <div class="row">
                            <!-- Birthdate field -->
                            <div class="col-sm-6" :class="{'has-error' : errors.has('birthdate')}">
                                <persian-calendar color="#ec407a"
                                                    placeholder= "تاریخ تولد"
                                                    name = "birthdate"
                                                    v-model="tempRecord.people.birthdate"
                                                    format="jYYYY/jMM/jDD"
                                                    data-vv-as ="تاریخ تولد"
                                                    v-validate="{ required: true, is_not: 'null' }">
                                </persian-calendar>
                            </div>
                            <!-- /Birthdate field -->

                            <!-- Melliat field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons"> person_pin</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('melliat_id')}">
                                        <label class="control-label">ملیت</label>
                                        <select class="form-control"
                                                v-model="tempRecord.people.melliat.id"
                                                name="melliat_id"
                                                v-validate="{ required: true,  is_not: 0 }"
                                                data-vv-as ="ملیت">
                                            <option v-for="melliat in melliats" :value="melliat.id"
                                            :selected="tempRecord.people.melliat_id == melliat.id">
                                            @{{ melliat.name }}
                                            </option>
                                        </select>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Melliat field -->
                        </div>

                        <div class="row">
                            <!-- Phone field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('phone')}">
                                        <label class="control-label">تلفن
                                        </label>
                                        <input name="phone"
                                                type="text"
                                                class="form-control"
                                                minlength="11"
                                                maxlength="11"

                                                data-vv-delay="250"
                                                data-vv-as ="تلفن"
                                                v-validate="{required: true, is_not: 'null'}"
                                                v-model="tempRecord.people.phone"
                                                v-validate="{ min:11, max:11}">
                                    </div>
                                </div>
                            </div>
                            <!-- /Phone field -->

                            <!-- Mobile field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone_android</i>
                                    </span>
                                    <div class="form-group label-floating"
                                    :class="{'has-error' : errors.has('mobile')}">
                                        <label class="control-label">موبایل</label>
                                        <!-- <input name="mobile"

                                                class="form-control"
                                                minlength="11" maxlength="11"
                                                {{-- v-validate="{required: true}" --}}
                                                v-validate="{ regex:/^09[0-9][0-9]{8}$/ }"
                                                data-vv-delay="250"
                                                data-vv-as =
                                                v-model="tempRecord.people.mobile"> -->

                                          <input id="mobile"
                                                 class="form-control transparent-input direction-rtl text-right"
                                                 type="tel"
                                                 name="mobile"
                                                 placeholder="*********09"
                                                 pattern="^09[0-9][0-9]{8}"
                                                 v-validate="{ regex:/^09[0-9][0-9]{8}$/ }"
                                                 data-vv-as="موبایل"
                                                 v-model="tempRecord.people.mobile"
                                                 required>
                                    </div>
                                </div>
                            </div>
                            <!-- /Mobile field -->
                        </div>
                        <div class="row">
                            <!-- Province field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person_pin_circle</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('province_id')}">
                                        <label class="control-label">محل سکونت</label>
                                        <select class="form-control"
                                                name="province_id"
                                                v-model="tempRecord.people.province.id"
                                                @change="updateCities"
                                                v-validate="{ required: true, is_not: 0 }"
                                                data-vv-as = "محل سکونت">
                                            <option v-for="province in provinces" :value="province.id"
                                            :selected="tempRecord.people.province.id == province.id">
                                            @{{ province.name }}
                                            </option>
                                        </select>
                                        {{-- <span class="material-input"></span> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- /Province field -->

                            <!-- City field -->
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person_pin_circle</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('city_id')}">
                                        <label class="control-label">شهرستان محل سکونت</label>
                                        <select class="form-control"
                                                name="city_id"
                                                v-model="tempRecord.people.city.id"
                                                @change="updateCities"
                                                v-validate="{ required: true, is_not: 0 }"
                                                data-vv-as = "شهرستان محل سکونت">

                                            <option v-for="city in cities" :value="city.id"
                                            :selected="tempRecord.people.city.id == city.id">
                                            @{{ city.name }}
                                            </option>
                                        </select>
                                        {{-- <span class="material-input"></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                          <!-- Address field -->
                          <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">place</i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('address')}">
                                    <label class="control-label">آدرس محل سکونت
                                    </label>
                                    <input name="address"
                                            type="text"
                                            class="form-control"
                                            minlength="2"
                                            maxlength="500"
                                             required
                                            v-model="tempRecord.people.address"
                                            v-validate="{ required: true, is_not: 'null' , min:2, max:500 }"
                                            data-vv-delay="250"
                                            data-vv-as="آدرس محل سکونت">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /Address field -->



                    </div>

                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /Second Tab : Person -->
