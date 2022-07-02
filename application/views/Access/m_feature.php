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
                        <th>Feature Group</th>
                        <th>Sequence</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th>Visible Menu</th>
                        <th>Type</th>
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
                            { "data": "m_feature_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_feature_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_feature_group_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_feature_squance", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_feature_url", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_feature_icon", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_feature_visible", "render": function (data, type, row, meta) {
                                    data = data==1?"Ya":"Tidak";
                                    return data;
                                }
                            },
                            { "data": "m_feature_menu_type", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_feature_status", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                                    var id = row.m_feature_id;
                                    var edit = "<button type='button' class='btn btn-primary btn-sm' onclick=\"edit_display('" + id + "')\"><i class='fa fa-edit'></i> </button> ";
                                    var hapus = "<button type='button' class='btn btn-danger btn-sm' onclick=\"send_delete_data('" + id + "')\"><i class='fa fa-trash'></i> </button> ";
                                    return edit + hapus;
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

        $m_feature_id = $count==0?"":$item['m_feature_id'];
        $m_feature_name = $count==0?"":$item['m_feature_name'];
        $m_feature_url = $count==0?"":$item['m_feature_url'];
        $m_feature_icon = $count==0?"":$item['m_feature_icon'];
        $m_feature_group_id = $count==0?"":$item['m_feature_group_id'];
        $m_feature_menu_type = $count==0?"":$item['m_feature_menu_type'];
        $m_feature_squance = $count==0?"":$item['m_feature_squance'];
        $m_feature_visible = $count==0?false:$item['m_feature_visible'];
        $m_feature_status = $count==0?"Active":$item['m_feature_status'];
        $read_only = false;

        $count_list_m_feature_group = count($data['list_m_feature_group']);
        $list_m_feature_group = $count_list_m_feature_group==0?"":$data['list_m_feature_group'];

        if($count>0){
            $m_feature_status = $m_feature_status=="Active"?true:false;
            $m_feature_visible = $m_feature_visible==true?true:false;
            $read_only = $m_feature_status==true?false:true;
        }

        $list_tipe= array(
            array(
                "id"=>"Left menu",
            ),
            array(
                "id"=>"Top menu",
            )
        );
        
        $input_kiri =  
            get_input("m_feature_id","Id","hidden",true,$m_feature_id)
            .get_group_input_full("m_feature_name","Name","text",50,true,$m_feature_name,$read_only)
            .get_group_select2_full("m_feature_group_id","Feature Group",true,$list_m_feature_group,$m_feature_group_id,$read_only)
            .get_group_input_full("m_feature_url","URL","text",50,true,$m_feature_url,$read_only)
            .get_group_input_full("m_feature_icon","Icon","text",20,false,$m_feature_icon,$read_only)
            ;

        $input_kanan =  
            get_group_input_full("m_feature_squance","Squance","text",3,true,$m_feature_squance,$read_only)
            .get_group_select2_value_full("m_feature_menu_type","Menu Type",true,$list_tipe,$m_feature_menu_type,$read_only)
            .get_group_toggle_full("m_feature_visible","Visible Menu",true,$m_feature_visible,$read_only,"Yes","No")
            .get_group_toggle_full("m_feature_status","Status",true,$m_feature_status)
            ;
        ?>

        <div class='form-group row'>
            <div class='col-lg-6 col-md-6'><?php echo $input_kiri ?></div>
            <div class='col-lg-6 col-md-6'><?php echo $input_kanan ?></div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#m_feature_squance').keyup(function() {
                    var value = $(this).val();
                    value = value.replace(/,.*|[^0-9]/g, '');
                    if(value<1){
                        value = 1;
                    }
                    else if(value>100){
                        value = 100;
                    }
                    
                    $(this).val(value)
                })

            })
        </script>
                    
        <?php
    }
?>