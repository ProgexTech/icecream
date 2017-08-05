
<form class="form-inline">
    <div class="form-group">
        <select id="store" class="form-control">
            <?php
            $stores = $this->store_model->getAllStores();
            foreach ($stores as $st) {
                ?>
                <option value="<?php echo $st->id; ?>"><?php echo $st->name ?></option>
            <?php }
            ?>
        </select>
        <select id="type" class="form-control">
            <option value="CASH">CASH</option>
            <option value="CREDIT">CREDIT</option>
        </select>
        <input type="text" class="form-control" id="price" placeholder="Enter Price">
        <button type="button" class="btn btn-primary" onclick="addPrice()">Add Price</button>
    </div>
</form>

<?php if ($prices) : ?>
    <table class="table">
        <thead>
        <th>Type</th>
        <th>Store Location</th>
        <th>Price</th>
        <th>Added By</th> 
        <th>Action</th>
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
                <td><?php echo $p->type; ?></td>
                <td><?php echo $store->name; ?></td>
                <td><?php echo $p->price; ?></td>
                <td><?php if ($user) echo $user->name; ?></td>
                <td>Action</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php else: ?>
    No Prices found.
<?php endif; ?>
