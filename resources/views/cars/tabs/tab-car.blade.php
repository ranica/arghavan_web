<!-- Car Tab : user -->
<tab-content title="ثبت مشخصات خودرو"
            icon="fas fa-car"
            :before-change="tabSwitchCar">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-offset-3">
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('car_plate_type_id')}">
                                <label class="control-label">نوع پلاک</label>
                                <select class="form-control"
                                        name="car_plate_type_id"
                                        v-model="tempRecord.car.plate_type.id"
                                        v-validate="{ required: true,  is_not: 0 }"
                                        required
                                        data-vv-as ="نوع پلاک">
                                    <option v-for="car_plate_type in car_plate_types" :value="car_plate_type.id">
                                    @{{ car_plate_type.name }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-3 col-sm-offset-2">
                            <div class="form-group">
                                <label class="control-label"> کد اول </label>
                                <input type="text"
                                        class="form-control"
                                        minlength="2"
                                        maxlength="2"
                                        name = "plate_first"
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-as ="کد اول پلاک"
                                        v-model= "tempRecord.car.plate_first">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">حروف پلاک</label>
                                <input type="text"
                                class="form-control"
                                        minlength="1"
                                        maxlength="3"
                                        name = "plate_word"
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-as ="حروف پلاک"
                                        v-model= "tempRecord.car.plate_word">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> کد دوم پلاک</label>
                                <input type="text"
                                        class="form-control"
                                        minlength="2"
                                        maxlength="3"
                                        name = "plate_second"
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-as ="کد دوم پلاک"
                                        v-model= "tempRecord.car.plate_second">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" :class="{'has-error' : errors.has('plate_city_id')}">
                                <label class="control-label">شهر پلاک</label>
                                <select class="form-control"
                                        name="plate_city_id"
                                        v-model="tempRecord.car.plate_city.id"
                                        v-validate="{ required: true,  is_not: 0 }"
                                        required
                                        data-vv-as ="شهر پلاک">
                                    <option v-for="car_plate_city in car_plate_cities"
                                            :value="car_plate_city.id">
                                    @{{ car_plate_city.key }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Car Type field -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-car-alt"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('car_type_id')}">
                                    <label class="control-label">نوع خودرو</label>
                                    <select class="form-control"
                                            name="car_type_id"
                                            v-model="tempRecord.car.type.id"
                                            required
                                            v-validate="{ required: true, is_not: 0 }"
                                            data-vv-as ="نوع خودور">
                                        <option v-for="car_type in car_types" :value="car_type.id"
                                        :selected="tempRecord.car.type.id == car_type.id">
                                        @{{ car_type.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-car-side"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('car_system_id')}">
                                    <label class="control-label">سیستم خودرو</label>
                                    <select class="form-control"
                                            name="car_system_id"
                                            v-model="tempRecord.car.system.id"
                                            required
                                            v-validate="{ required: true,  is_not: 0 }"
                                            data-vv-as ="سیستم خودرو">
                                        <option v-for="car_system in car_systems" :value="car_system.id">
                                            @{{ car_system.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Car Type field -->

                    <!-- Color Car and Level Car field -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-palette"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('car_color_id')}">
                                    <label class="control-label">رنگ خودرو</label>
                                    <select class="form-control"
                                            name="car_color_id"
                                            v-model="tempRecord.car.color.id"
                                            v-validate="{ required: true, is_not: 0 }"
                                            required
                                            data-vv-as ="رنگ خودرو">
                                        <option v-for="car_color in car_colors" :value="car_color.id"
                                        :selected="tempRecord.car.color.id == car_color.id">
                                        @{{ car_color.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-car-battery"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('car_level_id')}">
                                    <label class="control-label">تیپ خودرو</label>
                                    <select class="form-control"
                                            name="car_level_id"
                                            v-model="tempRecord.car.level.id"
                                            required
                                            v-validate="{ required: true,  is_not: 0 }"
                                            data-vv-as ="تیپ خودرو">
                                        <option v-for="car_level in car_levels" :value="car_level.id"
                                        :selected="tempRecord.car.level.id == car_level.id">
                                        @{{ car_level.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Color Car and Level Car field -->

                    <!-- Fuel Car and Model Car field -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-gas-pump"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('car_fuel_id')}">
                                    <label class="control-label">سوخت خودرو</label>
                                    <select class="form-control"
                                            name="car_fuel_id"
                                            v-model="tempRecord.car.fuel.id"
                                            v-validate="{ required: true, is_not: 0 }"
                                            required
                                            data-vv-as ="سوخت خودرو">
                                        <option v-for="car_fuel in car_fuels" :value="car_fuel.id"
                                        :selected="tempRecord.car.fuel.id == car_fuel.id">
                                        @{{ car_fuel.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-car-alt"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('car_model_id')}">
                                    <label class="control-label">مدل خودرو</label>
                                    <select class="form-control"
                                            name="car_model_id"
                                            v-model="tempRecord.car.model.id"
                                            required
                                            v-validate="{ required: true,  is_not: 0 }"
                                            data-vv-as ="مدل خودرو">
                                        <option v-for="car_model in car_models" :value="car_model.id"
                                        :selected="tempRecord.car.model.id == car_model.id">
                                        @{{ car_model.name }}
                                        </option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Fuel Car and Model Car field -->

                    <!-- Chasiscode  and  field -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('chasiscode')}">
                                    <label class="control-label">شماره شاسی
                                    </label>
                                    <input name="chasiscode"
                                            autofocus required
                                            type="text"
                                            class="form-control"
                                            minlength="5"
                                            maxlength="50"
                                            {{-- v-validate="{ required: true, is_not: 'null' }" --}}
                                            data-vv-delay="250"
                                            data-vv-as = "شماره شاسی"
                                            v-model="tempRecord.car.chasiscode">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('enginecode')}">
                                    <label class="control-label">شماره موتور
                                    </label>
                                    <input name="chasiscode"
                                            autofocus required
                                            type="text"
                                            class="form-control"
                                            minlength="5"
                                            maxlength="50"
                                            {{-- v-validate="{ required: true, is_not: 'null' }" --}}
                                            data-vv-delay="250"
                                            data-vv-as = "شماره موتور"
                                            v-model="tempRecord.car.enginecode">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Capacity field -->
                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /Car Tab : user -->
