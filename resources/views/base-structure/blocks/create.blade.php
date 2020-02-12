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

                <!-- Block name field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('name_block')}">
                    <label class="control-label">نام بلوک</label>
                    <input autofocus
                        required
                        class="form-control"
                        type="text"
                        name="name_block"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.name"
                       v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="نام بلوک" />
                    <span class="material-input"></span>
                </div>
                 <!-- /Block name field -->

                <!-- Block code field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('code_block')}">
                    <label class="control-label">کد بلوک</label>
                    <input required
                        class="form-control"
                        type="text"
                        name="code_block"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.code"
                        v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="کد بلوک" />
                    <span class="material-input"></span>
                </div>
                 <!-- /Block code field -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveBlockRecord">

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
