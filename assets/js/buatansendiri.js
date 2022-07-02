// function show(hide,show){
// 	$(hide).hide();
// 	$(show).show();
// }

// $(".number" ).keyup(function() {
// 	var target = $( event.target );
// 	if ( target.is( "input" ) ) {
// 		var angka = target.val()
// 		angka = angka.replace(/,.*|[^0-9]/g, '')

// 		if(angka>0){
// 			angka = angka;
// 		}
// 		else{
// 			angka = 0			
// 		}
// 		target.val(angka)
// 	}
// });

// $(".numberrupiah" ).keyup(function() {
// 	var target = $( event.target );
// 	if ( target.is( "input" ) ) {
// 		var angka = target.val()
// 		angka = parseInt(angka.replace(/,.*|[^0-9]/g, ''))

// 		if(angka>0){
// 			angka = numberformatrupiah(angka);
// 		}
// 		else{
// 			angka = 0			
// 		}
// 		target.val(angka)
// 	}
// });

// $(".rupiah" ).keyup(function() {
// 	var target = $( event.target );
// 	if ( target.is( "input" ) ) {
// 		var angka = target.val()
// 		angka = parseInt(angka.replace(/,.*|[^0-9]/g, ''))

// 		if(angka>0){
// 			angka = numberformatrupiah(angka);
// 		}
// 		else{
// 			angka = 0			
// 		}
// 		target.val(angka)
// 	}
// });

// function numberformatrupiah(b){
// 	var _minus = false;
// 	if (b<0) _minus = true;
// 	b = b.toString();
// 	b=b.replace(".","");
// 	b=b.replace("-","");
// 	c = "";
// 	panjang = b.length;
// 	j = 0;
// 	for (i = panjang; i > 0; i--){
// 	j = j + 1;
// 	if (((j % 3) == 1) && (j != 1)){
// 	c = b.substr(i-1,1) + "." + c;
// 	} else {
// 	c = b.substr(i-1,1) + c;
// 	}
// 	}
// 	if (_minus) c = "-" + c ;
// 	return c;
// }

// function formatdeciaml(angka){
// 	angka 	= angka.toString()
// 	index 	= angka.indexOf(".");
	
// 	if(index>0){
// 		bulat 	= angka.substring(0, index);
// 		des 	= angka.substring(index+1);
// 		bulat 	= numberformatrupiah(bulat)
// 		angka	= bulat+","+des;
// 	}
// 	else{
// 		angka 	= numberformatrupiah(angka)
// 		angka	= angka+",00";
// 	}
	
// 	return angka;
// }

// function normalformat(angka){
// 	angka 	= angka.toString()
// 	index 	= angka.indexOf(",");
// 	if(index>0){
// 		bulat 	= angka.substring(0, index);
// 		des 	= angka.substring(index+1);
// 		bulat 	= Number(bulat.replace(/,.*|[.]/g, ''));
// 		angka	= bulat+"."+des;
// 	}
// 	else{
// 		bulat 	= Number(angka.replace(/,.*|[.]/g, ''));
// 		angka	= bulat;
// 	}
// 	return angka;
// }

function form_validation(form){
	delete_validation(form)
	var form_data=$("#"+form).serializeArray();
	sts = false;

	for (var input in form_data){
		var element=$("#"+form+" #"+form_data[input]['name']);
		var localName=element[0].localName;
		var valid =  element[0].required;
		var type =  element[0].type;
		
		if (valid){
			var hide = element.is(":visible");
			var id = element[0].id;
			var value = element[0].value;
			var name = element[0].placeholder;
			if(hide){
				if(value==""){
					if(localName=="input"){
						$("#"+id).after(
						"<ul class='parsley-errors-list filled' id='parsley-id-15'>"+
							"<li class='parsley-required'>Cannot null</li>"+
						"</ul>");		
					}
					else if(localName=="select"){
						$("#"+id).next().after(
						"<ul class='parsley-errors-list filled' id='parsley-id-15'>"+
							"<li class='parsley-required'>Cannot null</li>"+
						"</ul>");							
					}
					else if(localName=="textarea"){
						$("#"+id).after(
						"<ul class='parsley-errors-list filled' id='parsley-id-15'>"+
							"<li class='parsley-required'>Cannot null</li>"+
						"</ul>");							
					}

					sts = true;
				}
				else{
					if(localName=="input"){
						if(type=="email"){
							var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

							if(filter.test(value)==false){
								$("#"+id).after(
								"<ul class='parsley-errors-list filled' id='parsley-id-15'>"+
									"<li class='parsley-required'>Wrong " +name+" </li>"+
								"</ul>");
								sts = true;
							}
						}
						else if(type=="password"){
							if(value.length<6){
								$("#"+id).after(
								"<ul class='parsley-errors-list filled' id='parsley-id-15'>"+
									"<li class='parsley-required'>"+name+" minimal 6 character</li>"+
								"</ul>");
								sts = true;
							}
						}
					}
				}
			}
		}
	}
	
	return sts;
}

function delete_validation(form){
	var form_data=$("#"+form).serializeArray();
	for (var input in form_data){
		var element=$("#"+form+" #"+form_data[input]['name']);
		var localName=element[0].localName;
		var valid =  element[0].required;
		var type =  element[0].type;
		
		if (valid){
			var hide = element.is(":visible");
			var id = element[0].id;
			var value = element[0].value;

			if(hide){
				if(localName=="input"){
					$("#"+id+ '+ .parsley-errors-list').html("");
				}
				else if(localName=="select"){
					$("#"+id+ '+ .select2 + .parsley-errors-list').html("")
				}

				else if(localName=="textarea"){
					$("#"+id+ '+ .parsley-errors-list').html("");
				}

				if(value!=""){
					if(localName=="input"){
						if(type=="email"){
							$("#"+id+ '+ .parsley-errors-list').html("");
						}
					}
				}
			}
		}
	}
}

