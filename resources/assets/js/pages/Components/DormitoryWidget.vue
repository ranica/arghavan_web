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
                <h6>
                    <p class="card-text"> نام ساختمان: {{ building_name }} </p>
                    <hr>
                    <p class="card-text"> نیمسال تحصیلی: {{ semester.name }} {{term_year }} </p>
                    <hr>
                    <p class="card-text"> مقطع تحصیلی: {{ degree_name }} </p>
                    <hr>
                    <p class="card-text">برنامه تردد: {{ gatePlan_name }} </p>
                </h6>
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
    name:'DormitoryMobile',
    props: ['myData', 'title'],
    computed:{
        building_name: state => state.myData.building.name,
        degree_name: state => state.myData.degree.name,
        semester: state => state.myData.term.semester,
        term_year: state => state.myData.term.year ,
        gatePlan_name: state => state.myData.room_count,
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
        }
    },
}
</script>
<style scoped>

</style>
