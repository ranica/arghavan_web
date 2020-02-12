<template>
    <div class="card card-stats">
        <div class="card-header" :data-background-color="backgroundColor">
            <i class="material-icons">{{ icon }}</i>
        </div>

        <div class="card-content">
            <div v-show="isLoading" class="text-center color-black">
                <i class="fas fa-sync-alt fa-spin fa-fw fa-4x"></i>
            </div>
            <h2 class="card-title" v-show="! isLoading"> {{ value }}</h2>
        </div>

        <div class="card-footer" v-show="! isLoading">
            <div class="stats">
                <h4>
                    <i v-show="showRefresh"
                        class="fas fa-sync-alt fa-2x pd-right-05em pd-left-05em cursor-pointer"
                        @click.prevent="refreshChart">
                    </i>

                    <a href="#" @click="titleClicked">
                        <i class="fa fa-circle text-info"></i> {{ text }}
                    </a>
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SimpleCounter',

    props: {
        itemKey: {  type: String, default : '' },
        value : { required: true, default: '0'},
        text : { type: String, default: 'SIMPLE CHART'},
        icon : { type: String, default: 'equalizer'},
        backgroundColor : { type: String, default: 'blue'},
        isLoading : { type: Boolean, default: false},
        showRefresh: { type: Boolean, default: true}
    },

    data() {
        return {
            canvas : {}
        };
    },

    mounted() {
        this.refreshChart();
    },

    methods: {
        refreshChart(){
            this.$emit('on-refresh');
        },

        titleClicked (){
            this.$emit ('title-click', this.itemKey);
        }
    }
};
</script>

<style scoped>
</style>
