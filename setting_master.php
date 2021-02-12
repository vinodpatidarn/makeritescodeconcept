<link href="https://nightly.datatables.net/colreorder/css/colReorder.dataTables.css?_=b5e1f72100ce548dc8ad3fd6e4211bad.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/colreorder/js/dataTables.colReorder.js?_=b5e1f72100ce548dc8ad3fd6e4211bad"></script>
<style type="text/css">
    div.dt-button-collection button.dt-button.active:not(.disabled) {


        background-image: linear-gradient(to bottom, #337ab7 0%, #337ab7 100%) !important;


        color: #fff !important;

    }

    button.dt-button.dt-button.active:not(.disabled):hover:not(.disabled) {
        background-image: linear-gradient(to bottom, #eaeaea 0%, #ccc 100%) !important;
        color: #000 !important;
    }
    .hide1{
	display:none;
    }
    .show1{
        display:block;
    }
    .hide2{
	display:none;
    }
    .show2{
        display:block;
    }
</style>

<!-- <div id="page-wrapper"> -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Setting Masters
        </h1>
                        <div class="row" style="margin-top:5px">
                                <div class="col-lg-8">
                                   <div class="alert alert-success hide1" style="border-radius: 66px;">Data submitted successfully ThankYou !</div> 
                                        </div> 
                                        <div class="col-lg-8">
                                   <div class="alert alert-fail hide1"> Review submitted Failed TryAgain !</div> 
                            </div>
                            <div class="row" style="margin-top:5px">
                                <div class="col-lg-8">
                                   <div class="alert alert-success hide2" style="border-radius: 66px;">Data Update successfully ThankYou !</div> 
                                        </div> 
                                        <div class="col-lg-8">
                                   <div class="alert alert-fail hide2"> Review submitted Failed TryAgain !</div> 
                            </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="panel panel-default">
                    <!-- <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo site_url('admin/') ?>"><i class="fa fa-th-list"><span class="text-align">Add Setting Masters</span></i></a> </div> -->
                           
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <!-- <div class="col-lg-12"> -->
                        <?php
                                                if (!empty($update_data)) {
                            //print_r($update_data);
                            foreach ($update_data as $update_value) {
                        ?>
                                <form method="POST" id="update_data" class="form-inline">
                                    <label for="">Code Type</label>
                                    <select name="update_code_type" id="update_code_type" class="form-control" class="" onchange="change_data(this.value)" style="margin-right: 20px;text-transform: capitalize" >
                                        <option value="" disabled>Select Code</option>
                                        <?php
                                        if (!empty($code_type)) {
                                            foreach ($code_type as $values) {
                                        ?>
                                                <option style="text-transform: capitalize" value="<?php echo $values->settings_type; ?>" <?php echo ($update_value->setting_type == $values->settings_type) ? 'selected' : '' ?>><?php echo $values->settings_type; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>


                                    <label for=""> Name </label>
                                    <input type="text" name='update_update_code_name' id="update_code_name" class="form-control" class="" placeholder="Name" value="<?php echo $update_value->name; ?>" style="margin-right: 20px;">


                                    <label for="">Sequence</label>
                                    <input type="number" min='0' name='update_sequece' id='update_sequece' class="form-control" class="" value="<?php echo $update_value->sequence; ?>" style="margin-right: 20px;">


                                    <label for="">Status</label>
                                    <select name="update_status" id="update_status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1" <?php echo ($update_value->status == '1') ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?php echo ($update_value->status == '0') ? 'selected' : '' ?>>InActive</option>
                                    </select>

                                    <!-- </div>   -->

                                    <div class="row">
                                        <div class="col-lg-12" style="margin-top: 35px;">

                                            <textarea name="update_remark" id="update_remark" rows="4" placeholder="Remarks" style="width: 83%;"><?php echo $update_value->remark; ?></textarea>


                                        </div>
                                        <div class="col-lg-12" style="margin-top: 10px;">

                                            <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $update_value->id; ?>">
                                            <input type="submit" name="save" class="btn btn-success" value="Update">
                                            <a class="btn btn-success" href="<?php echo base_url('index.php/admin/setting_master/') ?>">Add New</a>

                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                        } else {
                            ?>
                            <form method="POST" id="formData" class="form-inline">

                                <label for="">Code Type</label>
                                <select name="code_type" id="code_type" class="form-control" class="" onchange="change_data(this.value)" style="margin-right: 20px;text-transform: capitalize">
                                    <option value="" style="text-transform: capitalize" disabled>Select Code</option>
                                    <?php
                                    if (!empty($code_type)) {
                                        foreach ($code_type as $values) {
                                    ?>
                                            <option style="text-transform: capitalize" value="<?php echo $values->settings_type; ?>"><?php echo $values->settings_type; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>


                                <label for=""> Name </label>
                                <input type="text" name='code_name' id="code_name" class="form-control" class="" placeholder="Name" style="margin-right: 20px;">


                                <label for="">Sequence</label>
                                <input type="number" min='0' name='sequece' id='sequece' class="form-control" class="" style="margin-right: 20px;">


                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>

                                <!-- </div>   -->

                                <div class="row">
                                    <div class="col-lg-12" style="margin-top: 35px;">

                                        <textarea name="remark" id="remark" rows="4" placeholder="Remarks" style="width: 83%;"></textarea>


                                    </div>
                                    <div class="col-lg-12" style="margin-top: 10px;">
                                        <input type="submit" name="save" class="btn btn-success" value="Save">

                                    </div>
                                </div>

                            </form>
                        <?php

                        }

                        ?>

                        <!-- table start -->
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="appointment">
                                <thead class="table_headings">
                                    <tr class="bg-primary">
                                        <th>Sr. no</th>
                                        <th class="code_type">Code</th>
                                        <th>Name</th>
                                        <th>Sequence</th>
                                        <th>remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_append">

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive AND table end -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </section>
</div>

<script type="text/javascript">
    // $(document).ready(function() {
    //     // var currentRow=$('#code_type').closest("tr"); 
    //     // var code =currentRow.find("td:eq(1)").text();
    //     // alert(code);
    //     var table = $('#appointment').DataTable({
    //         responsive: true,
    //         colReorder: true,
    //         'aoColumnDefs': [{
    //             'bSortable': false,
    //             'aTargets': [-1],
    //             /* 1st one, start by the right */

    //         }],
    //         columns: [{
    //                 name: 'Sr. no'
    //             },
    //             {
    //                 name: 'Code'
    //             },
    //             {
    //                 name: 'Name'
    //             },
    //             {
    //                 name: 'Sequence'
    //             },
    //             {
    //                 name: 'remark'
    //             },
    //             {
    //                 name: 'Status'
    //             },
    //             {
    //                 name: 'Action'
    //             },


    //         ],

    //         dom: 'Bfrtip',
    //         buttons: [{
    //                 extend: 'pageLength',
    //                 titleAttr: 'Registros a mostrar',
    //                 className: 'selectTable'
    //             },
    //             {
    //                 extend: 'csvHtml5',
    //                 text: 'Csv',
    //                 exportOptions: {
    //                     columns: [0, ':visible'],
    //                     modifier: {
    //                         search: 'none'
    //                     }
    //                 }
    //             },
    //             {
    //                 extend: 'copyHtml5',
    //                 exportOptions: {
    //                     columns: [0, ':visible']
    //                 }
    //             },
    //             {
    //                 extend: 'excelHtml5',
    //                 exportOptions: {
    //                     columns: ':visible'
    //                 }
    //             },
    //             {
    //                 extend: 'pdfHtml5',
    //                 exportOptions: {
    //                     columns: ':visible'
    //                 }
    //             },

    //             'colvis'
    //         ]

    //     });
    // });

    function delete_category(id, tr_id) {
        swal({
            title: "Are you sure?",
            text: "you want to delete?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo site_url('admin/delete') ?>",
                data: {
                    id: id,
                    table: 'master_setting'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully deleted!", "success");
                $('#tr_' + tr_id).remove();
            }).error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
        });
    }

    function update_status(id, status, tr_id) {
        swal({
            title: "Are you sure?",
            text: "you want to change Status?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo site_url('admin/update_status') ?>",
                data: {
                    id: id,
                    status: status,
                    table: 'master_setting'
                },
                type: "POST"
            }).done(function(data) {
                // console.log(data);
                // alert(data);
                swal("Success", "Status Change Successfully", "success");
                window.location.reload();
                //$('.status_change').html('')
                //$('#tr_' + tr_id).remove();
            }).error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
        });
    }

    function change_data(val) {
        var site_url = "<?php echo site_url('admin/setting_master/'); ?>";
        $.ajax({
            url: "<?php echo site_url('admin/table_data_update') ?>",
            data: {
                id: val
            },
            type: "POST",
            success: function(data) {
                var data1 = JSON.parse(data);
                console.log(data1);
                $('#table_append').html('');
                for (var i = 0; i < data1.length; i++) {
                    var rows = i + 1;
                    $('#table_heading').append(`<tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th style="text-transform:Uppercase class="code_type">Code</th>
                                    <th>Name</th>
                                    <th>Sequence</th>
                                    <th>remark</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   </tr>`)
                    $('#table_append').append(`<tr class="odd gradeX" id="tr_`+rows+`">
                                    
                                    <td>` + rows + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['setting_type'] + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['name'] + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['sequence'] + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['remark'] + `</td>
                                    <td class="status_change">` + (data1[i]['status'] == '1' ? 'Active' : 'InActive') + `</td>
                                    <td class="center">` + (data1[i]['status'] == 0 ? `<a title="Update" href="javascript:void(0)" onclick="update_status(` + data1[i]['id'] + `,'1',` + rows + `)" class="btn btn-danger"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>` : `<a title="Update" href="javascript:void(0)" onclick="update_status(` + data1[i]['id'] + `,'0',` + rows + `)" class="btn btn-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>`) + `<a title="Edit" href='` + site_url + '' + data1[i]['id'] + `' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a title="Delete" href="javascript:void(0)" onclick="delete_category(` + data1[i]['id'] + `,`+rows+`)" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                   </tr>`);
                }
            }
        })

    }
    $(document).ready(function() {
        $("#formData").submit(function(e) {
            e.preventDefault();
            // alert('data');
            // location.reload(flase)
            var code_type = $('#code_type').val();
            //alert(code_type);
            var code_name = $('#code_name').val();
            var sequece = $('#sequece').val();
            var remark = $('#remark').val();
            var status = $('#status').val();
            var site_url = "<?php echo site_url('admin/setting_master/'); ?>";


            if (code_name == '') {
                $('#code_name').css("border", "1px solid blue");
                $('#code_name').focus();
                return false;
            }
            if (sequece == '') {
                $('#sequece').css("border", "1px solid blue");
                $('#sequece').focus();
                return false;
            }
            if (remark == '') {
                $('#remark').css("border", "1px solid blue");
                $('#remark').focus();
                return false;
            }



            document.getElementById("formData").reset();

            $.ajax({
                url: "<?php echo site_url('admin/setting_master_save'); ?>",
                data: {
                    type: code_type,
                    code_name: code_name,
                    sequece: sequece,
                    remark: remark,
                    status: status,
                },
                type: "POST",
                success: function(data) {
                    var data1 = JSON.parse(data);
                   // console.log(data1);
                   $('.alert-success').removeClass('hide1');
                    $('#table_append').html('');
                    for (var i = 0; i <= data1.length; i++) {
                        var rows = i + 1;
                        $('#table_headings').html(`<tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th style="text-transform: capitalize">` + data1[0]['setting_type'] + `</th>
                                    <th>Name</th>
                                    <th>Sequence</th>
                                    <th>remark</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   </tr>`);

                        $('#table_append').append(`<tr class="odd gradeX" id="tr_`+rows+`">
                                    
                                    <td>` + rows + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['setting_type'] + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['name'] + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['sequence'] + `</td>
                                    <td style="text-transform: capitalize">` + data1[i]['remark'] + `</td>
                                    <td>` + (data1[i]['status'] == '1' ? 'Active' : 'InActive') + `</td>
                                    <td class="center">
                                    
                                    ` + (data1[i]['status'] == 0 ? `<a title="Update" href="javascript:void(0)" onclick="update_status(` + data1[i]['id'] + `,'1',` + rows + `)" class="btn btn-danger"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>` : `<a title="Update" href="javascript:void(0)" onclick="update_status(` + data1[i]['id'] + `,'0',` + rows + `)" class="btn btn-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>`) + `
                                    <a title="Edit" href='` + site_url + '' + data1[i]['id'] + `' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a title="Delete" href="javascript:void(0)" onclick="delete_category(` + data1[i]['id'] + `,`+rows+`)" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                           </td>
                                   </tr>`);


                    }
                }
            })
        });
    });

    $(document).ready(function() {
        $("#update_data").submit(function(e) {
            //e.preventDefault();

            // alert('data');
            // location.reload(flase)
            var update_code_type = $('#update_code_type').val();
            var hidden_id = $('#hidden_id').val();
            //alert(code_type);
            var update_code_name = $('#update_code_name').val();
            var update_sequece = $('#update_sequece').val();
            var update_remark = $('#update_remark').val();
            var update_status = $('#update_status').val();
            var site_url = "<?php echo site_url('admin/setting_master/'); ?>";


            if (update_code_name == '') {
                $('#update_code_name').css("border", "1px solid blue");
                $('#update_code_name').focus();
                return false;
            }
            if (update_sequece == '') {
                $('#update_sequece').css("border", "1px solid blue");
                $('#update_sequece').focus();
                return false;
            }
            if (update_remark == '') {
                $('#update_remark').css("border", "1px solid blue");
                $('#update_remark').focus();
                return false;
            }



            document.getElementById("update_data").reset();

            $.ajax({
                url: "<?php echo site_url('admin/setting_master_update'); ?>",
                data: {
                    type: update_code_type,
                    code_name: update_code_name,
                    sequece: update_sequece,
                    remark: update_remark,
                    status: update_status,
                    hidden_id: hidden_id
                },
                type: "POST",
                success: function(data) {
                    var data1 = JSON.parse(data);
                    console.log(data1);
                    $('.alert-success').removeClass('hide2');
                    $('#table_append').html('');
                    for (var i = 0; i <= data1.length; i++) {
                        var rows = i + 1;
                        $('#table_headings').html(`<tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th style="text-transform: capitalize">` + data1[0]['setting_type'] + `</th>
                                    <th>Name</th>
                                    <th>Sequence</th>
                                    <th>remark</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   </tr>`);

                        $('#table_append').append(`<tr class="odd gradeX" id="tr_`+rows+`">
                                    
                                    <td>` + rows + `</td>
                                    <td>` + data1[i]['setting_type'] + `</td>
                                    <td>` + data1[i]['name'] + `</td>
                                    <td>` + data1[i]['sequence'] + `</td>
                                    <td>` + data1[i]['remark'] + `</td>
                                    <td>` + (data1[i]['status'] == '1' ? 'Active' : 'InActive') + `</td>
                                    <td class="center">
                                    
                                    ` + (data1[i]['status'] == 0 ? `<a title="Update" href="javascript:void(0)" onclick="update_status(` + data1[i]['id'] + `,'1',` + rows + `)" class="btn btn-danger"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>` : `<a title="Update" href="javascript:void(0)" onclick="update_status(` + data1[i]['id'] + `,'0',` + rows + `)" class="btn btn-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>`) + `
                                    <a title="Edit" href='` + site_url + '' + data1[i]['id'] + `' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a title="Delete" href="javascript:void(0)" onclick="delete_category(` + data1[i]['id'] + `,`+rows+`)" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                           </td>
                                   </tr>`);


                    }
                }
            })
        });
    });
    // $.fn.dataTable.ext.search.push(
    //     function( settings, data, dataIndex ) {
    //         var status = $('#status').val();
    //         if(status=='select' || status==undefined){
    //             return true;
    //         }
    //         if(status==data[13]){
    //             return true;
    //         }
    //         else{
    //             return false;
    //         }
    //         // if ( ( isNaN( min ) && isNaN( max ) ) ||
    //         //      ( isNaN( min ) && age <= max ) ||
    //         //      ( min <= age   && isNaN( max ) ) ||
    //         //      ( min <= age   && age <= max ) )
    //         // {
    //         //     return true;
    //         // }
    //         // return false;
    //     }
    // );  
</script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>