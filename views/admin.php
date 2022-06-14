<?php
/** @var $prods \app\controllers\ProductController */
use app\core\Application;
use app\core\form\TextareaField;
?>

<button class="btn btn-success btn-sm" id="btn">Create new Product</button>
<div class="col-md-5 m-auto create">
    <form action="/create" class="form text-center p-5" method="post" enctype="multipart/form-data">
        <label for="name">Name
            <input class="form-control" id="name" type="text" name="name" required>
        </label> <br>
        <label for="desc">Description
            <textarea class="form-control" id="desc" name="description" required></textarea>
        </label> <br>
        <label for="image">Image
            <input class="form-control" hidden id="image" type="file" name="image" required>
        </label> <br>
        <button type="submit" class="btn btn-success mt-2">Add</button>
    </form>
</div>
<table id="tableID" class="display">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Review</th>
        <th>Image</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php  foreach($prods as $product){?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name']?></td>
            <td><?= $product['description']?></td>
            <td><?= $product['rev']?></td>
            <td>
                <img src="<?php echo $product['image'] ?>" style="width: 150px; height: 100px" alt="Card image cap">
            </td>
            <td>
                <a href="/edit?id=<?php echo $product['id'] ?>"> <button type="button" class="btn btn-sm btn-outline-primary">Update</button></a>
            </td>
            <td>
                <a href="/productDelete?id=<?php echo $product['id'] ?>"> <button type="button" class="btn btn-sm btn-outline-danger">Delete</button></a>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
