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
                <h3 class="card-title f-BYekan">ثبت اطلاعات </h3>

                <!-- Key field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('key')}">
                    <label class="control-label">کلید واژه</label>
                    <input autofocus
                            required
                            class="form-control"
                            type="text"
                            name="key"
                            minlength="2"
                            maxlength="50"
                            v-model="tempRecord.key"
                            v-validate="{ required: true, is_not: 'null' }"
                            data-vv-delay="250"
                            data-vv-as = "کلید واژه" />
                    <span class="material-input"></span>
                </div>
                <!-- /Key field -->

                <!-- Name field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('name')}">
                    <label class="control-label">نام مجوز</label>
                    <input autofocus required class="form-control" type="text"
                        name="name" minlength="2" maxlength="500"
                        v-model="tempRecord.name"
                        v-validate="{ required: true, is_not: 'null' }"
                        data-vv-delay="250"
                        data-vv-as ="نام مجوز" />
                    <span class="material-input"></span>
                </div>
                <!-- /Name field -->

                <!-- Description field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('description')}">
                    <label class="control-label">توضیحات</label>
                    <input required
                            class="form-control"
                            type="text"
                            name="description"
                            minlength="2"
                            maxlength="500"
                            v-model="tempRecord.description"
                            v-vaidate="{ required: true, is_not: 'null' }"
                            data-vv-as="توضیحات"
                            data-vv-delay="250" />

                    <span class="material-input"></span>
                </div>
                <!-- Description field -->

                <span class="pull-left">
                        <input type="submit"
                                value="ذخیره"
                                class="btn btn-fill btn-round btn-rose"
                                @click.prevent="saveRecord">

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
