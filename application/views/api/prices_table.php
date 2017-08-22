<form class="form-inline">
    <div class="form-group add-space-after">
        <input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
        <label for="store" class="fixed-width-110 text-right">Store Location : </label>
        <select id="store" name="store"  class="form-control">
            <?php $stores = $this->store_model->getAllStores(); ?>
            <?php foreach ($stores as $st): ?>
                <option value="<?php echo $st->id; ?>"><?php echo $st->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group add-space-after">
        <label for="type" class="fixed-width-110 text-right">Type of Sale : </label>
        <select id="type" name="type" class="form-control">
            <option value="CASH">CASH</option>
            <option value="CREDIT">CREDIT</option>
        </select>    
    </div>
    <div class="form-group add-space-after">
        <label for="price" class="fixed-width-110 text-right">Price : </label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price">
    </div>
    <div class="form-group add-space-after">
        <label for="price" class="fixed-width-110 text-right">&nbsp;</label>
        <button type="button" class="btn btn-primary" onclick="addPrice()">Add Price</button>
    </div>
</form>

<?php if ($prices) : ?>
    <table class="table">
        <thead>
        <th>Store Location</th>
        <th>Type</th>
        <th>Price</th>
    </thead>
    <tbody>
        <?php foreach ($prices as $p) : ?>
            <?php
            $user = $this->user_model->getUserById($p->addedUser);
            $store = $this->store_model->getStoreById($p->storeId);
            ?>
            <?php if ($p->hidden == '0') : ?>
                <tr class="pgx-success">
                <?php else : ?>
                <tr class="pgx-danger">
                <?php endif; ?>
                <td><?php echo $store->name; ?></td>
                <td><?php echo $p->type; ?></td>
                <td><?php echo $p->price; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php else: ?>
    No Prices found.
<?php endif; ?>
