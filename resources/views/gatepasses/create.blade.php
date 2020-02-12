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
				<div class="form-group label-floating"
                    :class="{'has-error' : errors.has('name')}">
					<label class="control-label">نام</label>
					<input class="form-control"
                            type="text"
                            name="name"
                            minlength="2"
                            maxlength="50"
                            autofocus
                            required
						    v-validate="{ required: true, is_not:'null' }"
                            data-vv-delay="250"
                            data-vv-as= "نام ناحیه تردد"
                            v-model="tempRecord.name"/>
					<span class="material-input"></span>
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
