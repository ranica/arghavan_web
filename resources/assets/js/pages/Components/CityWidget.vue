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
                <h3>
                    <p class="card-text"> نام استان: {{ name_province }} </p>
                    <hr>
                    <p class="card-text"> نام شهرستان: {{ name_city }} </p>
                </h3>
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
    name:'CityMobile',
    props: ['myData', 'title'],
    computed:{
        name_city: state => state.myData.name,
        name_province: state => state.myData.province.name,
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
