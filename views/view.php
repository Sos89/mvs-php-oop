<?php
/** @var $review \app\controllers\ReviewsController */
/** @var $product \app\controllers\ProductController */
?>

<div class="view">
    <div class="m-2">
        <?php foreach ($product as $prod) { ?>
            <div class="view_img_div">
                <div class="card-body text-center">
                    <h2 class="card-text"><?php echo $prod['name'] ?></h2>
                </div>
                <img class="w-100" src="<?php echo $prod['image'] ?>" alt="Card image cap">
            </div>
        <?php } ?>
    </div>

<div class="m-2">
    <table id="tableID">

        <thead>
        <tr>
            <th>Stars:</th>
            <th>Comment:</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($review as $i => $reviews): ?>
            <tr>
                <td class="text-center"> <?php echo $reviews['stars'] ?> </td>
                <td class="text-center"><?php echo $reviews['comment_text'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</div>




