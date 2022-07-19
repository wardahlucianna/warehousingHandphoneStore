<?php $this->load->view('crud_function'); ?>

<?php
    $data = json_decode($data,true);
    $aksi = $data['aksi'];
    $path = $data['path'];
    $data = $data['data'];

    if($aksi == "table_master"){
        insert_handler($data,$aksi);
    }
    else if($aksi == "insert_handler" || $aksi == "edit_handler"){
        insert_handler($data,$aksi);
    }
    

    function table_master($path){
         $input =  
            get_group_input("m_product_name","Name","text",50,true)
            ;
        echo $input;
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

<script type="text/javascript">
    $("#table_area_title").hide();
    $("#btn_add").hide();
</script>

