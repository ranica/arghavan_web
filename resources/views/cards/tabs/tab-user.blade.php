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

                  <card-search v-for="user in searchdata"
                      :key= "user.id"
                      :user-data="user"
                      @edit-data="showCard"
                      @selection-changed = "selectionChanged" v-show = "hasSearch">
                  </card-search>

                  <!-- modal -->
                  <div class="modal fade"
                      id="cardModal"
                      tabindex="-1"
                      role="dialog"
                      aria-labelledby=""
                      aria-hidden="true">
                      <div class="modal-dialog modal-notice">
                          <div class="modal-content">
                              @include('cards.tabs.modal')
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
