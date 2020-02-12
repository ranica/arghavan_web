<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">
<form-wizard class="direction-rtl"
             title=""
             subtitle=""
             color="#e91e63"
             ref="register_wizard"
             @on-complete=""
             next-button-text=""
             back-button-text=""
             finish-button-text="">
             <!-- @on-change="wizardTabChange" -->

                @include('referrals.tab-user')
                @include('referrals.tab-image')

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
                    </wizard-button>

                    <wizard-button class="wizard-footer-right next-button"
                                v-if="!props.isLastStep"
                                @click.native="props.nextTab()"
                                :style="props.fillButtonStyle">
                                    بعدی
                    </wizard-button>

                    <wizard-button v-else @click.native="saveRecord"
                                class="wizard-footer-right finish-button"
                                :style="props.fillButtonStyle">
                                پایان
                    </wizard-button>
                </template>
    </form-wizard>
</div>
