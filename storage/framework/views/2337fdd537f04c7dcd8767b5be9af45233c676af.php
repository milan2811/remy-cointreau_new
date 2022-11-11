<?php if(isset($response) && $response): ?>
<div class="text-center m-auto w-75 p-5">    
    <?php echo e($response); ?>

    <canvas id="brand" style="background:#fff"></canvas>
    <button class="btn btn-outline-primary mt-5" id="download">Download</button>
</div>


<script>
    $(function() {

        const data = {
            labels: [
                'Using',
                'not using',                
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [parseFloat('<?php echo e($percentage); ?>'), parseFloat('<?php echo e(100 - $percentage); ?>')],
                backgroundColor: [
                    '#C22E38',                
                    '#F5ECD6',
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {}
        };

        const brandChart = new Chart(
            document.getElementById('brand'),
            config
        );

        $("#download").click(() => {
            var link = document.createElement('a');
            link.download = 'brands-chart.png';
            link.href = document.getElementById('brand').toDataURL()
            link.click();
        })
    })
</script>
<?php else: ?> 
    <div class="text-center w-100">
        <p class="text-center">Please Select category and brand to show the analytics</p>
    </div>
<?php endif; ?>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/analytics/_components/cointreau-brands.blade.php ENDPATH**/ ?>