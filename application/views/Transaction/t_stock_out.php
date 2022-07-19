<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];

    if($aksi == "table_master"){
        table_master($path);
    }
    else if($aksi == "insert_handler"){
        insert_handler($data,$aksi,$path);
    }
    else if($aksi == "detail_handler"){
        detail_handler($data,$aksi,$path);
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
                        <th class="all">Created</th>
                        <th class="all">Action</th>
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

                    master_table = $("#master_table").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        stateSave: true,
                        columns: [
                            { "data": "t_outcome_goods_entry_code", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "create_at", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_employee_full_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                                    var id = row.t_outcome_goods_entry_code;
                                    var edit = "<button type='button' class='btn btn-primary btn-sm' onclick=\"detail_display('" + id + "')\"><i class='fa fa-list'></i> </button> ";
                                    return edit;
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
            </script>
        <?php
    }

    function insert_handler($data,$aksi,$path){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $list_m_shop = count($data['list_m_shop']);
        $list_m_shop = $list_m_shop==0?"":$data['list_m_shop'];
        
        if($count>0){
            $m_warehouse_status = $m_warehouse_status=="Active"?true:false;
            $read_only = $m_warehouse_status==true?false:true;
        }
        
        $input_kiri =  
            get_group_input_full("date_input","Date","text",50,true,"",true)
        ;

        $input_kanan =  
            get_single_input("data_imei","Email","hidden",true)
        ;
        ?>

        <div class='form-group row'>
            <div class='col-lg-6 col-md-6'><?php echo $input_kiri ?></div>
            <div class='col-lg-6 col-md-6'><?php echo $input_kanan ?></div>
        </div>

        <hr>

        <form id="table_input_pengeluaran">
             <table id="master_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th class="all">Shop</th>
                        <th>Imei</th>
                        <th>Nama Product</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>*</td>
                        <td><?php echo get_single_select2("m_shop_id","Shop",true,$list_m_shop) ?></td>
                        <td><?php echo get_single_input("imei","Imei","text","15",true) ?></td>
                        <td>
                            <?php 
                                echo get_single_input("m_product_id","Product","hidden","15",true,"",true) ;
                                echo get_single_input("m_product_name","Product","text","15",true,"",true) ;
                            ?>
                                
                        </td>
                        <td>
                            <button type='button' class='btn btn-danger btn-sm' onclick="send_reset_input()"><i class='fa fa-refresh'></i></button>
                            <button type='button' class='btn btn-primary btn-sm' onclick="send_input()"><i class='fa fa-check'></i></button>
                        </td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>

        <div class="modal fade bd-example-modal-lg" id="ModalSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Summary Stock Out Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table id="Summary_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th class="all">No</th>
                            <th class="all">Product</th>
                            <th class="all">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="send_insert_data()">Save changes</button>
              </div>
            </div>
          </div>
        </div>
       

        <script type="text/javascript">
            var ArrInputTransaction = [];
            $('#imei').on('input', function (event) { 
                this.value = this.value.replace(/[^0-9]/g, '');
            });


            $("#insert_button").attr("Onclick", "summery_model()");

            myInterval_date = setInterval(timestamp, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik
            function timestamp(){
                var dateNow = new Date();
                var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                date_string = dateNow.getDate() + " " + months[dateNow.getMonth()] + " " + dateNow.getFullYear() + " " + dateNow.toLocaleTimeString();
                $('#date_input').val(date_string)
            }

           

            function summery_model(){
                if(ArrInputTransaction.length==0){
                    msg_warning("Sorry, cant save this transaction. Please input 1 row transaction")
                }
                else{
                    var unique = ArrInputTransaction.filter(onlyUnique);

                    var ArrSummary = [];
                    var ArrId = ArrInputTransaction.map(object => {
                        return object.m_shop_id;
                    });

                    var uniqueSites = ArrId.filter(function(item, i, sites) {
                        return i == ArrId.indexOf(item);
                    });


                    $.each(uniqueSites, function(index, value) {
                      
                      var ArrNameFiletById = ArrInputTransaction.filter(object => {
                            return object.m_shop_id==value;
                      });

                      var ArrFiletById = ArrInputTransaction.filter(object => {
                            return object.m_shop_id==value;
                      });


                      ArrSummary.push({
                        "m_shop_name":ArrNameFiletById[0].m_shop_name,
                        "total":ArrFiletById.length,
                      })
                    });

                    TableSummary.clear().draw();

                    TableSummary.rows.add(ArrSummary).draw();
                    $('#ModalSave').modal('show'); 
                }
            }

            function onlyUnique(value, index, self) {
              return self.indexOf(value) === index;
            }

            var TableTransaction = $("#master_table").DataTable({
                language: {
                    "infoFiltered": " (filtered from _MAX_ total entries)"
                },
                order: [[0, 'desc']],
                columns: [
                    { visible: false,
                        "data": "no", "render": function (data, type, row, meta) {
                            no = meta.row + meta.settings._iDisplayStart + 1;
                            return no;
                        }
                    },
                    {   orderable: false,
                        targets: "no-sort",
                        "data": "m_shop_name", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                    {   orderable: false,
                        targets: "no-sort",
                        "data": "imei", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                    { 
                        orderable: false,
                        targets: "no-sort",
                        "data": "m_product_name", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                    {  orderable: false,
                        targets: "no-sort",
                        "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                            var id = 1;
                            var hapus = "<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> </button> ";
                            return hapus;
                        }
                    },
                ],
            }); //invoke dataTable here, put custom options here

            var TableSummary = $("#Summary_table").DataTable({
                language: {
                    "infoFiltered": " (filtered from _MAX_ total entries)"
                },
                stateSave: true,
                columns: [
                    { 
                        "data": "no", "render": function (data, type, row, meta) {
                            no = meta.row + meta.settings._iDisplayStart + 1;
                            return no;
                        }
                    },
                    {  
                        targets: "no-sort",
                        "data": "m_shop_name", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                    { 
                        
                        "data": "total", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                ],
            }); //invoke dataTable here, put custom options here

            var myInterval = setTimeout("", 1000);
            $("#imei, #note").on('keyup',function(e) {
                if(e.which == 13) {
                    myInterval = setTimeout(function() {send_input()}, 1000);
                }
                else{
                    var form_data = {};
                    form_data.imei = $('#imei').val();

                    $.ajax({
                        url: '<?php echo $path."/check_exsis_imei" ?>',
                        type: 'post',
                        dataType: 'json',
                        data: form_data,
                    }).done(function (result) {
                        if(result.data!=null){
                            $('#m_product_name').val(result.data.m_product_name)
                        }
                        else{
                             $('#m_product_name').val('')
                        }
                    }).fail(function (xhr, status, error) {
                        msg_warning("process failed","")
                    })
                }
            });

            function send_input() {
                invalid = form_validation("table_input_pengeluaran");

                var ObjInputTransaction = {
                    "no": "",
                    "m_shop_id": $('#m_shop_id').select2('data')[0].id,
                    "m_shop_name": $('#m_shop_id').select2('data')[0].text,
                    "imei": $('#imei').val(),
                    "m_product_name": $('#m_product_name').val(),
                    "m_product_id": $('#m_product_id').val(),
                    "aksi": "",
                }

                if($('#m_product_name').val()==""){
                    msg_warning("Sorry, Imei is not exsis");
                }
                
                if(invalid==false){
                    $('#imei').val('').focus();
                    $('#m_product_name').val('');

                    const indexOfObject = ArrInputTransaction.findIndex(object => {
                        return object.imei === ObjInputTransaction.imei;
                    });

                    var form_data = {};
                    form_data.imei = ObjInputTransaction.imei;

                    $.ajax({
                        url: '<?php echo $path."/check_imei_ready" ?>',
                        type: 'post',
                        dataType: 'json',
                        data: form_data,
                    }).done(function (result) {
                        if(result.data!=null){
                            if(indexOfObject>=0){
                                msg_warning("Sorry, Imei "+ObjInputTransaction.imei+" already exsis in this entry");
                            }
                            else if(result.data.t_imei_status=="Ready"){
                                if(ArrInputTransaction.length<50){
                                    ArrInputTransaction.push(ObjInputTransaction)
                                    TableTransaction.row.add(ObjInputTransaction).draw();
                                }
                                else{
                                    msg_warning("Sorry, rows are full. please save than create new transaction");
                                }

                                $("#data_imei").val(JSON.stringify(ArrInputTransaction));
                            }
                            else if(result.data.t_imei_status=="Sold"){
                                msg_warning("Sorry, Imei "+ObjInputTransaction.imei+" is sold");
                            }
                        }
                        else{
                            msg_warning("Sorry, Imei is not exsis");
                        }
                        // clearTimeout(myInterval);
                    }).fail(function (xhr, status, error) {
                        msg_warning("process failed","")
                    })
                }
            };

            $('#master_table tbody').on('click', 'tr', function () {
                var row_data = TableTransaction.row( this ).data();
                TableTransaction.clear().draw();

                const indexOfObject = ArrInputTransaction.findIndex(object => {
                    return object.m_product_id === row_data.m_product_id && object.imei === row_data.imei;
                });

                ArrInputTransaction.splice(indexOfObject, 1);
                TableTransaction.rows.add(ArrInputTransaction).draw();
                $("#data_imei").val(ArrInputTransaction.length==0?"":JSON.stringify(ArrInputTransaction));
            });

            function send_reset_input(){
                $('#m_shop_id').val('').trigger('change');
                $('#imei').val('');
                $('#m_product_name').val('');
            }
        </script>
        <?php
    }

    function detail_handler($data,$aksi,$path){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];
        $id = $data['id'];

        if($count>0){
            $m_warehouse_status = $m_warehouse_status=="Active"?true:false;
            $read_only = $m_warehouse_status==true?false:true;
        }
        
        $input_kiri =  
            get_group_input_full("date","Date","text",50,true,$data['create_at'],true)
        ;

        $input_kanan =  
            get_single_input("data_imei","Email","hidden",true)
        ;
        ?>

        <div class='form-group row'>
            <div class='col-lg-6 col-md-6'><?php echo $input_kiri ?></div>
            <div class='col-lg-6 col-md-6'><?php echo $input_kanan ?></div>
        </div>

        <hr>

        <form id="table_input_pengeluaran">
             <table id="master_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th class="all">Product</th>
                        <th>Imei</th>
                        <th class="all">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>

        <script type="text/javascript">
            var TableTransaction = $("#master_table").DataTable({
                language: {
                    "infoFiltered": " (filtered from _MAX_ total entries)"
                },
                stateSave: true,
                columns: [
                    { visible: true,
                        "data": "m_product_name", "render": function (data, type, row, meta) {
                            no = meta.row + meta.settings._iDisplayStart + 1;
                            return no;
                        }
                    },
                    {   targets: "no-sort",
                        "data": "m_product_name", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                    { 
                        targets: "no-sort",
                        "data": "t_imei_number", "render": function (data, type, row, meta) {
                            return data;
                        }
                    },
                    {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                            var id = row.t_outcome_goods_entry_id;
                            var edit = "<button type='button' class='btn btn-danger btn-sm' onclick=\"send_delete_data('" + id + "')\"><i class='fa fa-trash'></i> </button> ";
                            return edit;
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
                    data_new.id = "<?php echo $id ?>";
                    var path = "<?php echo $path.'/data_table_detail'?>"

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
        </script>
        <?php
    }
?>



