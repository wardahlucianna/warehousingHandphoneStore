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
        insert_handler($data,$aksi,$path);
    }
    
    function table_master($path){
        $input_kiri =  
            get_group_input_full("date","Date","text",50,true,"")
        ;
        ?>

        <div class='form-group row'>
            <div class='col-lg-6 col-md-6'><?php echo $input_kiri ?></div>
            <div class='col-lg-6 col-md-6'></div>
        </div>
        <hr>
            <table id="master_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th class="all">Date</th>
                        <th>Shop</th>
                        <th>Imei Return</th>
                        <th>Imei</th>
                        <th>Note</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#date').datetimepicker({
                        format: 'L',
                        defaultDate: new Date(),
                        format: 'MMMM YYYY'
                     });

                    $("#date").on('dp.change',function(e) {
                        $('#master_table').DataTable().ajax.reload()
                    });

                    $("#master_table").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        stateSave: true,
                        columns: [
                            { "data": "t_return_stock_in_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "create_at", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_shop_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "t_imei_number_return", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "t_imei_number_replacement", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "t_return_stock_in_note", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_employee_full_name", "render": function (data, type, row, meta) {
                                    return data;
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
                            data_new.date = $("#date").val();
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

    function insert_handler($data,$aksi,$path){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $list_m_shop = count($data['list_m_shop']);
        $list_m_shop = $list_m_shop==0?"":$data['list_m_shop'];

        $input_kiri =  
            get_group_input("date","Date","text",50,true,"",true)
            .get_group_select2("m_shop_id","Shop",true,$list_m_shop)
            .get_group_input("imei_return","Imei Return","text",15,true)
            .get_group_input("t_product_name_return","Product Name Return","text",10,true,"",true)
            .get_group_input("imei_replacement","Imei Replacement","text",15,true)
            .get_group_input("t_product_name_replacement","Product Name Replacement","text",10,true,"",true)
            .get_group_textarea("t_return_stock_in_note","Note","text",255,false)
        ;

        echo $input_kiri;
        ?>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#imei_return, #imei_replacement').on('input', function (event) { 
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                setInterval(timestamp, 1000);

                function timestamp(){
                    var dateNow = new Date();
                    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    date_string = dateNow.getDate() + " " + months[dateNow.getMonth()] + " " + dateNow.getFullYear() + " " + dateNow.toLocaleTimeString();
                    $('#date').val(date_string)
                }

               
                $("#imei_return").on('keyup',function(e) {
                    if(e.which == 13) {
                        var form_data = {};
                        form_data.imei_return = $('#imei_return').val();
                        form_data.m_shop_id = $('#m_shop_id').val();

                        $.ajax({
                            url: '<?php echo $path."/check_exsis_imei_return" ?>',
                            type: 'post',
                            dataType: 'json',
                            data: form_data,
                        }).done(function (result) {
                            if(result.data!=null){
                                $('#t_product_name_return').val(result.data.m_product_name)
                            }
                            else{
                                $('#t_product_name_return').val('')
                                msg_warning("Sorry, "+$('#m_shop_id').select2('data')[0].text+" didn't buy this imei"+$('#imei_return').val());
                            }
                        }).fail(function (xhr, status, error) {
                            msg_warning("process failed","")
                        })
                    }
                });

 
                $("#imei_replacement").on('keyup',function(e) {
                    if(e.which == 13) {
                        var form_data = {};
                        form_data.imei_replacement = $('#imei_replacement').val();

                        $.ajax({
                            url: '<?php echo $path."/check_exsis_imei_replacement" ?>',
                            type: 'post',
                            dataType: 'json',
                            data: form_data,
                        }).done(function (result) {
                            if(result.data!=null){
                                $('#t_product_name_replacement').val(result.data.m_product_name)
                            }
                            else{
                                 $('#t_product_name_replacement').val('')
                                 msg_warning("Sorry, Imei replacement is not exsis");
                            }
                        }).fail(function (xhr, status, error) {
                            msg_warning("process failed","")
                        })
                    }
                });
            })
        </script>
                    
        <?php
    }
?>