<?php 
    $this->load->view('crud_function'); 
?>

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
                            { "data": "m_user_group_id", "render": function (data, type, row, meta) {
                                    no = meta.row + meta.settings._iDisplayStart + 1;
                                    return no;
                                }
                            },
                            { "data": "m_user_group_name", "render": function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {  "data": "aksi", className: 'text-nowrap', "render": function (data, type, row, meta) {
                                    var id = row.m_user_group_id;
                                    var detail = "<button type='button' class='btn btn-primary btn-sm' onclick=\"edit_display('" + id + "')\"><i class='fa fa-list'></i> ("+data+")</button> ";
                                    return detail;
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

                    $("#btn_add").hide()
                });
            </script>
        <?php
    }

    function insert_handler($data,$aksi){
        $count_data_item = count($data['data']);
        $data_item = $count_data_item==0?"":$data['data'];

        $count = count($data['list_m_feature']);
        $list_m_feature = $count==0?"":$data['list_m_feature'];

        $count = count($data['list_m_feature_group']);
        $list_m_feature_group = $count==0?"":$data['list_m_feature_group'];
        
        $count = count($data['id']);
        $id = $count==0?"":$data['id'];

        $max_feature = max($list_m_feature);
        $count_feature = count($list_m_feature);
        $count_group_feature = count($list_m_feature_group);

        if($count_feature!=0){
            $max_feature = $max_feature['m_feature_id'];
        }

        $input = get_input("m_user_group_id","User Group","hidden",true,$id)
        .get_input("count_feature","count","hidden",true,$max_feature);
        echo $input;

        $j = 0;
        foreach ($list_m_feature_group as $key => $item) {
            $m_feature_group_id = $item['m_feature_group_id'];
            $m_feature_group_name = $item['m_feature_group_name'];
            $input = "";

            ?>
                <div class="form-group row">
                    <h6 class="col-lg-10 col-md-9">
                        <i class="fa fa-eercast"></i>
                        <?php echo $m_feature_group_name ?>
                    </h4>
                </div>

            <?php
            $i=1;
            $count = count($list_m_feature);
            $status_div = false;
            foreach ($list_m_feature as $key => $item1) {
                $m_feature_id = $item1['m_feature_id'];
                $m_feature_name = $item1['m_feature_name'];
                $m_feature_group = $item1['m_feature_group_id'];
                $status = false;

                if($count_data_item!=0){
                    foreach ($data_item as $key => $item2) {
                        $m_feature = $item2['m_feature_id'];

                        if($m_feature_id==$m_feature){
                            $status = true;                        
                        }
                    }    
                }

                if($m_feature_group==$m_feature_group_id){
                    $input = get_group_toggle_full($m_feature_id,$m_feature_name,true,$status,false,"Yes","No");
                        
                    if($i%3==1){
                        echo "<div class='form-group row'>";
                        $status_div = false;
                    }

                    ?>
                        <div class='col-lg-4 col-md-4'><?php echo $input ?></div>
                    <?php

                    if($i%3==0){
                        echo "</div>";
                        $status_div = true;
                    }
                    $i++;
                }
            }
            
            if($status_div == false){
                echo "</div>";
            }

            if($count_group_feature-1!=$j){
                ?>
                    <hr>
                <?php    
            }
            
            $j++;
        }

    }
?>