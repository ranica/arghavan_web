// import Store from '../Stores/DashboardStore';
import VueChartist from 'vue-chartist';
import GateWidget from '../../Components/GateWidget';
import CircularCounter from '../../Components/CircularCounter';
import SimpleCounter from '../../Components/SimpleCounter';

Vue.use(VueChartist, {
    messageNoData: "اطلاعاتی ثبت نشده است",
    classNoData: "chart-empty"
});

// Chart
const LOADING_CAR_TRAFFIC_DAILY = 1;
const LOADING_CAR_TRAFFIC_WEEKLY = 2;
const LOADING_CAR_TRAFFIC_MONTHLY = 4;

// Count data
const LOADING_CAR_TRAFFIC_PRESENTS = 8;
const LOADING_ACTIVE_ANTENNA = 16;

/* Daily chart */
const dailyChartOptions = {
    fullWidth: true,
    seriesBarDistance: 30,
    axisY: {
      labelInterpolationFnc: function (value, index) {
              return index % 2 == 0 ? value: null;
        }
    },
};

const dailyChartData = {
    labels: ["A", "B", "C"],
    series: [
        [1, 3, 2],
        [5, 1, 3]
    ]
};

/* Weekly chart */
const weeklyChartOptions = dailyChartOptions;
const weeklyChartData    = dailyChartData;

/* Monthly chart */
const monthlyChartOptions = dailyChartOptions;
const monthlyChartData    = dailyChartData;

/* pie chart */
const pieChartOptions = dailyChartOptions;
const pieChartData    = dailyChartData;

/* Instantiated VueJs */
window.x = new Vue({
    el: '#app',

    // store: Store,

    components: {
        GateWidget,
        CircularCounter,
        SimpleCounter,
    },

    data: {
        loadingStatus: 0,
        carTrafficPresentsCount: 0,
        antennaActiveCount: 0,


        dailyChartData,
        dailyChartOptions,
        weeklyChartData,
        weeklyChartOptions,
        monthlyChartData,
        monthlyChartOptions,
        pieChartData,
        pieChartOptions,

        tempRecord: {},
        options: {
            sign: 'نفر',
            bakckground: 'white',
            textFillStyle: '#26c6da',
            fontFamily: 'BYekan',
            normalLineWidth: 15,
            filledStrokeStyle: '#26c6da',
            filledLineWidth: 25,
            normalStrokeStyle: '#b3b6b7'
        }
    },

    computed: {
        //Count data
        loadingActiveAntenna: state => (state.loadingStatus & LOADING_ACTIVE_ANTENNA) == LOADING_ACTIVE_ANTENNA,
        loadingCarTrafficPresents: state => (state.loadingStatus & LOADING_CAR_TRAFFIC_PRESENTS) == LOADING_CAR_TRAFFIC_PRESENTS,
        // Chart
        loadingTrafficDaily: state => (state.loadingStatus & LOADING_CAR_TRAFFIC_DAILY) == LOADING_CAR_TRAFFIC_DAILY,
        loadingTrafficWeekly: state => (state.loadingStatus & LOADING_CAR_TRAFFIC_WEEKLY) == LOADING_CAR_TRAFFIC_WEEKLY,
        loadingTrafficMonthly: state => (state.loadingStatus & LOADING_CAR_TRAFFIC_MONTHLY) == LOADING_CAR_TRAFFIC_MONTHLY,

        aspectRatio: state => 'ct-golden-section',
        emptyRecord() {
            return {
                id: 0,
                name: '',
                ip: '',
                state: '',
                timeserver: '',
                timepass: '',
                type: '', // Logical or Physical
                gategender: {
                    id: 0
                },
                gatepass: {
                    id: 0
                },
                gatedirect: {
                    id: 0
                },
                zone: {
                    id: 0
                },
                editMode: false,
                refreshMode: false,
            };
        },

        gaterecords: state => state.$store.getters.gaterecords,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.gaterecords.length),
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadChartData();
    },

    methods: {

         /**
         * Convert gregorian date to persian
         */
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },

        /**
         * Set Loading Status
         *
         * @param      {<type>}  status  The status
         */
        setLoadingStatus(status) {
            this.loadingStatus = this.loadingStatus | status;
        },

        /**
         * Remove Loading Status
         *
         * @param      {<type>}  status  The status
         */
        removeLoadingStatus(status) {
            this.loadingStatus = this.loadingStatus & ~status;
        },

        /**
         * Refresh chart
         *
         * @param      {<type>}  type    The type
         */
        refreshChart(type) {
            if (type == 'car-traffic-daily') {
                this.loadDailyTraffics();

                return;
            }

            if (type == 'car-traffic-weekly') {
                this.loadWeeklyTraffics();

                return;
            }

            if (type == 'car-traffic-monthly') {
                this.loadMonthlyTraffics();

                return;
            }

            if (type == 'car-traffic-presents') {
                this.loadDailyCountCarTraffices();

                return;
            }

            if (type == 'antenna-active') {
                this.loadActiveCountAntennas();

                return;
            }
        },

        /**
         * Load Chart data
         */
        loadChartData() {
            // Count Data
            this.loadDailyCountCarTraffices();
            this.loadActiveCountAntennas();
            // Chart
            this.loadDailyTraffics();
            this.loadWeeklyTraffics();
            this.loadMonthlyTraffics();
           this.loadPicChart();
        },
        /**
         * Load Count Antenna
         */
        loadActiveCountAntennas() {
            let url = document.pageData.car.count_active_antenna_url;

            this.setLoadingStatus(LOADING_ACTIVE_ANTENNA);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        this.antennaActiveCount = res.data;
                        this.removeLoadingStatus(LOADING_ACTIVE_ANTENNA);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_ACTIVE_ANTENNA);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },


        /**
         * Load Present daily traffics count
         */
        loadDailyCountCarTraffices() {
            let url = document.pageData.car.count_daily_car_traffic_url;

            this.setLoadingStatus(LOADING_CAR_TRAFFIC_PRESENTS);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        this.carTrafficPresentsCount = res.data;
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_PRESENTS);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_PRESENTS);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load daily traffics chart
         */
        loadDailyTraffics() {
            let url = document.pageData.car.daily_traffic_url;

            this.setLoadingStatus(LOADING_CAR_TRAFFIC_DAILY);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        let labels = res.data.labels;
                        let series = res.data.series;

                        let result = {
                            labels: labels,
                            series: [
                                series.map(el => el.inputCount),
                                series.map(el => el.outputCount)
                            ]
                        };

                        this.dailyChartData = result;
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_DAILY);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_DAILY);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load weekly traffics chart
         */
        loadWeeklyTraffics() {
            let url = document.pageData.car.weekly_traffic_url;

            this.setLoadingStatus(LOADING_CAR_TRAFFIC_WEEKLY);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        let labels = res.data.labels;
                        let series = res.data.series;

                        let result = {
                            labels: labels,
                            series: [
                                series.map(el => el.inputCount),
                                series.map(el => el.outputCount)
                            ]
                        };

                        this.weeklyChartData = result;
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_WEEKLY);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_WEEKLY);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load monthly traffics chart
         */
        loadMonthlyTraffics() {
            let url = document.pageData.car.monthly_traffic_url;

            this.setLoadingStatus(LOADING_CAR_TRAFFIC_MONTHLY);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        let labels = res.data.labels;
                        let series = res.data.series;

                        let result = {
                            labels: labels,
                            series: [
                                series.map(el => el.inputCount),
                                series.map(el => el.outputCount)
                            ]
                        };

                        this.monthlChartData = result;
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_MONTHLY);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_CAR_TRAFFIC_MONTHLY);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

          /**
         * Load Pie chart
         */
        loadPicChart() {
            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext('2d');

            // Global Options:
            Chart.defaults.global.defaultFontColor = 'black';
            Chart.defaults.global.defaultFontSize = 12;

            var data = {
                labels: ["1", "2", "blue"],
                  datasets: [{
                        fill: true,
                        backgroundColor: [
                            "#146570",
                            "#1c8e9e",
                            "#66d8e8"
                            ],
                        data: [30, 20, 50],
                        // Notice the borderColor
                        borderColor:  ['black', 'black', 'black'],
                        borderWidth: [2,2]
                    }
                ]
            };

          // Notice the rotation from the documentation.

            var options = {
                    title: {
                              display: false,
                              // text: 'What happens when you lend your favorite t-shirt to a girl ?',
                              position: 'top',
                          },
                    rotation: -0.7 * Math.PI,
                    // animateRotate: true,
                    // animateScale: true,
                    // cutoutPercentage: 70,
            };


            var myBarChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: options
            });

        },
    }
});
