   <style>
       .table_ul {
           padding-left: 0px;

       }

       .table_ul li {
           list-style: none;
           display: inline-block;
           margin-right: 50px;
           margin-left: 10px;
       }
   </style>


   <!-- <div id="page-wrapper"> -->
   <div class="content-wrapper">
       <section class="content-header">
           <h1>
               Stock Transfer
           </h1>

           <section class="content">
               <div class="row">
                   <div class="col-lg-12">

                       <div class="panel panel-default">
                           <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo site_url('distributor/stocks/') ?>"><i class="fa fa-th-list"><span class="text-align">view stock</span></i></a> </div>
                           <div class="panel-body">

                               <div class="panel-body">
                                   <!-- <div class="container-fluid"> -->
                                   <!-- <div class="col-md-12"> -->
                                   <div class="row">
                                       <div class=" col-md-2" style="text-align:center" id="ddate">

                                           Date <input type="date" name="date" id="prdt" class="in_date" value="<?php echo date('Y-m-d') ?>">
                                       </div>
                                   </div>
                                   <div class="row">

                                       <div class=" col-md-2" style="text-align:center">

                                           Shoppe

                                           <select class="niceSelect form-control d_name" id="distributorname" name="distributorname">
                                                <option disabled>Select Shoppe</option>
                                               <?php if (!empty($distributor)) {


                                                    foreach ($distributor as $key => $dvalue) { 
                                                        $order_table = $this->Common_model->distint_order('shoppe_orders');
                                                        foreach($order_table as $order_value){
                                                            print_r($order_value->shoppe_id);
                                                            if($order_value->shoppe_id == $dvalue->id ){
                                                                
                                                          ?>

                                                       <option value="<?php echo $dvalue->id; ?>"><?php echo $dvalue->name; ?></option>

                                               <?php  }} }
                                                } ?>
                                           </select>
                                       </div>
                                   
                                       <div class=" col-md-2" style="text-align:center">


                                           Product

                                           <select class="niceSelect form-control" id="productName" name="productName" onchange="//return product_id(this.value)">
                                                <option value="">Select Product</option>

                                               <?php
                                                  
                                                 

                                                foreach ($product_list as $value) { 
                                                   
                                                    ?>
                                                      
                                                   <option value="<?php echo  $value->product_id . '|' . $value->group_name . '|' . $value->rate . '|' . $value->unit . '|' . $value->Stock . '|' . $value->product_name; ?>" <?php if (1 == 1) {echo 'selected';} ?>><?php 
                                                              
                                                   echo  $value->product_name; ?></option><?php
                                                       
                                                } ?>
                                              </select>
                                       </div>

                                       <div id="dproductId">

                                           <input type="hidden" name="productId" id="productId" class="form-control input-sm text-center">
                                       </div>
                                       <div class=" col-md-2" style="text-align:center" id="dgroup">
                                           Group<input type="text" name="group" id="group" class="form-control input-sm text-center" readonly>
                                       </div>
                                       <div class=" col-md-2" style="text-align:center" id="dunit">

                                           Unit <input type="text" name="unit" id="unit" class="form-control input-sm text-center" readonly>
                                       </div>

                                       <div class=" col-md-2" style="text-align:center" id="drate">

                                           Rate<input type="text" name="rate" id="rate" class="form-control input-sm text-center" readonly>
                                       </div>
                                       <div class=" col-md-1" style="text-align:center;display:none;" id="dstock">

                                           <input type="text" name="stock" id="stock" class="form-control input-sm text-center">
                                       </div>
                                       <div class=" col-md-1" style="text-align:center" id="dquantity">
                                           Quantity <input type="text" name="quantity" id="quantity" class="form-control input-sm text-center">
                                       </div>

                                       <div id="ddistributer">

                                           <input type="hidden" name="ddistributer" id="ddistributer" class="form-control input-sm text-center">

                                       </div>
                                       <div id="stock_count">
                                           <input type="hidden" id="stock_c" class="form-control input-sm text-center">
                                       </div>

                                       <div class=" col-md-1 disa">
                                           <input type="button" id="add_data" value="add" class="btn btn-primary  btn-sm" style="margin-top: 20px;">
                                       </div>
                                   </div>
                                   <!-- </div> -->
                                   <!-- </div> -->
                                   <br>
                                   <section class="content">
                                       <div class="row">
                                           <div class="col-lg-12">
                                               <?php if ($info_message = $this->session->flashdata('info_message')) : ?>
                                                   <div id="form-messages" class="alert alert-success" role="alert">
                                                       <?php echo $info_message; ?>
                                                   </div>
                                               <?php endif ?>
                                               <div class="panel panel-default">

                                                   <!-- /.panel-heading -->
                                                   <div class="panel-body">
                                                       <div class="row">
                                                           <div class="col-lg-10">
                                                               <span class="for_date" style="display:none"><?php echo  date('Y-m-d'); ?></span>
                                                           </div>
                                                           <div class="col-lg-2">
                                                               Voucher NO : <span class="bill_no"></span>
                                                           </div>
                                                       </div>
                                                       <div style="display: block;overflow-x: auto;">
                                                           <table class="table table-bordered display nowrap table-responsive" cellspacing="0" id="data_table">
                                                               <thead>
                                                                   <tr class="bg-primary">
                                                                       <th>No</th>
                                                                       <th>Product</th>
                                                                       <th>Group</th>
                                                                       <th>Unit</th>
                                                                       <th>Rate</th>
                                                                       <th>Quantity</th>
                                                                       <th>Shoppe</th>
                                                                       <th style="display:none">date</th>
                                                                       <th>Action</th>

                                                                   </tr>
                                                               </thead>
                                                               <tbody id="colam">


                                                               </tbody>
                                                              
                                                           </table>
                                                           <div id='totalAppend'>
                                                          
                                                           </div>


                                                       </div>




                                                   </div>
                                                   <!-- /.panel-body -->
                                                   <!-- <table class="table table-bordered display nowrap table-responsive" cellspacing="0">
                                                          <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>  <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                         
                                                         
                                                           <td colspan="12" >Total</td>
                                                           <td>Total Qty</td>
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                          </tr>
                                                        </table> -->
                                               </div>

                                               <form method="POST" enctype="multipart/form-data">
                                                   <div class="col-md-12">
                                                       <div class="row">
                                                           <div class="col-md-3">
                                                               <label for="Ref no"></label>
                                                               <input type="text" class="form-control" name="ref" id="ref" placeholder="Refferal No" required>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <label for="Ref no"></label>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <label for="Image"></label>
                                                               <input type="file" name="file" class="form-control" id="file" required>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <div class="col-md-6">
                                                               <label for=""></label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="row">
                                                           <div class="col-md-9">
                                                               <textarea name="remark" id="remark" class="form-control" cols="34" rows="6" placeholder="Remark" style="width:100%" required></textarea>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="row">
                                                       <div class="col-md-6">
                                                           <label for=""></label>
                                                       </div>
                                                   </div>





                                                   <!-- /.panel -->
                                                   <div class="print" style="margin-top:40px">
                                                       <input type="button" id="save_data" value="Transfer" class="btn btn-primary btn-sm">
                                                   </div>
                                               </form>


                                           </div>
                                           <!-- /.col-lg-12 -->
                                       </div>
                                       <!-- /.row -->
                                   </section>




                                   </body>
                                   <script type="text/javascript">
                                       var data = [];
                                       var print_data = [];


                                       $(function() {

                                           $('#add_data').click(function() {


                                               if ($('#quantity').val() != '0') {
                                                   // alert("quantity Less than stock");
                                                   var productId = $('#productName').val();
                                                   var product_name= $('#productName').val();
                                                   var row=product_name.split('|');
                                                   var stock = $('#stock').val();
                                                   var product = ($("#productName option:selected").text());
                                                   var group = $('#group').val();
                                                   var unit = $('#unit').val();
                                                   var rate = $('#rate').val();
                                                   var quantity = $('#quantity').val();
                                                   var date = $('#prdt').val();
                                                   var distributer = ($("#distributorname option:selected").text());
                                                   var distributer_id = $('#distributorname').val();
                                                   var in_date = $('.in_date').val();

                                                   var store_data = {
                                                       'productId': $('#productId').val(),
                                                       'distributer': distributer,
                                                       ' product': $('#productName').val().split("|"),
                                                       'group': $('#group').val(),
                                                       'unit': $('#unit').val(),
                                                       'rate': $('#rate').val(),
                                                       'quantity': $('#quantity').val(),
                                                       'in_date': $('.in_date').val(),
                                                   }

                                                   data.push(store_data);
                                                   console.log(data);
                                                   var i = 0;
                                                   var total_quty = 0;
                                                   for (i; i < data.length; i++) {

                                                       //  alert(productId[0]);
                                                       //  alert(data[i]['productId'][0]);

                                                       if (productId[0] == data[i]['productId'][0]) {

                                                           // alert('enter');
                                                           var total_quty = parseInt(total_quty) + parseInt(data[i]['quantity']);


                                                       }

                                                   }


                                                   // $('#stock_count').html('<input type="hidden"  id="stock_count" class="form-control input-sm text-center" value="'+  $total_quty +'">');

                                                   $('.for_date').html(in_date);
                                                   //alert(total_quty);
                                                   if (total_quty <= $('#stock').val()) {
                                                       //var rate = 0;  
                                                       var Qty = 0;
                                                       var print_d = {
                                                           'productId': $('#productId').val(),
                                                           'distributer': distributer,
                                                           ' product': $('#productName').val().split("|"),
                                                           'group': $('#group').val(),
                                                           'unit': $('#unit').val(),
                                                           'rate': $('#rate').val(),
                                                           'quantity': $('#quantity').val(),
                                                           'in_date': $('.in_date').val()
                                                       }
                                                       
                                                     
                                                       print_data.push(print_d);
                                                       //alert(print_data.length);

                                                                   
                                                       $('#data_table tbody:last-child').append(

                                                            '<tr>' +
                                                            '<td>' + ($('#data_table tbody tr').length + 1) + '</td>' +
                                                            '<td style="display:none">' + productId + '</td>' +
                                                            '<td>' + product + '</td>' +
                                                            '<td>' + group + '</td>' +
                                                            '<td>' + unit + '</td>' +
                                                            '<td>' + rate + '</td>' +
                                                            '<td>' + quantity + '</td>' +
                                                            '<td>' + distributer + '</td>' +
                                                            '<td style="display:none" >' + distributer_id + '</td>' +
                                                            '<td style="display:none">' + date + '</td>' +
                                                            '<td><button type="button" id="delete-button"  class="btn btn-danger" onclick="delete_product(`'+row[0]+'`,this,`'+quantity+'`)">Delete</button></td>' +
                                                            '</tr>'
                                                            );
                                                           
                                                            var x=0;
                                                var Amount = 0;
                                                var Totalqty = 0;
                                                for(x;x<print_data.length;x++){
                                                    //alert(print_data[x]['quantity']);

                                                    Amount   = parseInt(Amount) + (parseInt(print_data[x]['rate'] * parseInt(print_data[x]['quantity'])));
                                                    Totalqty = parseInt(Totalqty) + parseInt(print_data[x]['quantity']);
                                                    
                                                    //console.log(Amount);
                                                    //$('#ref').append(Amount);
                                                }
                                                // alert(Amount);

                                            $('#totalAppend').html(`<tfoot class='table_ul' id="table_ul">
                                                            <tr>
                                                                <td>Total Amount : </td>
                                                                <td id="total_amount">`+Amount+`</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Qty : </td>
                                                                <td id="qtyToatl">`+Totalqty+`</td>
                                                            </tr>
                                                        </tfoot>`);
                                                   } else {
                                                       swal('info', 'You Have Enter More Then Available Stock Quantity', 'info');
                                                   }

                                                   // $('#dproductId').html('<input type="hidden" name="productId" id="productId" value="" class="form-control input-sm text-center">');
                                                   // $('#dgroup').html('Group<input type="text"  name="group" id="group" value="" class="form-control input-sm text-center">');
                                                   // $('#dunit').html('Unit<input type="text" name="unit" id="unit" value="" class="form-control input-sm text-center">');
                                                   // $('#drate').html('Rate<input type="text" name="rate" id="rate" value="" class="form-control input-sm text-center" id="rate">');
                                                   $('#dquantity').html('Quantity<input type="text" name="quantity" id="quantity"  class="form-control input-sm text-center">');

                                               }
                                           });
                                           // Add delete product - Rahul
                                           
                                           
                                          



                                           $('#productName').on('change', function() {
                                               var id = $(this).val();
                                               var res = id.split("|");
                                               //alert(res[0]);

                                               $('#dproductId').html('<input type="hidden" display="None"  name="productId" id="productId" value="' + res[0] + '" class="form-control input-sm text-center">');
                                               $('#dgroup').html('Group<input type="text"  name="group" id="group" value="' + res[1] + '" class="form-control input-sm text-center" readonly>');
                                               $('#dunit').html('Unit<input type="text" name="unit" id="unit" value="' + res[3] + '" class="form-control input-sm text-center" readonly>');
                                               $('#drate').html('Rate<input type="text" name="rate" id="rate" value="' + res[2] + '" class="form-control input-sm text-center"  readonly>');
                                               $('#dstock').html('<input type="hidden" name="stock" id="stock" value="' + res[4] + '" class="form-control input-sm text-center" id="stock" style="display:none">');
                                               $('#dquantity').html('Quantity<input type="text" name="quantity" value="' + res[4] + '" max="2" class="form-control input-sm text-center" id="quantity">');


                                           });

                                           $('#save_data').click(function() {

                                               var table_data = [];
                                               // alert()
                                               $('#data_table tr').each(function(row, tr) {

                                                   if ($(tr).find('td:eq(0)').text() == "") {


                                                   } else {

                                                       var sub = {

                                                           //'no': $(tr).find('td:eq(0)').text(),

                                                           'dproductId': $(tr).find('td:eq(1)').text(),
                                                           'dgroup': $(tr).find('td:eq(3)').text(),
                                                           'dunit': $(tr).find('td:eq(4)').text(),
                                                           'drate': $(tr).find('td:eq(5)').text(),
                                                           'dquantity': $(tr).find('td:eq(6)').text(),
                                                           'ddistributer': $(tr).find('td:eq(8)').text(),
                                                           'ddate': $(tr).find('td:eq(9)').text(),
                                                           'ref': $('#ref').val(),
                                                           'upload': document.getElementById('file').files[0].name,
                                                           // 'tmp_name':document.getElementById('file').files[0].tmp_name,
                                                           'remark': $('#remark').val()

                                                       };
                                                       //console.log(sub);
                                                       //alert(sub);

                                                       table_data.push(sub);

                                                   }
                                               });



                                               $(function() {
                                                   var data = {
                                                       'data_table': table_data

                                                   };
                                                   // var upload =$('#upload').val();
                                                   // console.log(upload);
                                                   $.ajax({

                                                       type: 'POST',
                                                       data: data,
                                                       url: '<?php echo base_url('distributor/transfer_stock'); ?>',
                                                       crossorigin: false,
                                                       dataType: 'text',
                                                       success: function(result) {
                                                           if (result) {

                                                               $('.bill_no').append(result);
                                                               $('.disa').html('<input type="button" id="add_data" value="Add" class="btn btn-primary  btn-sm" style="margin-top: 20px;" disabled>');
                                                               $('.print').html(`<input type="button" value="print" onclick="print_1()" class="btn btn-primary btn-sm">`);
                                                               $('.print').append('<input type="button" onclick="location.reload()" value="New" class="btn btn-primary btn-sm" style="margin-left:10px">');


                                                           } else {
                                                               alert('failed');
                                                               //alert('failed');

                                                           }
                                                       }
                                                   })
                                               });
                                           });

                                       });
                                       function delete_product(product_id,el,quantity){
                                              // alert(quantity);
                                                console.log("before",data);
                                                console.log("before",print_data);
                                                console.log(product_id);
                                                        for(var i = 0; i < data.length; i++) {
                                                        if(data[i].productId == product_id && data[i].quantity == quantity ) {
                                                            data.splice(i, 1);
                                                            break;
                                                        }
                                                    }
                                                    for(var i = 0; i < print_data.length; i++) {
                                                        if(print_data[i].productId == product_id) {
                                                            print_data.splice(i, 1);
                                                            break;
                                                        }
                                                    }
                                                    console.log("after",data);
                                                console.log("after",print_data);
                                                                var x=0;
                                                                    var Amount = 0;
                                                                    var Totalqty = 0;
                                                                    for(x;x<data.length;x++){
                                                                        //alert(print_data[x]['quantity']);

                                                                        Amount   = parseInt(Amount) + (parseInt(data[x]['rate'] * parseInt(data[x]['quantity'])));
                                                                        Totalqty = parseInt(Totalqty) + parseInt(data[x]['quantity']);
                                                                        
                                                                        //console.log(Amount);
                                                                        //$('#ref').append(Amount);
                                                                    }
                                                                    
                                                                    $('#total_amount').text(Amount);
                                                                    $('#qtyToatl').text(Totalqty);
                                                                    $(el).parents("tr").remove();
                                                }
                                       
                                       function print_1() {

                                           var i = 0;

                                           // console.log(print_data);
                                           //dist_name =null;

                                           var v_no = $('.bill_no').html();
                                           var date = $('.for_date').html();

                                           var html;
                                           html += '<div class="form wrap_all container" style="width:100%;font-size:13px;padding:15px;padding-left:0px;margin-left:0px;" ><div class="card"><div class="card-header p-4"></div><div class="card-body" id="printables"><div class="row mb-4" style="margin-bottom:1%;text-align:center;font-size:18px"><strong>BHARATJAN SEVA SAMAGRI</strong><div class="col-sm-6" style="align:center;"><h4 style="font-weight:bold;text-align:center;font-size:16px"><b></b></h4><div style="text-align:center;font-size:16px"><b></b></div><div style="text-align:center;font-size:14px"><b></b></div><div style="text-align:center;font-size:14px">DATE : ' + date + '</div><div style="text-align:center;font-size:14px"></div><div style="font-size:16px;font-weight:bold;text-align:center;margin-top:5px" class="bill_no">Voucher No. : ' + v_no + '</div></div></div>';


                                          

                                           html += '<hr style=" border-top: 2px solid #000;"><div class="table-responsive-lg">';
                                           html += ' <table>';
                                           html += '<thead>';
                                           html += '<tr>';

                                           html += '</tr>';
                                           html += '<tr>';
                                           html += '<div  style="width:5.28%;display:inline-block;">No</div>  <div  style="width:23.28%;display:inline-block;"> Product</div>  <div  style="width:14.28%;display:inline-block;">Group</div> <div  style="width:14.28%;display:inline-block;">Unit</div> <div  style="width:14.28%;display:inline-block;">Rate</div><div  style="width:14.28%;display:inline-block;">QTY</div><div  style="width:14.28%;display:inline-block;">Distributer</div>';
                                           html += '<hr style="border-top: 2px solid #000;">';
                                           html += '</tr>';
                                           html += '</thead>';
                                           html += '<tbody>';
                                           var i = 0;
                                            var Am = 0;
                                            var qt = 0;
                                           //console.log(data);
                                           alert(data[0]['rate'])
                                           for (i; i < data.length; i++) {
                                              
                                               var product_name = data[i][' product'][5];

                                               var date = data[i]['in_date'];
                                               var group = data[i]['group'];
                                               var quantity = data[i]['quantity'];
                                               var rate = data[i]['rate'];
                                               var unit = data[i]['unit'];
                                               var dist_name = data[i]['distributer'];
                                               var Am = parseInt(Am)+ (parseInt(data[i]['rate']) * parseInt(data[i]['quantity'])) ;
                                               var qt = parseInt(qt)+ parseInt(data[i]['quantity']);
                                               var s_no = i + 1;




                                              
                                               html += '<tr style="font-size:18px;text-align:center">';

                                               html += '<div style="width:5.28%;display:inline-block;">' + s_no + '</div>';

                                               html += '<div style="width:23.28%;display:inline-block;">' + product_name + '</div>';
                                               html += '<div style="width:14.28%;display:inline-block;">' + group + '</div>';
                                               html += '<div style="width:14.28%;display:inline-block;">' + unit + '</div>';
                                               html += '<div style="width:14.28%;display:inline-block;">' + rate + '</div>';
                                               html += '<div style="width:14.28%;display:inline-block;">' + quantity + '</div>';
                                               html += '<div style="width:14.28%;display:inline-block;">' + dist_name + '</div>';


                                               html += '</tr>';




                                           }



                                           html += '</tbody>';
                                        
                                        
                                           html += '</table>';
                                           
                                           html += '<hr style=" border-top: 1px solid #000;"><div class="table-responsive-lg">';
                                        //    html +='<div  style="width:5.28%;display:inline-block;"></div>  <div  style="width:23.28%;display:inline-block;"></div>  <div  style="width:14.28%;display:inline-block;"></div></div> <div  style="width:14.28%;display:inline-block;">Toatal Amount : '+Am+'</div><div  style="width:14.28%;display:inline-block;">Toatal Quantity : '+qt+'</div><div  style="width:14.28%;display:inline-block;"></div>';
                                           html +='<div>';
                                            html +='Total Amount :'       
                                            html += Am;
                                           html +='</div>';
                                           html +='<div>';
                                           html +='Total Quantity :' 
                                            html += qt;
                                           html +='</div>'; 

                                          

                                           newWin = window.open("");
                                           newWin.document.write(html);
                                           newWin.print();
                                           newWin.close();
                                           //console.log(cmds);




                                       }
                                   </script>

                               </div>
                           </div>
           </section>
   </div>
   <script type="text/javascript">
       $(document).ready(function() {
           var i = 1;

           $('#add').click(function() {
               i++;
               $('#dynamic_field').append('<div id="row' + i + '"><div class="box-body"><br> <label class="col-md-1">Category</label><div class="col-lg-3"><select class="form-control" name="category[]"><option>Category</option></select></div><div class="col-lg-2"><input type="number" name="quantity" class="form-control" autocomplete="off" placeholder="Quantity" required="required"></div> <div class="col-lg-2">  <input type="number" name="unit" class="form-control" autocomplete="off"  placeholder="unit" required="required"></div><div class="col-lg-2">  <input type="number" name="stock" class="form-control" autocomplete="off"  placeholder="stock" required="required"></div><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div></div></div>');
           });

           $(document).on('click', '.btn_remove', function() {
               var button_id = $(this).attr("id");
               var res = confirm('Are You Sure You Want To Delete This?');
               if (res == true) {
                   $('#row' + button_id + '').remove();
                   $('#' + button_id + '').remove();
               }
           });

       });
   </script>

   </html>