<?php
$this->extend('../layout/TwitterBootstrap/dashboard');
?>

<?= $this->Html->script('Chart') ?>
<div class="row">
    <div class="col-12 col-md-12">
        <canvas id="destinyChart" width="400" height="100"></canvas>
    </div>
</div>


<?= $this->Html->scriptStart([
    'inline' => false,
    'block' => 'footer-script',
    ]); ?>

var pageChart = document.getElementById("destinyChart").getContext('2d');
var options = [];
var destinyChart = new Chart(pageChart, {
    type: 'line',
    data: {
        datasets: [{
            data: [20,10,20,30,40,50,60,70,75,80,85,90],
            pointBackgroundColor: function(context) {
                var index = context.dataIndex;
                var value = context.dataset.data[index];
                return index == <?= $zero['destinyNum'] ?> ? 'red' : 'green';
            },
            pointRadius:10,
        }], 
        labels: [ <?php
        foreach ($lifeSteps as $step) {
            echo '"' . $step['name'] . '",';
        }?>
        ],
   },
    options: {
        scales: {
            yAxes: [ // Ｙ軸の設定
            {
                display: false,
                drawBorder: false,
                ticks: {
                    min: 0, // 軸の最小値
                    max: 100, // 軸の最大値
                },
                gridLines: {display:false}
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    console.log(tooltipItem.index);
                    var description = [
                        <?php foreach ($lifeSteps as $step) {
                            $lists = mb_str_split($step['description'], 20);
                            echo '[';
                            foreach ($lists as $item) {
                                echo '"' . $item . '",';
                            }
                            echo '],';
                        }
                        ?>
                    ];
                    return description[tooltipItem.index];
                }
            },
            displayColors: false,
        }
    }
});

<?= $this->Html->scriptEnd(); ?>
