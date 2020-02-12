<!-- Fourth Tab : Card -->
<tab-content title="ثبت کارت"
             icon="fa fa-id-card">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
                <form>
                    <h4 class="info-text f-BYekan"> اطلاعات کارت تردد را کامل نمایید</h4>
                        <!-- Cardtype field -->
                        <div class="row">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_circle</i>
                                </span>
                                <div class="form-group label-floating" :class="{'has-error' : errors.has('cardtype_id')}">
                                    <label class="control-label">نوع کارت</label>
                                    <select class="form-control"
                                            name="cardtype_id"
                                            v-model="tempRecord.card.cardtype.id"
                                            data-vv-as ="نوع کارت">
                                        <option v-for="cardtype in cardtypes" :value="cardtype.id"
                                        :selected="tempRecord.card.cardtype_id == cardtype.id">
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
                                    <input name="cdn"
                                            class="form-control"
                                            type="cdn"
                                            minlength="2"
                                            maxlength="50" autofocus
                                            v-validate="'min:5|max:15'"
                                            data-vv-delay="250"
                                            data-vv-as ="سریال کارت"
                                            v-model="tempRecord.card.cdn">
                                    <i v-show="errors.has('cdn')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('cdn')" class="help is-danger">سریال کارت نامعتبر می باشد</span>
                                </div>
                            </div>
                        </div>
                        <!-- /CDN field -->

                        <!-- Start Date Card field -->
                        <div class="row">
                            <persian-calendar color="#ec407a"
                                                placeholder= "تاریخ شروع اعتبار"
                                                name = "startDate"
                                                v-model="tempRecord.card.startDate"
                                                format="jYYYY/jMM/jDD"
                                                data-vv-as ="تاریخ شروع اعتبار">
                            </persian-calendar>
                        </div>
                        <!-- /Start Date Card field -->

                        <!-- End Date Card field -->
                        <div class="row">
                            <persian-calendar color="#ec407a"
                                                placeholder= "تاریخ پایان اعتبار"
                                                name = "endDate"
                                                v-model="tempRecord.card.endDate"
                                                format="jYYYY/jMM/jDD"
                                                data-vv-as ="تاریخ پایان اعتبار">
                            </persian-calendar>
                        </div>
                        <!-- /End Date Card field -->

                        <!-- State Card field -->
                        <div class = "input-group" :class="{'has-error' :errors.has('state')}">
                            <div class="togglebutton">
                                <label>
                                    <input class="form-check-input"
                                            id="state"
                                            checked=""
                                            type="checkbox"
                                            name="state"
                                            v-model="tempRecord.card.state">
                                    فعال
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
<!-- /Fourth Tab : Card -->
