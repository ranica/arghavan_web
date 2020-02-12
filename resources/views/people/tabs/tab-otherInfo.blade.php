<!-- Third Tab : other -->
<tab-content title="سایر اطلاعات"
             icon="fa fa-info"
             :before-change="tabSwitchOther">
    <div class="card">
        <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
                <form>
                      <!-- Student subtab -->
                    <div v-if="isStudent">
                        @include('people.tabs.tab-student')
                    </div>
                    <div v-if="isTeacher">
                        @include('people.tabs.tab-teacher')
                    </div>
                    <div v-if="isStaff">
                        @include('people.tabs.tab-staff')
                    </div>

                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /Third Tab : other -->
