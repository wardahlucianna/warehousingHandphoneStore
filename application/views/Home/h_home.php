<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];
    // print_r($data);

    if($aksi=='total_all_product'){
        table_master($path,$data);
    }
    else if($aksi=='summary_product'){
        table_summary($path,$data);
    }

    
    function table_master($path,$data){
        $total_all_product = $data['total_all_product'];
        $total_stoct_in = $data['total_stoct_in'];
        $persen_stoct_in = $data['persen_stoct_in'];
        $status_stoct_in = $data['status_stoct_in'];
        $colur_stoct_in = $data['colur_stoct_in'];
        $colur_text_stoct_in = $data['colur_text_stoct_in'];

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
                $(document).ready(function(){
                    $("#master_table").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        searching: false,
                        "bLengthChange": false,
                        lengthMenu: [
                            [5,10, 25, 50, -1],
                            [5,10, 25, 50, 'All'],
                        ],
                        "pageLength": 5,
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
                            console.log(data)
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
            </script>

            <script type="text/javascript">
                $("#table_area, #table_summary_area").css("height","500px");
                $("#title_welcome").css("text-align","center");
                $("#table_area_title").html("");
                $("#btn_add").hide();

                $('#total_all_product').text('<?php echo $total_all_product ?>');
                $('#total_stoct_in').text('<?php echo $total_stoct_in ?>');
                $('#persen_stoct_in').text('<?php echo $persen_stoct_in ?>%');
                $('#progressbar_stoct_in').width('<?php echo $persen_stoct_in ?>%');                
                $("#icon_stoct_in").removeAttr('class');
                $("#icon_stoct_in").addClass('<?php echo $status_stoct_in ?>');
                $("#icon_stoct_in").addClass('<?php echo $colur_text_stoct_in ?>');
                $("#progressbar_stoct_in").addClass('progress-bar  <?php echo $colur_stoct_in ?>');
            </script>
        <?php
    }

    function table_summary($path,$data){
        ?>

        <table id="table_summary" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">No</th>
                        <th class="all">Type Product</th>
                        <th class="all">Stock</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <script type="text/javascript">
                $(document).ready(function(){
                    $("#table_summary").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        searching: false,
                        "bLengthChange": false,
                        lengthMenu: [
                            [5,10, 25, 50, -1],
                            [5,10, 25, 50, 'All'],
                        ],
                        "pageLength": 5,
                        columns: [
                            { "data": "t_stock_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_product_type_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "t_stock_total", "render": function (data, type, row, meta) {
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
                            var path = "<?php echo $path.'/data_summery_table'?>"

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
