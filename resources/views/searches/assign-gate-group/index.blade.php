<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">
	<div class="card">

		{{-- Card Header --}}
		<div class="card-header card-header-icon" data-background-color="rose">
			@{{ tempRecord.user.code }}
           </div>
          {{-- /Card Header --}}

          {{-- Card Content --}}
          <div class="card-content f-BYekan">
          	<h3 class="card-title f-BYekan">
          		<span class="pull-left">
          			<input type="submit" value="ذخیره" class="btn btn-fill btn-rose"
                              @click.prevent="saveGateGroupRecord('GateGroupScope')">
          			<input type="button" value="انصراف" class="btn btn-fill btn-default"
                              @click.prevent="registerCancel">
          		</span>
          	</h3>

          	<form class="pd-top-35em pd-bottom-2em" data-vv-scope ="GateGroupScope">

          		{{-- List Gate Group --}}
          		<div v-for = "gategroup in gategroups" class="form-check col-md-3">
          			<label :title="gategroup.name" class="upper-case">
          			     <input class="form-check-input" v-model="gategroup.permit"
                                   data-vv-scope ="GateGroupScope"
                                   type="checkbox" >
     				      @{{ gategroup.name }}
          			</label>
          			<span class="form-check-sign">
          				<span class="check"></span>
          			</span>
          		</div>
          		{{-- /List GateGroup --}}
          	</form>
          </div>
          {{-- /Card Content --}}
     </div>
</div>


