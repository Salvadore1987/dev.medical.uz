<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Types;
use app\models\Lists;
use yii\helpers\ArrayHelper;

$this->title = 'Запись на прием';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2>Пациент: <?= $patient_name ?></h2>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Имя доктора</th>
            <th>Дата записи</th>
            <th>Статус</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($lists): ?>
            <?php $i = 1 ?>
            <?php foreach ($lists as $list): ?>
                <tr>
                    <td scope="row"><?= $i++ ?></td>
                    <td><?= $list['username'] ?></td>
                    <td><?= $list['date'] ?></td>
                    <td><?= ($list['status'] == Lists::STATUS_INACTIVE) ? "Неактивно" : "Активно"?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Записаться на прием</button></td>
        </tr>
    </tfoot>
</table>

<div class="modal fade" tabindex="-1" id="myModal" role="dialog">
    <div class="modal-dialog">
        <form action="" name="AddRecord" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Запись на прием.</h4>
                </div>
                <div class="modal-body col-sm-12">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="form-group">
                                <label for="doctor_id">Выберите доктора:</label>
                                <select class="form-control" name="doctor_id" id="doctor_id">
                                    <?php foreach ($doctors as $doctor): ?>
                                        <option value="<?= $doctor['id'] ?>"><?= $doctor['username'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Выберите дату:</label>
                                <input class="form-control" id="date" type="date">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="save">Добавить</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
