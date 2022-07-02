<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];

    if($aksi == "table_master"){
        table_master($path);
    }
    else if($aksi == "insert_handler" || $aksi == "edit_handler"){
        insert_handler($data,$aksi);
    }
    
    function table_master($path){
        ?>
            <table id="master_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th class="all">Full Name</th>
                        <th>Sort Name</th>
                        <th>Position</th>
                        <th>User Group</th>
                        <th>User</th>
                        <th>Warehouse</th>
                        <th>Status</th>
                        <th class="all">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <script type="text/javascript">
                $(document).ready(function(){
                    $("#master_table").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        stateSave: true,
                        columns: [
                            { "data": "m_employee_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_employee_full_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_employee_sort_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_position_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_user_group_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_employee_username", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_warehouse_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            
                            { "data": "m_employee_status", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                                    var id = row.m_employee_id;
                                    var edit = "<button type='button' class='btn btn-primary btn-sm' onclick=\"edit_display('" + id + "')\"><i class='fa fa-edit'></i> </button> ";
                                    var hapus = "<button type='button' class='btn btn-danger btn-sm' onclick=\"send_delete_data('" + id + "')\"><i class='fa fa-trash'></i> </button> ";
                                    var resert = "<button type='button' class='btn btn-inverse  btn-sm' onclick=\"send_resert_password('" + id + "')\"><i class='fa fa-undo'></i></button> ";
                                    return edit + hapus + resert;
                                }
                            },
                        ],
                        processing: true,
                        serverSide: true,
                        
                        ajax: function (data, callback, settings) {
                            var order = data.order;
                            var sort = [{}];
                            order.forEach(function(item) {
                                sort.push([data.columns[item.column].data + " " +item.dir])
                            });

                            var data_new = {}
                            data_new.start = data.start;
                            data_new.length = data.length;
                            data_new.search = data.search["value"];
                            data_new.sort = sort;
                            var path = "<?php echo $path.'/data_table'?>"

                            $.ajax({
                                type  : 'POST',
                                url   : path,
                                dataType : 'json',
                                data: data_new,
                                success : function(result){
                                    callback({
                                        draw: data.draw,
                                        data: result.data,
                                        recordsTotal: result.row_total,
                                        recordsFiltered: result.row_filter,
                                    });
                                }
                            }).fail(function (xhr, status, error) {
                                msg_warning("process failed","")
                            })
                        },
                    }); //invoke dataTable here, put custom options here
                });

                function send_resert_password(id){
                    $.confirm({
                        title: 'Warning',
                        content: 'Do you want to reset the password?',
                        icon: 'fa fa-warning',
                        animation: 'scale',
                        closeAnimation: 'scale',
                        opacity: 0.5,
                        buttons: {
                            'confirm': {
                                text: 'Yes',
                                btnClass: 'btn-blue',
                                action: function () {
                                    input_password(id)
                                }
                            },
                            cancel: function () {
                                
                            },
                        }
                    });
                }

                function input_password(id){
                    $.confirm({
                        title: 'Warning',
                        content: "Your Password <br> <input type='password' name='alert_password' placeholder='Your Password' class='form-control' id='alert_password'>",
                        icon: 'fa fa-warning',
                        animation: 'scale',
                        closeAnimation: 'scale',
                        opacity: 0.5,
                        buttons: {
                            'confirm': {
                                text: 'Yes',
                                btnClass: 'btn-blue',
                                action: function () {
                                    var password = $("#alert_password").val();
                                    form_data = {};
                                    form_data.id = id;
                                    form_data.password = password;
                                  
                                    $.ajax({
                                        url: "<?php echo $path; ?>"+"/resert_password", 
                                        type: 'post',
                                        dataType: 'json',
                                        data: form_data,
                                    }).done(function (result) {
                                        if(result.status=="failed"){
                                            msg_warning(result.msg)
                                        }
                                        else{
                                            msg_warning(result.msg,"")
                                        }
                                    }).fail(function (xhr, status, error) {
                                        msg_warning("process failed","")
                                    })

                                }
                            },
                            cancel: function () {
                                
                            },
                        }
                    });
                }
            </script>
        <?php
    }

    function insert_handler($data,$aksi){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $m_employee_id = $count==0?"":$item['m_employee_id'];
        $m_employee_full_name = $count==0?"":$item['m_employee_full_name'];
        $m_employee_sort_name = $count==0?"":$item['m_employee_sort_name'];
        $m_position_id = $count==0?"":$item['m_position_id'];
        $m_user_group_id = $count==0?"":$item['m_user_group_id'];
        $m_warehouse_id = $count==0?"":$item['m_warehouse_id'];
        $m_employee_username = $count==0?"":$item['m_employee_username'];
        $m_employee_status = $count==0?"Active":$item['m_employee_status'];
        $read_only = false;

        $count = count($data['list_m_position']);
        $list_m_position = $count==0?"":$data['list_m_position'];

        $count = count($data['list_m_user_group']);
        $list_m_user_group = $count==0?"":$data['list_m_user_group'];

        $count = count($data['list_m_warehouse']);
        $list_m_warehouse = $count==0?"":$data['list_m_warehouse'];

        if($count>0){
            $m_employee_status = $m_employee_status=="Active"?true:false;
            $read_only = $m_employee_status==true?false:true;
        }

        $input_kiri =  
            get_input("m_employee_id","Id","hidden",true,$m_employee_id)
            .get_group_input_full("m_employee_full_name","Full Nama","text",50,true,$m_employee_full_name,$read_only)
            .get_group_input_full("m_employee_sort_name","Sort Name","text",10,true,$m_employee_sort_name,$read_only)
            .get_group_select2_full("m_position_id","Position",true,$list_m_position,$m_position_id,$read_only)
            .get_group_select2_full("m_user_group_id","User Group",true,$list_m_user_group,$m_user_group_id,$read_only)
            ;

        $input_kanan =  
            get_group_select2_full("m_warehouse_id","Warehouse",true,$list_m_warehouse,$m_warehouse_id,$read_only)
            .get_group_input_full("m_employee_username","User","text",50,true,$m_employee_username,$read_only)
            .get_group_toggle_full("m_employee_status","Status",true,$m_employee_status)
        ;
        ?>

        <div class='form-group row'>
            <div class='col-lg-6 col-md-6'><?php echo $input_kiri ?></div>
            <div class='col-lg-6 col-md-6'><?php echo $input_kanan ?></div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#m_feature_squance').attr('min',1)
                $('#m_feature_squance').keyup(function() {
                    var value = $(this).val();
                    value = value<1 ? $(this).val(1) : $(this).val(value);
                })
            })
        </script>
                    
        <?php
    }
?>