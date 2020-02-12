<template>
    <div>
        <div class="cards">
            <div class="card card-pricing card-raised">
                <div class="card-body">
                    <div class="card-icon icon-rose">
                        <i class="fas fa-parking icon-cog"></i>
                    </div>
                    <h3 class="card-title"> {{ baseData.name }}</h3>
                    <p class="card-description">

                    </p>
                    <div class="row text-center">
                        <a href="#"
                            class="btn btn-round btn-info btn-just-icon pull-center"
                            @click.prevent="editSignal">
                            <i class="material-icons">create</i>
                            <div class="ripple-container"></div>
                        </a>
                        <a href="#"
                            class="btn btn-round btn-just-icon pull-center"
                            @click.prevent="deleteSignal">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'BaseCarWidget',

    props: ['baseData'],

    computed: {
        editMode: state => state.baseData.editMode,
        deleteMode: state => state.baseData.deleteMode,

        stateActive: state => state.baseData.state == 1,
    },

    methods: {
        /**
         * Edit signal
         */
        editSignal(){
            this.$emit('edit-data', this.baseData);
        },
        /**
         * Delete signal
         */
        deleteSignal(){
            this.$emit('delete-data', this.baseData);
        },
    }
};
</script>

<style scoped>
</style>
