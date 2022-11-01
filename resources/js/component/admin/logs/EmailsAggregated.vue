<template>
  <div class="py-4">
    <div class="row">
      <div class="col-md-9"></div>
      <div class="col-md-3">
        <select class="form-select" id="cp-report-change-emails">
          <option value="30">Last 30 days</option>
          <option value="6" selected>Last 6 months</option>
          <option value="12">Last 12 months</option>
        </select>
      </div>
    </div>
    <div class="text-center mt-4">
      <div
        class="col-md-5 m-auto"
        style="background: #a3a1fb; border-radius: 4px"
      >
        <div class="py-4">
          <h2 class="text-center text-white">{{ count }}</h2>
          <p class="text-center pb-0 mb-0 text-white">{{ text }}</p>
        </div>
      </div>
    </div>
    <div class="card mt-5 p-3">
      <div id="cp-report-graph-emails" style="height: 300px"></div>
    </div>
  </div>
</template>

<script>
import IziToast from "./../../mixins/IziToast";
import Helpers from "./../../mixins/helpers";
import Request from "../../mixins/requestHelper";
export default {
  name: "EmailsAggregated",
  mixins: [IziToast, Helpers],
  components: {},
  data() {
    return {
      charts: null,
      count: "",
      text: "",
    };
  },
  mounted() {
    let app = this;
    app.getData(6);

    Highcharts.setOptions({
      colors: [
        "#A3A1FB",
        "#DDDF00",
        "#24CBE5",
        "#64E572",
        "#FF9655",
        "#9DFCFF",
        "#FFD59D",
        "#FC46FC",
      ],
    });

    $("#cp-report-change-emails").change(function () {
      var type = $("#cp-report-change-emails").val();
      app.getData(type);
    });
  },
  methods: {
    getData(t) {
      let app = this;

      Request.getMethod("/api/admin/emails/aggregated")
        .then((data) => {
         // console.log(data.data.data, 'dmdmdma')
          app.charts = data.data;
          app.count = app.numerilize(
            data.data.data.reduce((a, b) => a + b, 0),
            null,
            2
          );
          app.text = data.data.message[0];
          app.drawGraph(data.data);
        })
        .catch((error) => {
          //console.log(error, 'mundi')
          //app.showErrorMessage("An error Occured ");
        });
    },
    drawGraph(data) {
      Highcharts.chart("cp-report-graph-emails", {
        chart: {
          type: "column",
          style: { fontFamily: "Poppins, Avenir" },
        },
        xAxis: {
          categories: data.labels,
          title: { text: null },
          labels: { style: { fontSize: "11px" } },
        },
        yAxis: {
          title: { text: null },
          labels: { enabled: true },
        },
        title: {
          text: null,
        },
        subtitle: {
          text: null,
        },
        legend: { enabled: true },
        credits: { enabled: false },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true,
            },
          },
          column: {
            pointPadding: 0.2,
            borderWidth: 0,
          },
        },
        tooltip: {},
        series: [
          {
            name: "Emails Dispatched",
            data: data.data,
          },
        ],
      });
    },
  },
};
</script>

<style scoped>
</style>
