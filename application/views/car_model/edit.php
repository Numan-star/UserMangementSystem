<form action="" method="post" id="editCarModel" name="editCarModel">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Name">
            <p class="nameError"></p>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" value="<?php echo $row['color'] ?>" class="form-control" placeholder="Color">
            <p class="colorError"></p>
        </div>
        <div class="form-group">
            <label for="transmission">Transmission</label>
            <select name="transmission" id="transmission" class="form-control">
                <option value="Automatic" <?php echo ($row['transmission'] == "Automatic") ? 'selected' : '' ?>>Automatic</option>
                <option value="Manual" <?php echo ($row['transmission'] == "Manual") ? 'selected' : '' ?>>Manual</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" value="<?php echo $row['price'] ?>" placeholder="Price" class="form-control">
            <p class="priceError"></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>