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
				<h3 class="card-title f-BYekan">
					ثبت اطلاعات
					<span class="pull-left">
                        <input type="submit" value="ذخیره" class="btn btn-fill btn-rose" @click.prevent="saveRecord">
                        <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                    </span>
                </h3>

				<!-- Semester field -->
				<div class="form-group label-floating" >
					<label class="control-label">عنوان نیمسال </label>
					<select class="form-control"
							v-model="tempRecord.semester.id"
							name="semester_id"
							required
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
                        	name="year"
							minlength="2" maxlength="50" autofocus required
							v-validate="'required|min:2|max:50'"
                        	data-vv-delay="250"
                        	v-model="tempRecord.year"
						/>
					<span class="material-input"></span>
				</div>
				<!-- /Year field -->

				<!-- Start Date  field -->
				<div class="row">
					<persian-calendar  name = "startDate"
										color="#ec407a"
										v-model="tempRecord.startDate"
										format="jYYYY/jMM/jDD"
										v-validate="'required'"
										placeholder="تاریخ شروع نیمسال">
					</persian-calendar>
				</div>
				<!-- /Start Date  field -->

				<!-- End Date  field -->
				<div class="row">
					<persian-calendar name = "endDate"
										color="#ec407a"
										v-model="tempRecord.endDate"
										format="jYYYY/jMM/jDD"
										v-validate ="'required'"
										placeholder="تاریخ پایان نیمسال">
					</persian-calendar>
				</div>
				<!-- /End Date  field -->
			</form>
		</div>
		 {{-- /Card Content --}}

	</div>
</div>
