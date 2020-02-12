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

                <!-- Type field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('type_contact_type')}">
                    <label class="control-label">عنوان مخاطب</label>

                    <input autofocus required class="form-control"
                        type="text"
                        name="type_contact_type"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.type"
                        v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="عنوان مخاطب" />
                    <span class="material-input"></span>
                </div>
                <!-- /Type field -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveContactTypeRecord">

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
