
<form class="form-inline">
    <div class="form-group">
        <input type="text" class="form-control" id="price" placeholder="Enter Price">
        <button type="button" class="btn btn-primary" onclick="addPrice()">Add Price</button>
    </div>
</form>

<?php if ($prices) : ?>
<table class="table">
    <thead>
        <th>Price</th>
        <th>Added By</th> 
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach ($prices as $p): ?>
        <?php $user = $this->user_model->getUserById($p->addedUser); ?>
        <?php if ($p->hidden == '0') : ?>
        <tr class="pgx-success">
        <?php else : ?>
        <tr class="pgx-danger">
        <?php endif; ?>
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
