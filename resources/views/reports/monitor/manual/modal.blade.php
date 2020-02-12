<!-- Manual Report modal -->
<div class="modal fade" id="ManualRecordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            	 <div class="text-center">
	            	 <h3>
            			@{{ tempRecord.traffic.user.name }}
	            	 </h3>
            	</div>
            </div>
            <!-- /Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
							<div class="card">
							    <!-- Card Content -->
							    <div class="card-content f-BYekan">
								    <form>
								        <h3 class="card-title f-BYekan">
								            ثبت دستی تردد

								        </h3>

								        <div class="col-lg-10 col-lg-offset-1">

											<!-- Code field -->
											<div class="row">
								                <div class="input-group">
				                                    <span class="input-group-addon">
				                                        <i class="material-icons">face</i>
				                                    </span>
				                                    <div class="form-group label-floating">
				                                        <label class="control-label">شماره دانشجویی/پرسنلی
				                                            <small>(ضروری)</small>
				                                        </label>
				                                        <input  @change="loadUser"
                                                                name="code"
                                                                type="text"
                                                                class="form-control"
                                                                minlength="2"
				                                                maxlength="50"
                                                                autofocus
                                                                required
                                                                v-validate="'required|min:2|max:50'"
                                                                data-vv-delay="250"
				                                                data-vv-as="شماره دانشجویی/پرسنلی"
                                                                v-model="tempRecord.traffic.user.code">
				                                        <i v-show="errors.has('code')" class="fa fa-warning"></i>
				                                        <span v-show="errors.has('code')" class="help is-danger">شماره دانشجویی/پرسنلی نامعتبر می باشد</span>
				                                    </div>
				                                </div>
								            </div>
											<!-- /Code field -->


								             <!-- gate direct field -->
								            <div class="row">
				                                <div class="input-group">
				                                    <span class="input-group-addon">
				                                        <i class="fa fa-arrows fa-lg"></i>
				                                    </span>
				                                    <div class="form-group label-floating"
                                                        :class="{'has-error' : errors.has('gatedirect_id')}">
				                                        <label class="control-label">جهت تردد</label>
				                                        <select v-model="tempRecord.traffic.gatedirect.id"
                                                                class="form-control"
                                                                name="gatedirect_id"
				                                                v-validate="'required'"
                                                                required
                                                                data-vv-as ="نام گروه">
				                                            <option v-for="gatedirect in gatedirects"
                                                                    :value="gatedirect.id">
				                                            @{{ gatedirect.name }}
				                                             </option>
				                                         </select>
				                                        <span class="material-input"></span>
				                                    </div>
				                                </div>
				                            </div>
								            <!-- /gate direct field -->

								            <!-- Gate date field -->
								            <div class="row">
	                                         	<persian-calendar name = "gatedate"
												 					v-model="tempRecord.traffic.gatedate"
	                                         						format="jYYYY/jMM/jDD"
																	v-validate="'required'"
																	placeholder="تاریخ تردد"
																	color= "#ec407a">
												 </persian-calendar>
								            </div>
								            <!-- /Gate Date field -->

								            <!-- Gate Time field -->
								            <div class="row">
												<persian-calendar  name="gatetime"
                                                                    v-model="tempRecord.traffic.gatetime"
                                                                    type="time"
												                    v-validate="'required'"
                                                                    placeholder="ساعت تردد"
                                                                    color= "#ec407a">
                                                </persian-calendar>
								            </div>
								            <!-- /Gate Time field -->
								        </div>

                                        <span class="pull-left">
                                            <input type="submit"
                                                    value="ذخیره"
                                                    class="btn btn-fill btn-rose"
                                                    @click.prevent="saveRecord({{ \Auth::user()->id }})">
                                            <input type="button"
                                                    value="انصراف"
                                                    class="btn btn-fill btn-default"
                                                    @click.prevent="manualTrafficCancel"
                                                    data-dismiss="modal">
                                        </span>
								    </form>
							    </div>
							    <!-- /Card Content -->
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal Body -->

            <!--- Modal Footer -->
            <div class="modal-footer justify-content-center">
               {{-- <span class="pull-left"> --}}
	              {{--   <input type="submit" value="ذخیره" class="btn btn-fill btn-rose" @click.prevent="saveRecord">
	                <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="manualTrafficCancel" data-dismiss="modal"> --}}
           		{{-- </span> --}}
            </div>
            <!-- /Modal Footer -->

        </div>
    </div>
</div>
<!-- /Manual Reportt modal -->
