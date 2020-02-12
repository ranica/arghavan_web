<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">

 <!--      Wizard container        -->
    <div class="wizard-container">
        <div class="card wizard-card" data-color="rose" id="wizardProfile">
            <form  data-vv-scope ="peopleScope">

                <div class="wizard-header">
                    <h3 class="wizard-title f-BYekan">
                        ثبت اطلاعات
                    </h3>
                </div>

                <!-- Title Header -->
                <div class="wizard-navigation">
                    <ul>
                        <li>
                            <a href="#about" data-toggle="tab">حساب کاربری</a>
                        </li>
                        <li>
                            <a href="#account" data-toggle="tab">مشخصات فردی</a>
                        </li>
                        <li>
                            <a href="#other" data-toggle="tab">سایر اطلاعات</a>
                        </li>
                        <li>
                            <a href="#card" data-toggle="tab">ثبت کارت</a>
                        </li>
                        <li>
                            <a href="#image" data-toggle="tab">ثبت تصویر</a>
                        </li>
                    </ul>
                </div>
                <!-- /Title Header -->


                <div class="tab-content">

                    <!-- First Tab : About -->
                    <div class="tab-pane" id="about">
                        <div class="col-lg-10 col-lg-offset-1">

                            <h4 class="info-text f-BYekan"> حساب کاربری را با دقت کامل نمایید</h4>

                            <!-- Code field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">شماره دانشجویی/پرسنلی
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="code" type="text" class="form-control" minlength="2" maxlength="50"
                                         autofocus required v-validate="'required|min:2|max:50'"
                                         data-vv-delay="250"
                                         data-vv-name="شماره دانشجویی/پرسنلی "
                                         data-vv-scope ="peopleScope"
                                         v-model="tempRecord.user.code">
                                        <i v-show="errors.has('code')" class="fa fa-warning"></i>
                                        <span v-show="errors.has('code')" class="help is-danger">شماره دانشجویی/پرسنلی نامعتبر می باشد</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Code field -->

                            <!-- Email field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">آدرس ایمیل
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="email" type="email" class="form-control" minlength="2" maxlength="50"
                                            autofocus required v-validate="'required|min:2|max:50'"
                                            data-vv-delay="250"
                                            data-vv-name = "آدرس ایمیل "
                                            data-vv-scope = "peopleScope"
                                            v-model="tempRecord.user.email">
                                        <i v-show="errors.has('email')" class="fa fa-warning"></i>
                                        <span v-show="errors.has('email')" class="help is-danger">ایمیل نامعتبر می باشد</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Email field -->

                            <!-- Group field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_circle</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('group_id')}">
                                        <label class="control-label">نام گروه</label>
                                        <select v-model="tempRecord.user.group.id" class="form-control" @change="updateTabs"
                                            name="group_id" v-validate="'required'" required
                                            data-vv-name ="نام گروه"
                                            data-vv-scope ="peopleScope">
                                            <option v-for="group in groups" :value="group.id"
                                            :selected="tempRecord.user.group_id == group.id">
                                            @{{ group.name }}
                                             </option>
                                         </select>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Group field -->

                            <!-- State field -->
                            <div class="row">
                                <div class="input-group" :class="{'has-error' :errors.has('state')}">
                                    <div class="togglebutton">
                                        <label>
                                            <input class="form-check-input" checked="checked" type="checkbox"
                                            name="state" id="state" v-model="tempRecord.user.state">
                                            وضعیت فعال شود
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /State field -->

                        </div>
                    </div>
                    <!-- /First Tab : About -->

                    <!-- Second Tab: Account -->
                    <div class="tab-pane" id="account">
                        <div class="col-lg-10 col-lg-offset-1">

                            <h4 class="info-text f-BYekan"> مشخصات فردی را با دقت کامل نمایید</h4>
                             <!-- Name field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">نام
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="name" type="text" class="form-control" minlength="2" maxlength="50"
                                            autofocus required v-validate="'required|min:2|max:50'"
                                            data-vv-delay="250"
                                            data-vv-name = "نام شخص "
                                            data-vv-scope = "peopleScope"
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
                                    <div class="form-group label-floating">
                                        <label class="control-label">نام خانوادگی
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="lastname" type="text" class="form-control" minlength="2" maxlength="50"
                                            autofocus required v-validate="'required|min:2|max:50'"
                                            data-vv-delay="250"
                                            data-vv-name = "نام خانوادگی"
                                            data-vv-scope = "peopleScope"
                                            v-model="tempRecord.people.lastname">
                                    </div>
                                </div>
                            </div>
                            <!-- /Lastname field -->

                            <!-- Nantional field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">portrait</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">کد ملی
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="nationalId" type="text"
                                            class="form-control" minlength="5"
                                            maxlength="10" autofocus required
                                            v-validate="'required|min:5|max:10'"
                                            data-vv-delay="250"
                                            data-vv-name = "کد ملی "
                                            data-vv-scope ="peopleScope"
                                            v-model="tempRecord.people.nationalId">
                                    </div>
                                </div>
                            </div>
                            <!-- /Nantional field -->

                            <!-- Gender field -->
                            <div class="row">
                                <div class="col-md-1 ml-auto mr-auto col-sm-offset-1" v-for="gender in genders">
                                    <div class="radio">
                                        <label>
                                             <input type="radio" name="gender_id"
                                                :value="gender.id"
                                                :checked="tempRecord.people.gender.id == gender.id"
                                                v-model="tempRecord.people.gender.id"
                                                v-validate="'required'"
                                                data-vv-name ="جنسیت"
                                                data-vv-scope ="peopleScope" />

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
                                <div class="col-sm-6">
                                    <persian-calendar color="#ec407a" placeholder= "تاریخ تولد"
                                        name = "birthdate"
                                        v-model="tempRecord.people.birthdate"
                                        format="jYYYY/jMM/jDD"
                                        data-vv-name ="تاریخ تولد"
                                        data-vv-scope ="peopleScope"
                                        v-validate="'required'"></persian-calendar>
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
                                                v-validate="'required'"
                                                data-vv-name ="ملیت"
                                                data-vv-scope ="peopleScope">
                                                <!-- required -->
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
                                        <div class="form-group label-floating">
                                            <label class="control-label">تلفن
                                            </label>
                                            <input name="phone" type="number" class="form-control"
                                                minlength="11" maxlength="11" autofocus
                                                data-vv-delay="250"
                                                data-vv-name ="تلفن"
                                                data-vv-scope="peopleScope"
                                                v-model="tempRecord.people.phone"
                                                v-validate="'min:11|max:11'">
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
                                        <div class="form-group label-floating">
                                            <label class="control-label">موبایل</label>
                                            <input name="mobile" type="number" class="form-control"
                                                minlength="11" maxlength="11" autofocus
                                                v-validate="'min:11|max:11'"
                                                data-vv-delay="250"
                                                data-vv-name ="موبایل "
                                                data-vv-scope ="peopleScope"
                                                v-model="tempRecord.people.mobile">
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
                                            <select class="form-control" name="province_id"
                                                v-model="tempRecord.people.province.id"
                                                @change="updateCities"
                                                v-validate="'required'" required
                                                data-vv-name = "محل سکونت"
                                                data-vv-scope ="peopleScope">

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
                                            <select class="form-control" name="city_id"
                                                v-model="tempRecord.people.city.id"
                                                @change="updateCities"
                                                v-validate="'required'" required
                                                data-vv-name = "شهرستان محل سکونت"
                                                data-vv-scope ="peopleScope">

                                                <option v-for="city in cities" :value="city.id"
                                                :selected="tempRecord.people.city.id == city.id">
                                                @{{ city.name }}
                                                </option>
                                             </select>
                                            {{-- <span class="material-input"></span> --}}
                                        </div>
                                    </div>
                                </div>





                                {{-- <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person_pin_circle</i>
                                        </span>

                                        <label class="control-label">شهرستان محل سکونت</label>
                                        <select class="form-control" name="city_id"
                                            v-model="tempRecord.people.city.id"
                                            v-validate="'required'"
                                            data-vv-name ="شهرستان محل سکونت"
                                            data-vv-scope ="peopleScope">
                                            <option v-for="city in cities" :value="city.id"
                                            :selected="tempRecord.people.city_id == city.id">
                                            @{{ city.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div> --}}
                                <!-- /City field -->
                            </div>

                            <!-- Address field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">place</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">آدرس محل سکونت
                                        </label>
                                        <input name="address" type="text" class="form-control"
                                            minlength="2" maxlength="50" autofocus required
                                            v-model="tempRecord.people.address"
                                            v-validate="'min:5|max:500'"
                                            data-vv-delay="250"
                                            data-vv-scope="peopleScope" >
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Address field -->
                        </div>
                    </div>
                    <!-- /Second Tab: Account -->


                    <!-- Thirdy Tab: Other -->
                    <div class="tab-pane" id="other">
                        <div class="col-lg-10 col-lg-offset-1">

                            <!-- Student subtab -->
                            <div v-if="isStudent">
                                {{-- <div class="row"> --}}
                                    <h4 class="info-text f-BYekan"> ثبت مشخصات تحصیلی </h4>

                                    <div class="row">
                                        <!-- Year field -->
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">سال ورود</label>
                                                <input type="number" class="form-control" name="year"
                                                    minlength="2" maxlength="2" autofocus required
                                                    v-validate="'required|min:2|max:2'"
                                                    data-vv-delay="250"
                                                    data-vv-name ="سال ورود"
                                                    data-vv-scope ="peopleScope"
                                                    v-model="tempRecord.student.year">
                                            </div>
                                        </div>
                                        <!-- /Year field -->


                                        <!-- Term field -->
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">ترم ورود</label>
                                                <input type="text" class="form-control" name="term"
                                                    minlength="1" maxlength="2" autofocus required
                                                    v-validate="'required|min:1|max:2'"
                                                    data-vv-delay="250"
                                                    data-vv-scope ="peopleScope"
                                                    data-vv-name ="ترم ورود"
                                                    v-model="tempRecord.student.term">
                                            </div>
                                        </div>
                                        <!-- /Term field -->
                                    </div>

                                    <div class="row">
                                        <!-- University field -->
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating" :class="{'has-error' : errors.has('university_id')}">
                                                <label class="control-label">نام دانشکده</label>
                                                <select class="form-control" name="university_id"
                                                    v-model="tempRecord.student.university.id"
                                                    @change="updateFields"  required
                                                    data-vv-name ="نام دانشکده"
                                                    data-vv-scope ="peopleScope"
                                                    v-validate="'required'">
                                                    <option v-for="university in universities" :value="university.id"
                                                    :selected="tempRecord.student.university_id == university.id">
                                                    @{{ university.name }}
                                                     </option>
                                                 </select>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <!-- /University field -->

                                        <!-- Field field -->
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating" :class="{'has-error' : errors.has('field_id')}">
                                                <label class="control-label">نام رشته تحصیلی</label>
                                                <select class="form-control" name="field_id"
                                                    v-model="tempRecord.student.field.id"
                                                    required v-validate="'required'"
                                                    data-vv-name ="نام رشته تحصیلی"
                                                    data-vv-scope="peopleScope">
                                                    <option v-for="field in fieldsData" :value="field.id">
                                                        @{{ field.name }}
                                                    </option>
                                                </select>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <!-- /Field field -->
                                    </div>


                                    <div class="row">
                                        <!-- Degres field -->
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating" :class="{'has-error' : errors.has('degree_id')}">
                                                <label class="control-label">مقطع تحصیلی</label>
                                                <select class="form-control" name="degree_id"
                                                    v-model="tempRecord.student.degree.id"
                                                    required v-validate="'required'"
                                                    data-vv-name ="مقطع تحصیلی"
                                                    data-vv-scope="peopleScope">
                                                    <option v-for="degree in degrees" :value="degree.id"
                                                    :selected="tempRecord.student.degree_id == degree.id">
                                                    @{{ degree.name }}
                                                     </option>
                                                </select>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <!-- /Degres field -->

                                        <!-- Part field -->
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating" :class="{'has-error' : errors.has('part_id')}">
                                                <label class="control-label">گروه آموزشی</label>
                                                <select class="form-control" name="part_id"
                                                    v-model="tempRecord.student.part.id"
                                                    required v-validate="'required'"
                                                    data-vv-name ="گروه آموزشی"
                                                    data-vv-scope ="peopleScope">
                                                    <option v-for="part in parts" :value="part.id"
                                                    :selected="tempRecord.student.part_id == part.id">
                                                    @{{ part.name }}
                                                     </option>
                                                </select>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <!-- /Part field -->
                                    </div>

                                    <!-- Situation field -->
                                    <div class="row">
                                        <div class="form-group label-floating" :class="{'has-error' : errors.has('situation_id')}">
                                            <label class="control-label">وضعیت تحصیلی</label>
                                            <select class="form-control" name="situation_id"
                                                v-model="tempRecord.student.situation.id"
                                                required v-validate="'required'"
                                                data-vv-name ="وضعیت تحصیلی"
                                                data-vv-scope ="peopleScope">
                                                <option v-for="situation in situations" :value="situation.id"
                                                :selected="tempRecord.student.situation_id == situation.id">
                                                @{{ situation.name }}
                                                </option>
                                                </select>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <!-- /Situation field -->

                                    <!-- Native field  -->
                                    <div class="row">
                                        <div class="input-group" :class="{'has-error' :errors.has('native')}">
                                            <div class="togglebutton">
                                                <label>
                                                    <input class="form-check-input" checked="" type="checkbox"
                                                    name="native" id="native" v-model="tempRecord.student.native">
                                                    بومی می باشد
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Native field -->

                                    <!-- Suit field  -->
                                    <div class="row">
                                        <div class="input-group" :class="{'has-error' :errors.has('suit')}">
                                            <div class="togglebutton">
                                                <label>
                                                    <input class="form-check-input" checked="" type="checkbox"
                                                    name="suit" id="suit" v-model="tempRecord.student.suit">
                                                    خوابگاهی می باشد
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Suit field -->

                                {{-- </div> --}}
                            </div>
                            <!-- /Student subtab -->

                            <!-- Teacher subtab -->
                            <div v-if="isTeacher">
                                <!-- Semat field -->
                                 <div class="row">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">place</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">سمت
                                            </label>
                                            <input name="semat" type="text" class="form-control"
                                                minlength="2" maxlength="50" autofocus required
                                                v-validate="'required|min:2|max:50'"
                                                data-vv-delay="250"
                                                data-vv-name ="سمت"
                                                data-vv-scope ="peopleScope"
                                                v-model="tempRecord.teacher.semat">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Semat field -->

                            </div>
                            <!-- /Teacher subtab -->

                            <!-- Staff subtab -->
                            <div v-if="isStaff">
                                {{-- <div class="row"> --}}
                                    <h4 class="info-text f-BYekan"> ثبت مشخصات اشتغال </h4>

                                    <!-- Contract field -->
                                    <div class="row">
                                        <div class="form-group label-floating" :class="{'has-error' : errors.has('contract_id')}">
                                            <label class="control-label">نوع قرارداد</label>
                                            <select class="form-control" name="contract_id"
                                                v-model="tempRecord.staff.contract.id"
                                                required v-validate="'required'"
                                                data-vv-name ="نوع قرار داد"
                                                data-vv-scope="peopleScope">
                                                <option v-for="contract in contracts" :value="contract.id">
                                                    @{{ contract.name }}
                                                </option>
                                            </select>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <!-- /Contract field -->

                                    <!-- Depratment field -->
                                    <div class="row">
                                        <div class="form-group label-floating" :class="{'has-error' : errors.has('department_id')}">
                                            <label class="control-label">نام ساختمان</label>
                                            <select class="form-control" name="department_id"
                                                v-model="tempRecord.staff.department.id"
                                                equired v-validate="'required'"
                                                data-vv-name ="نام ساختمان"
                                                data-vv-scope ="peopleScope">
                                                <option v-for="department in departments" :value="department.id">
                                                    @{{ department.name }}
                                                </option>
                                            </select>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <!-- /Depratment field -->

                                {{-- </div> --}}
                            </div>
                            <!-- Staff subtab -->


                        </div>
                    </div>
                    <!-- /Thirdy Tab: Other -->

                    <!-- Fourty Tab: Card -->
                    <div class="tab-pane" id="card">
                        <div class="col-lg-10 col-lg-offset-1">

                            <!-- Cardtype field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">account_circle</i>
                                    </span>
                                    <div class="form-group label-floating" :class="{'has-error' : errors.has('cardtype_id')}">
                                        <label class="control-label">نوع کارت</label>
                                        <select class="form-control" name="cardtype_id"
                                            v-model="tempRecord.card.cardtype.id"
                                            {{-- v-validate="'required'" --}}
                                            data-vv-name ="نوع کار"
                                            data-vv-scope="peopleScope">
                                            <option v-for="cardtype in cardtypes" :value="cardtype.id"
                                            :selected="tempRecord.card.cardtype_id == cardtype.id">
                                            @{{ cardtype.name }}
                                             </option>
                                         </select>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cardtype field -->

                            <!-- CDN field -->
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">card_membership</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">شماره سریال کارت
                                            <small>(ضروری)</small>
                                        </label>
                                        <input name="cdn" type="cdn" class="form-control"
                                            minlength="2" maxlength="50" autofocus
                                            v-validate="'min:8|max:15'"
                                            data-vv-delay="250"
                                            data-vv-name ="سریال کارت"
                                            data-vv-scope ="peopleScope"
                                            v-model="tempRecord.card.cdn">
                                        <i v-show="errors.has('cdn')" class="fa fa-warning"></i>
                                        <span v-show="errors.has('cdn')" class="help is-danger">سریال کارت نامعتبر می باشد</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /CDN field -->

                            <!-- Start Date Card field -->
                            <div class="row">
                                <persian-calendar color="#ec407a" placeholder= "تاریخ شروع اعتبار"
                                    name = "startDate"
                                    v-model="tempRecord.card.startDate"
                                    format="jYYYY/jMM/jDD"
                                    {{-- v-validate="'required'" --}}
                                    data-vv-name ="تاریخ شروع اعتبار"
                                    data-vv-scope ="peopleScope">
                                </persian-calendar>
                            </div>
                            <!-- /Start Date Card field -->

                            <!-- End Date Card field -->
                            <div class="row">
                                <persian-calendar color="#ec407a" placeholder= "تاریخ پایان اعتبار"
                                    name = "endDate"
                                    v-model="tempRecord.card.endDate"
                                    format="jYYYY/jMM/jDD"
                                    {{-- v-validate="'required'" --}}
                                    data-vv-name ="تاریخ پایان اعتبار"
                                    data-vv-scope ="peopleScope">
                                </persian-calendar>
                            </div>
                            <!-- /End Date Card field -->

                            <!-- State Card field -->
                            <div class = "input-group" :class="{'has-error' :errors.has('state')}">
                                <div class="togglebutton">
                                    <label>
                                        <input class="form-check-input" checked="" type="checkbox" name="state" id="state" v-model="tempRecord.card.state">
                                        فعال
                                    </label>
                                </div>
                            </div>
                            <!-- /State Card field -->
                        </div>
                     </div>
                    <!-- /Fourty Tab: Card -->

                    <!-- Fifty Tab: Image -->
                    <div class="tab-pane" id= "image">
                        <div class="col-lg-10 col-lg-offset-1">

                                <!-- Image field -->
                                <div class="row">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img :src="tempRecord.people.pictureUrl" class="picture-src" id="wizardPicturePreview" title="" />
                                            <input type="file" name="picture" @change="fileSelect" id="wizard-picture">
                                        </div>
                                         <h6 class="info-text f-BYekan"> انتخاب تصویر </h6>
                                    </div>
                                </div>
                                <!-- /Image field -->
                        </div>
                    </div>
                    <!-- /Fifty Tab: Image -->

                </div>

                <!-- Wizard Footer -->
                <div class="wizard-footer">

                    <!-- Next, Previous, Save Button -->
                    <div class="pull-right">
                        <input type='button' class='btn btn-next btn-rose btn-fill btn-wd' name='next' value='بعدی' />
                        <input type='button' class='btn btn-finish btn-fill btn-primary btn-wd' @click.prevent="saveRecord('peopleScope')" name='finish' value='پایان' />
                        <input type='button' class='btn btn-previous btn-fill btn-rose btn-wd' name='previous' value='قبلی' />
                    </div>
                    <!-- / Next, Previous, Save Button -->

                    <!-- Cancel Button -->
                    <div class="pull-left">
                        <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                    </div>
                    <!-- Cancel Button -->

                    <div class="clearfix"></div>
                </div>
                <!-- /Wizard Footer -->

            </form>
        </div>
    </div>
    <!-- wizard container -->
</div>
