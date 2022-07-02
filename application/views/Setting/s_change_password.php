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
                $("#btn_edit_cancel").hide();
            })
        </script>
        <?php
    }
    
    function insert_handler($data,$aksi){
        $count = count($data['data']);
        $item = $count==0?"":$data['data'][0];

        $input =  
            get_input("m_employee_id","Id","hidden",true,$_SESSION['employee_code'])
            .get_group_input("m_employee_password_lama","Old Password","password",20)
            .get_group_input("m_employee_password_new","New Password","password",20)
            .get_group_input("m_employee_password_re","Re-password","password",20)
            ;
        echo $input;

        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_edit').attr("onclick","send_edit_password()")
                $("#edit_area_title").html("");
                
                $('#m_employee_password_new').keyup(function() {
                    var m_employee_password_new = $('#m_employee_password_new').val();
                    var m_employee_password_re = $('#m_employee_password_re').val();

                    $("#m_employee_password_re"+ '+ .parsley-errors-list').html("");
                    if(m_employee_password_new!=m_employee_password_re){
                        $('#m_employee_password_re').after(
                        "<ul class='parsley-errors-list filled' id='parsley-id-15'>"+
                            "<li class='parsley-required'>Data password and re-password are not the same</li>"+
                        "</ul>");
                    }
                })

                $('#m_employee_password_re').keyup(function() {
                    $('#m_employee_password_new').trigger('keyup');
                })
            })
        </script>
        <?php
    }
?>