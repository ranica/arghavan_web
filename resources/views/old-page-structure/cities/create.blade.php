

<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">
{{-- <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Single Select">
<option disabled selected>Single Option</option>
<option value="2">Foobar</option>
<option value="3">Is great</option>
<option value="4">Is bum</option>
<option value="5">Is wow</option>
<option value="6">boom</option>
</select> --}}

	<div class = "card">
		 {{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        {{-- /Card Header --}}

		 {{-- Card Content --}}
		<div class="card-content f-BYekan">
			<form>
				<h3 class="card-title f-BYekan">ثبت اطلاعات
					 <span class="pull-left">
                        <input type="submit" value="ذخیره" class="btn btn-fill btn-primary" @click.prevent="saveRecord">
                        <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                    </span>
				</h3>

				<div class="form-group label-floating"  :class="{'has-error' : errors.has('province_id')}">
					<label class="control-label">استان</label>
					<select class="form-control"
							v-model="tempRecord.province.id"
							name="province_id"
							v-validate="'required'"
							required
							data-vv-name ="نام استان ">
						<option v-for="province in provinces" :value="province.id">
							@{{ province.name }}
						</option>
					</select>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating" :class="{'has-error' : errors.has('name')}">
					<label class="control-label">نام شهرستان</label>
					<input class="form-control" type="text"  name="name" minlength="2" maxlength="50"
						autofocus required  v-validate="'required|min:2|max:50'"
						data-vv-delay="250" v-model="tempRecord.name"
						data-vv-name = "نام شهرستان"
						/>
					<i v-show="errors.has('name')" class="fa fa-warning"></i>
                    <span v-show="errors.has('name')" class="help is-danger">نام شهرستان نامعتبر می باشد</span>
					<span class="material-input"></span>
				</div>
			</form>
		</div>
	</div>
</div>
