                        {{-- Modal Header --}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">بررسی درخواست رسیده</h5>
                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        {{-- /Modal Header --}}

                        {{-- Modal Body --}}
                        <div class="modal-body">
                            {{-- <div class="row"> --}}
                                <div class="col-md-12">
                                    <div class="row pad-right-2em pad-left-2em">
                                        <div class="card card-profile">
                                            {{-- Image --}}
                                            <div class="card-avatar">
                                                <a href="#">
                                                    <img class="img" src= "" />
                                                </a>
                                            </div>
                                            {{-- /Image --}}

                                            <div class="card-body">
                                                <h3 class="card-category text-gray">
                                                    @{{ tempRecord.user.code }}
                                                    <br>
                                                    @{{ tempRecord.people.name}}
                                                    @{{ tempRecord.people.lastname}}
                                                </h3>

                                                <h4 class="card-title"></h4>
                                                {{-- @{{ tempRecord.user.people.name }}   @{{ tempRecord.user.people.lastname }} </h4> --}}
                                                <p class="card-description">
                                                    <div class="text-right pad-right-2em">
                                                        <div class="row">
                                                            <h4> موضوع : @{{ tempRecord.subject}} </h4>
                                                        </div>
                                                        <div class="row">
                                                            <h4> نوع مرخصی : @{{ tempRecord.vacationType.name}} </h4>
                                                        </div>
                                                        {{-- Vacation Daily --}}
                                                        <div v-show = "isDaily">
                                                            <div class="row">
                                                                <h4> تاریخ شروع مرخصی :  @{{ tempRecord.begin_date }}</h4>
                                                            </div>
                                                            <div class="row">
                                                                <h4>تاریخ پایان مرخصی :  @{{ tempRecord.begin_date }}</h4>
                                                            </div>
                                                        </div>
                                                        {{-- Vacation Daily --}}

                                                        {{-- Vacation Clock --}}
                                                        <div v-show = "isClock">
                                                            <div class="row">
                                                                <h4> تاریخ مرخصی :  @{{ tempRecord.begin_date }}</h4>
                                                            </div>
                                                            <div class="row">
                                                                <h4>از ساعت :  @{{ tempRecord.begin_hour }}</h4>
                                                            </div>
                                                            <div class="row">
                                                                <h4>تا ساعت :  @{{ tempRecord.finish_hour }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                        {{-- /Modal Body --}}

                        {{-- Modal Footer --}}
                        <div class="modal-footer justify-content-center">
                            <span class="pull-left">

                                <button v-show="tempRecord.responsed_at == null"
                                        type="button"
                                        class="btn btn-info btn-round"
                                        @click.prevent="acceptRecord(tempRecord)">پذیرش درخواست
                                </button>

                                <button v-show="tempRecord.responsed_at == null"
                                        type="button"
                                        class="btn btn-info btn-round"
                                        @click.prevent="rejectRecord(tempRecord)">رد درخواست
                                </button>

                                 <button type="button"
                                        class="btn btn-info btn-round"
                                        @click.prevent="hideModal"
                                        data-dismiss="modal">انصراف
                                </button>
                            </span>
                        </div>
                        {{-- /Modal Footer --}}








