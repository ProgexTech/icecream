
<div>
    <legend>Add New Store</legend>
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>store/add">
        <div class="form-group">
            <label class="control-label col-md-1">Name</label>
            <div class=" col-md-3"><input type="text" class="form-control" id="name" name="name" ></div>
            <label class="control-label col-md-2">Address</label>
            <div class=" col-md-6"><input type="text" class="form-control" id="address" name="address" ></div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1">Phone</label>
            <div class=" col-md-3"><input type="text" class="form-control" id="phone" name="phone"></div>
            <label class="control-label col-md-2">Contact Person</label>
            <div class=" col-md-6"><input type="text" class="form-control" id="cperson" name="cperson"></div>
        </div>
        <div class="form-group">
            <div class="col-md-1">&nbsp;</div>
            <div class=" col-md-11"><button type="submit" class="btn btn-primary">Add</button></div>
        </div>
    </form>
</div>

<?php $stores = $this->store_model->getAllStores(); ?> 

<div>
    <legend>Stores</legend>
    <table class="table table-striped">
        <thead>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Contact Person</th>
        <th>Current Stock</th>
        </thead>
        <tbody>
            <?php if ($stores): ?>
            <?php foreach ($stores as $store) : ?>
            <tr>
                <td><?php echo $store->name; ?></td>
                <td><?php echo $store->address; ?></td>
                <td><?php echo $store->phone; ?></td>
                <td><?php echo $store->contactPerson; ?></td>
                <td>to-do</td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No Entries</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>