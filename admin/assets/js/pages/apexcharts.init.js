async function getData() {
  let Data = [];
  const response = await fetch('http://localhost:8080/admin/chart/transaksi.php');
  const result = await response.json();
  // console.log(JSON.stringify(data));
  result.forEach((x) => {
    console.log(x.banyak);
  });
  return Data;
}
console.log(getData());
// async function coba() {
//   getData();
//   console.log(Data);
// }
// coba();
// window.onload() = () => {
//   coba()
// }
const currentDate = (new Date()).getFullYear();
var options = {

  chart: {
    height: 380,
    type: "line",
    zoom: { enabled: !1 },
    toolbar: { show: !1 },
  },
  colors: ["#34c38f"],
  dataLabels: { enabled: !1 },
  stroke: { width: [3, 3], curve: "straight" },
  series: [
    { name: `Tahun - ${currentDate}`, data: [26, 24, 32, 36, 33, 31, 33] },
  ],
  grid: {
    row: { colors: ["transparent", "transparent"], opacity: 0.2 },
    borderColor: "#f1f1f1",
  },
  markers: { style: "inverted", size: 6 },
  xaxis: {
    categories: ["Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"],
    title: { text: "Month" },
  },
  yaxis: { title: { text: "Temperature" }, min: 5, max: 40 },
  legend: {
    position: "top",
    horizontalAlign: "right",
    floating: !0,
    offsetY: -25,
    offsetX: -5,
  },
  responsive: [
    {
      breakpoint: 600,
      options: { chart: { toolbar: { show: !1 } }, legend: { show: !1 } },
    },
  ],
},
  chart = new ApexCharts(
    document.querySelector("#line_chart_datalabel"),
    options
  );
chart.render();
options = {
  chart: {
    height: 380,
    type: "line",
    zoom: { enabled: !1 },
    toolbar: { show: !1 },
  },
  colors: ["#556ee6", "#f46a6a", "#34c38f"],
  dataLabels: { enabled: !1 },
  stroke: { width: [3, 4, 3], curve: "straight", dashArray: [0, 8, 5] },

  title: {
    text: "Page Statistics",
    align: "left",
    style: { fontWeight: "500" },
  },
  markers: { size: 0, hover: { sizeOffset: 6 } },
  xaxis: {
    categories: [
      "01 Jan",
      "02 Jan",
      "03 Jan",
      "04 Jan",
      "05 Jan",
      "06 Jan",
      "07 Jan",
      "08 Jan",
      "09 Jan",
      "10 Jan",
      "11 Jan",
      "12 Jan",
    ],
  },
  tooltip: {
    y: [
      {
        title: {
          formatter: function (e) {
            return e + " (mins)";
          },
        },
      },
      {
        title: {
          formatter: function (e) {
            return e + " per session";
          },
        },
      },
      {
        title: {
          formatter: function (e) {
            return e;
          },
        },
      },
    ],
  },
  grid: { borderColor: "#f1f1f1" },
};


