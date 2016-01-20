<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Types;
use app\models\Lists;
use yii\helpers\ArrayHelper;

$this->title = 'Список пациентов';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2>Доктор</h2>

<div id="table_content">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя доктора</th>
            <th>Дата записи</th>
            <th>Статус</th>
            <th>Действия</th>
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
                    <td>
                        <button class="btn btn-info" data-id="<?= $list['id'] ?>" title="Активировать">
                            <i class="glyphicon glyphicon-ok"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

