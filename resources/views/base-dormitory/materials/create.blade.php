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

                <!-- material Type field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('material_type_id')}">
                    <label class="control-label">دسته بندی</label>
                    <select class="form-control"
                        v-model="tempRecord.material_type.id"
                        name="material_type_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="دسته بندی ">

                        <option v-for="material_type in materialTypes"
                                :value="material_type.id">
                            @{{ material_type.name }}
                        </option>

                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /material type field -->

                <!--  name field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('material_name')}">
                    <label class="control-label">نام تجهیزات</label>

                    <input autofocus
                        required
                        class="form-control"
                        type="text"
                        min="0"
                        max="500"
                        name="material_name"
                        minlength="1"
                        maxlength="50"
                        v-model="tempRecord.name"
                        v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="نام تجهیزات" />

                    <span class="material-input"></span>
                </div>
                <!-- /name field -->

                 <!--  code field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('material_code')}">
                    <label class="control-label">کد اموال</label>

                    <input required
                        class="form-control"
                        type="text"
                        min="0"
                        max="500"
                        name="material_code"
                        minlength="1"
                        maxlength="50"
                        v-model="tempRecord.code"
                        v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="کد اموال" />

                    <span class="material-input"></span>
                </div>
                <!-- /code field -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveMaterialRecord">

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
