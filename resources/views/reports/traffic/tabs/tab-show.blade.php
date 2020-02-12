<tab-content title="نمایش گزارش"
             icon="fas fa-print">
      <div class="card">
          <!-- Card Header -->
        <div class="card-header card-header-icon" data-background-color="rose">
              <i class="fas fa-chart-pie fa-2x"></i>
        </div>
        <!-- /Card Header -->
        <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-9 col-lg-offset-1">
                <form>
                    {{-- <div class="card-body"> --}}
                    <div class="table-responsive">
                        <table class="table table-striped">

                          <thead>
                            <tr>
                              <th class="text-center">کد کاربری</th>
                              <th class="text-center"> نام</th>
                              <th class="text-center">نام خانوادگی</th>
                              <th class="text-center">تاریخ تردد</th>
                              <th class="text-center">پیام</th>
                              <th class="text-center">مسیر تردد</th>

                            </tr>
                          </thead>
                          <tbody>
                            <tr v-if="isLoading">
                              <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                            </tr>
                               <tr v-for="record in records">
                                  <td class="text-center"> @{{ record.user.code }}</td>
                                  <td class="text-center"> @{{ record.people.name }}</td>
                                  <td class="text-center"> @{{ record.people.lastname }}</td>
                                  <td class="text-center">  @{{ toPersian(record.gatetraffic.gatedate) }}</td>
                                  <td class="text-center"> @{{ record.gatemessage.name }}</td>
                                  <td class="text-center"> @{{ record.gatedirect.name }}</td>
                                </tr>
                          </tbody>
                        </table>
                         <div class="text-center">
                            <pagination :data="allData"
                                        v-on:pagination-change-page="showRecord"
                                        :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                        :show-disable= true>
                            </pagination>
                        </div>
                    </div>

                    <span class="pull-left" v-show = "is_search">
                        <a class="btn btn-success confg"
                            href="#"
                            @click.prevent="exportTrafficExcel"
                            title="خروجی اکسل">
                          <i class="fas fa-file-excel fa-2x"></i>
                        </a>
                        <a class="btn btn-rose confg"
                            href="#"
                            @click.prevent="exportTrafficPDF"
                            title="خروجی پی دی اف">
                          <i class="fas fa-file-pdf fa-2x"></i>
                      </a>
                    </span>
                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
</tab-content>
