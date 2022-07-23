<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];

    if($aksi == "table_master"){
        table_master($path,$data);
    }
    

    function table_master($path,$data){
        $count = count($data['list_m_warehouse']);
        $list_m_warehouse = $count==0?"":$data['list_m_warehouse'];
        $m_warehouse_id = $list_m_warehouse[0]['m_warehouse_id'];
        $read_only = false;

        if($_SESSION['employee_position_name']!="Owner"){
            $m_warehouse_id = $_SESSION['m_warehouse_id'];
            $read_only = true;
        }

        if($_SESSION['employee_position_name']=="Owner"){
            $input =  
            get_group_select2("m_warehouse_id","Warehouse",false,$list_m_warehouse,$m_warehouse_id,$read_only)
            ;
            echo $input."<hr>";
        }
        else{
            $input =  
            get_input("m_warehouse_id","Warehouse","hidden",true,$_SESSION['m_warehouse_id']);
            echo $input;
        }
        ?>
            <table id="master_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th class="all">Product</th>
                        <th class="all">Total</th>
                        <th>Limit</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <script type="text/javascript">
                $('#btn_add').hide();
                $(document).ready(function(){
                    $('#m_warehouse_id').on('change', function () {
                        $('#master_table').DataTable().ajax.reload()
                    });

                    $("#master_table").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        stateSave: true,
                        columns: [
                            { "data": "t_stock_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_product_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "t_stock_total", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_product_limit", "render": function (data, type, row, meta) {
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
                            data_new.m_warehouse_id = $("#m_warehouse_id").val();
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