@extends('layouts.app')

@section('content')

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <span class="panel-heading"> test picture </span>
                <div class="card-content">
                    <div class="card-header card-header-tabs card-header-rose" >
                        بررسی تصویر
                    </div>
                    <div class="row">
                       <form-wizard class="direction-rtl"
                            ref="test_wizard"
                             title=""
                             subtitle=""
                             color="#e91e63"
                             @on-complete="saveRecord"
                             next-button-text=""
                             back-button-text=""
                             finish-button-text="">
                                @include('wizard-test.tabs.second')

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
                                                {{-- @{{props.isLastStep ? 'Done' : 'Next'}} --}}
                                                {{-- <i class="fa fa-check" aria-hidden="true"></i> --}}
                                    </wizard-button>
                                </template>
                       </form-wizard>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ mix('js/test.js') }}"></script>
@endsection
