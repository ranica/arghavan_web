<!-- {{-- document.getElementById('nationalId').addEventListener ('blur', function (){alert('blured')}) --}} -->
    <form-wizard class="direction-rtl"
             title=""
             subtitle=""
             color="#e91e63"
             ref="register_wizard"
             :validate-on-back="true"
             @on-complete="saveRecord"
             next-button-text=""
             back-button-text=""
             finish-button-text="">
             <!-- @on-change="wizardTabChange" -->

                @include('people.tabs.tab-user')
                @include('people.tabs.tab-person')
				@include('people.tabs.tab-otherInfo')
				@include('people.tabs.tab-card')
				@include('people.tabs.tab-image')

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
								@click.native="changeTab(props, 'prev')">
									قبلی
						{{-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> --}}
					</wizard-button>

					<wizard-button class="wizard-footer-right next-button"
								v-if="!props.isLastStep"
								@click.native="changeTab(props, 'next')"
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

