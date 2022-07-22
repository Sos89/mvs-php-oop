<?php
use app\core\form\TextareaField;
/** @var $model \app\controllers\ProductController */
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto text-center">
            <h2>Update Product</h2>
           <?php  $form = \app\core\form\Form::begin('editProduct', 'post', 'multipart/form-data') ?>
            <?php if ($model):
                foreach ($model as $product): ?>
                    <input type="text" class="form-control" hidden name="id" value="<?php echo $product['id'] ?>"> <br>
                    <input type="text" class="form-control" name="name" value="<?php echo $product['name'] ?>"> <br>
                    <input type="text" class="form-control" name="description" value="<?php echo $product['description'] ?>">
                    <?php if ($product['image']): ?>
                        <div class="m-auto" style="width: 330px; height: 330px ">
                            <label for="img"><img class="img-fluid" src="<?php echo $product['image'] ?>" alt=""></label>
                            <input type="file" name="image" id="img" class="form-control" hidden >
                            <input type="hidden" name="image_current" value="<?php echo $product['image'] ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-success mt-2">Add</button>
            <?php endif; ?>
            <?php \app\core\form\Form::end(); ?>
        </div>
    </div>
</div>