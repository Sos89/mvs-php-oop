<?php
/** @var $prods \app\controllers\ProductController */

?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Comment</h1>
        </div>
        <div class="col-md-12 m-auto">
            <div class="comment_div">
                <?php if ($prods):
                    foreach ($prods as $i => $product): ?>
                        <div class="card m-2">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                                <div class="comment_img">
                                    <img class="w-75" src="<?php echo $product['image'] ?>" alt="Card image cap">
                                </div>
                                <p class="card-text"><?php echo $product['description'] ?></p>
                                <p class="card-text"><?php echo $product['rev'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>