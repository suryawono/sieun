<div class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header"><a class="navbar-brand" href="<?= Router::url("/admin/dashboard", true) ?>"><img style="height:60px" src="<?= Router::url("/img/logoftis.jpg", true) ?>" alt="Dinas Pemuda, Olahraga dan Pariwisata" title="<?= _APP_CORPORATE ?>"></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons"><span class="sr-only">Toggle navbar</span><i class="icon-grid3"></i></button>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar"><span class="sr-only">Toggle navigation</span><i class="icon-paragraph-justify2"></i></button>
    </div>
    <?php
    $notifications = [];
    $countNotif = count($notifications);
    array_multisort(array_column($notifications, "time"), SORT_DESC, $notifications);
    ?>
    <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">

        <li class="dropdown">
            <a class="dropdown-toggle sidebar-toggle">
                <i class="icon-paragraph-justify2"></i>
            </a>
        </li>
    </ul>
</div>