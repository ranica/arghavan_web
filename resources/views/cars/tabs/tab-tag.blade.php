<!-- First Tab : user -->
<tab-content title="ثبت برچسب"
             icon="fas fa-tag"
             :before-change="tabSwitchTag">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
               
                <form>
                    <!-- CDN Field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-tag"></i>
                            </span>
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('cdn')}">
                                <label class="control-label"> شماره برچسب خودرو
                                    <small>(ضروری)</small>
                                </label>
                                <input name="cdn"
                                    type="text"
                                    class="form-control"
                                    minlength="2"
                                    maxlength="50"
                                    autofocus required
                                    v-validate="{ required: true, is_not:'null' }"
                                    data-vv-delay="250"
                                    data-vv-as = "شماره برچسب خودرو"
                                    v-model="tempRecord.card.cdn">
                            </div>
                        </div>
                    </div>
                    <!-- /CDN Field -->

                    <!-- Start Date Card field -->
                    <div class="row" :class="{'has-error' : errors.has('startDate')}">
                        <persian-calendar color="#ec407a"
                                            placeholder= "تاریخ شروع اعتبار"
                                            name = "startDate"
                                            v-model="tempRecord.card.startDate"
                                            format="jYYYY/jMM/jDD"
                                            data-vv-as ="تاریخ شروع اعتبار"
                                            v-validate="{ required: true, is_not: 'null' }">
                        </persian-calendar>
                    </div>
                    <!-- /Start Date Card field -->

                    <!-- End Date Card field -->
                    <div class="row" :class="{'has-error' : errors.has('endDate')}">
                        <persian-calendar color="#ec407a"
                                            placeholder= "تاریخ پایان اعتبار"
                                            name = "endDate"
                                            v-model="tempRecord.card.endDate"
                                            format="jYYYY/jMM/jDD"
                                            data-vv-as ="تاریخ پایان اعتبار"
                                            v-validate="{ required: true, is_not: 'null' }">
                        </persian-calendar>
                    </div>
                    <!-- /End Date Card field -->

                      <!-- State  field -->
                      <div class="row">
                        <div class = "input-group" :class="{'has-error' :errors.has('state')}">
                            <div class="togglebutton">
                                <label>
                                    <input class="form-check-input"
                                            checked="checked"
                                            type="checkbox"
                                            name="state"
                                            id="state"
                                            v-model="tempRecord.card.state">
                                        وضعیت فعال شود
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /State field -->

                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /Tag Tab -->
