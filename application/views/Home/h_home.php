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
            <h5 id="title_welcome"> Welcome </h5>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#table_area").css("height","400px");
                    $("#title_welcome").css("text-align","center");
                    $("#table_area_title").html("");
                    $("#btn_add").hide();
                });
            </script>
        <?php
    }

    function insert_handler($data,$aksi){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $m_feature_group_id = $count==0?"":$item['m_feature_group_id'];
        $m_feature_group_name = $count==0?"":$item['m_feature_group_name'];
        $m_feature_group_url = $count==0?"":$item['m_feature_group_url'];
        $m_feature_group_icon = $count==0?"":$item['m_feature_group_icon'];
        $m_feature_group_status = $count==0?"Active":$item['m_feature_group_status'];
        $read_only = false;
        
        if($count>0){
            $m_feature_group_status = $m_feature_group_status=="Active"?true:false;
            $read_only = $m_feature_group_status==true?false:true;
        }
        
        $input =  
            get_input("m_feature_group_id","Id","hidden",true,$m_feature_group_id)
            .get_group_input("m_feature_group_name","Name","text",50,true,$m_feature_group_name,$read_only)
            .get_group_input("m_feature_group_url","URL","text",50,false,$m_feature_group_url,$read_only)
            .get_group_input("m_feature_group_icon","Icon","text",20,false,$m_feature_group_icon,$read_only)
            .get_group_toggle("m_feature_group_status","Status",true,$m_feature_group_status,$read_only)
            ;
        echo $input;
    }
?>