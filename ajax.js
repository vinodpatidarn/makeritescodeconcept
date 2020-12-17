
 https://github.com/jayanthbabu123/how-to-convert-html-web-pages-to-pdf-in-javascript
 // javascript html code convert to pdf code  in same  formate

$(document).ready(function(){

    $("#formData").submit(function(e){
   e.preventDefault();   
   
   var formData = new FormData(this);
   
         $.ajax({
           url :'login_from.php',
           type :'POST',
             data : formData,
             cache: false,
             dataType: 'json',
             contentType: false,
             processData: false,
            
 
               success:function(data){
                
                if(data.response.code == '1')
               {
                   $.toast({
              heading: 'Success',
              text: data.response.msg,
                showHideTransition: 'slide',
                icon: 'success',
                showHideTransition: 'fade',
                hideAfter: 3000,
              position: 'top-right',
                loaderBg: '#9EC600'
         });   
                    setTimeout(function() {
                             window.location.href = "admin_login.php";
                         }, 3000);             
                }
                if(data.response.code == '0')
               {
                   $.toast({
             heading: 'Warning',
             text: data.response.msg,
               showHideTransition: 'slide',
               icon: 'warning',
               showHideTransition: 'fade',
               hideAfter: 3000,
             position: 'top-right',
               loaderBg: '#9EC600'
         });             }
 
            },
 
             error:function(data) {
                 console.log("error");
                 console.log(data);
             }
         });
     });
 
   });
https://www.jqueryscript.net/other/Print-Specified-Area-Of-A-Page-PrintArea.html

// ajax use for product filters by price and checkbox
filter_item();

    function filter_item()
    {
        $('.product_filter').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var f_name = "<?php echo $_GET['p_name']?>"
        var minimum_price = $('#min').val();
        var maximum_price = $('#max').val();
         var size = get_filter('variant');
         
         var ram = get_filter('ram');
         var storage = get_filter('storage');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action,p_name:f_name,minimum_price:minimum_price,maximum_price:maximum_price,size:size},
            success:function(data){
                $('.product_filter').html(data);
            }
        });
    }
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_item();
    });
     $('.min-max-slider').click(function(){
         filter_item();   
     });
// and  then fetch data by tables
<?php
include 'function.php';
$min = $_POST['minimum_price'];


$max = $_POST['maximum_price'];
if (isset($_POST['maximum_price']) and !empty($_POST['maximum_price']) ) {
   $size1 ="";
   if(isset($_POST['size'])){
   $size1 = implode(',',array_map('intval',$_POST['size']));   
}
   
   
   $strfilter ="";
   if(!empty($size1))
   {
        $strfilter = " AND product_attributes.product_attributes IN(".$size1.") ";
   }
   else{
    $strfilter ="";
   }

    $p_fname = base64_decode($_POST['p_name']);
    $result = mysqli_query($conn, "SELECT product.product_image as p_img,product.product_name as p_name,product.id as p_id,product_attributes.product_price,product_attributes.	product_attributes as p_a_attribute,product_attributes.product_price as p_a_price FROM product INNER JOIN product_attributes ON product.id = product_attributes.product_id WHERE (product_attributes.product_price BETWEEN $min AND $max )
     $strfilter AND sub_cat_id = '$p_fname'");

    if (mysqli_num_rows($result) > '0') {
        while ($p_rows = mysqli_fetch_array($result)) {
?>

            <div class="col-6 col-md-4 col-lg-4 col-xl-3 product_filter">
                <div class="product product-7 text-center" style="box-shadow: 0 0px 5px 0px #777;">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        <a href="product-details.php">
                            <?php
                            $images  = @unserialize($p_rows['p_img']);
                            $f_image = isset($images[0]) ? $images[0] : '';
                            ?>
                            <img src="assets/uploads/<?php if (!empty($f_image)) {
                                                            echo $f_image;
                                                            //echo implode(',',unserialize($p_rows['p_img']));
                                                        } else {
                                                            echo "default_img/download.png";
                                                        }; ?>" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">


                            <a href="#" id="a_value" class="btn-product btn-cart" ><span>add to cart</span></a>
                                                        
                                                    </div><!-- End .product-action -->
                                                </figure><!-- End .product-media -->

                                                <div class=" product-body">
                                <div class="product-cat">
                                    <a href="#"></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.php"><?php echo $p_rows['p_name']; ?></a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <?php echo $p_rows['p_a_attribute']; ?> Rs <?php echo $p_rows['p_a_price']; ?>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <!-- End .product-nav -->
                        </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->

<?php
        }
    }


}
?>
    //end fetch data by tables

//full filter used by html pages for price and checkbox

<?php 

//index.php

include('database_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
         <br />
         <h2 align="center">Advance Ajax Product Filters in PHP</h2>
         <br />
            <div class="col-md-3">                    
    <div class="list-group">
     <h3>Price</h3>
     <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 65000</p>
                    <div id="price_range"></div>
                </div>    
                <div class="list-group">
     <h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
     <?php

                    $query = "SELECT DISTINCT(product_brand) FROM product WHERE product_status = '1' ORDER BY product_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['product_brand']; ?>"  > <?php echo $row['product_brand']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

    <div class="list-group">
     <h3>RAM</h3>
                    <?php

                    $query = "
                    SELECT DISTINCT(product_ram) FROM product WHERE product_status = '1' ORDER BY product_ram DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['product_ram']; ?>" > <?php echo $row['product_ram']; ?> GB</label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>
    
    <div class="list-group">
     <h3>Internal Storage</h3>
     <?php
                    $query = "
                    SELECT DISTINCT(product_storage) FROM product WHERE product_status = '1' ORDER BY product_storage DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector storage" value="<?php echo $row['product_storage']; ?>"  > <?php echo $row['product_storage']; ?> GB</label>
                    </div>
                    <?php
                    }
                    ?> 
                </div>
            </div>

            <div class="col-md-9">
             <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
 text-align:center; 
 background: url('loader.gif') no-repeat center; 
 height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>
 
</body>

</html>

 // anchore tag ajax use
 $(document).ready(function() {
        $('.anchore_value').click(function(event) {
            event.preventDefault();
            var get = $(this).attr('value');
            alert('Add to Cart');
            $.ajax({
                url: 'addcart.php?id='+get,
                success: function(data) {
                    $(".fetch_data").html(data);
                   },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        });
    });

 
 
 
