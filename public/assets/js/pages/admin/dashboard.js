"use strict";

var KTAdminDashboardStatistics = function () {
    var chart = null;

    var initChart = function () {
        var element = document.getElementById("kt_charts_main_analytics");

        if (!element) return;
        
        // Anti-duplication: Clear previous chart instance if exists
        if (chart) {
            chart.destroy();
        }
        element.innerHTML = ""; 

        var wrapper = document.getElementById("kt_admin_dashboard_stats");
        if (!wrapper) return;

        var labels = JSON.parse(wrapper.getAttribute("data-chart-labels") || "[]");
        var depositSeries = JSON.parse(wrapper.getAttribute("data-deposit-series") || "[]");
        var orderSeries = JSON.parse(wrapper.getAttribute("data-order-series") || "[]");

        var height = 350;
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');

        var options = {
            series: [{
                name: 'Doanh thu (VNĐ)',
                data: depositSeries
            }, {
                name: 'Đơn hàng',
                data: orderSeries
            }],
            chart: {
                id: 'kt_charts_main_analytics_instance',
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            plotOptions: {},
            legend: { show: true, position: 'top', horizontalAlign: 'right' },
            dataLabels: { enabled: false },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: ['#009ef7', '#50cd89']
            },
            xaxis: {
                categories: labels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: labelColor, fontSize: '12px' }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: labelColor, fontSize: '12px' },
                    formatter: function (val) {
                        return val >= 1000 ? (val / 1000) + 'k' : val;
                    }
                }
            },
            states: {
                hover: { filter: { type: 'none' } }
            },
            tooltip: {
                style: { fontSize: '12px' },
                y: { formatter: function (val) { return val.toLocaleString('vi-VN'); } }
            },
            colors: ['#009ef7', '#50cd89'],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                padding: { left: 20, right: 20 }
            },
            markers: {
                size: 5,
                colors: ['#009ef7', '#50cd89'],
                strokeColors: '#ffffff',
                strokeWidth: 3
            }
        };

        chart = new ApexCharts(element, options);
        chart.render();
    };

    return {
        init: function () {
            initChart();
        }
    };
}();

// Initialize on page load and Livewire navigation
if (document.readyState === "complete" || document.readyState === "interactive") {
    KTAdminDashboardStatistics.init();
} else {
    document.addEventListener("DOMContentLoaded", KTAdminDashboardStatistics.init);
}

document.addEventListener("livewire:navigated", function () {
    KTAdminDashboardStatistics.init();
});
