<!-- First Tab : user -->
<tab-content title="انتخاب کاربر"
             icon="fas fa-user"
             :before-change="tabSwitchUser">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
                <form>
                  <div v-if="! hasSearch">
                    <h4 class="text-center f-BYekan">
                        رکوردی یافت نشد
                    </h4>
                  </div>
                  <car-search v-for="user in searchdata"
                       :user-data="user"
                       :key= "user.id"
                        @edit-data="showCar"
                        @selection-changed = "selectionChanged"
                        v-show = "hasSearch">
                  </car-search>

                  <!-- modal -->
                  <div class="modal fade"
                      id="carModal"
                      tabindex="-1"
                      role="dialog"
                      aria-labelledby=""
                      aria-hidden="true">
                      <div class="modal-dialog modal-notice">
                          <div class="modal-content">
                              @include('cars.tabs.modal')
                          </div>
                      </div>
                  </div>
                  <!-- /modal -->
                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
<!-- /First Tab : user -->
