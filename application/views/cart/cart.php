<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <script>
        //Update item quantity
        function updateCartItem(obj, rowid) {
            $.get("<?php echo base_url('carts/updateItemQty/'); ?>", {
                rowid: rowid,
                qty: obj.value
            }, function(resp) {
                if (resp == 'ok') {
                    location.reload();
                } else {
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>

    <div class="row cart">
        <table class="table">
            <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="30%">Collection</th>
                    <th width="15%">Price</th>
                    <th width="13%">Quantity</th>
                    <th width="20%">Subtotal</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($this->cart->total_items() > 0) {
                    foreach ($cartItems as $item) { ?>
                        <tr>
                            <td>
                                <?php $imageURL = !empty($item["image"] ? base_url('assets/img/collection/' . $item["image"]) : base_url('assets/img/collection/')); ?>
                                <img src="<?php echo base_url('assets/img/collection/' . $item["image"]); ?>" width="50" />
                            </td>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo 'RM' . $item["price"]; ?></td>
                            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                            <td><?php echo 'RM' . $item["subtotal"]; ?></td>
                            <td>
                                <a href="<?php echo base_url('carts/removeItem/' . $item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">
                            <p>Your cart is empty...</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <a href="<?php echo base_url('collections/collection'); ?>" class="btn btn-warning">
                            <i class="gluphicon glyphicon-menu-left"></i> Continue Shopping
                        </a>
                    </td>
                    <td colspan="3"></td>

                    <td class="text-left">Grand Total: <b><?php echo 'RM' . $this->cart->total(); ?></b></td>
                    <td><a href="<?php echo base_url('checkouts/checkout'); ?>" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>

                </tr>
            </tfoot>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->