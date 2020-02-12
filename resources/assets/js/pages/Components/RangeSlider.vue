<template>
  <div>
    <div>value: {{ value }}</div>
    <vue-range-slider
      v-model="value">
    </vue-range-slider>
  </div>
</template>
<script>
export default {
    name:'VueSlider',
    props: {
      value: [0, 50],

    },
    computed:{
     //   name: state => state.myData.name,
    },

    methods:{

    },
}
</script>
<style scoped>

</style>


<template>

</template>
