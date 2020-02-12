<div class="card">
    <!-- Card Content -->
    <div class="card-content f-BYekan">

        <form data-vv-scope ="parentScope">

            <h3 class="card-title f-BYekan">
                ثبت اطلاعات
                <span class="pull-left">
                    <input type="submit" value="ذخیره" class="btn btn-fill btn-primary" @click.prevent="saveParentRecord('parentScope')">
                    <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerParentCancel">
                </span>
            </h3>
            
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row"></div>
                <div class="row">
                    <!-- kintype -->
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons"> person_pin</i>
                        </span>
                        <div class="form-group label-floating" :class="{'has-error' : errors.has('kintype_id')}">
                            <label class="control-label">نسبت</label>
                            <select v-model="tempRecord.parent.kintype.id" class="form-control" name="kintype_id" 
                                v-validate="'required'"
                                data-vv-name ="نسبت"
                                data-vv-scope ="parentScope">
                                <option v-for="kintype in kintypes" :value="kintype.id"
                                :selected="tempRecord.parent.kintype_id == kintype.id">
                                @{{ kintype.name }}
                                </option>
                            </select>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <!-- /kintype field -->
                </div>

                <!-- Name field -->
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-group label-floating" class="{'has-error' : errors.has('name')}">
                            <label class="control-label">نام
                                <small>(ضروری)</small>
                            </label>
                            <input name="name" type="text" class="form-control" minlength="2" maxlength="50" 
                                autofocus required v-validate="'required|min:2|max:50'" 
                                data-vv-delay="250" 
                                data-vv-name = "نام"
                                data-vv-scope ="parentScope"
                                v-model="tempRecord.parent.name">
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
                                data-vv-scope ="parentScope"
                                v-model="tempRecord.parent.lastname">
                        </div>
                    </div>
                </div>
                <!-- /Lastname field -->

                <!-- phone field -->
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">تلفن ثابت
                            </label>
                            <input name="phone" type="text" class="form-control" minlength="2" maxlength="50" 
                                autofocus v-validate="'min:2|max:50'" 
                                data-vv-delay="250"  
                                data-vv-name = "تلفن ثابت"
                                data-vv-scope ="parentScope"
                                v-model="tempRecord.parent.phone">
                        </div>
                    </div>
                </div>
                <!-- /phone field -->

                 <!-- mobile field -->
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone_android</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">تلفن همراه
                                <small>(ضروری)</small>
                            </label>
                            <input name="mobile" type="text" class="form-control" minlength="2" 
                                maxlength="50" autofocus required v-validate="'required|min:2|max:50'" 
                                data-vv-delay="250"  
                                data-vv-name = "تلفن همراه"
                                data-vv-scope = "parentScope"
                                v-model="tempRecord.parent.mobile">
                        </div>
                    </div>
                </div>
                <!-- /mobile field -->
            </div>
        </form>

    </div>
    <!-- /Card Content -->
</div>
