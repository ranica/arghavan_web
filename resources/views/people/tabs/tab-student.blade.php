
<h4 class="info-text f-BYekan"> ثبت مشخصات تحصیلی </h4>
<!-- Situation field -->
<div class="row">
	<div class="col-sm-6">
		<div class="form-group label-floating" :class="{'has-error' : errors.has('situation_id')}">
			<label class="control-label">وضعیت تحصیلی</label>
			<select class="form-control"
					name="situation_id"
					v-model="tempRecord.student.situation.id"
					required
					v-validate="{ required: true, is_not: 0 }"
					data-vv-as ="وضعیت تحصیلی">
				<option v-for="situation in situations" :value="situation.id"
				:selected="tempRecord.student.situation_id == situation.id">
				@{{ situation.name }}
				</option>
			</select>
			<span class="material-input"></span>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group label-floating" :class="{'has-error' : errors.has('term_id')}">
			<label class="control-label">نیمسال تحصیلی</label>
			<select class="form-control"
					name="term_id"
					v-model="tempRecord.student.term.id"
					required v-validate="'required'"
					data-vv-as ="نیمسال تحصیلی">
				<option v-for="term in terms" :value="term.id"
				:selected="tempRecord.student.term_id == term.id">
				@{{ term.semester.name }}
				@{{ term.year }}
				</option>
			</select>
			<span class="material-input"></span>
		</div>
	</div>
</div>

<!-- /Situation field -->
{{-- <div class="row"> --}}
	<!-- Year field -->
	{{-- <div class="col-sm-6">
		<div class="form-group label-floating">
			<label class="control-label">سال ورود</label>
			<input type="number"
					class="form-control"
					autofocus required
					name="year"
					minlength="2"
					maxlength="2"
					v-validate="{ required: true, is_not: 0 }"
					data-vv-delay="250"
					data-vv-as ="سال ورود"
					v-model="tempRecord.student.year">
		</div>
	</div> --}}
	<!-- /Year field -->


	<!-- Term field -->
	{{-- <div class="col-sm-6">
		<div class="form-group label-floating">
			<label class="control-label">ترم ورود</label>
			<input type="text"
					class="form-control"
					autofocus required
					name="term"
					minlength="1"
					maxlength="2"
					v-validate="{ required: true, is_not: 0 }"
					data-vv-delay="250"
					data-vv-as ="ترم ورود"
					v-model="tempRecord.student.term">
		</div>
	</div> --}}
	<!-- /Term field -->
{{-- </div> --}}

<div class="row">
	<!-- University field -->
	<div class="col-sm-6">
		<div class="form-group label-floating">
			<label class="control-label">نام دانشکده</label>
			<select class="form-control"
					required
					name="university_id"
					v-model="tempRecord.student.university.id"
					@change="updateFields"
					data-vv-as ="نام دانشکده"
					v-validate="{ required: true, is_not: 0 }">
				<option v-for="university in universities" :value="university.id"
				:selected="tempRecord.student.university.id == university.id">
				@{{ university.name }}
					</option>
				</select>
			<span class="material-input"></span>
		</div>
	</div>
	<!-- /University field -->

	<!-- Field field -->
	<div class="col-sm-6">
		<div class="form-group label-floating">
			<label class="control-label">نام رشته تحصیلی</label>
			<select class="form-control"
					required
					name="field_id"
					v-model="tempRecord.student.field.id"
					data-vv-as ="نام دانشکده"
					v-validate="{ required: true, is_not: 0 }">
				<option v-for="field in fieldData" :value="field.id"
						selected="tempRecord.student.field.id == field.id">
						@{{ field.name }}
					</option>
				</select>
			<span class="material-input"></span>
		</div>
	</div>

{{-- 	<div class="col-sm-6">
		<div class="form-group label-floating">
			<label class="control-label">نام رشته تحصیلی</label>
			<select class="form-control"
					required
					v-validate="{ required: true, is_not: 0 }"
					name="field_id"
					v-model="tempRecord.student.field.id"
					data-vv-as ="نام رشته تحصیلی">
				<option v-for="field in fieldData" :value="field.id"
				:selected="tempRecord.student.field.id == field.id">
					@{{ field.name }}
				</option>
			</select>
			<span class="material-input"></span>
		</div>
	</div> --}}
	<!-- /Field field -->
</div>

<div class="row">
	<!-- Degres field -->
	<div class="col-sm-6">
		<div class="form-group label-floating" :class="{'has-error' : errors.has('degree_id')}">
			<label class="control-label">مقطع تحصیلی</label>
			<select class="form-control"
					name="degree_id"
					v-model="tempRecord.student.degree.id"
					required
					v-validate="{ required: true, is_not: 0 }"
					data-vv-as ="مقطع تحصیلی">
				<option v-for="degree in degrees" :value="degree.id"
				:selected="tempRecord.student.degree.id == degree.id">
				@{{ degree.name }}
					</option>
			</select>
			<span class="material-input"></span>
		</div>
	</div>
	<!-- /Degres field -->

	<!-- Part field -->
	<div class="col-sm-6">
		<div class="form-group label-floating" :class="{'has-error' : errors.has('part_id')}">
			<label class="control-label"> دوره</label>
			<select class="form-control"
					required
					v-validate="{ required: true, is_not: 0 }"
					name="part_id"
					v-model="tempRecord.student.part.id"
					data-vv-as ="گروه آموزشی">
				<option v-for="part in parts" :value="part.id"
				:selected="tempRecord.student.part_id == part.id">
				@{{ part.name }}
					</option>
			</select>
			<span class="material-input"></span>
		</div>
	</div>
	<!-- /Part field -->
</div>

<!-- Native field  -->
<div class="row">
	<div class="input-group" :class="{'has-error' :errors.has('native')}">
		<div class="togglebutton">
			<label>
				<input class="form-check-input"
						id="native"
						checked=""
						type="checkbox"
						name="native"
						v-model="tempRecord.student.native">
				بومی می باشد
			</label>
		</div>
	</div>
</div>
<!-- /Native field -->

<!-- Suit field  -->
<div class="row">
	<div class="input-group" :class="{'has-error' :errors.has('suit')}">
		<div class="togglebutton">
			<label>
				<input class="form-check-input"
						id="suit"
						checked=""
						type="checkbox"
						name="suit"
						v-model="tempRecord.student.suit">
				خوابگاهی می باشد
			</label>
		</div>
	</div>
</div>
<!-- /Suit field -->
