<!--
    vacationData.refreshMode
    vacationData.editMode
    vacationData.deleteMode
    vacationData.name
    vacationData.zone.name
    vacationData.gatepass
    vacationData.gatedirect
    vacationData.netState
    vacationData.gategender
    vacationData.state
-->

<template>
    <div>
        <div class="card card-chart">
            <!-- Header -->
            <div class="card-header card-header-inactive" :class="{'card-header-rose':true}" data-header-animation="true">
                <div class="color-white text-center">
                    <h3 class ="row">
                        {{ vacationData.subject }}
                    </h3>

                    <!-- Vacation type -->
                    <h5 class ="row">
                        <i v-if="vacationModeDailyType" class="fa fa-calendar-check-o fa-8x" aria-hidden="true"></i>
                        <i v-if="vacationModeClockType" class="fa fa-clock fa-8x"></i>
                        <div class="row">
                            {{ vacationData.vacation_type.name}}
                        </div>
                    </h5>
                    <!-- /Vacation type -->
                </div>
            </div>
            <!-- /Header -->

            <div class="card-body">
                <!-- Actions -->
                <div class="card-actions">
                    <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="بازخوانی" v-if="refreshMode" @click.prevent="refreshSignal">
                        <i class="material-icons">refresh</i>
                    </button>

                    <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="ویرایش" v-if="editMode" @click.prevent="editSignal">
                        <i class="material-icons">edit</i>
                    </button>

                    <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="حذف" v-if="deleteMode" @click.prevent="deleteSignal">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- /Actions  -->

                <h4 class="card-title">
                    <div v-if="vacationModeDailyType" >
                        <div class ="row text-center">
                            {{ toPersian(vacationData.begin_date) }}
                        </div>
                        <div class ="row text-center">
                            الی
                            {{ toPersian(vacationData.finish_date) }}
                        </div>
                    </div>

                    <div v-if="vacationModeClockType" >
                        <div class ="row text-center">
                            {{ toPersian(vacationData.begin_date) }}
                        </div>
                        <div class ="row text-center">
                            {{ toTime(vacationData.begin_hour) }}
                            الی
                            {{ toTime(vacationData.finish_hour) }}
                       </div>
                    </div>
                </h4>
            </div>

            <div class="card-footer">
                <div class="stats full-width">

                    <!-- Check Mode -->
                    <span class="align-middle">
                        <i class="fa fa-eye fa-2x text-success" v-if="checkModeSeen"></i>
                        <i class="fa fa-eye-slash fa-2x text-warning" v-if="! checkModeSeen"></i>
                        <i class="fa fa-hourglass-start icon-background fa-2x text-warning" v-if="checkModeChecking"></i>
                        <i class="fa fa-check-circle text-success fa-2x" v-if="checkModeAccept"></i>
                        <i class="fa fa-ban text-danger fa-2x" v-if="checkModeReject"></i>
                    </span>
                    {{ vacationData.vacation_status.name}}
                    <!-- /Check Mode -->

                    <!-- Slot -->
                    <span class="full-width text-left flex-row">
                        <slot></slot>
                    </span>
                    <!-- /Slot -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'VacationWidget',

    props: ['vacationData'],

    computed: {
        checkModeChecking: state => state.vacationData.vacation_status.id == 1,
        checkModeAccept: state => state.vacationData.vacation_status.id == 2,
        checkModeReject: state => state.vacationData.vacation_status.id== 3,
        checkModeSeen: state => state.vacationData.seen_at != null,

        vacationModeDailyType: state => state.vacationData.vacation_type.id == 1,
        vacationModeClockType: state => state.vacationData.vacation_type.id == 2,


        refreshMode: state => state.vacationData.refreshMode,
        editMode: state => (state.vacationData.editMode == true) &&
                           (state.vacationData.seen_at == null),
        deleteMode: state => (state.vacationData.deleteMode)  &&
                           (state.vacationData.seen_at == null),

        vacationStateActive: state => state.vacationData.state == 1,
    },

    methods: {
        /**
         * Edit signal
         */
        editSignal(){
            this.$emit('edit-data', this.vacationData);
        },

        deleteSignal(){
            this.$emit('delete-data', this.vacationData);
        },
         /**
         * Refresh signal
         */
        refreshSignal(){
            this.$emit('refresh-data', this.vacationData);
        },
         /**
         * Convert gregorian date to persian
         */
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },

        toTime(gDate){
            return window.Helper.gregorianToJalaaliByTime(gDate).split(' ')[1];;
        },
    }
};
</script>

<style scoped>
</style>
