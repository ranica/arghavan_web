 <div class="card">
    <div class="card-content">

        <h3 class="card-title">
            <div>
                <i class="fas fa-gas-pump"></i>
                <span class="panel-heading">سوخت خودرو</span>

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

                <div v-if="! hasFuelRows">
                    <h4 class="text-center f-BYekan">
                        رکوردی ثبت نشده است
                    </h4>
                </div>

                <div v-for="record in car_fuels">
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-header card-header-icon card-header-rose">
                            </div>

                            <div class="card-body">
                                <div class="row"></div>
                                <div class="row text-center">
                                    @{{ record.name }}
                                </div>
                                <div class="row text-center">
                                    @can('command_edit')
                                        <a href="#"
                                            class="btn btn-round btn-info btn-just-icon pull-center"
                                            @click.prevent="editRecord(record)">
                                            <i class="material-icons">create</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                    @can('command_delete')
                                        <a href="#"
                                            class="btn btn-round btn-just-icon pull-center"
                                            data-toggle="modal"
                                            data-target="#removeRecordModalFuel"
                                            @click.prevent="readyToDelete(record, Fuel)">
                                            <i class="material-icons">delete</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="row"></div>
                <div class="text-center">
                    <pagination :data="car_fuels_paginate"
                                v-on:pagination-change-page="loadCarFuels"
                                :limit="{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                :show-disable= "true">
                    </pagination>
                </div>
            </div>
            {{-- /Data List --}}

            {{-- Register Form --}}
            <div v-if="isRegisterMode">
                @include('base-parking.fuel.create')
            </div>
            {{-- /Register Form --}}

           <!-- small modal -->
            <div class="modal fade"
                id="removeRecordModalFuel"
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
                                    @click.prevent="deleteRecord('carFuels')">بله
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--    end small modal -->
        </div>
    </div>
</div>

