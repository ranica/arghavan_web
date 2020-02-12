<!-- First Tab : user -->
<tab-content title="حساب کاربری"
             icon="fa fa-globe"
             :before-change="tabSwitchUser">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">

               <!--  <h1 v-if="userCodeExists">
                  <div >A notification message..</div>
                </h1> -->

                <form>
                    <h4 class="info-text f-BYekan"> حساب کاربری را با دقت کامل نمایید</h4>
                    <!-- Code field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_box</i>
                            </span>
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('code')}">
                                <label class="control-label">شماره دانشجویی/پرسنلی
                                    <small>(ضروری)</small>
                                </label>
                                <input name="code"
                                        type="text"
                                        class="form-control"
                                        minlength="2"
                                        maxlength="50"
                                        autofocus required
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-delay="250"
                                        data-vv-as="شماره دانشجویی/پرسنلی"
                                        v-model="tempRecord.user.code">
                            </div>
                        </div>
                    </div>
                    <!-- /Code field -->

                    <!-- Password field -->
                    <div class="row">
                        <div v-if="!updateMode" class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>

                            <div class="form-group label-floating"
                                :class="{'has-error' : errors.has('password')}">
                                <label class="control-label"> رمز عبور
                                    <small>(کد ملی - ضروری)</small>
                                </label>

                                <input name="password"
                                        id="password-field"
                                        type="password"
                                        class="form-control"
                                        style="z-index: 0"
                                        minlength="2"
                                        maxlength="50"
                                        autofocus required
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-delay="250"
                                        data-vv-as="رمز عبور"
                                        v-model="tempRecord.user.password"/>
                                <span toggle="#password-field"
                                      style="float: left; position: relative; top: -1.5em"
                                      class="fa fa-fw fa-eye field-icon toggle-password">
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /Password field -->

                    <!-- Email field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('email')}" >
                                <label class="control-label">آدرس ایمیل
                                    <small>(ضروری)</small>
                                </label>
                                <input name="email"
                                        type="email"
                                        class="form-control"
                                        minlength="2"
                                        maxlength="50"
                                        autofocus required
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-delay="250"
                                        data-vv-as="آدرس ایمیل"
                                        v-model="tempRecord.user.email">
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
                                <select v-model="tempRecord.user.group.id"
                                        class="form-control"
                                        @change="updateTabs"
                                        name="group_id"
                                        v-validate="{ required: true,  is_not: 0 }"
                                        data-vv-as="نام گروه"
                                        required>
                                    <option v-for="group in groups"
                                            :value="group.id"
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
                                    <input class="form-check-input"
                                           checked="checked"
                                           type="checkbox"
                                            name="state"
                                            id="state"
                                            v-model="tempRecord.user.state">
                                    وضعیت فعال شود
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /State field -->
                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /First Tab : user -->
