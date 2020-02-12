<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">
	<div class="card">

		{{-- Card Header --}}
		<div class="card-header card-header-icon" data-background-color="rose">
			@{{ title }}
     	</div>
     	{{-- /Card Header --}}

	     {{-- Card Content --}}
	    <div v-show="isSearchMode">
		     <div class="card-content f-BYekan">
		     	{{-- <div class="col-sm-12"> --}}
			     	<h3 class="card-title f-BYekan">
			     		<span class="pull-left">
			     			<input type="submit"
                                    value="جستجو"
                                    class="btn btn-fill btn-rose"
                                    @click.prevent="searchRecord(1)">
			     			<input type="button"
                                    value="انصراف"
                                    class="btn btn-fill btn-default"
                                    @click.prevent="registerCancel">
			     		</span>
			     	</h3>
		     	{{-- </div> --}}

		     	<form class="pd-top-35em pd-bottom-2em">

					{{-- code --}}
					<div class="row">
		                <div class="col-sm-12">
		                	<div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_box</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label"> شماره پرسنلی/دانشجویی </label>
                                    <input type="text" class="form-control" v-model="tempRecord.code">
                                </div>
                            </div>
		                </div>
		            </div>
					{{-- /code --}}

					{{-- nationalId --}}
					<div class="row">
		                <div class="col-sm-12">
		                	<div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">credit_card</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label"> کد ملی </label>
                                    <input type="text" class="form-control" v-model="tempRecord.nationalId">
                                </div>
                            </div>
		                </div>
		            </div>
					{{-- /nationalId --}}

					{{-- name --}}
					<div class="row">
		                <div class="col-sm-12">
		                	<div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">نام</label>
                                    <input type="text" class="form-control" v-model="tempRecord.name">
                                </div>
                            </div>
		                </div>
		            </div>
					{{-- /name --}}

					{{-- lastname --}}
					<div class="row">
		                <div class="col-sm-12">
		                	<div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">group</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">نام خانوادگی </label>
                                    <input type="text" class="form-control" v-model="tempRecord.lastname">
                                </div>
                            </div>
		                </div>
		            </div>
					{{--  /lastname --}}

					{{-- Serial Card --}}
				<!-- 	<div class="row">
		                <div class="col-sm-12">
		                	<div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">code</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label"> سریال کارت </label>
                                    <input type="text"
                                            class="form-control"
                                            v-model="tempRecord.cdn">
                                </div>
                            </div>
		                </div>
		            </div> -->
					{{-- /Serial Card --}}

					{{-- startDate --}}
					<div class="row">
						<div class="col-sm-12 pad-rem-right">
				     		<div class="form-group">
				     			<persian-calendar placeholder="تاریخ ورود"
                                    color= "#ec407a"
                                    name = "startDate"
                                    v-model="tempRecord.startDate"
                                    format="jYYYY/jMM/jDD"
                                    {{-- v-validate="'required'" --}}
                                    data-vv-as ="تاریخ ورود">
                                </persian-calendar>
							</div>
						</div>
					</div>
					{{-- /startDate --}}

					{{-- endDate --}}
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<persian-calendar placeholder= "تاریخ خروج"
                                    color= "#ec407a"
                                    name = "endDate"
                                    v-model="tempRecord.endDate"
                                    format="jYYYY/jMM/jDD"
                                    {{-- v-validate="'required'" --}}
                                    data-vv-as ="تاریخ ورود"
                                    data-vv-scope ="">
                                </persian-calendar>
							</div>
						</div>
					</div>
					{{-- /endDate --}}

		     	</form>

		    </div>
	 	</div>
	     {{-- /Card Content --}}
   	</div>
</div>
