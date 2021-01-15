
        <div class="container">
            <div class=" mt-4 pt-4"><br/></div>
            <canvas id="myChart" class=" mt-4 pt-4" style="width: 500px;height: 200px"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['User','Resep','Komentar','Artikel'],
                    datasets: [{
                            label: 'Total Data',
                            data: [<?=$user;?>,<?=$resep;?>,<?=$komentar;?>,<?=$artikel;?>],
                            backgroundColor: 'rgba(0, 175, 145,0.8)',
                            backgroundHover: 'rgba(0, 175, 145,1)',
                            borderColor: 'rgb(0, 121, 101,1)',
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