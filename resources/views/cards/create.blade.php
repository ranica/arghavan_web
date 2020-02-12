 <form-wizard class="direction-rtl"
                         title=""
                         subtitle=""
                         color="#e91e63"
                         ref="register_wizard"
                         :validate-on-back="true"
                         next-button-text=""
                         back-button-text=""
                         finish-button-text="">

                         @include('cards.tabs.tab-search')
                         @include('cards.tabs.tab-user')
                         @include('cards.tabs.tab-card')
                <template slot="footer" scope="props">
                    <wizard-button class="wizard-footer-left cancel-button"
                                :style="props.fillButtonStyle"
                                @click.native="registerCancel">
                                    انصراف
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
