TodayChart();
TotalAChart();
TotalUsers();
MethodsChart();
function TotalAChart() {
    $.ajax({
        url: 'rest/charts/total_attacks',
        type: 'post',
        cache: false,
        success: function (_0x3bac6c) {
            var _0x3b742a = [], _0x7a7f4 = [];
            for (var _0x18b93f in _0x3bac6c) {
                _0x3b742a.push(_0x3bac6c[_0x18b93f].date);
                _0x7a7f4.push(_0x3bac6c[_0x18b93f].attacks);
            }
            var _0x32d6cc = new Chart(document.getElementById('totalattacks'), {
                type: 'line',
                data: {
                    labels: _0x3b742a,
                    datasets: [{
                            label: 'Total Attacks',
                            backgroundColor: '#a771f9',
                            data: _0x7a7f4,
                            fill: true
                        }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    maintainAspectRatio: false,
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    },
                    elements: {
                        line: {
                            borderWidth: 2,
                            tension: 0.4
                        },
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }
    });
}
function TodayChart() {
    $.ajax({
        url: 'rest/charts/today',
        type: 'post',
        cache: false,
        success: function (_0x6b7f9e) {
            var _0x424b18 = [], _0x80cbbf = [];
            for (var _0x172435 in _0x6b7f9e) {
                _0x424b18.push(_0x6b7f9e[_0x172435].hour);
                _0x80cbbf.push(_0x6b7f9e[_0x172435].attacks);
            }
            var _0x127476 = new Chart(document.getElementById('todayattacks'), {
                type: 'line',
                data: {
                    labels: _0x424b18,
                    datasets: [{
                            label: 'Today Attacks',
                            backgroundColor: '#a771f9',
                            data: _0x80cbbf,
                            fill: true
                        }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    maintainAspectRatio: false,
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    },
                    elements: {
                        line: {
                            borderWidth: 2,
                            tension: 0.4
                        },
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }
    });
}
var runningattacksresult = [
        {
            x: '18:00',
            y: '200'
        },
        {
            x: '19:00',
            y: '900'
        },
        {
            x: '20:00',
            y: '300'
        },
        {
            x: '22:00',
            y: '800'
        }
    ], runningattackslabels = runningattacksresult.map(_0xcf2dc7 => moment(_0xcf2dc7.x, 'HH:mm')), runningattacksdata = runningattacksresult.map(_0x26a7dc => +_0x26a7dc.y), runningattacks = new Chart(document.getElementById('runningattacks'), {
        type: 'line',
        data: {
            labels: runningattackslabels,
            datasets: [{
                    label: 'Running Attacks',
                    backgroundColor: '#a771f9',
                    data: runningattacksdata,
                    fill: true
                }]
        },
        options: {
            plugins: { legend: { display: false } },
            maintainAspectRatio: false,
            scales: {
                x: { display: false },
                y: { display: false }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    });
function TotalUsers() {
    $.ajax({
        url: 'rest/charts/total_users',
        type: 'post',
        cache: false,
        success: function (_0x38d250) {
            var _0x242e2a = [], _0x41d75a = [];
            for (var _0x18de31 in _0x38d250) {
                _0x242e2a.push(_0x38d250[_0x18de31].date);
                _0x41d75a.push(_0x38d250[_0x18de31].users);
            }
            var _0x289239 = new Chart(document.getElementById('totalusers'), {
                type: 'line',
                data: {
                    labels: _0x242e2a,
                    datasets: [{
                            label: 'Total Users',
                            backgroundColor: '#a771f9',
                            data: _0x41d75a,
                            fill: true
                        }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    maintainAspectRatio: false,
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    },
                    elements: {
                        line: {
                            borderWidth: 2,
                            tension: 0.4
                        },
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }
    });
}
function MethodsChart() {
    $.ajax({
        url: 'rest/charts/methods',
        type: 'post',
        cache: false,
        success: function (_0x47de27) {
            var _0x31e71a = [], _0x2e2e49 = [];
            for (var _0x578e23 in _0x47de27) {
                _0x31e71a.push(_0x47de27[_0x578e23].method);
                _0x2e2e49.push(_0x47de27[_0x578e23].value);
            }
            var _0x13e0d4 = {
                    series: _0x2e2e49,
                    chart: {
                        width: 380,
                        type: 'pie',
                        foreColor: '#D1D5DB'
                    },
                    labels: _0x31e71a,
                    responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: { width: 300 },
                                legend: { position: 'bottom' }
                            }
                        }],
                    colors: [
                        '#a771f9',
                        '#ada3f5',
                        '#a093f0',
                        '#8b8af5',
                        '#807ef7'
                    ],
                    stroke: { show: false }
                }, _0x1d1f09 = new ApexCharts(document.querySelector('#statisticschart'), _0x13e0d4);
            _0x1d1f09.render();
        }
    });
}