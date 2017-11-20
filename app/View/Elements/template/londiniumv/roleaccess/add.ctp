<?php
if (!isset($addLabel)) {
    $addLabel = "Tambah Data";
}
if (!isset($addUrl)) {
    $addUrl = "/admin/{$this->params['controller']}/add";
}
if ($roleAccess['add']) {
    if (isset($importable) && $importable) {
        ?>
        <a href="<?= Router::url("import_excel", true) ?>">
            <button class="btn btn-xs btn-default" type="button">
                <i class="icon-upload"></i>
                <?= __("Import Data") ?>
            </button>
        </a>&nbsp;
        <?php
    }
    ?>
    <a href="<?= Router::url($addUrl, true) ?>">
        <button class="btn btn-xs btn-success" type="button">
            <i class="icon-file-plus"></i>
            <?= __($addLabel) ?>
        </button>
    </a>
    <?php
}
?>