<!--
    referralData.editMode
    referralData.searchMode
    referralData.saveMode
    referralData.name
    referralData.count
-->

<template>
    <div>
        <div class="card card-chart">
            <!-- Header -->
            <div class="card-header card-header-inactive" :class="{'card-header-rose':true}" data-header-animation="true">
                <div class="color-white text-center">
                    <h3 class ="row">
                        {{ referralData.name }}
                    </h3>

                    <!-- referral count -->
                    <h5 class ="row">
                        <div class="row">
                            <h2>
                                {{ referralData.count}}
                            </h2>
                        </div>
                    </h5>
                    <!-- /referral count -->
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
                            title="بررسی" 
                            v-if="searchMode" 
                            @click.prevent="searchSignal">
                            <span class="glyphicon glyphicon-search"></span>
                    </button>

                    <button type="button" 
                            class="btn btn-default btn-link" 
                            rel="tooltip" 
                            data-placement="bottom" 
                            title="ذخیره" 
                            v-if="saveMode" 
                            @click.prevent="saveSignal">
                            <span class="glyphicon glyphicon-plus"></span>
                        
                    </button>

                    <button type="button" 
                            class="btn btn-default btn-link" 
                            rel="tooltip" 
                            data-placement="bottom" 
                            title="ویرایش" 
                            v-if="editMode" 
                            @click.prevent="editSignal">
                        <i class="material-icons">edit</i>
                    </button>
                </div>
                <!-- /Actions  -->

                <h4 class="card-title">
                    test
                </h4>
            </div>

            <div class="card-footer">
                <div class="stats full-width">

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
    name: 'ReferralWidget',

    props: ['referralData'],

    computed: {

        searchMode: state => state.referralData.searchMode,
        editMode: state => state.referralData.editMode,
        saveMode: state =>  state.referralData.saveMode,
    },

    methods: {
        /**
         * Edit signal
         */
        editSignal(){
            this.$emit('edit-data', this.referralData);
        },
        /**
         * Save signal
         */
        saveSignal(){
            this.$emit('save-data', this.referralData);
        },
         /**
         * Search signal
         */
        searchSignal(){
            this.$emit('search-data', this.referralData);
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
