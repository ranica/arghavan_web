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
                <div class="form-group label-floating mrg-top-2em" :class="{'has-error' : errors.has('name')}">
                    <label class="control-label">نام ملیت</label>
                    <input autofocus required class="form-control"
                        type="text"
                        name="name"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.name"
                        v-validate="'required|min:2|max:50'"
                        data-vv-delay="250"
                        data-vv-name ="نام ملیت" />

                    <i v-show="errors.has('name')" class="fa fa-warning"></i>
                    <span v-show="errors.has('name')" class="help is-danger">نام ملیت نامعتبر می باشد</span>
                    <span class="material-input"></span>
                </div>
                <!-- /Name field -->
                <span class="pull-left">
                    <input type="submit" value="ذخیره" class="btn btn-fill btn-round btn-rose" @click.prevent="saveRecord">
                    <input type="button" value="انصراف" class="btn btn-fill btn-round btn-default" @click.prevent="registerCancel">
                </span>

            </form>
        </div>
        <!-- /Card Content -->

    </div>
</div>
