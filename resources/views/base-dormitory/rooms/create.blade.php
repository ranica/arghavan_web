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


                <!-- building name field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('room_building_id')}">

                    <label class="control-label">نام ساختمان</label>

                    <select class="form-control"
                        v-model="tempRecord.room.building.id"
                        name="room_building_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="نام ساختمان ">

                        <option v-for="building in buildings"
                                :value="building.id">
                            @{{ building.name }}
                        </option>

                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /building name field -->

                 <!-- gender name field -->
                <div class="form-group label-floating"
                    :class="{'has-error' : errors.has('room_gender_id')}">
                    <label class="control-label">جنسیت ساختمان</label>

                    <select class="form-control"
                        v-model="tempRecord.room.gender.id"
                        name="room_gender_id"
                        v-validate="{ required: true, is_not: 0}"
                        data-vv-as ="جنسیت ساختمان ">

                        <option v-for="gender in genders"
                                :value="gender.id">
                            @{{ gender.gender }}
                        </option>

                    </select>
                    <span class="material-input"></span>
                </div>
                <!-- /gender name field -->

                 <!--  number room field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('room_number')}">
                    <label class="control-label">شماره اتاق</label>

                    <input autofocus
                        required
                        class="form-control"
                        type="number"
                        step="1"
                        min="0"
                        max="500"
                        name="room_number"
                        minlength="1"
                        maxlength="50"
                        v-model="tempRecord.room.number"
                        v-validate="{ required: true, is_not:'0' }"
                        data-vv-delay="250"
                        data-vv-as ="شماره اتاق" />

                    <span class="material-input"></span>
                </div>
                <!-- /number room field -->

                 <!--  capacity room field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('room_capacity')}">
                    <label class="control-label">ظرفیت اتاق</label>

                    <input autofocus
                        required
                        class="form-control"
                        type="number"
                        step="1"
                        min="0"
                        max="500"
                        name="room_capacity"
                        minlength="1"
                        maxlength="50"
                        v-model="tempRecord.room.capacity"
                        v-validate="{ required: true, is_not:'0' }"
                        data-vv-delay="250"
                        data-vv-as ="ظرفیت اتاق" />

                    <span class="material-input"></span>
                </div>
                <!-- /capacity room field -->

                <!--  floor_room field -->
                <div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('room_floor')}">
                    <label class="control-label">شماره طبقه</label>

                    <input autofocus
                        required
                        class="form-control"
                        type="number"
                        step="1"
                        min="0"
                        max="500"
                        name="room_floor"
                        minlength="1"
                        maxlength="50"
                        v-model="tempRecord.room.floor"
                        v-validate="{ required: true, is_not:'0' }"
                        data-vv-delay="250"
                        data-vv-as ="شماره طبقه" />

                    <span class="material-input"></span>
                </div>
                <!-- /floor_room field -->

                <span class="pull-left">
                    <input type="submit"
                            value="ذخیره"
                            class="btn btn-fill btn-round btn-rose"
                            @click.prevent="saveRoomRecord">

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
