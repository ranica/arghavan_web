<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">

	<div class="card">
		 {{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        {{-- /Card Header --}}

        {{-- Card Content --}}
		<div class="card-content f-BYekan">
			<h3 class="card-title f-BYekan">ثبت اطلاعات </h3>

			<form>

                <div class="col-sm-10 col-md-offset-1">
                    <div class="row">
                        <div class="form-group label-floating"
                            :class="{'has-error' : errors.has('name')}">
                            <label class="control-label">نام برنامه </label>
                            <input class="form-control"
                                 type="text"
                                 name="name"
                                 minlength="2"
                                 maxlength="50"
                                 autofocus
                                 required
                                 v-validate="{ required: true, is_not:'null' }"
                                 data-vv-delay="250"
                                 data-vv-as ="نام برنامه"
                                 v-model="tempRecord.name"/>
                            <span class="material-input"></span>
                        </div>
                    </div>

                    <div class="row">

                        <div v-for = "(weekday, index) in weekdays"
                            :key="index"
                           class="form-check col-md-6 col-sm-12">
                            <div class="col-md-4">
                                <label class="form-check-label"
                                    :for="'chkBox' + weekday.index"
                                    class="upper-case">
                                    <input class="form-check-input"
                                              :id="'chkBox' + weekday.index"
                                              v-model="weekday.checked"
                                              type="checkbox"
                                              name="weekdays">
                                        @{{ weekday.name }}
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-8">
                                <div class="col-md-6 col-sm-12" >
                                    <vue-clock :time="changeValue(weekday.start_value)"
                                                border="2px"
                                                size="100px">
                                    </vue-clock>
                                </div>

                                <div class="col-md-6 col-sm-12" >
                                    <vue-clock :time="changeValue(weekday.end_value)"
                                                border="2px"
                                                size="100px">
                                    </vue-clock>
                                </div>

                                <div class=" text-center col-md-6 col-sm-12">
                                    <circle-slider
                                        refs= weekday.name
                                        v-model="weekday.start_value"
                                        :side="100"
                                        :min="start_min"
                                        :max="start_max"
                                        :step-size="step"
                                        :circle-width-rel="20"
                                        :progress-width-rel="10"
                                        :knob-radius="10">
                                    </circle-slider>
                                    <p>  @{{ changeValue(weekday.start_value) }} صبح</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <circle-slider
                                        refs= weekday.name
                                        v-model="weekday.end_value"
                                        :side="100"
                                        :min="end_min"
                                        :max="end_max"
                                        :step-size="step"
                                        :circle-width-rel="20"
                                        :progress-width-rel="10"
                                        :knob-radius="10">
                                    </circle-slider>
                                    <p>  @{{ changeValue(weekday.end_value) }} بعدازظهر</p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pull-left">
                        <input type="submit"
                                value="ذخیره"
                                class="btn btn-fill btn-round btn-rose"
                                @click.prevent="saveRecord">
                        <input type="button"
                                value="انصراف"
                                class="btn btn-fill btn-round btn-default"
                                @click.prevent="registerCancel">
                    </div>
                </div>
            </form>
        </div>
        {{-- /Card Content --}}
	</div>
</div>
