<template>
    <div>
        <div class="card card-chart">
            <!-- Header -->
            <div class="card-header resize card-header-inactive card-header-info" data-header-animation="true" >
                <div class="color-white text-center">
                   <h3>
                        {{ carData.plate_first }}
                        {{ carData.plate_word }}
                        {{ carData.plate_second }}  -
                        {{ carData.car_plate_city.key }}
                   </h3>
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

                <h3 class="card-title">
                    {{ carData.users[0].people.name }}
                    {{ carData.users[0].people.lastname }}
                    <br>
                    <small class="card-category">{{ carData.users[0].code }}</small>
                    <br>
                    <small class="card-category">{{ carData.users[0].people.nationalId }}</small>
                </h3>
                <i class="fa fa-circle text-info"></i> {{ carData.car_type.name }}
                <i class="fa fa-circle text-info"></i> {{ carData.car_plate_type.name }}
                <i class="fa fa-circle text-info"></i> {{ carData.car_color.name }}
                <br>
                <span class="align-middle" >
                    <i class="fas fa-calendar-alt"> </i>
                    {{ toPersian(carData.card.endDate) }}
                </span>
            </div>

            <div class="card-footer">
                <div class="stats full-width">
                    <span class="align-middle" >
                        {{ carData.users[0].group.name }}
                    </span>
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
    name: 'CarWidget',

    props: [
        'carData',
    ],

    computed: {
        refreshMode: state => state.carData.refreshMode,
        editMode: state => state.carData.editMode,
        deleteMode: state => state.carData.deleteMode,
    },

    methods: {
        /**
         * Edit signal
         */
        editSignal(){
            this.$emit('edit-data', this.carData);
        },

        /**
         * Delete signal
         */
        deleteSignal(){
            this.$emit('delete-data', this.carData);
        },

         /**
         * Refresh signal
         */
        refreshSignal(){
            this.$emit('refresh-data', this.carData);
        },
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },

    }
};
</script>

<style scoped>
    .card-chart .card-header {
        min-height: 0 !important;
    }


</style>
