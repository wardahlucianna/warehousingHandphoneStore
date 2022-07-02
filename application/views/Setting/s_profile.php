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
        <script type="text/javascript">
            edit_display();

            $(document).ready(function(){
                $("#edit_area_title").html("");
                $("#btn_edit_cancel").hide();
            })
        </script>
        <?php
    }
    
    function insert_handler($data,$aksi){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $m_employee_id = $count==0?"":$item['m_employee_id'];
        $m_employee_full_name = $count==0?"":$item['m_employee_full_name'];
        $m_employee_sort_name = $count==0?"":$item['m_employee_sort_name'];
        $m_position_id = $count==0?"":$item['m_position_id'];
        $m_user_group_id = $count==0?"":$item['m_user_group_id'];
        $m_employee_email = $count==0?"":$item['m_employee_email'];
        $m_employee_username = $count==0?"":$item['m_employee_username'];
        $m_employee_status = $count==0?"Active":$item['m_employee_status'];
        $read_only = false;

        $count = count($data['list_m_position']);
        $list_m_position = $count==0?"":$data['list_m_position'];

        $count = count($data['list_m_user_group']);
        $list_m_user_group = $count==0?"":$data['list_m_user_group'];

        if($count>0){
            $m_employee_status = $m_employee_status=="Active"?true:false;
            $read_only = $m_employee_status==true?false:true;
        }

        $input =  
            get_input("m_employee_id","Id","hidden",true,$m_employee_id)
            .get_group_input("m_employee_full_name","Full Nama","text",50,true,$m_employee_full_name,$read_only)
            .get_group_input("m_employee_sort_name","Sort Name","text",10,true,$m_employee_sort_name,$read_only)
            .get_group_select2("m_position_id","Position",true,$list_m_position,$m_position_id,true)
            .get_group_select2("m_user_group_id","User Group",true,$list_m_user_group,$m_user_group_id,true)
            .get_group_input("m_employee_email","Email","email",50,true,$m_employee_email,$read_only)
            .get_group_input("m_employee_username","User","text",50,true,$m_employee_username,$read_only)
            ;

        echo $input;
    }
?>