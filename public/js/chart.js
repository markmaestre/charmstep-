$(document).ready(function () {
    
    $.ajax({
        type: "GET",
        url: "/api/dashboard/users-chart",
        dataType: "json",
        success: function (data) {
            var ctx = $("#usersChart");
            var myDoughnutChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Number of Users by Role',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Users by Role'
                        }
                    }
                },
            });
        },
        error: function (error) {
            console.log(error);
        }
    });


    $.ajax({
        type: "GET",
        url: "/api/dashboard/items-quantity-chart",
        dataType: "json",
        success: function (data) {
            var ctx = $("#itemsQuantityChart");
            var myBarChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Quantity of Items',
                        data: data.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(199, 199, 199, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(199, 199, 199, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                },
            });
        },
        error: function (error) {
            console.log(error);
        }
    });


    $.ajax({
        type: "GET",
        url: "/api/dashboard/sales-chart",
        dataType: "json",
        success: function (data) {
            var ctx = $("#salesChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Sales per Month',
                        data: data.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                },
            });
        },
        error: function (error) {
            console.log(error);
        }
    });
});
