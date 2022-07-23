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
                        <th class="all">Name</th>
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
                            { "data": "m_position_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_position_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_position_status", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                                    var id = row.m_position_id;
                                    var name = row.m_position_name;

                                    var edit = "<button type='button' class='btn btn-primary btn-sm' onclick=\"edit_display('" + id + "')\"><i class='fa fa-edit'></i> </button> ";
                                    var hapus = "<button type='button' class='btn btn-danger btn-sm' onclick=\"send_delete_data('" + id + "')\"><i class='fa fa-trash'></i> </button> ";
                                    return name!="Owner"?(edit + hapus):"";
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
            </script>
        <?php
    }

    function insert_handler($data,$aksi){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $m_position_id = $count==0?"":$item['m_position_id'];
        $m_position_name = $count==0?"":$item['m_position_name'];
        $m_position_status = $count==0?"Active":$item['m_position_status'];
        $read_only = false;

        if($count>0){
            $m_position_status = $m_position_status=="Active"?true:false;
            $read_only = $m_position_status==true?false:true;
        }
        
        $input =  
            get_input("m_position_id","Id","hidden",true,$m_position_id)
            .get_group_input("m_position_name","Name","text",50,true,$m_position_name,$read_only)
            .get_group_toggle("m_position_status","Status",true,$m_position_status,$read_only)
            ;
        echo $input;
    }
?>