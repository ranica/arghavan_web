<!--
    gateData.refreshMode
    gateData.editMode
    gateData.deleteMode
    gateData.name
    gateData.zone.name
    gateData.gatepass
    gateData.gatedirect
    gateData.netState
    gateData.gategender
    gateData.state
-->

<template>
    <div>
        <div class="card card-chart">
            <!-- Header -->
            <div class="card-header card-header-inactive" :class="{'card-header-rose':gateStateActive}" data-header-animation="true">
                <div class="color-white text-center">
                    <i v-if="genderModeFemale" class="fa fa-female icon-background fa-10x"></i>
                    <i v-if="genderModeMale" class="fa fa-male icon-background fa-10x"></i>
                    <!-- <i v-if="genderModeMaleFemale" class="fa fa-male fa fa-female icon-background fa-10x"></i> -->
                </div>
            </div>
            <!-- /Header -->

            <div class="card-body">
                <!-- Actions -->
                <div class="card-actions">
                    <button type="button"
                            class="btn btn-info btn-link"
                            rel="tooltip"
                            data-placement="bottom"
                            title="بازخوانی"
                            v-if="refreshMode"
                            @click.prevent="refreshSignal">
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

                <h3 class="card-title">
                    {{ gateData.name }}
                    <br>
                    <small class="card-category">{{ gateData.zone.name }}</small>
                    <small class="card-category">{{ gateData.device_type.name }}</small>
                </h3>
            </div>

            <div class="card-footer">
                <div class="stats full-width">
                    <!-- Detection Mode -->
                    <span class="align-middle"  v-if="detectionModeCard">
                        <i class="far fa-credit-card icon-background fa-2x"></i>
                    </span>
                    <span class="align-middle"  v-if="detectionModeFinger">
                        <i class="fa fa-hand-pointer icon-background fa-2x"></i>
                    </span>
                    <span class="align-middle"  v-if="detectionModeFace">
                        <i class="fa fa-user-circle  icon-background fa-2x"></i>
                    </span>
                    <!-- /Detection Mode -->

                    <!-- Direction Mode -->
                    <span class="align-middle">
                        <i class="fas fa-arrow-circle-up icon-background fa-2x" v-if="directionModeOutput"></i>
                        <i class="fas fa-arrow-circle-down icon-background fa-2x" v-if="directionModeInput"></i>
                    </span>
                    <!-- /Direction Mode -->

                    <!-- Direction Mode -->
                    <span class="align-middle">
                        <i class="fa fa-wifi icon-background fa-2x" v-if="networkModeConnected"></i>
                    </span>
                    <!-- /Direction Mode -->

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
    name: 'GateWidget',

    props: ['gateData'],

    computed: {
        detectionModeCard: state => (state.gateData.gatepass.id == 2) ||
                                    (state.gateData.gatepass.id == 5) ||
                                    (state.gateData.gatepass.id == 6) ||
                                    (state.gateData.gatepass.id == 8),

        detectionModeFinger: state => (state.gateData.gatepass.id == 3) ||
                                      (state.gateData.gatepass.id == 5) ||
                                      (state.gateData.gatepass.id == 7) ||
                                      (state.gateData.gatepass.id == 8),

        detectionModeFace: state => (state.gateData.gatepass.id == 4) ||
                                    (state.gateData.gatepass.id == 6) ||
                                    (state.gateData.gatepass.id == 7) ||
                                    (state.gateData.gatepass.id == 8),

        directionModeInput: state => (state.gateData.gatedirect.id == 1) ||
                                     (state.gateData.gatedirect.id == 3),

        directionModeOutput: state => (state.gateData.gatedirect.id == 2) ||
                                      (state.gateData.gatedirect.id == 3),

        networkModeConnected: state => state.gateData.netState == 1,

        genderModeMale: state => (state.gateData.gategender.id == 2) ||
                                 (state.gateData.gategender.id == 1),
        genderModeFemale: state => (state.gateData.gategender.id == 3) ||
                                   (state.gateData.gategender.id == 1),

        refreshMode: state => state.gateData.refreshMode,
        editMode: state => state.gateData.editMode,
        deleteMode: state => state.gateData.deleteMode,

        gateStateActive: state => state.gateData.state == 1,
    },

    methods: {
        /**
         * Edit signal
         */
        editSignal(){
            this.$emit('edit-data', this.gateData);
        },

        /**
         * Delete signal
         */
        deleteSignal(){
            this.$emit('delete-data', this.gateData);
        },

         /**
         * Refresh signal
         */
        refreshSignal(){
            this.$emit('refresh-data', this.gateData);
        }
    }
};
</script>

<style scoped>
</style>
