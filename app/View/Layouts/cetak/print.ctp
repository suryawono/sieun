<?php
echo $this->Html->script('jquery.min');
?>
<title><?= _APP_NAME ?> - <?= _APP_CORPORATE ?></title>
<link rel="icon" href="<?= Router::url("/favicon.ico", true) ?>">
<script>
    $(document).ready(function () {
        window.print();
    })
</script>
<div class="no-margin no-padding text-center" style="width:100%">
    <div style="display:inline-block">
        <?= _APP_NAME ?>
    </div>
</div>
<hr/>
<style>
    .no-margin *{
        margin:0;
    }
    .no-padding *{
        padding:0;
    }
    .table-data td{
        text-align: left;
        padding:0 5px;
    }
    .table-data th{
        text-align: center;
        padding:0 5px;
    }
    .table-data td:first-child{
        text-align:center !important;
    }
    table {
        border-collapse: collapse;
        font-size:11px !important; 
        font-family:Tahoma, Geneva, sans-serif;
    }
    table, th, td {
        border: 1px solid black;
        padding:0 5px;
    }
    .table-data th{
        background-color: lightgray;
    }
    .text-center{
        text-align:center !important;
    }
    .text-right{
        text-align:right !important;
    }
    .text-left{
        text-align:left !important;
    }
    table.no-border,.no-border th,.no-border td{
        border:none !important;
        padding:0;
    }
</style>
<?php
echo $this->fetch("content");
?>