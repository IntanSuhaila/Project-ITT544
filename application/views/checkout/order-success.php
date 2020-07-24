<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <p class="ord-succ">Your order has been placed successfully.</p>

    <!-- order status & shipping info -->
    <div class="row col-lg-12 ord-addr-info">
        <div class="col-sm-6 adr">
            <div class="hdr">Shipping Address</div>
            <p><?php echo $order['name']; ?></p>
            <p><?php echo $order['email']; ?></p>
            <p><?php echo $order['phone']; ?></p>
            <p><?php echo $order['address']; ?></p>
        </div>
        <div class="col-sm-6 info">
            <div class="hdr">Order Info</div>
            <p><b>Reference ID</b> #<?php echo $order['id']; ?></p>
            <p><b>Total</b> <?php echo 'RM' . $order['grand_total']; ?></p>
        </div>
    </div>

    <!-- order items -->
    <div class="row ord-items">
        <?php if (!empty($order['items'])) {
            foreach ($order['items'] as $item) { ?>
                <div class="col-lg-12 item">
                    <div class="col-sm-2">
                        <div class="img" style="height: 75px; width: 75px;">
                            <?php $imageURL = !empty($item["image"]) ? base_url('assets/img/collection/' . $item["image"]) : base_url('assets/img/collection/'); ?>
                            <img src="<?php echo $imageURL; ?>" width="75" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <p><b><?php echo $item["name"]; ?></b></p>
                        <p><b><?php echo 'RM' . $item["price"]; ?></b></p>
                        <p>QTY: <?php echo $item["quantity"]; ?></p>
                    </div>
                    <div class="col-sm-2">
                        <p><b><?php echo 'RM' . $item["sub_total"]; ?></b></p>
                    </div>
                </div>
        <?php }
        } ?>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->