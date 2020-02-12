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
                    <p class="card-text"> نوع ساختمان: {{ building_type_name }} </p>
                    <hr>
                    <p class="card-text"> نام بلوک: {{ block_name }} </p>
                    <hr>
                    <p class="card-text">تعداد طبقه: {{ building_floor_count }} </p>
                    <hr>
                    <p class="card-text">تعداد اتاق: {{ building_room_count }} </p>
                   
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
    name:'BuildingMobile',
    props: ['myData', 'title'],
    computed:{
        building_type_name: state => state.myData.building_type.name,
        block_name: state => state.myData.block.name,
        building_name: state => state.myData.name,
        building_room_count: state => state.myData.room_count,
        building_floor_count: state => state.myData.floor_count,
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
