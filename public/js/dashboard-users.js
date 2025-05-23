document.addEventListener('DOMContentLoaded', function() {
    // Total Earn Chart
    function initTotalEarn() {
        const totalEarnCanvas = document.getElementById("totalEarn");
        if (!totalEarnCanvas) return;

        const ctx = totalEarnCanvas.getContext("2d");
        const data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [{
                data: [20, 45, 30, 60, 40, 55],
                borderColor: '#22C55E',
                backgroundColor: function(context) {
                    const gradient = ctx.createLinearGradient(0, 0, 0, 450);
                    gradient.addColorStop(0, "rgba(34, 197, 94, 0.41)");
                    gradient.addColorStop(0.2, "rgba(255, 255, 255, 0)");
                    return gradient;
                },
                borderWidth: 1,
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }]
        };

        new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });
    }

    // Total Spending Chart
    function initTotalSpending() {
        const totalSpendingCanvas = document.getElementById("totalSpending");
        if (!totalSpendingCanvas) return;

        const ctx = totalSpendingCanvas.getContext("2d");
        // Konfigurasi sama seperti totalEarn dengan data berbeda
        // ...kode chart configuration...
    }

    // Total Goal Chart
    function initTotalGoal() {
        const totalGoalCanvas = document.getElementById("totalGoal");
        if (!totalGoalCanvas) return;

        const ctx = totalGoalCanvas.getContext("2d");
        // Konfigurasi sama seperti totalEarn dengan data berbeda
        // ...kode chart configuration...
    }

    // Revenue Flow Chart
    function initRevenueFlow() {
        const revenueFlowCanvas = document.getElementById("revenueFlow");
        if (!revenueFlowCanvas) return;

        const ctx = revenueFlowCanvas.getContext("2d");
        // ...kode chart configuration...
    }

    // Initialize all charts
    try {
        initTotalEarn();
        initTotalSpending();
        initTotalGoal();
        initRevenueFlow();
    } catch (error) {
        console.error("Error initializing charts:", error);
    }
});

$(".card-slider").slick({
    dots: true,
    infinite: true,
    autoplay: true,
    speed: 500,
    fade: true,
    cssEase: "linear",
    arrows: false,
  });
  function totalEarn() {
    const canvas = document.getElementById('totalEarn');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const bitsMonth = [
      "Jan",
      "Feb",
      "Mar",
      "Afril",
      "May",
      "Jan",
      "Feb",
      "Mar",
      "Afril",
      "May",
      "Feb",
      "Mar",
      "Afril",
      "May",
    ];
    const bitsData = [
      0, 10, 0, 65, 0, 25, 0, 35, 20, 100, 40, 75, 50, 85, 60,
    ];
    const totalEarn = new Chart(ctx, {
      type: "line",
      data: {
        labels: bitsMonth,
        datasets: [
          {
            label: "Visitor",
            data: bitsData,
            backgroundColor: () => {
              const chart = document
                .getElementById("totalEarn")
                .getContext("2d");
              const gradient = chart.createLinearGradient(0, 0, 0, 450);
              gradient.addColorStop(0, "rgba(34, 197, 94,0.41)");
              gradient.addColorStop(0.2, "rgba(255, 255, 255, 0)");

              return gradient;
            },
            borderColor: "#22C55E",
            pointRadius: 0,
            pointBackgroundColor: "#fff",
            pointBorderColor: "#22C55E",
            borderWidth: 1,
            fill: true,
            fillColor: "#fff",
            tension: 0.4,
          },
        ],
      },
      options: {
        layout: {
          padding: {
            bottom: -20,
          },
        },
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          x: {
            grid: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
          y: {
            grid: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
        },

        plugins: {
          legend: {
            position: "top",
            display: false,
          },
          title: {
            display: false,
            text: "Visitor: 2k",
          },
          tooltip: {
            enabled: false,
          },
        },
      },
    });
  }
  totalEarn();
  function totalSpendingChart() {
    let ctx_bids = document
      .getElementById("totalSpending")
      .getContext("2d");
    let bitsMonth = [
      "Jan",
      "Feb",
      "Mar",
      "Afril",
      "May",
      "Jan",
      "Feb",
      "Mar",
      "Afril",
      "May",
      "Feb",
      "Mar",
      "Afril",
      "May",
    ];
    let bitsData = [
      0, 10, 0, 65, 0, 25, 0, 35, 20, 100, 40, 75, 50, 85, 60,
    ];
    let totalEarn = new Chart(ctx_bids, {
      type: "line",
      data: {
        labels: bitsMonth,
        datasets: [
          {
            label: "Visitor",
            data: bitsData,
            backgroundColor: () => {
              const chart = document
                .getElementById("totalEarn")
                .getContext("2d");
              const gradient = chart.createLinearGradient(0, 0, 0, 450);
              gradient.addColorStop(0, "rgba(34, 197, 94,0.41)");
              gradient.addColorStop(0.2, "rgba(255, 255, 255, 0)");

              return gradient;
            },
            borderColor: "#22C55E",
            pointRadius: 0,
            pointBackgroundColor: "#fff",
            pointBorderColor: "#22C55E",
            borderWidth: 1,
            fill: true,
            fillColor: "#fff",
            tension: 0.4,
          },
        ],
      },
      options: {
        layout: {
          padding: {
            bottom: -20,
          },
        },
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          x: {
            grid: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
          y: {
            grid: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
        },

        plugins: {
          legend: {
            position: "top",
            display: false,
          },
          title: {
            display: false,
            text: "Visitor: 2k",
          },
          tooltip: {
            enabled: false,
          },
        },
      },
    });
  }
  totalSpendingChart();
  function totalGoal() {
    let ctx_bids = document.getElementById("totalGoal").getContext("2d");
    let bitsMonth = [
      "Jan",
      "Feb",
      "Mar",
      "Afril",
      "May",
      "Jan",
      "Feb",
      "Mar",
      "Afril",
      "May",
      "Feb",
      "Mar",
      "Afril",
      "May",
    ];
    let bitsData = [
      0, 10, 0, 65, 0, 25, 0, 35, 20, 100, 40, 75, 50, 85, 60,
    ];
    let totalEarn = new Chart(ctx_bids, {
      type: "line",
      data: {
        labels: bitsMonth,
        datasets: [
          {
            label: "Visitor",
            data: bitsData,
            backgroundColor: () => {
              const chart = document
                .getElementById("totalGoal")
                .getContext("2d");
              const gradient = chart.createLinearGradient(0, 0, 0, 450);
              gradient.addColorStop(0, "rgba(34, 197, 94,0.41)");
              gradient.addColorStop(0.2, "rgba(255, 255, 255, 0)");
              console.log({ gradient });
              return gradient;
            },
            borderColor: "#22C55E",
            pointRadius: 0,
            pointBackgroundColor: "#fff",
            pointBorderColor: "#22C55E",
            borderWidth: 1,
            fill: true,
            fillColor: "#fff",
            tension: 0.4,
          },
        ],
      },
      options: {
        layout: {
          padding: {
            bottom: -20,
          },
        },
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          x: {
            grid: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
          y: {
            grid: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
        },

        plugins: {
          legend: {
            position: "top",
            display: false,
          },
          title: {
            display: false,
            text: "Visitor: 2k",
          },
          tooltip: {
            enabled: false,
          },
        },
      },
    });
  }
  totalGoal();

  let revenueFlowElement = document
    .getElementById("revenueFlow")
    .getContext("2d");
  let month = [
    "Jan",
    "Feb",
    "Mar",
    "April",
    "May",
    "Jun",
    "July",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  let dataSetsLight = [
    {
      label: "My First Dataset",
      data: [1, 5, 2, 2, 6, 7, 8, 7, 3, 4, 1, 3],
      backgroundColor: [
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(250, 204, 21, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
      ],
      borderWidth: 0,
      borderRadius: 5,
    },
    {
      label: "My First Dataset 2",
      data: [5, 2, 4, 2, 5, 8, 3, 7, 3, 4, 1, 3],
      backgroundColor: [
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(255, 120, 75, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
      ],
      borderWidth: 0,
      borderRadius: 5,
    },
    {
      label: "My First Dataset 3",
      data: [2, 5, 3, 2, 5, 6, 9, 7, 3, 4, 1, 3],
      backgroundColor: [
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(74, 222, 128, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
        "rgba(237, 242, 247, 1)",
      ],
      borderWidth: 0,
      borderRadius: 5,
    },
  ];
  let dataSetsDark = [
    {
      label: "My First Dataset",
      data: [1, 5, 2, 2, 6, 7, 8, 7, 3, 4, 1, 3],
      backgroundColor: [
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(250, 204, 21, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
      ],
      borderWidth: 0,
      borderRadius: 5,
    },
    {
      label: "My First Dataset 2",
      data: [5, 2, 4, 2, 5, 8, 3, 7, 3, 4, 1, 3],
      backgroundColor: [
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(255, 120, 75, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
      ],
      borderWidth: 0,
      borderRadius: 5,
    },
    {
      label: "My First Dataset 3",
      data: [2, 5, 3, 2, 5, 6, 9, 7, 3, 4, 1, 3],
      backgroundColor: [
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(74, 222, 128, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
        "rgba(42, 49, 60, 1)",
      ],
      borderWidth: 0,
      borderRadius: 5,
    },
  ];
  let revenueFlow = new Chart(revenueFlowElement, {
    type: "bar",
    data: {
      labels: month,
      datasets: dataSetsLight,
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            color: "rgb(243 ,246, 255 ,1)",
          },
          gridLines: {
            zeroLineColor: "transparent",
          },
          ticks: {
            callback(value) {
              return `${value}% `;
            },
          },
        },
        x: {
          grid: {
            color: "rgb(243 ,246, 255 ,1)",
          },
          gridLines: {
            zeroLineColor: "transparent",
          },
        },
      },
      plugins: {
        legend: {
          display: false,
        },
      },
      x: {
        stacked: true,
      },
      y: {
        stacked: true,
      },
    },
  });
  //pie chart
  let pieChart = document.getElementById("pie_chart").getContext("2d");

  const data = {
    labels: [10, 20, 30],
    datasets: [
      {
        label: "My First Dataset",
        data: [15, 20, 35, 40],
        backgroundColor: ["#1A202C", "#61C660", "#F8CC4B", "#EDF2F7"],
        borderColor: ["#ffffff", "#ffffff", "#ffffff", "#1A202C"],
        hoverOffset: 18,
        borderWidth: 0,
      },
    ],
  };
  const customDatalabels = {
    id: "customDatalabels",
    afterDatasetsDraw(chart, args, pluginOptions) {
      const {
        ctx,
        data,
        chartArea: { top, bottom, left, right, width, height },
      } = chart;
      ctx.save();
      data.datasets[0].data.forEach((datapoint, index) => {
        const { x, y } = chart
          .getDatasetMeta(0)
          .data[index].tooltipPosition();
        ctx.font = "bold 12px sans-serif";
        ctx.fillStyle = data.datasets[0].borderColor[index];
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText(`${datapoint}%`, x, y);
      });
    },
  };
  const config = {
    type: "doughnut",
    data,
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 10,
          bottom: 10,
        },
      },
      plugins: {
        legend: {
          display: false,
        },
      },
    },
    plugins: [customDatalabels],
  };

  let pieChartConfiig = new Chart(pieChart, config);

  //chart dark mode
  let themeToggleSwitch = document.getElementById("theme-toggle");

  //onclick

  if (themeToggleSwitch) {
    themeToggleSwitch.addEventListener("click", function () {
      if (
        document.documentElement.classList[0] === "dark" ||
        localStorage.getItem('darkMode') === 'true'
      ) {
        revenueFlow.data.datasets = dataSetsDark;
        revenueFlow.options.scales.y.ticks.color = "white";
        revenueFlow.options.scales.x.ticks.color = "white";
        revenueFlow.options.scales.x.grid.color = "#222429";
        revenueFlow.options.scales.y.grid.color = "#222429";
        revenueFlow.update();
      } else {
        revenueFlow.data.datasets = dataSetsLight;
        revenueFlow.options.scales.y.ticks.color = "black";
        revenueFlow.options.scales.x.ticks.color = "black";
        revenueFlow.options.scales.x.grid.color = "rgb(243 ,246, 255 ,1)";
        revenueFlow.options.scales.y.grid.color = "rgb(243 ,246, 255 ,1)";
        revenueFlow.update();
      }
    });
  }

  //initial load
  if (
    localStorage.getItem('darkMode') === 'true' ||
    window.matchMedia("(prefers-color-scheme: dark)").matches
  ) {
    revenueFlow.data.datasets = dataSetsDark;
    revenueFlow.options.scales.y.ticks.color = "white";
    revenueFlow.options.scales.x.ticks.color = "white";
    revenueFlow.options.scales.x.grid.color = "#222429";
    revenueFlow.options.scales.y.grid.color = "#222429";
  } else {
    revenueFlow.data.datasets = dataSetsLight;
    revenueFlow.options.scales.y.ticks.color = "black";
    revenueFlow.options.scales.x.ticks.color = "black";
    revenueFlow.options.scales.x.grid.color = "rgb(243 ,246, 255 ,1)";
    revenueFlow.options.scales.y.grid.color = "rgb(243 ,246, 255 ,1)";
  }
  revenueFlow.update();
