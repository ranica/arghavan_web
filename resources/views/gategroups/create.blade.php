<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">
	<div class="card">

		 {{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        {{-- /Card Header --}}

        {{-- Card Content --}}
        <div class="card-content f-BYekan">
        	<form>
				<h3 class="card-title f-BYekan">ثبت اطلاعات </h3>

				<div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('name')}">
					<label class="control-label">نام گروه </label>

					<input class="form-control"
                        type="text"
                        name="name"
                        minlength="2"
                        maxlength="50"
                        required
						v-validate="{ required: true, is_not: 'null' }"
                        data-vv-delay="250"
                        data-vv-as="نام گروه"
                        v-model="tempRecord.name"/>
                    </span>
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating mrg-top-2em"
                    :class="{'has-error' : errors.has('description')}">
					<label class="control-label"> شرح گروه </label>

					<input class="form-control"
                        type="text"
                        name="description"
                        minlength="2"
                        maxlength="50"
                        required
						v-validate=" {required: true, is_not:'null'} "
                        data-vv-delay="250"
                        data-vv-as="شرح گروه"
                        v-model="tempRecord.description"/>
					<span class="material-input"></span>
				</div>

                <!-- Button Save & Cancel -->
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
                    <!-- /Button Save & Cancel -->


            </form>
        </div>
        {{-- /Card Content --}}
	</div>
</div>
