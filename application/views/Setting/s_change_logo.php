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
        insert_handler($aksi);
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
    
    function insert_handler($aksi){
        $read_only = false;
        $m_device_file_login = base_url().'assets/images/logo_dark.png';
        $m_device_file_name_login = 'logo_dark.png';

        $m_device_file_web_full = base_url().'assets/images/logo.png';
        $m_device_file_name_web_full = 'logo.png';

        $m_device_file_web_small = base_url().'assets/images/logo_sm.png';
        $m_device_file_name_web_small = 'logo_sm.png';

        $m_device_file_icon_tabs = base_url().'assets/images/favicon.ico';
        $m_device_file_name_icon_tabs = 'favicon.ico';

        $input =  
            get_group_upload_jpg_full("logo_dark","Logo Login","text",200,true,$m_device_file_name_login,$m_device_file_login,$read_only)
            .get_group_upload_jpg_full("logo","Logo Web (full Size)","text",200,true,$m_device_file_name_web_full,$m_device_file_web_full,$read_only)
            .get_group_upload_jpg_full("logo_sm","Logo Web (Small Size)","text",200,true,$m_device_file_name_web_small,$m_device_file_web_small,$read_only)
            .get_group_upload_jpg_full("favicon","Icon Tabs","text",200,true,$m_device_file_name_icon_tabs,$m_device_file_icon_tabs,$read_only)

            ;
        echo $input;
    }
?>