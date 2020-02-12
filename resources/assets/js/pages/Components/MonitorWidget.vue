<template>
    <div>
        <div class="card card-profile" >
            <div class="card-avatar">
                <a href="#">
                    <img class="img" :src="gateData.user.people.pictureThumbUrl" />
                </a>
            </div>
            <div  class="card-body" :data-bg-color="backgroundColor" >
                <h6 class="card-category text-gray"> {{  gateData.user.code }}</h6>
                <h6 class="card-title">
                    {{ gateData.user.people.name }}
                    {{ gateData.user.people.lastname }}
                </h6>
                <p class="card-description">
                    <div class="row">
                        <i v-if="gateMessageMode" class="fas fa-check-circle icon-background fa-2x"></i>
                        <i v-if="! gateMessageMode" class="fas fa-ban icon-background fa-2x"></i>
                        {{ gateData.gatemessage.message }}
                    </div>
                    <hr>
                     <div class="row text-center">
                        <i class="far fa-calendar-alt fa-2x"></i>
                        {{ toPersian(gateData.gatedate) }}
                    </div>
                    <hr>
                    <!-- <span class="align-middle"> -->
                    <span class="btn btn-primary btn-round design btn-fab text-center"
                        title="شماره دستگاه">
                        {{ gateData.gatedevice.number }}
                    </span>
                    <button class="btn btn-success btn-round design btn-fab text-center"
                            v-if="detectionModePass"
                            title="ورود">
                        <i class="fas fa-arrow-circle-up fa-2x" ></i>
                    </button>
                    <button class="btn btn-rose btn-round design btn-fab text-center"
                            v-if="detectionModeDontPass"
                            title= "خروج">
                        <i class="fas fa-arrow-circle-down fa-2x" ></i>
                    </button>

                  </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MonitorWidget',

    props: ['gateData'],

    computed: {

        detectionModePass: state => (state.gateData.gatedirect.id == 1),
        detectionModeDontPass: state => (state.gateData.gatedirect.id == 2),
        gateMessageMode: state => (state.gateData.gatemessage.id == 1),
        backgroundColor: state => (state.gateData.degree.color),


        editMode: state => state.gateData.editMode,
        deleteMode: state => state.gateData.deleteMode,
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
        },

        toPersian(gDate) {
            return window.Helper.gregorianToJalaaliByTime(gDate);
        },

        setColor(){
            // if (this.backgroundColor == 1)
            name = "marjan";
            return name.toLowerCase();
            // if (value == 1){
            //     backgroundColor = "blue";
            //     return "blue";
            // }
            // else if (value == 2){
            //     backgroundColor = "rose";
            //     return "rose"
            // }
            // else{
            //     backgroundColor = "white";
            //     return "white"
            // }
        },

    }
};
</script>

<style scoped>
</style>
