<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheckForBranch();

$id = $_POST['id'];

if (isset($_POST['add'])) {
    header('Location: staff_add.php');
    exit();
}

if (!isset($_POST['id'])) {
    header('Location: staff_ng.php');
    exit();
}

if (isset($_POST['disp'])) {
    header('Location: staff_disp.php?id=' . $id);
    exit();
}

if (isset($_POST['edit'])) {
    header('Location: staff_edit.php?id=' . $id);
    exit();
}

if (isset($_POST['delete'])) {
    header('Location: staff_delete.php?id=' . $id);
    exit();
}

