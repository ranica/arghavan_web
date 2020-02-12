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

                <!-- Semester field -->
                <div class="form-group label-floating" >
                    <label class="control-label">عنوان نیمسال </label>
                    <select class="form-control"
                            v-model="tempRecord.semester.id"
                            name="semester_id"
                            required
                            v-validate="{required: true, is_not: 'null'}"
                            data-vv-as ="عنوان نیمسال">
                        <option v-for="semester in semesters"
                                :value="semester.id">
                            @{{ semester.name }}
                        </option>
                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /Semester field -->

                <!-- Year field -->
                <div class="form-group label-floating">
                    <label class="control-label"> سال تحصیلی</label>
                    <input class="form-control" type="text"
                            name="term_year"
                            minlength="2"
                            maxlength="50"
                            v-validate="{required: true, is_not:'null' }"
                            data-vv-delay="250"
                            v-model="tempRecord.year"
                            data-vv-as ="سال تحصیلی"
                        />
                    <span class="material-input"></span>
                </div>
                <!-- /Year field -->

                <!-- Start Date  field -->
                <div class="row">
                    <persian-calendar  name = "term_startDate"
                                        color="#ec407a"
                                        v-model="tempRecord.startDate"
                                        format="jYYYY/jMM/jDD"
                                        v-validate="{ required: true, is_not: 'null' }"
                                        placeholder="تاریخ شروع نیمسال">
                    </persian-calendar>
                </div>
                <!-- /Start Date  field -->

                <!-- End Date  field -->
                <div class="row">
                    <persian-calendar name = "term_endDate"
                                        color="#ec407a"
                                        v-model="tempRecord.endDate"
                                        format="jYYYY/jMM/jDD"
                                        v-validate="{ required: true, is_not: 'null' }"
                                        placeholder="تاریخ پایان نیمسال">
                    </persian-calendar>
                </div>
                <!-- /End Date  field -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveTermRecord">
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
