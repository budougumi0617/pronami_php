<?php

$id = $_POST['id'];

if (isset($_POST['add'])) {
    header('Location: pro_add.php');
    exit();
}

if (!isset($_POST['id'])) {
    header('Location: pro_ng.php');
    exit();
}

if (isset($_POST['disp'])) {
    header('Location: pro_disp.php?id=' . $id);
    exit();
}

if (isset($_POST['edit'])) {
    header('Location: pro_edit.php?id=' . $id);
    exit();
}

if (isset($_POST['delete'])) {
    header('Location: pro_delete.php?id=' . $id);
    exit();
}

