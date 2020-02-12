<h4 class="info-text f-BYekan"> ثبت مشخصات کارمند </h4>
 
 <!-- Semat field -->
 <div class="row">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="material-icons">place</i>
		</span>
		<div class="form-group label-floating">
			<label class="control-label">سمت
			</label>
			<input name="semat" 
					autofocus required
					type="text" 
					class="form-control"
					minlength="2" 
					maxlength="50" 
					v-validate="{ required:true, is_not: 'null' }"
					data-vv-delay="250"
					data-vv-as ="سمت"
					v-model="tempRecord.teacher.semat">
			<span class="material-input"></span>
		</div>
	</div>
</div>
<!-- /Semat field -->