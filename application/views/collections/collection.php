<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- List Of Collection -->
    <div class="card-group row">
        <div class="card-group row">
            <?php if (!empty($collection)) {
                foreach ($collection as $row) { ?>
                    <div class="thumbnail" style="max-width: 15rem;">
                        <img src="<?= base_url('assets/img/collection/' . $row['image']); ?>" class="card-img-top" style="max-height: 13rem;" />
                        <div class="card-body">
                            <h4 class="text-center"><?php echo $row['name']; ?></h4>
                            <h5 class="text-center">RM <?php echo $row['price']; ?></h5>
                            <p class="text-center"><?php echo $row['description']; ?></p>
                        </div>
                        <div class="text-center">
                            <a href="<?php echo base_url('collections/addToCart/' . $row['id']); ?>" class="btn btn-success">Add to Cart</a>
                        </div>
                        <pre></pre>
                        <pre></pre>
                    </div>
                <?php }
            } else { ?>
                <p>Product(s) not found...</p>
            <?php } ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->