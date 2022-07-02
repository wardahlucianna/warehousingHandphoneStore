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
                        <th class="all">Product Type</th>
                        <th class="all">Color</th>
                        <th class="all">Size</th>
                        <th class="all">Limit</th>
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
                            { "data": "m_product_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_product_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_product_type_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_color_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_size_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_product_limit", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            { "data": "m_product_status", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                                    var id = row.m_product_id;
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

        $m_product_id = $count==0?"":$item['m_product_id'];
        $m_product_name = $count==0?"":$item['m_product_name'];
        $m_product_type_id = $count==0?"":$item['m_product_type_id'];
        $m_color_id = $count==0?"":$item['m_color_id'];
        $m_size_id = $count==0?"":$item['m_size_id'];
        $m_product_limit = $count==0?"":$item['m_product_limit'];
        $m_product_status = $count==0?"Active":$item['m_product_status'];
        $read_only = false;
        
        $count_list_m_color = count($data['list_m_color']);
        $list_m_color = $count_list_m_color==0?"":$data['list_m_color'];

        $list_m_size = count($data['list_m_size']);
        $list_m_size = $list_m_size==0?"":$data['list_m_size'];

        $list_m_product_type = count($data['list_m_product_type']);
        $list_m_product_type = $list_m_product_type==0?"":$data['list_m_product_type'];

        if($count>0){
            $m_product_status = $m_product_status=="Active"?true:false;
            $read_only = $m_product_status==true?false:true;
        }
        
        $input =  
            get_input("m_product_id","Id","hidden",true,$m_product_id)
            .get_group_select2("m_product_type_id","Product Type",true,$list_m_product_type,$m_product_type_id,$read_only)
            .get_group_select2("m_color_id","Color",true,$list_m_color,$m_color_id,$read_only)
            .get_group_select2("m_size_id","Size",true,$list_m_size,$m_size_id,$read_only)
            .get_group_input("m_product_name","Name","text",50,true,$m_product_name,true)
            .get_group_input("m_product_limit","Limit","number",50,true,$m_product_limit,$read_only)
            .get_group_toggle("m_product_status","Status",true,$m_product_status,$read_only)
            ;
        echo $input;

        ?>
            <script type="text/javascript">
             $( document ).ready(function() {
                $('#m_product_type_id, #m_color_id,#m_size_id').change(function() {
                    var product_type_name = $('#m_product_type_id').select2('data')[0].text;
                    var color_name = $('#m_color_id').select2('data')[0].text;
                    var size_name = $('#m_size_id').select2('data')[0].text;

                    $("#m_product_name").val(product_type_name + (size_name==""?"":" "+size_name) + (color_name==""?"":" "+color_name))
                })
            });
            </script>
        <?php
    }
?>

