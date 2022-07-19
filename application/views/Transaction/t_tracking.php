<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];

    if($aksi == "table_master"){
        table_master($path);
    }
    

    function table_master($path){
         $input_kiri =  
            get_group_input_full("imei","Imei","text",15,true)
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

            <table id="master_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">Date</th>
                        <th class="all">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <script type="text/javascript">
                $('#btn_add').hide();
                $(document).ready(function(){
                    $("#imei").on('keypress',function(e) {
                        if(e.which == 13) {
                            $('#master_table').DataTable().ajax.reload()
                        }
                    });

                    $("#master_table").dataTable({
                        language: {
                            "infoFiltered": " (filtered from _MAX_ total entries)"
                        },
                        stateSave: true,
                        searching: false,
                        "bPaginate": false,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": false,
                        "bAutoWidth": false,
                        columns: [
                            { "data": "create_at", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "hs_imei_status", "render": function (data, type, row, meta) {
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
                            data_new.imei = $('#imei').val();
                            var path = "<?php echo $path.'/data_table'?>"
                            $.ajax({
                                type  : 'POST',
                                url   : path,
                                dataType : 'json',
                                data: data_new,
                                success : function(result){
                                    if(result.data.length==0 && $('#imei').val()!=""){
                                        msg_warning("Sorry, Imei is not found","")
                                        callback({
                                            draw: data.draw,
                                            data: result.data,
                                            recordsTotal: result.row_total,
                                            recordsFiltered: result.row_filter,
                                        });
                                    }
                                    else{
                                        callback({
                                            draw: data.draw,
                                            data: result.data,
                                            recordsTotal: result.row_total,
                                            recordsFiltered: result.row_filter,
                                        });
                                    }
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