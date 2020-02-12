<template>
    <canvas class="drawing-canvas" id="canvas" ref="canvas"></canvas>
</template>
<script>
export default {
    name: 'CircularCounter',
    props: ['options', 'percentage'],
    data() {
        return {
            canvas : {}
        };
    },

    mounted() {
        this.canvas = this.$refs.canvas;
        this.redraw();
    },

    methods: {
        /**
         * { function_description }
         *
         * @param      {number}  deg     The degrees
         * @return     {number}  { description_of_the_return_value }
         */
        degreesToRadians(deg) {
            return (deg / 180) * Math.PI;
        },

        /**
         * convert the percentage into degrees
         *
         * @param      {number}  percentage  The percentage
         * @return     {<type>}  { description_of_the_return_value }
         */
        percentToRadians(percentage) {
            let degrees = percentage * 360 / 100;

            // and so that arc begins at top of circle (not 90 degrees) we add 270 degrees
            return this.degreesToRadians(degrees + 270);
        },

        /**
         * Draw Percentage circle
         *
         * @param      {string}  percentage  The percentage
         * @param      {number}  radius      The radius
         * @param      {<type>}  canvas      The canvas
         */
        redraw() {
            let canvas = this.canvas;
            let percentage = this.percentage;
            let options = this.options;

            let context = canvas.getContext('2d');
            let x = canvas.width / 2;
            let y = canvas.height / 2;
            let startAngle = this.percentToRadians(0);
            let endAngle = this.percentToRadians(percentage);

            // set to true so that we draw the missing percentage
            let counterClockwise = true;
            let radius = 0;

            if (canvas.height < canvas.width) {
                radius = canvas.height / 3;
            } else {
                radius = canvas.width / 3;
            }

            // Prepare
            options.background = options.bakckground == undefined ? 'white' : options.background;
            options.sign = options.sign == undefined ? '%' : options.sign;
            options.filledLineWidth = options.filledLineWidth == undefined ? 15 : options.filledLineWidth;
            options.normalLineWidth = options.normalLineWidth == undefined ? 15 : options.normalLineWidth;
            options.normalStrokeStyle = options.normalStrokeStyle == undefined ? 'black' : options.normalStrokeStyle;
            options.filledStrokeStyle = options.filledStrokeStyle == undefined ? 'green' : options.filledStrokeStyle;
            options.textFillStyle = options.textFillStyle == undefined ? 'green' : options.textFillStyle;
            options.fontFamily = options.fontFamily == undefined ? 'arial' : options.fontFamily;

            // Setup
            canvas.style.backgroundColor = options.background;

            context.beginPath();
            context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
            context.lineWidth = options.normalLineWidth;

            // line color
            context.strokeStyle = options.normalStrokeStyle;
            context.stroke();

            // set to false so that we draw the actual percentage
            counterClockwise = false;
            context.beginPath();
            context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
            context.lineWidth = options.filledLineWidth;

            // line color
            context.strokeStyle = options.filledStrokeStyle;
            context.stroke();

            // now draw the inner text
            context.font = radius / 2.5 + "px " + options.fontFamily;
            context.fillStyle = options.textFillStyle;
            context.textAlign = "center";

            // baseline correction for text
            context.fillText(percentage + options.sign, x, y * 1.05);
        }
    }
};
</script>

<style scoped>
</style>
