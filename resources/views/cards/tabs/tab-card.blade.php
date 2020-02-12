<!-- Car Tab : user -->
<tab-content title="ثبت مشخصات کارت"
            icon="fas fa-search"
            :before-change="tabSwitchCard">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
                <form>
                    <!-- Cardtype field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('cardtype_id')}">
                                <label class="control-label">نوع کارت</label>
                                <select class="form-control"
                                        v-model="tempRecord.cardtype.id"
                                        data-vv-as ="نوع کارت"
                                        name="cardtype_id"
                                        v-validate="{ required: true, is_not: 0 }"
                                        required>
                                    <option v-for="cardtype in cardtypes" :value="cardtype.id"
                                    :selected="tempRecord.cardtype.id == cardtype.id">
                                    @{{ cardtype.name }}
                                     </option>
                                 </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /Cardtype field -->

                    <!-- CDN field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">card_membership</i>
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label">شماره سریال کارت
                                    <small>(ضروری)</small>
                                </label>
                                <input class="form-control"
                                        name="cdn"
                                        type="cdn"
                                        minlength="2"
                                        maxlength="50"
                                        autofocus required
                                        v-validate="{ required: true, is_not: 'null' }"
                                        data-vv-delay="250"
                                        data-vv-as ="شماره سریال کارت"
                                        {{-- data-vv-scope ="cardScope" --}}
                                        v-model="tempRecord.cdn">
                            </div>
                        </div>
                    </div>
                    <!-- /CDN field -->

                    <!-- Start Date Card field -->
                    <div class="row" :class="{'has-error' : errors.has('startDate')}">
                        <persian-calendar color="#ec407a"
                                            placeholder= "تاریخ شروع اعتبار"
                                            name = "startDate"
                                            v-model="tempRecord.startDate"
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
                                            v-model="tempRecord.endDate"
                                            format="jYYYY/jMM/jDD"
                                            data-vv-as ="تاریخ پایان اعتبار"
                                            v-validate="{ required: true, is_not: 'null' }">
                        </persian-calendar>
                    </div>
                    <!-- /End Date Card field -->

                    <!-- State Card field -->
                    <div class = "input-group" :class="{'has-error' :errors.has('state')}">
                        <div class="togglebutton">
                            <label>
                                <input class="form-check-input"
                                        checked="checked"
                                        type="checkbox"
                                        name="state"
                                        id="state"
                                        v-model="tempRecord.state">
                                    وضعیت فعال شود
                            </label>
                        </div>
                    </div>
                    <!-- /State Card field -->
               </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /Car Tab : user -->
