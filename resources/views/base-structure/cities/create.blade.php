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
                <!-- Province name field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('province_id')}">
                    <label class="control-label">استان نام</label>
                    <select class="form-control"
                        v-model="tempRecord.province.id"
                        name="province_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="نام استان ">
                        <option v-for="province in allProvinces" :value="province.id">
                            @{{ province.name }}
                        </option>
                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /Province name field -->

                <!-- City name field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('name_city')}">
                    <label class="control-label">نام شهرستان</label>
                    <input required class="form-control"
                        type="text"
                        name="name_city"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.name"
                       v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="نام شهرستان" />
                    <span class="material-input"></span>
                </div>
                <!-- /Name field -->
                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveCityRecord">
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
