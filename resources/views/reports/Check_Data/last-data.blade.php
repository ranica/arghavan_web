<div class="col-md-3">
                                    <div class="card card-profile">
                                        <div class="card-avatar">
                                            <a @click.prevent="editTrafficStatus(record)" href="#">
                                                <img class="img" :src="record.user.people.pictureThumbUrl" />
                                            </a>
                                        </div>

                                        <div class="card-body">
                                             <!-- User Code -->
                                            <div class="row text-center">
                                                <h4>
                                                    <strong>
                                                        @{{  record.user.code }}
                                                    </strong>
                                                </h4>
                                            </div>
                                            <!-- /User Code -->

                                            <!-- User name and lastname -->
                                            <div class="row text-center">
                                                <h4>
                                                    <strong>
                                                          @{{ record.user.people.name }}
                                                          @{{ record.user.people.lastname }}
                                                    </strong>
                                                </h4>
                                            </div>
                                            <!-- /User Code -->

                                            <!-- Gate Direct -->
                                            <div class="row text-center">
                                                <h4>
                                                    <i v-show="record.gatedirect.id == 1"
                                                        class="fas fa-arrow-circle-up icon-background fa-4x"></i>
                                                     <i v-show="record.gatedirect.id == 2"
                                                        class="fas fa-arrow-circle-down icon-background fa-4x"></i>
                                                </h4>
                                            </div>
                                            <!-- /Gate Direct -->

                                             <!-- Gate Device -->
                                            <div class="row text-center">
                                                <h4>
                                                    @{{ record.gatedevice.name }}
                                                </h4>
                                            </div>
                                            <!-- /Gate Device -->

                                            <!-- Gate Date -->
                                            <div class="row text-center">
                                                <h4>
                                                  @{{ toPersian(record.gatedate) }}
                                                </h4>
                                            </div>
                                            <!-- /Gate Date -->

                                            <!-- Gate Message -->
                                            <div class="row text-center ">
                                                <h4>
                                                    <div v-show="record.gatemessage.id == 1" class="alert alert-success row">
                                                        <span class="col-md-11">@{{ record.gatemessage.message }}</span>
                                                        <a href="#" v-show="record.gatedevice.id == 1"
                                                            class="col-md-1 pull-left"
                                                            data-toggle="modal"
                                                            data-target="#removeRecordModal"
                                                            title = "حذف"
                                                            @click.prevent="readyToDelete(record)">x</a>
                                                    </div>
                                                    <div v-show="record.gatemessage.id !=  1" class="alert alert-danger">
                                                        <span>@{{ record.gatemessage.message }}</span>
                                                    </div>
                                                </h4>
                                            </div>
                                            <!-- /Gate Message -->

                                        </div>
                                    </div>
                                </div>
