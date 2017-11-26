<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/foul-yoy");
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr">Grafik Pelanggaran Ujian Per Semester
                <small class="display-block"><?= _APP_CORPORATE_FULL ?></small>
            </h6>
        </div>
        <div id="simple_graph" class="graph-standard">

        </div>
    </div>
</div>
<script>
    var dataGraph =<?= json_encode($buildGraph) ?>;
    var xaxis=<?= json_encode($xaxis) ?>;
    $(document).ready(function () {
        var plot = $.plot($("#simple_graph"),
                dataGraph,
                {
                    colors: ["#ee7951", "#6db6ee", "#95c832", "#993eb7", "#3ba3aa"],
                    grid: {hoverable: true, clickable: true},
                    yaxis: {min: 0,tick:1, font: {size: 11, lineHeight: 1, color: "#333333"}},
                    xaxis: {ticks:xaxis},
                });

    })
</script>

