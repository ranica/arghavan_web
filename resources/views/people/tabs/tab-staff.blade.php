<h4 class="info-text f-BYekan"> ثبت مشخصات اشتغال </h4>

<!-- Contract field -->
<div class="row">
	<div class="form-group label-floating" :class="{'has-error' : errors.has('contract_id')}">
		<label class="control-label">نوع قرارداد</label>
		<select class="form-control"
				name="contract_id"
				v-model="tempRecord.staff.contract.id"
				required
				v-validate="{ required: true, is_not: 0 }"
				data-vv-as ="نوع قرار داد">
			<option v-for="contract in contracts" :value="contract.id">
				@{{ contract.name }}
			</option>
		</select>
		<span class="material-input"></span>
	</div>
</div>
<!-- /Contract field -->

<!-- Depratment field -->
<div class="row">
	<div class="form-group label-floating" :class="{'has-error' : errors.has('department_id')}">
		<label class="control-label">نام ساختمان</label>
		<select class="form-control"
				equired v-validate="'required'"
				name="department_id"
				v-model="tempRecord.staff.department.id"
				data-vv-as ="نام ساختمان">
			<option v-for="department in departments" :value="department.id">
				@{{ department.name }}
			</option>
		</select>
		<span class="material-input"></span>
	</div>
</div>
<!-- /Depratment field -->
