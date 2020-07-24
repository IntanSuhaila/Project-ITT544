<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row checkout">
        <!-- order items -->
        <table class="table">
            <thead>
                <tr>
                    <th width="13%"></th>
                    <th width="34%">Collection</th>
                    <th width="18%">Price</th>
                    <th width="13%">Quantity</th>
                    <th width="22%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($this->cart->total_items() > 0) {
                    foreach ($cartItems as $item) { ?>
                        <tr>
                            <td>
                                <?php $imageURL = !empty($item["image"]) ? base_url('assets/img/collection/' . $item["image"]) : base_url('assets/img/collection/'); ?>
                                <img src="<?php echo $imageURL; ?>" width="75" />
                            </td>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo 'RM' . $item["price"]; ?></td>
                            <td><?php echo $item["qty"]; ?></td>
                            <td><?php echo 'RM' . $item["subtotal"]; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5">
                            <p>No items in your cart...</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <?php if ($this->cart->total_items() > 0) { ?>
                        <td class="text-center">
                            <strong>Total <?php echo 'RM' . $this->cart->total(); ?></strong>
                        </td>
                    <?php } ?>
                </tr>
            </tfoot>
        </table>

        <!-- shipping address -->
        <form class="form-horizontal" method="post">
            <div class="ship-info">
                <h4>Shipping Info</h4>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <div class="col-sm=50">
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo !empty($custData['name']) ? $custData['name'] : ''; ?>" placeholder="Enter name">
                        <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="col-sm-30">
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo !empty($custData['email']) ? $custData['email'] : ''; ?>" placeholder="Enter email">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone: </label>
                    <div class="col-sm-30">
                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo !empty($custData['phone']) ? $custData['phone'] : ''; ?>" placeholder="Enter contact no">
                        <?php echo form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address: </label>
                    <div class="col-sm-30">
                        <textarea class="form-control" name="address" id="address" rows="3" value="<?php echo !empty($custData['address']) ? $custData['address'] : ''; ?>" placeholder="Enter address"></textarea>
                        <?php echo form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="footBtn">
                <a href="<?php echo base_url('carts/cart'); ?>" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Back to Cart</a>
                <button type="submit" name="placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->