<?php
ini_set('display_errors','off');

function get_input($label,$name,$text,$cannot_null = true,$value="",$read_only =false) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"":"readonly";
    $display = $text=="hidden"?"style='display:none'":"";

    $input =    "<div class='form-group row' ".$display.">".
                    "<div class='col-lg-2 col-md-1'></div>".
                    "<div class='col-lg-8 col-md-7'>".
                        "<input type='".$text."' name='".$label."' ".$required." placeholder='".$name."' class='form-control' id='".$label."' ".$read_only." value = '".$value."'>".
                    "</div>".
                    "<div class='col-lg-2 col-md-1'></div>".
                "</div>";
    return $input;
}

function get_group_input($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$read_only =false) {
	$required = $cannot_null==false?"":"required";
	$cannot_null = $cannot_null==false?"":"*";
	$read_only = $read_only==false?"":"readonly";

	$input = 	"<div class='form-group row'>".
                    "<div class='col-lg-2 col-md-1'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-2 col-md-3'>".$name.
                    	"<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-6 col-md-7'>".
                        "<input type='".$text."' name='".$label."' ".$required." placeholder='".$name."' class='form-control' id='".$label."' maxlength='".$maxlength."' ".$read_only." value = '".$value."'>".
                    "</div>".
                    "<div class='col-lg-2 col-md-1'></div>".
                "</div>";
	return $input;
}

function get_group_input_full($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$read_only =false) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"":"readonly";

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<input type='".$text."' name='".$label."' ".$required." placeholder='".$name."' class='form-control' id='".$label."' maxlength='".$maxlength."' ".$read_only." value = '".$value."'>".
                    "</div>".
                "</div>";
    return $input;
}

function get_group_toggle($label,$name,$cannot_null = true,$checked=true,$read_only =false,$data_on='Active',$data_off='Not Active',$script =true) {
    $cannot_null = $cannot_null==false?"":"*";
    $checked = $checked==false?false:true;
    $checked_value = $checked==false?"":"checked";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').bootstrapToggle();
            $('#".$label."').change(function() {
                var value = $(this).prop('checked')==true?1:0;
                $('#".$label."').val(value);
                $('#".$label."_area').val(value);
            })
        </script>";

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-2 col-md-1'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-2 col-md-3'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-6 col-md-7'>".
                        "<input type='checkbox' id = '".$label."' name = '".$label."' ".$checked_value." data-toggle='toggle' data-on='".$data_on."' data-off='".$data_off."' data-onstyle='primary' data-offstyle='danger' value = '".$checked."'>".
                        "<input type='hidden' name='".$label."_area' placeholder='".$name."' class='form-control' id='".$label."_area' ".$read_only." value = '".$checked."'>".

                    "</div>".
                    "<div class='col-lg-2 col-md-1'></div>".
                "</div>".
                $script
                ;

    return $input;
}

function get_group_toggle_full($label,$name,$cannot_null = true,$checked=true,$read_only =false,$data_on='Active',$data_off='Not Active',$script =true) {
    $cannot_null = $cannot_null==false?"":"*";
    $checked = $checked==false?false:true;
    $checked_value = $checked==false?"":"checked";
    $read_only = $read_only==false?"":"disable";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').bootstrapToggle('".$read_only."');
            $('#".$label."').change(function() {
                var value = $(this).prop('checked')==true?1:0;
                $('#".$label."').val(value);
                $('#".$label."_area').val(value);

            })

        </script>";

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<input type='checkbox' id = '".$label."' name = '".$label."' ".$checked_value." data-toggle='toggle' data-on='".$data_on."' data-off='".$data_off."' data-onstyle='primary' data-offstyle='danger' value = '".$checked."'>".
                        "<input type='hidden' name='".$label."_area' placeholder='".$name."' class='form-control' id='".$label."_area' ".$read_only." value = '".$checked."'>".
                    "</div>".
                "</div>".
                $script
                ;

    return $input;
}

function get_group_select2($label,$name,$cannot_null = true,$list,$value="",$read_only =false,$script =true) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"false":"true";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').select2({
                placeholder: 'Select ".$name."',
                allowClear: true,
                disabled: ".$read_only."
            });
            $('#".$label."').on('change', function () {
                $('#".$label."_area').val($(this).val())
            })
        </script>";
    
    $option = "<option selected></option>";
    if(is_array($list)){
        foreach ($list as $key => $item) {
            $value_option = "";
            $id = "";
            $else = "";
            $selected = "";
            $i = 1;
            foreach ($item as $key1 => $item1) {
                if($i==1){
                    $id = "value ='".$item1."'" ;
                    $selected = $value==$item1?"selected":"";
                }
                else if($i==2){
                    $value_option = $item1;
                }
                else{
                    $else .= "data-".$key1."='".$item1."' ";
                }
                $i++;
            }

            $option .= "<option ".$id." ".$else." ".$selected.">".$value_option."</option>";
        }  
    }

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-2 col-md-1'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-2 col-md-3'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-6 col-md-7'>".
                        "<select class='form-control' id='".$label."' name='".$label."' ".$required.">".
                            $option.
                        "</select>".
                        "<input type='hidden' name='".$label."_area' class='form-control' id='".$label."_area' value = '".$value."' ".$read_only.">".
                    "</div>".
                    "<div class='col-lg-2 col-md-1'></div>".
                "</div>".
                $script;
    return $input;
}

function get_group_select2_full($label,$name,$cannot_null = true,$list,$value="",$read_only =false,$script =true) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"false":"true";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').select2({
                placeholder: 'Select ".$name."',
                allowClear: true,
                disabled: ".$read_only."
            });
            $('#".$label."').on('change', function () {
                $('#".$label."_area').val($(this).val())
            })
        </script>";
    
    $option = "<option selected></option>";

    if(is_array($list)){
        foreach ($list as $key => $item) {
            $value_option = "";
            $id = "";
            $else = "";
            $selected = "";
            $i = 1;

            foreach ($item as $key1 => $item1) {
                if($i==1){
                    $id = "value ='".$item1."'" ;
                    $selected = $value==$item1?"selected":"";
                }
                else if($i==2){
                    $value_option = $item1;
                }
                else{
                    $else .= "data-".$key1."='".$item1."' ";
                }
                $i++;
            }

            $option .= "<option ".$id." ".$else." ".$selected.">".$value_option."</option>";
        }
    }

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<select class='form-control' id='".$label."' name='".$label."' ".$required.">".
                            $option.
                        "</select>".
                        "<input type='hidden' name='".$label."_area' class='form-control' id='".$label."_area' value = '".$value."' ".$read_only.">".
                    "</div>".
                "</div>".
                $script;
    return $input;
}

function get_group_select2_value($label,$name,$cannot_null = true,$list,$value="",$read_only =false,$script =true) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"false":"true";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').select2({
                placeholder: 'Select ".$name."',
                allowClear: true,
                disabled: ".$read_only."
            });
             $('#".$label."').on('change', function () {
                $('#".$label."_area').val($(this).val())
            })
        </script>";

    $option = "<option selected></option>";
    if(is_array($list)){
        foreach ($list as $key => $item) {
            $value_option = "";
            $id = "";
            $else = "";
            $selected = "";
            foreach ($item as $key1 => $item1) {
                $id = "value ='".$item1."'" ;
                $value_option = $item1;
                $selected = $value==$item1?"selected":"";
            }

            $option .= "<option ".$id." ".$else." ".$selected.">".$value_option."</option>";
        }    
    }
    
    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-2 col-md-1'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-2 col-md-3'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-6 col-md-7'>".
                        "<select class='form-control' id='".$label."' name='".$label."' ".$required.">".
                            $option.
                        "</select>".
                        "<input type='hidden' name='".$label."_area' class='form-control' id='".$label."_area' value = '".$value."' ".$read_only.">".
                    "</div>".
                    "<div class='col-lg-2 col-md-1'></div>".
                "</div>".
                $script;
    return $input;
}

function get_group_select2_value_full($label,$name,$cannot_null = true,$list,$value="",$read_only =false,$script =true) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"false":"true";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').select2({
                placeholder: 'Select ".$name."',
                allowClear: true,
                disabled: ".$read_only."
            });
             $('#".$label."').on('change', function () {
                $('#".$label."_area').val($(this).val())
            })
        </script>";

    $option = "<option selected></option>";
    if(is_array($list)){
        foreach ($list as $key => $item) {
            $value_option = "";
            $id = "";
            $else = "";
            $selected = "";
            foreach ($item as $key1 => $item1) {
                $id = "value ='".$item1."'" ;
                $value_option = $item1;
                $selected = $value==$item1?"selected":"";
            }

            $option .= "<option ".$id." ".$else." ".$selected.">".$value_option."</option>";
        }
    }

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<select class='form-control' id='".$label."' name='".$label."' ".$required.">".
                            $option.
                        "</select>".
                        "<input type='hidden' name='".$label."_area' class='form-control' id='".$label."_area' value = '".$value."' ".$read_only.">".
                    "</div>".
                "</div>".
                $script;
    return $input;
}

function get_button_full($label,$name,$icon,$color='primary',$on_click,$read_only =false) {
    $read_only = $read_only==false?"":"disabled";

    $input =    "<div class='form-group row' id='".$label."_area'>".
                    "<div class='col-lg-2 col-md-2'></div>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<button type='button' class='btn btn-".$color." waves-effect waves-light' id='".$label."' name='".$label."' onclick='".$on_click."' ".$read_only." style='width: 100%;'>
                            <i class='".$icon."'></i> ".$name."
                        </button>".
                    "</div>".
                "</div>";
    return $input;
}

function get_button_filter_full($label,$name,$icon,$color='primary',$on_click,$read_only =false) {
    $read_only = $read_only==false?"":"disabled";

    $input =    "<div class='form-group row' id='".$label."_area'>".
                    "<div class='col-lg-4 col-md-4'></div>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<button type='button' class='btn btn-".$color." waves-effect waves-light' id='".$label."' name='".$label."' onclick='".$on_click."' ".$read_only." style='width: 100%;'>
                            <i class='".$icon."'></i> ".$name."
                        </button>".
                    "</div>".
                "</div>";
    return $input;
}

function get_group_textarea($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$read_only =false) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"":"readonly";

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-2 col-md-1'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-2 col-md-3'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-6 col-md-7'>".
                        "<textarea class='form-control' placeholder='".$name."' id='".$label."' name='".$label."' maxlength='".$maxlength."' rows='3' ".$read_only." ".$required.">".$value."</textarea>".
                    "</div>".
                    "<div class='col-lg-2 col-md-1'></div>".
                "</div>";
    return $input;
}

function get_group_textarea_full($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$read_only =false) {
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"":"readonly";

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8'>".
                        "<textarea class='form-control' placeholder='".$name."' id='".$label."' name='".$label."' maxlength='".$maxlength."' rows='3' ".$read_only." ".$required.">".$value."</textarea>".
                    "</div>".
                "</div>";
    return $input;
}

function get_group_upload_jpg_full($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$file="",$read_only =false,$script =true) {
    
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"false":"true";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#upload_".$label."').on('change', function() {
                var input = this;
                var file_name = $(this).val().split('\\\\').pop();
                $(this).siblings('.custom-file-label').addClass('selected').html(file_name);

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0]);
                    reader.onload = function(e) {
                        $('#img_".$label."').attr('src', e.target.result);

                        $('#img_".$label."').on('load', function() {
                            var count_form = $('#upload_".$label."').innerHeight();
                            var count_img = $('#img_".$label."').innerHeight();
                            var count_all = count_img+count_form;
                            $('#div_".$label."').css('height',count_all)
                        })
                    }
                }
            });

            var file_name = '".$value."';
            var file = '".$file."';
            if(file_name==''){
                file_name = 'Choose File';
            }

            else{
                $('#upload_".$label."').siblings('.custom-file-label').addClass('selected').html(file_name);
                $('#img_".$label."').attr('src', file);
                
                $('#img_".$label."').on('load', function() {
                    var count_form = $('#upload_".$label."').innerHeight();
                    var count_img = $('#img_".$label."').innerHeight();
                    var count_all = count_img+count_form;
                    $('#div_".$label."').css('height',count_all)
                })
            }
        </script>";

    $input =    "<div class='form-group row' >".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8' id='div_".$label."'>".
                        "<div class='custom-file'>".                            
                            "<input type='file' class='custom-file-input form-control' id ='upload_".$label."' name ='upload_".$label."'>".
                            "<label class='custom-file-label' id ='upload_".$label."' for='customFile'>Choose file</label>".
                            "<img id='img_".$label."' src='' class = 'img-fluid' style='width: inherit;border: 1px solid gray;background: gray;'>".
                        "</div>".
                    "</div>".
                "</div>".
                $script;
    return $input;
}

function get_group_download_jpg_full($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$file="",$read_only =false,$script =true) {
    
    $required = $cannot_null==false?"":"required";
    $cannot_null = $cannot_null==false?"":"*";
    $read_only = $read_only==false?"":"readonly";
    $script = $script==false?"":"
        <script type='text/javascript'>
            var file = '".$file."';
            $('#img_".$label."').attr('src', file);
            
            $('#img_".$label."').on('load', function() {
                var count_form = $('#download_".$label."').innerHeight();
                var count_img = $('#img_".$label."').innerHeight();
                var count_all = count_img+count_form;
                $('#div_".$label."').css('height',count_all)
            })
        </script>";

    $input =    "<div class='form-group row'>".
                    "<div class='col-lg-1 col-md-0'></div>".
                    "<label for='text1' class='control-label pull-left col-lg-3 col-md-4'>".$name.
                        "<span class='text-danger'>".$cannot_null."</span></label>".
                    "<div class='col-lg-8 col-md-8' id='div_".$label."'>".
                        "<div class='custom-file'>".
                            "<img id='img_".$label."' src='' class = 'img-fluid' style='width: inherit;border: 1px solid gray;background: gray;'>".
                            "<a type='button' class='btn btn-primary waves-effect waves-light' id='download_".$label."' name='download_".$label."' style='width: 100%;' href='".$file."' download='".$value."' >
                                <i class='fa fa-download'></i> Download
                            </a>".
                        "</div>".
                    "</div>".
                "</div>".
                $script;
    return $input;
}

function get_single_select2($label,$name,$cannot_null = true,$list,$value="",$read_only =false,$script =true) {
    $required = $cannot_null==false?"":"required";
    $read_only = $read_only==false?"false":"true";
    $script = $script==false?"":"
        <script type='text/javascript'>
            $('#".$label."').select2({
                placeholder: 'Select ".$name."',
                allowClear: true,
                disabled: ".$read_only."
            });
            $('#".$label."').on('change', function () {
                $('#".$label."_area').val($(this).val())
            })
        </script>";
    
    $option = "<option selected></option>";
    if(is_array($list)){
        foreach ($list as $key => $item) {
            $value_option = "";
            $id = "";
            $else = "";
            $selected = "";
            $i = 1;
            foreach ($item as $key1 => $item1) {
                if($i==1){
                    $id = "value ='".$item1."'" ;
                    $selected = $value==$item1?"selected":"";
                }
                else if($i==2){
                    $value_option = $item1;
                }
                else{
                    $else .= "data-".$key1."='".$item1."' ";
                }
                $i++;
            }

            $option .= "<option ".$id." ".$else." ".$selected.">".$value_option."</option>";
        }  
    }

    $input =    "<select class='form-control' id='".$label."' name='".$label."' ".$required.">".
                    $option.
                "</select>".
                $script;
    return $input;
}
function get_single_input($label,$name,$text,$maxlength=100,$cannot_null = true,$value="",$read_only =false) {
    $required = $cannot_null==false?"":"required";
    $read_only = $read_only==false?"":"readonly";
    $display = $text=="hidden"?"style='display:none'":"";

    $input =    "<input type='".$text."' name='".$label."' ".$required." placeholder='".$name."' class='form-control' id='".$label."' ".$read_only." value = '".$value."' maxlength='".$maxlength."'>";
    return $input;
}


?>
