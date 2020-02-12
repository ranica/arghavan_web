
<form-wizard class="direction-rtl"
             title=""
             subtitle=""
             color="#e91e63"
             ref="search_wizard"
             @on-complete=""
             next-button-text=""
             back-button-text=""
             finish-button-text="">
             <!-- @on-change="wizardTabChange" -->

                @include('reports.traffic.tabs.tab-search')
                @include('reports.traffic.tabs.tab-show')

                <template slot="footer" scope="props">
                    <wizard-button class="wizard-footer-right back-button"
                                :style="props.fillButtonStyle"
                                v-show="props.activeTabIndex > 0"
                                @click.native="props.prevTab()">
                                    قبلی
                        {{-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> --}}
                    </wizard-button>

                    <wizard-button class="wizard-footer-right next-button"
                                v-show="!props.isLastStep"
                                @click.native="props.nextTab()"
                                :style="props.fillButtonStyle">
                                    بعدی
                        {{-- <i class="fa fa-check" aria-hidden="true"> بعدی</i> --}}
                    </wizard-button>
                </template>

</form-wizard>
