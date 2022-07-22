<?php
/** @var $model \app\models\User */
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <h1>Create an account</h1>
            <?php  $form = \app\core\form\Form::begin('', "post", '') ?>
            <?php echo $form->field($model, 'name') ?>
            <?php echo $form->field($model, 'surname') ?>
            <?php echo $form->field($model, 'age') ?>
            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordField() ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php  \app\core\form\Form::end() ?>
        </div>
    </div>
</div>