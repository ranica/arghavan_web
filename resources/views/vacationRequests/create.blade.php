<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">
	<div class="card">

		{{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        {{-- /Card Header --}}

        {{-- Card Content --}}
		<div class="card-content f-BYekan">
			<h3 class="card-title f-BYekan">
			ثبت اطلاعات

		    </h3>

			<form>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
    					{{-- <div class="row">
    						<div class="form-group label-floating" :class="{'has-error' : errors.has('name')}">
    							<h3>
    								@if (\Auth::check())
    			                        {{ \Auth::user()->people->name .' '. \Auth::user()->people->lastname }}
    								@endif
    							</h3>
    							<i v-show="errors.has('name')" class="fa fa-warning"></i>
    		                    <span v-show="errors.has('name')" class="help is-danger">نام مقطع تحصیلی نامعتبر می باشد</span>
    							<span class="material-input"></span>
    						</div>
    					</div> --}}

    					<!-- Subject field -->
                        <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">speaker_notes</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">موضوع</label>
                                    <input name="code"
                                            type="text"
                                            class="form-control"
                                            minlength="2"
                                            maxlength="50"
                                            autofocus
                                            required
                                            v-validate="{ required: true, is_not: 'null' }"
                                            data-vv-delay="250"
                                            data-vv-as="موضوع درخواست"
                                            v-model="tempRecord.subject">
                                </div>
                            </div>
                        </div>
                        <!-- /Subject field -->

                        <!-- Vacation Type -->
                        <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-coffee"></i>
                                </span>
                                <div class="form-group label-floating"
                                    :class="{'has-error' : errors.has('vacationType_id')}">
                                <label class="control-label">نوع مرخصی</label>
                                <select class="form-control"
                                        @change="updateFields"
                                        v-model="tempRecord.vacationType.id"
                                        name="vacationType_id"
                                        required
                                        v-validate="{ required: true, is_not: 0 }"
                                        data-vv-as ="نوع مرخصی">
                                    <option v-for="vacationType in vacationTypes" :value="vacationType.id">
                                        @{{ vacationType.name }}
                                    </option>
                                </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <!-- /Vacation Type -->

                        <!-- Begin Date field -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <persian-calendar color="#ec407a"
                                                        placeholder= "تاریخ مرخصی"
                                                        name = "begin_date"
                                                        v-model="tempRecord.begin_date"
                                                        format="jYYYY/jMM/jDD"
                                                        data-vv-as ="تاریخ مرخصی">
                                    </persian-calendar>
                                </div>
                            </div>
                        </div>
                        <!-- /Begin Date field -->

                        <div v-if= "isDaily">
                            <!-- End Date field -->
                           <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <persian-calendar
                                                    color="#ec407a"
                                                    placeholder= "تاریخ پایان"
                                                    name = "finish_date"
                                                    v-model="tempRecord.finish_date"
                                                    format="jYYYY/jMM/jDD"
                                                    data-vv-as ="تاریخ پایان">
                                        </persian-calendar>
                                    </div>
                                </div>
                            </div>
                            <!-- /End Date field -->
                        </div>

                        <div v-if="isClock">
                            <!-- Begin Clock field -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <persian-calendar
                                                        name="gatetime"
                                                        v-model="tempRecord.begin_hour"
                                                        type="time"
                                                        v-validate="'required'"
                                                        placeholder="ساعت شروع مرخصی"
                                                        color= "#ec407a">
                                        </persian-calendar>
                                    </div>
                                </div>
                            </div>
                            <!-- Begin Clock field -->

                            <!-- Finish Clock field -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <persian-calendar
                                                        name="gatetime"
                                                        v-model="tempRecord.finish_hour"
                                                        type="time"
                                                        v-validate="'required'"
                                                        placeholder="ساعت پایان مرخصی"
                                                        color= "#ec407a">
                                        </persian-calendar>
                                    </div>
                                </div>
                            </div>
                            <!-- Finish Clock field -->
                        </div>
                    </div>
				</div>

                <div class="pull-left">
                    <input type="button"
                            value="ذخیره"
                            class="btn btn-fill  btn-round btn-rose"
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
