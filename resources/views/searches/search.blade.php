<div class="col-lg-12">
    <div class="card ">

        {{-- Card Header --}}
        <div class="card-header card-header-icon" data-background-color="rose">
            جستجوی کاربر
        </div>
        {{-- /Card Header --}}

        <div class="card-content f-BYekan">

            {{-- Buttons --}}
            <h3 class="card-title f-BYekan">
                <span class="pull-left">
                    <input type="submit" value="جستجو" class="btn btn-fill btn-rose" @click.prevent="searchRecord">
                    <input type="button" value="انصراف" class="btn btn-fill btn-default" @click.prevent="registerCancel">
                </span>
            </h3>
            {{-- /Buttons --}}


            <form  class="form-horizontal f-BYekan pad-all-1em pad-rem-top">
                {{-- title search --}}
                <div class="row">
                    <center>
                    <h4 class="info-text f-BYekan">انتخاب نام گروه و تکمیل یکی از فیلدها الزامی می باشد
                    </h4>
                    </center>
                </div>
                {{-- title search --}}

                {{-- Group field --}}
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">account_circle</i>
                        </span>
                        <div class="form-group label-floating" :class="{'has-error' : errors.has('group_id')}">
                            <label class="control-label">نام گروه</label>
                            <select v-model="tempRecord.user.group.id" class="form-control" name="group_id" 
                                data-vv-name ="نام گروه">
                                <option v-for="group in groups" :value="group.id"
                                :selected="tempRecord.user.group_id == group.id">
                                @{{ group.name }}
                                 </option>
                             </select>
                            <span class="material-input"></span>
                        </div>
                    </div>

                </div>
                {{-- /Group field --}}

                {{-- Code field --}}
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">account_box</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label"> شماره پرسنلی/دانشجویی </label>
                            <input type="text" class="form-control" v-model="tempRecord.user.code">
                        </div>
                    </div>
                </div>
                {{-- /Code field --}}

               {{-- National Code field --}}
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">credit_card</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label"> کد ملی </label>
                            <input type="text" class="form-control" v-model="tempRecord.people.nationalId">
                        </div>
                    </div>
                </div>
               {{-- /National Code field --}}

                {{-- Name user field --}}
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">نام</label>
                            <input type="text" class="form-control" v-model="tempRecord.people.namee">
                        </div>
                    </div>
                </div>
                {{-- /Name user field --}}

                {{-- Lastname user field --}}
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">group</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">نام خانوادگی </label>
                            <input type="text" class="form-control" v-model="tempRecord.people.lastname">
                        </div>
                    </div>
                </div>
                {{-- /Lastname user field --}}

            </form>
        </div>
    </div>
</div>

