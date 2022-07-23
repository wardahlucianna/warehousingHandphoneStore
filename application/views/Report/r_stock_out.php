<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];

    if($aksi == "table_master"){
        ?>
            <script type="text/javascript">
                 display_filter_report()
            </script>
        <?php
    }
    else if($aksi == "filter_report"){
        form_filter($data,$aksi,$path);
    }
    else if($aksi == "report"){
        report($data,$aksi,$path);
    }
    
    function form_filter($data,$aksi,$path){
        $count = count($data['list_m_warehouse']);
        $list_m_warehouse = $count==0?"":$data['list_m_warehouse'];
        $m_warehouse_id = "";
        $input_warehouse = "";
        $read_only = false;

        $count = count($data['list_m_shop']);
        $list_m_shop = $count==0?"":$data['list_m_shop'];

        if($_SESSION['employee_position_name']!="Owner"){
            $m_warehouse_id = $_SESSION['m_warehouse_id'];
            $read_only = true;
            $input_warehouse = get_input("m_warehouse_id","Warehouse","hidden",50,true,$m_warehouse_id);
        }
        else{
            $input_warehouse = get_group_select2("m_warehouse_id","Warehouse",false,$list_m_warehouse,$m_warehouse_id,$read_only);
        }

        $input =  
            $input_warehouse
            .get_group_select2("m_shop_id","Shop",false,$list_m_shop)
            .get_group_input("date_range","Date","text",50,true,"")
            .get_input("start_date_format","Date","hidden",50,true,"")
            .get_input("end_date_format","Date","hidden",50,true,"")
            ;
        echo $input;

        ?>
            <script type="text/javascript">
                $('#date_range').daterangepicker({
                    locale: {
                        format: 'DD MMM YYYY'
                    }
                });

                var formattedDate = new Date();
                var d = formattedDate.getDate();
                var m =  formattedDate.getMonth();
                m += 1;  // JavaScript months are 0-11
                var y = formattedDate.getFullYear();
                $("#start_date_format").val(y+"/"+m+"/"+d)
                $("#end_date_format").val(y+"/"+m+"/"+d)

                $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                    $('#start_date_format').val(picker.startDate.format('YYYY/MM/DD'))
                    $('#end_date_format').val(picker.endDate.format('YYYY/MM/DD'))
                });

            </script>
        <?php
    }

    function report($data,$aksi,$path){
        $m_warehouse_id = $data['m_warehouse_id'];
        $m_shop_id = $data['m_shop_id'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $date_range = $data['date_range'];
        
        $date = (date('d M Y', strtotime($start_date))) ." - ".(date('d M Y', strtotime($end_date)));

        $input =  
            get_input("m_warehouse_id","m_warehouse_id","hidden",true,$m_warehouse_id)
            .get_input("m_shope_id","m_shope_id","hidden",true,$m_shop_id)
            .get_input("start_date","start_date","hidden",true,$start_date)
            .get_input("end_date","end_date","hidden",true,$end_date)
            .get_group_input("start_date_format","Date","text",50,true,$date_range,true)
            ;
        echo $input;

        ?>
            <hr>
            <table id="master_table" class="table table-striped table-bordered dt-responsive">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th>Date</th>
                        <th >Shop</th>
                        <th>Product Type</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th class="all">Imei</th>
                        <th>Create</th>
                        <th>Warehouse</th>
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
                        columns: [
                            { "data": "t_outcome_goods_entry_id", "render": function (data, type, row, meta) {
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
                            { "data": "m_product_type_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_size_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_color_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "t_imei_number", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_employee_full_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_warehouse_name", "render": function (data, type, row, meta) {
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
                            data_new.m_warehouse_id = $('#m_warehouse_id').val();
                            data_new.start_date = $('#start_date').val();
                            data_new.end_date = $('#end_date').val();
                            data_new.m_shop_id = $('#m_shop_id').val();
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

?>