<?php require_once VIEWS_PATH . DS . 'includes' . DS . 'main' . DS . 'header.php'; ?>

<div class = "container mt-3 px-5">   
    <div class="row align-items-center">
        <!-- header text -->
        <div class="col">
            <h1 class="ms-2">Product List</h1>
        </div>
        <!-- buttons -->
        <div class="col">
            <!-- ADD BUTTON -->
            <!--Link with (add product page) by clicking (ADD button)-->
            <button onclick=" window.location.href = 'product/add' " type="button" class="btn btn-light  float-end me-2" >ADD</button>
            <!--DELETE BUTTON -->
            <button type="submit" form= "products" class="btn btn-danger float-end me-2" id ="delete-product-btn">MASS DELETE</button>                      
        </div>
    </div>
    <hr>


    <form id = "products" action="product/delete" method="post">
        <div class="row">
            
            <!-- Iteration through all products from database -->
            <?php foreach ($products as $product):?>
                
                        <div class = "col-md-3 col-sm-6 border border-2  border-top-0 border-bottom-0 rounded-circle text-center py-4 my-3" >
                            <!-- checkbox -->
                            <div class="form-check">
                                <input class="form-check-input delete-checkbox DVD" name = "<?php echo $product['item_id'] ?>" type="checkbox" value= "<?php echo $product['type'] ?>" id="flexCheckDefault">
                            </div>
                            <!-- showing Product sku -->
                            <h6><?php echo $product['sku'] ?></h6>
                            <!-- showing Product name -->
                            <h6><?php echo $product['name'] ?></h6>
                            <!-- showing Product price -->
                            <h6><?php echo round($product['price'], 2).' $' ?></h6>
                            <!-- showing Product size -->
                            <h6><?php echo $idsWithSpecialAttrs[ $product['item_id'] ]?></h6>
                        </div>

            <?php endforeach; ?>

        </div>
    </form>

</div>

<?php require_once VIEWS_PATH . DS . 'includes' . DS . 'main' . DS . 'footer.php';
