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
                    <p class="card-text"> شماره اتاق: {{ room_number }} </p>
                    <hr>
                    <p class="card-text"> شماره طبقه: {{ room_floor }} </p>
                    <hr>
                    <p class="card-text"> ظرفیت اتاق: {{ room_capacity }} </p>
                    <hr>
                    <p class="card-text">جنسیت اتاق: {{ room_gender_name }} </p>
                    <hr>
                    <p class="card-text">نام ساختمان: {{ room_building_name }} </p>

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
    name:'RoomMobile',
    props: ['myData', 'title'],
    computed:{
        room_number: state => state.myData.number,
        room_capacity: state => state.myData.capacity,
        room_floor: state => state.myData.floor,
        room_building_name: state => state.myData.building.name,
        room_gender_name: state => state.myData.gender.gender,
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
