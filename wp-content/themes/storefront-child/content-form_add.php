<?php
/**
 * The template part for add product form.
 */
?>

<form id="form-new-product" class="form-new-product form" method="post" action="" enctype="multipart/form-data">
    <div id="note"></div>
    <div class="row">
        <div class="form-group col-6">
            <input type="text" placeholder="Title" id="post_title" name="post_title">
        </div>
        <div class="form-group col-6">
            <input type="number" placeholder="Price" id="price" name="price">
        </div>
        <div class="form-group col-4">
            <p class="form-group__title">Product image</p>
            <label class="file-label" for="custom_picture">Upload image</label>
            <input class="file-input" type="file" multiple="false"  id="custom_picture" name="custom_picture" accept="image/png, image/jpeg, image/webp">
            <?php wp_nonce_field( 'custom_picture', 'custom_picture_nonce' ); ?>
        </div>
        <div class="form-group col-4">
            <p class="form-group__title">Product type</p>
            <select name="select_type" id="select_type">
                <option value="rare">Rare</option>
                <option value="frequent">Frequent</option>
                <option value="unusual">Unusual</option>
            </select>
        </div>
        <div class="form-group col-4">
            <p class="form-group__title">Product create date</p>
            <input type="date" id="create_date" name="create_date">
        </div>
    </div>
    <input id="form-submit" class="form__submit" name="submit" type="submit" value="Create" />
</form>