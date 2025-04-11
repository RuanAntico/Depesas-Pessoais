<?php
session_start();
require_once '../model/PerfilUsuarioModel.php';

$model = new PerfilUsuarioModel();
$usuario = $model->getPerfilUsuario();


include '../view/perfilUsuarioView.php';
