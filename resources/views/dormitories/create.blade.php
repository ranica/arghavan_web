<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"  id="registerForm">
	<div class = "card">
		 {{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        {{-- /Card Header --}}

        {{-- Card Content --}}
		<div class="card-content f-BYekan">
			<h3 class="card-title f-BYekan">ثبت اطلاعات </h3>

			<div class="col-md-12">
				<form>

                    <!-- building name field -->
                    <div class="row">
                        <div class="form-group label-floating"
                            :class="{'has-error' : errors.has('building_id')}">
                            <label class="control-label">نام ساختمان</label>
                            <select class="form-control"
                                v-model="tempRecord.building.id"
                                name="building_id"
                                v-validate="{ required: true, is_not: 0}"
                                data-vv-as ="نام ساختمان ">

                                <option v-for="building in buildings"
                                        :value="building.id">
                                    @{{ building.name }}
                                </option>

                            </select>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <!-- /building name field -->

                    <!-- term name field -->
                    <div class="row">
                        <div class="form-group label-floating"
                            :class="{'has-error' : errors.has('term_id')}">
                            <label class="control-label">نیمسال تحصیلی</label>
                            <select class="form-control"
                                    name="term_id"
                                    v-model="tempRecord.term.id"
                                    required v-validate="'required'"
                                    data-vv-as ="نیمسال تحصیلی">
                                <option v-for="term in terms" :value="term.id"
                                :selected="tempRecord.term_id == term.id">
                                @{{ term.semester.name }}
                                @{{ term.year }}
                                </option>
                            </select>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <!-- /term name field -->


                    <!-- degree name field -->
                    <div class="row">
                        <div class="form-group label-floating"
                            :class="{'has-error' : errors.has('degree_id')}">
                            <label class="control-label">مقطع تحصیلی</label>
                            <select class="form-control"
                                v-model="tempRecord.degree.id"
                                name="degree_id"
                                v-validate="{ required: true, is_not: 0}"
                                data-vv-as ="مقطع تحصیلی">

                                <option v-for="degree in degrees"
                                        :value="degree.id">
                                    @{{ degree.name }}
                                </option>

                            </select>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <!-- /degree name field -->

                    <!-- gate_plan name field -->
                    <div class="row">
                        <div class="form-group label-floating"
                            :class="{'has-error' : errors.has('gatePlan_id')}">
                            <label class="control-label">برنامه تردد</label>
                            <select class="form-control"
                                v-model="tempRecord.gatePlan.id"
                                name="gatePlan_id"
                                v-validate="{ required: true, is_not: 0}"
                                data-vv-as ="برنامه تردد">

                                <option v-for="gate_plan in gatePlans"
                                        :value="gate_plan.id">
                                    @{{ gate_plan.name }}
                                </option>

                            </select>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <!-- /gate_plan name field -->

                    <div class="pull-left">
                        <input type="submit"
                                value="ذخیره"
                                class="btn btn-round btn-fill btn-rose"
                                @click.prevent="saveRecord">
                        <input type="button"
                                value="انصراف"
                                class="btn btn-round btn-fill btn-default"
                                @click.prevent="registerCancel">
                    </div>

	            </form>
	        </div>
        </div>
        {{-- /Card Content --}}
	</div>
</div>
