
        <div class="container">
            <div class=" mt-4 pt-4"><br/></div>
            <canvas id="myChart" class=" mt-4 pt-4" style="width: 500px;height: 200px"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['user','resep','komentar','artikel'],
                    datasets: [{
                            label: 'Total Data',
                            data: [<?=$user;?>,<?=$resep;?>,<?=$komentar;?>,<?=$artikel;?>],
                            backgroundColor: [
                                'rgba(255, 0, 0, 1)',
                                'rgba(0, 0, 255, 1)',
                                'rgba(0, 255, 0, 1)',
                                'rgba(255, 255, 0, 1)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 2
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>