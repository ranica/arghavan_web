   <!-- First Tab : user -->
<tab-content title="جستجوی کاربر"
             icon="fas fa-search"
             :before-change="tabSwitchSearch">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">

                <form>
                     <!-- Group field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <div class="form-group label-floating" :class="{'has-error' : errors.has('group_id')}">
                                <label class="control-label">نام گروه</label>
                                <select v-model="tempRecord.group.id"
                                        class="form-control"
                                        name="group_id"
                                        v-validate="{ required: true,  is_not: 0 }"
                                        data-vv-as ="نام گروه">
                                    <option v-for="group in groups" :value="group.id"
                                    :selected= "tempRecord.group.id == group.id">
                                    @{{ group.name }}
                                     </option>
                                 </select>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /Group field -->

                    <!-- Search field -->
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">style</i>
                            </span>
                            <div class="form-group label-floating is-empty"
                                    :class="{'has-error' : errors.has('search')}">
                                <label class="control-label"> شماره پرسنلی/دانشجویی - نام - نام خانوادگی - کد ملی</label>
                                <input type="text"
                                        class="form-control"
                                        v-model="tempRecord.search"
                                        name="search"
                                        v-validate="{ required: true,  is_not: 0 }"
                                        data-vv-as ="شماره پرسنلی/دانشجویی - نام - نام خانوادگی - کد ملی">
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /Search field -->
                </form>

            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /First Tab : user -->

