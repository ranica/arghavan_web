<div class="card">
    <div class="card-content">

        <h3 class="card-title">
            <div>
                <i class="fas fa-parking fa-2x"></i>
                <span class="panel-heading">پارکینگ</span>

                @can('command_insert')
                    <!-- Pc size -->
                    <span class="pull-left pc" v-show="isNormalMode">
                        <a class="btn btn-rose btn-round"
                            href="#"
                            @click.prevent="newRecord">
                            <span class="glyphicon glyphicon-plus"></span>
                            ثبت رکورد جدید
                        </a>
                    </span>

                    <!--  mobile size -->
                    <span class="mobile" v-show="isNormalMode">
                        <a class="btn btn-round btn-rose"
                            href="#"
                            @click.prevent="newRecord">
                            <span class="glyphicon glyphicon-plus"></span>
                            ثبت رکورد جدید
                        </a>
                    </span>
                @endcan
            </div>
        </h3>
        <div class="row"></div>

        <div class="row">
            {{-- Data list --}}
            <div v-show="isNormalMode">

                <div v-if="! hasCarSiteRows">
                    <h4 class="text-center f-BYekan">
                        رکوردی ثبت نشده است
                    </h4>
                </div>
                <site-widget class="col-md-2"
                             v-for="record in car_sites"
                             :site-data="record"
                             v-on:edit-data="editRecord"
                             v-on:delete-data="readyToDeleteSiteCar(record, CarSite)">
                </site-widget>
                <pagination :data="car_sites_paginate"
                            v-on:pagination-change-page="loadCarSites"
                            :limit="{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                            :show-disable= "true">
                </pagination>
            </div>
        </div>
        {{-- /Data List --}}

        {{-- Register Form --}}
        <div v-if="isRegisterMode">
            @include('base-parking.site.create')
        </div>
        {{-- /Register Form --}}

        <!-- small modal -->
        <div class="modal fade"
            id="removeRecordModalSiteCar"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-small ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-hidden="true">
                                <i class="material-icons">delete</i>
                        </button>
                    </div>

                    <div class="modal-body text-center">
                        <h5>برای حذف اطمینان دارید؟ </h5>
                    </div>

                    <div class="modal-footer text-center">
                        <button type="button"
                                class="btn btn-label"
                                data-dismiss="modal">خیر
                        </button>

                        <button type="button"
                                class="btn btn-rose"
                                data-dismiss="modal"
                                @click.prevent="deleteRecord('carSites')">بله
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--    end small modal -->
    </div>
</div>

