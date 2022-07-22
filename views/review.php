<?php
/** @var $prods \app\controllers\ProductController */
/** @var $user \app\models\User */

?>
<div class="review">
    <?php if ($prods):
        foreach ($prods as $i => $product): ?>
            <div class="card m-2 text-center card_div">
                <div class="card-body m-auto">
                    <h3 class="card-title"><?php echo $product['name'] ?></h3>
                    <div class="review_img">
                        <img class="w-100" src="<?php echo $product['image'] ?>" alt="Card image cap">
                    </div>
                    <p class="card-text"><?php echo $product['description'] ?></p>
                    <p class="card-text"><?php echo $product['rev'] ?></p>

                    <form action="/insert" method="post" class="form-control">
                        <input type="text" name="comment_text" class="form-control comment" required>
                        <div class="star-widget">
                            <input type="radio" name="stars"  id="rate-5" value="5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="stars"  id="rate-4" value="4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input type="radio"   name="stars" id="rate-3" value="3">
                            <label for="rate-3"  class="fas fa-star"></label>
                            <input type="radio"   name="stars" id="rate-2" value="2">
                            <label for="rate-2"   class="fas fa-star"></label>
                            <input type="radio" name="stars"   id="rate-1" value="1">
                            <label for="rate-1" class="fas fa-star"></label>
                        </div>
                        <input type="hidden" value="<?php echo $product['id'] ?>" name="product_id" >
                        <button type="submit" class="btn btn-sm btn-outline-primary">Send</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

