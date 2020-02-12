<template>
    <div>
        <div class="cards">
            <div class="card card-pricing card-raised">
                <div class="card-body">
                    <div class="card-icon icon-rose">
                        <i class="fas fa-parking" :class="{'icon-cog':stateActive}"></i>
                    </div>
                    <h3 class="card-title"> {{ siteData.capacity }}</h3>
                    <p class="card-description">
                       {{ siteData.name }}
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
    name: 'SiteWidget',

    props: ['siteData'],

    computed: {
        editMode: state => state.siteData.editMode,
        deleteMode: state => state.siteData.deleteMode,

        stateActive: state => state.siteData.state == 1,
    },

    methods: {
        /**
         * Edit signal
         */
        editSignal(){
            this.$emit('edit-data', this.siteData);
        },

        /**
         * Delete signal
         */
        deleteSignal(){
            this.$emit('delete-data', this.siteData);
        },
    }
};
</script>

<style scoped>
</style>
