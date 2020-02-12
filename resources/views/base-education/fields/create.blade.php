<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">
    <div class="card">
        <!-- Card Header -->
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        <!-- /Card Header -->

        <!-- Card Content -->
        <div class="card-content f-BYekan">
            <form>
                <span class="card-title f-BYekan">
                    ثبت اطلاعات
                </span>

                <!-- Name field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('name_field')}">
                    <label class="control-label">نام رشته تحصیلی</label>
                    <input autofocus required class="form-control"
                        type="text"
                        name="name_field"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.name"
                       v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="نام رشته تحصیلی" />
                    <span class="material-input"></span>
                </div>
                <!-- /Name field -->

                 <!-- Province name field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('university_id')}">
                    <label class="control-label">نام دانشکده</label>
                    <select class="form-control"
                        v-model="tempRecord.university.id"
                        name="university_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="نام استان ">
                        <option v-for="university in allUniversities" :value="university.id">
                            @{{ university.name }}
                        </option>
                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /University name field -->

                <!-- Name university -->
               <!--  <div class="form-group label-floating" >
                    <label class="control-label">نام دانشکده</label>
                    <select class="form-control"
                        v-model="tempRecord.university.id"
                        name="university_id"
                        required
                        v-validate="{required: true, is_not: 'null'}"
                        data-vv-as ="ام دانشکده">
                        <option v-for="university in universities"
                                :value="university.id">
                            @{{ university.name }}
                        </option>
                    </select>
                    <span class="material-input"></span>
                </div> -->
                <!-- /Name University -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveFieldRecord">
                    <input type="button"
                            value="انصراف"
                            class="btn btn-fill btn-round btn-default"
                            @click.prevent="registerCancel">
                </span>

            </form>
        </div>
        <!-- /Card Content -->

    </div>
</div>
