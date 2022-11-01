<template>
  <div class="w-100 ">
    <div class="row">
      <div class="col-md-8">
        <h3 style="font-weight: 500; color: #333; font-size: 18px">
          Dashboard
        </h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="w-100 cp-card cp-dashboard-menu p-4">
              <h5>Egg Producers</h5>
              <div class="cp-menu-values">
                <div class="row">
                  <div class="col-md-7">
                    <h2>{{content.reports}}</h2>
                    <!-- <p class="red"><i class="fas fa-long-arrow-alt-down"></i><span>0%</span></p> -->
                  </div>
                  <div class="col-md-5">
                    <div class="cp-menu-chart">
                      <SmallGraph width="100%" id="bar1" color="#54d8ff" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="w-100 cp-card cp-dashboard-menu p-4">
          <h5>Bulking Centers</h5>
          <div class="cp-menu-values">
            <div class="row">
              <div class="col-md-7">
                <h2>{{centers["all"]}}</h2>
                <!-- <p class="red"><i class="fas fa-long-arrow-alt-down"></i><span>0%</span></p> -->
              </div>
              <div class="col-md-5">
                <div class="cp-menu-chart">
                  <SmallGraph width="100%" id="bar2" color="#54d8ff" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="w-100 cp-card cp-dashboard-menu p-4">
          <h5>Current Price/KG of Eggs (UGX)</h5>
          <div class="cp-menu-values">
            <div class="row">
              <div class="col-md-7">
                <h2>{{latestPrice["newprice"]}}</h2>
                <!-- <p class="green"><i class="fas fa-long-arrow-alt-up"></i><span>0%</span></p> -->
              </div>
              <div class="col-md-5">
                <div class="cp-menu-chart">
                  <SmallGraph width="100%" id="bar3" color="#54d8ff" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row ml-1">
      <div class="col-8 cp-card p-3 graph-card mt-3">
        <div class="row">
          <div class="col-md-9" v-if="cooperative.name == ''">
            <h3
              class="cp-h3 pt-2"
              style="font-size: 15px; font-weight: 400; color: #666"
            >
              Data by Pristine Foods Limited Staff
            </h3>
          </div>
          <div class="col-md-9" v-else>
            <h3
              class="cp-h3 pt-2"
              style="font-size: 15px; font-weight: 400; color: #666"
            >
              Resilience Trends
            </h3>
          </div>
          <div class="col-md-3">
            <select name="#" id="#" class="form-control">
              <option value="30">Last 30 days</option>
              <option value="6">Last 6 months</option>
              <option value="12">Last Year</option>
              <option value="12">All</option>
            </select>
          </div>
        </div>

        <LineGraph
          class="mt-3"
          id="graph-trend"
          width="100%"
          height="320px"
        ></LineGraph>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="cp-card cp-dashboard-menu p-4" style="height: 38em">
              <div class="row">
                <div class="col-14">
                  <h5 class="d-inline">Egg Producer Regions</h5>
                  <h6
                    class="text-primary d-inline ml-3"
                    style="font-size: 10px"
                  >
                    <a href="#">See least Common</a>
                  </h6>
                </div>
              </div>
              <div class="cp-menu-values">
                <div class="row"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LineGraph from "../common/LineGraph";
import SmallGraph from "../common/SmallGraph";
import IziToast from "../mixins/IziToast";
import Request from "../mixins/requestHelper";


export default {
  name: "admin-dashboard-content",
  props: ["user", "allCooperatives", "detail", "selectedCooperative"],
  components: { SmallGraph, LineGraph },
  mixins: [IziToast],
  data() {
    return {
      session: null,
      value: 0,
      cooperatives: [],
      latestPrice: {},
      centers: [],
      content: [],
      details: {},
      cooperative: {
        id: "",
        name: "",
      },
    };
  },
  mounted() {
    let app = this;
    app.getProfileRecord();
    app.getLatestPrice();
    app.getBulkingCenter();



    //console.log(app.detail)
  },
  computed: {},
  methods: {
    createGauge() {
      // Create a new Gauge
      const app = this;
      let cpuGauge = Gauge(document.getElementById("cpuSpeed"), {
        max: 10,
        dialStartAngle: -90,
        dialEndAngle: -90.001,
        value: app.value / 10,
        label: function () {
          return "";
        },
        color: function (value) {
          if (value > 5) {
            return "#5ee432"; // green
          } else if (value < 4 && value > 3.5) {
            return "#fffa50"; // yellow
          } else if (value < 3 && value > 2.5) {
            return "#f7aa38"; // orange
          } else {
            return "#ef4655"; // red
          }
        },
      });
    },
    getProfileRecord() {
      const app = this;

      Request.getMethod("/api/enumerator/get-counts")
        .then((response) => {
          app.content = response.data;

          console.log(app.content);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    getBulkingCenter() {
      const app = this;

      Request.getMethod("/api/count-centers")
        .then((response) => {
          app.centers = response.data;

          console.log(app.centers);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    getLatestPrice() {
            let app = this;
            Request.getMethod("/api/admin/price/latest")
                .then((result) => {
                 console.log(result.data);
                 app.latestPrice = result.data;
                   
                    // if (result.data.response === "success") {
                    //     app.latestPrice = result.data.latestPrice;
                    // }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
  },
};
</script>

<style scoped>
</style>
