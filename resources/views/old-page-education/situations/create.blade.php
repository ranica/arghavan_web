<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">
	<div class="card">
		<div class="card-header card-header-icon" data-background-color="rose">
			<i class="material-icons">assignment</i>
		</div>

		<div class="card-content f-BYekan">
			<h3 class="card-title f-BYekan">ثبت اطلاعات
				<div class="pull-left">
                    <input type="submit" value="ذخیره" class="btn btn-fill btn-rose" @click.prevent="saveRecord">
                    <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                </div>
			</h3>

			<form>
				<div class="form-group label-floating" :class="{'has-error' : errors.has('name')}">
					<label class="control-label"> نام وضعیت</label>
					<input class="form-control" type="text"
                        name="name" minlength="2" maxlength="50"
						autofocus required
                        v-validate="'required|min:2|max:50'"
                        data-vv-delay="250"
                        data-vv-name="نام وضعیت"
                        v-model="tempRecord.name"/>
					<i v-show="errors.has('name')" class="fa fa-warning"></i>
                    <span v-show="errors.has('name')" class="help is-danger">نام وضعیت نامعتبر می باشد</span>
					<span class="material-input"></span>
				</div>

				<div class = "input-group" :class="{'has-error' :errors.has('state')}">
                    <div class="togglebutton">
                        <label>
                            <input checked="" class="form-check-input" type="checkbox" name="state"
                            id="state" v-model="tempRecord.state">
                            فعال
                        </label>
                    </div>
                </div>



            </form>
        </div>
        {{-- /Card Content --}}

	</div>
</div>
