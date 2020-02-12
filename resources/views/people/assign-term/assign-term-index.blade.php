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
                              @click.prevent="saveTermRecord('TermScope')">
          			<input type="button" value="انصراف" class="btn btn-fill btn-default"
                              @click.prevent="registerCancel">
          		</span>
          	</h3>

          	<form class="pd-top-35em pd-bottom-2em" data-vv-scope ="TermScope">

          		<!--  List Term  -->
          		<div v-for = "term in terms" class="form-check col-md-3">
          			<label :title="term.semester.name" class="upper-case">
          			     <input class="form-check-input" v-model="term.checked"
                                   data-vv-scope ="termScope"
                                   type="checkbox" name="peopleterm">
     				      @{{ term.semester.name }}
          			</label>
          			<span class="form-check-sign">
          				<span class="check"></span>
          			</span>
          		</div>
          		<!--  /List term  -->
          	</form>
          </div>
          {{-- /Card Content --}}
     </div>
</div>


