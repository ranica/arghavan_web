<form-wizard class="direction-rtl"
            ref="car_wizard"
             title=""
             subtitle=""
             color="#e91e63"
             @on-complete="saveRecord"
             next-button-text=""
             back-button-text=""
             finish-button-text="">
                @include('cars.tabs.tab-search')
                @include('cars.tabs.tab-user')
                @include('cars.tabs.tab-car')
                @include('cars.tabs.tab-tag')

                <template slot="footer" scope="props">
                    <wizard-button class="wizard-footer-left cancel-button"
                                :style="props.fillButtonStyle"
                                @click.native="registerCancel">
                                    انصراف
                        {{-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> --}}
                    </wizard-button>
                    <wizard-button class="wizard-footer-right back-button"
                                :style="props.fillButtonStyle"
                                v-if="props.activeTabIndex > 0"
                                @click.native="props.prevTab()">
                                    قبلی
                        {{-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> --}}
                    </wizard-button>

                    <wizard-button class="wizard-footer-right next-button"
                                v-if="!props.isLastStep"
                                @click.native="props.nextTab()"
                                :style="props.fillButtonStyle">
                                    بعدی
                        {{-- <i class="fa fa-check" aria-hidden="true"> بعدی</i> --}}
                    </wizard-button>

                    <wizard-button v-else @click.native="saveRecord"
                                class="wizard-footer-right finish-button"
                                :style="props.fillButtonStyle">
                                پایان
                                {{-- @{{props.isLastStep ? 'Done' : 'Next'}} --}}
                                {{-- <i class="fa fa-check" aria-hidden="true"></i> --}}
                    </wizard-button>
                {{-- <div class="wizard-footer-center">
                </div> --}}

                </template>

</form-wizard>
