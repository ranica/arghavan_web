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
                    <p class="card-text"> دسته بندی: {{ material_type_name }} </p>
                    <hr>
                    <p class="card-text"> نام تجهیزات: {{ material_name }} </p>
                    <hr>
                    <p class="card-text"> کد اموال: {{ material_code }} </p>

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
    name:'MaterialMobile',
    props: ['myData', 'title'],
    computed:{
        material_type_name: state => state.myData.material_type.name,
        material_name: state => state.myData.name,
        material_code: state => state.myData.code,
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
