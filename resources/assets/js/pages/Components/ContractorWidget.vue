<template>
    <div class="col-sm-12 mobile">

        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content f-BYekan">
                <h5 class="card-title f-BYekan">
                    {{ title }}
                </h5>
                <h4>
                    <p class="card-text"> {{ name }} </p>
                    <hr>
                    <p class="card-text"> {{ toPersian(beginDate) }} </p>
                    <hr>
                    <p class="card-text"> {{ toPersian(endDate) }} </p>
                    <hr>
                    <p class="card-text"> {{ state }} </p>
                </h4>
                <a href="#" class="btn btn-round btn-info btn-just-icon"
                    @click.prevent="editSignal">
                    <i class="material-icons">create</i>
                </a>
                <a href="#" class="btn btn-round btn-just-icon"
                    @click.prevent="deleteSignal">
                    <i class="material-icons">delete</i>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'ContractorMobile',
    props: ['myData', 'title'],
    computed:{
        name: state => state.myData.name,
        beginDate: state => state.myData.beginDate,
        endDate: state => state.myData.endDate,
        state: state => state.myData.stateStr,
    },

    methods:{
        /*
        * edit signal
        */
        editSignal(){
            this.$emit('edit-data', this.myData);
        },
        /*
        * delete signal
        */
        deleteSignal(){
            this.$emit('delete-data', this.myData);
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
    },
}
</script>
<style scoped>

</style>
