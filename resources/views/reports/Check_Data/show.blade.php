 <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
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
                                        :limit= {{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}
                                        :show-disable= true>
                            </pagination>
                        </div>
                       {{--    <div>
                            count : @{{ records[0].gatetraffic.count}}
                          </div> --}}

                      </div>
                </form>
            </div>
        </div>
        <!-- /Card Content -->
    </div>
