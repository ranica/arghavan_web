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
                    <p class="card-text"> {{ semester.name }} {{ year }}</p>
                    <hr>
                    <p class="card-text"> {{ toPersian(startDate) }} </p>
                    <hr>
                    <p class="card-text"> {{ toPersian(endDate) }} </p>
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
    name:'TermMobile',
    props: ['myData', 'title'],
    computed:{
        year: state => state.myData.year,
        semester: state => state.myData.semester,
        startDate: state => state.myData.startDate,
        endDate: state => state.myData.endDate,
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
