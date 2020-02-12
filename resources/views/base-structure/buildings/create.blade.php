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

                <!-- building_type name field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('building_type_id')}">
                    <label class="control-label">نوع ساختمان</label>
                    <select class="form-control"
                        v-model="tempRecord.building_type.id"
                        name="building_type_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="نوع ساختمان ">
                        <option v-for="building_type in buildingTypes"
                                :value="building_type.id">
                            @{{ building_type.name }}
                        </option>
                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /building_type name field -->

                <!--  name field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('name_building')}">
                    <label class="control-label">نام ساختمان</label>
                    <input autofocus required
                        class="form-control"
                        type="text"
                        name="name_building"
                        minlength="2"
                        maxlength="50"
                        v-model="tempRecord.name"
                       v-validate="{ required: true, is_not:'null' }"
                        data-vv-delay="250"
                        data-vv-as ="نام ساختمان" />
                    <span class="material-input"></span>
                </div>
                <!-- /Name field -->

                <!-- Block name field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('block_id')}">
                    <label class="control-label">نام بلوک</label>
                    <select class="form-control"
                        v-model="tempRecord.block.id"
                        name="block_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="نام بلوک ">
                        <option v-for="block in blocks" :value="block.id">
                            @{{ block.name }}
                        </option>
                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /Block name field -->

                 <!--  room_count field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('room_count_building')}">
                    <label class="control-label">تعداد اتاق</label>
                    <div class="direction-ltr-important price-padding">
                        <number-input name="room_count_building"
                                    v-model.trim="tempRecord.room_count"
                                    :min="1"
                                    :max="500"
                                    :step="1"
                                    v-validate="{ required: true, is_not: 'null' }"
                                    data-vv-as="تعداد اتاق"
                                    inline
                                    controls>
                        </number-input>
                    </div>
                    <span class="material-input"></span>
                </div>
                <!-- /room_count field -->

                 <!--  floor_count field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('floor_count_building')}">
                    <label class="control-label">تعداد طبقه</label>
                    <div class="direction-ltr-important price-padding">
                        <number-input name="floor_count_building"
                                    v-model.trim="tempRecord.floor_count"
                                    :min="1"
                                    :max="500"
                                    :step="1"
                                    v-validate="{ required: true, is_not: 'null' }"
                                    data-vv-as="تعداد طبقه"
                                    inline
                                    controls>
                        </number-input>
                    </div>

                    <span class="material-input"></span>
                </div>
                <!-- /floor_count field -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveBuildingRecord">

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
