<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">
	<div class="card">
		 {{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        {{-- /Card Header --}}

        {{-- Card Content --}}
		<div class="card-content f-BYekan">
			<h3 class="card-title f-BYekan">ثبت اطلاعات   </h3>

			<form>
				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('name')}">
					<label class="control-label">نام دستگاه </label>
					<input class="form-control"
                            type="text"
                            name="name"
                            minlength="2"
                            maxlength="50"
                            autofocus
                            required
						    v-validate="{ required: true, is_not:'null' }"
                            data-vv-delay="250"
                            data-vv-as ="نام دستگاه"
                            v-model="tempRecord.name"/>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('ip')}">
					<label class="control-label">دستگاه IP </label>
					<input class="form-control"
                            type="text"
                            name="ip"
                            minlength="2"
                            maxlength="50"
                            required
						    v-validate="{ required: true, is_not:'null' }"
                            data-vv-delay="250"
                            data-vv-as="آدرس ip"
                            v-model="tempRecord.ip"/>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('gategender_id')}">
					<label class="control-label">جنسیت تردد کننده</label>
					<select v-model="tempRecord.gategender.id"
                            class="form-control"
                            name="gategender_id"
                            required
                            v-validate="{ required: true, is_not: 0}"
                            data-vv-as ="جنسیت تردد کننده">
						<option v-for="gategender in gategenders" :value="gategender.id">
							@{{ gategender.gender }}
						</option>
					</select>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('gatepass_id')}">
					<label class="control-label">نحوه عبور از گیت</label>
					<select v-model="tempRecord.gatepass.id"
                            class="form-control"
                            name="gatepass_id"
                            v-validate= "{required: true, is_not: 0}"
                            data-vv-as= "نحوه عبور از گیت"
                            required>
						<option v-for="gatepass in gatepasses" :value="gatepass.id">
							@{{ gatepass.name }}
						</option>
					</select>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('gatedirect_id')}">
					<label class="control-label">جهت تردد </label>
					<select v-model="tempRecord.gatedirect.id"
                            class="form-control"
                            name="gatedirect_id"
                            v-validate= "{required: true, is_not: 0}"
                            data-vv-as ="جهت تردد"
                            required>
						<option v-for="gatedirect in gatedirects" :value="gatedirect.id">
							@{{ gatedirect.name }}
						</option>
					</select>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('zone_id')}">
					<label class="control-label">ناحیه تردد</label>
					<select v-model="tempRecord.zone.id"
                            class="form-control"
                            name="zone_id"
                            v-validate= "{required: true, is_not: 0}"
                            data-vv-as ="ناحیه تردد"
                            required>
						<option v-for="zone in zones" :value="zone.id">
							@{{ zone.name }}
						</option>
					</select>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('timepass')}">
					<label class="control-label">زمان عبور از گیت </label>
					<input class="form-control"
                            type="text"
                            name="timepass"
                            minlength="1"
                            maxlength="50"
                            required
                            v-validate= "{required: true, is_not: 'null'}"
                            data-vv-as ="زمان عبور از گیت "
                            data-vv-delay="250"
                            v-model="tempRecord.timepass"
						/>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('timeserver')}">
					<label class="control-label">زمان پاسخ سرور </label>
					<input class="form-control"
                            type="text"
                            name="timeserver"
                            minlength="1"
                            maxlength="50"
                            required
						    v-validate= "{required: true, is_not: 'null'}"
                            data-vv-as ="زمان پاسخ سرور "
                            data-vv-delay="250"
                            v-model="tempRecord.timeserver"/>
					<span class="material-input"></span>
				</div>

				<div class = "input-group"
                    :class="{'has-error' :errors.has('state')}">
                    <div class="togglebutton">
                        <label>
                            <input class="form-check-input"
                                    checked=""
                                    type="checkbox"
                                    name="state"
                                    id="state"
                                    v-model="tempRecord.state">
                            فعال
                        </label>
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

            </form>

           
        </div>
        {{-- /Card Content --}}
	</div>
</div>
