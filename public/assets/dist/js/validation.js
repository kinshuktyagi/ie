
function integer(number)
{
		var data=jQuery("#"+number).val();
		var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
		if(intRegex.test(data) || floatRegex.test(data))
		  {
		  }
		else
		  {
			var dat=jQuery("#"+number).val();
				if(dat!="")
				{
					var da=jQuery("#"+number).val().length;
					var str=data.substring(da-1,0);
					jQuery("#"+number).val(str);											
				}
			}
}

function intfloat(number)
{
	var data=jQuery("#"+number).val();
	var RE = /^\d*\.?\d*$/;
	if(RE.test(data)){  
	}else{
	 var da=jQuery("#"+number).val().length;
	var str=data.substring(da-1,0);
	jQuery("#"+number).val(str);
	}
}



//Function for percentage....
function percentage(control_id)
{
		var data=jQuery("#"+control_id).val();
		var intRegex = /^\s*(\d{0,2})(\.?(\d*))?\s*\%?\s*$/;
		if(intRegex.test(data) )
		{
															
		}
		else
		{
			var dat=jQuery("#"+control_id).val();
			if(dat!="")
			{
				var da=jQuery("#"+control_id).val().length;
				var str=data.substring(da-1,0);
				jQuery("#"+control_id).val(str);									
			}
		}										
		if(data>100)
		{
			jQuery("#"+control_id).css("background-color","rgb(253, 231, 231)");
			jQuery("#"+control_id).val("");
			jQuery("#"+control_id).attr("Placeholder","Percentage should be less than 100.");
		}
		else
		{
			jQuery("#"+control_id).css("background-color","white");
			
		}
											
}





function dynamic_integer(number){

		var data=jQuery("."+number).val();
		
		var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
		if(intRegex.test(data) || floatRegex.test(data))
		  {
															
		  }
		else
		  {
			var dat=jQuery("."+number).val();
				if(dat!="")
				{
					var da=jQuery("."+number).val().length;
					var str=data.substring(da-1,0);
					jQuery("."+number).val(str);

													
				}
			}
}





function strings(name){
	var name_str=jQuery("#"+name).val();
    var name_len=jQuery("#"+name).val().length;
	for(var i=0;i<name_len;i++)
	{
							
		var data1=name_str.substring(i,i+1);
									
									
		var intRegex = /^\d+$/;
		var floatRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
									//var re =/^[\s`~!@#$%^&*()+={}|;:'",.<>\/?\\-]+$/;
									
		if(intRegex.test(data1) || floatRegex.test(data1) )
		{
		 var ind=name_str.indexOf(data1);
											
											
		if(i==ind)
		  {
			var val=name_str.substring(0,ind);
				jQuery("#"+name).val(val);
		  }
		}
	}	
	
}

function img(file)
{
	var file = jQuery("#"+file).val();
	var exts = ['jpg','jpeg','gif','png'];
							
       if ( file ) {
			var get_ext = file.split('.');
				get_ext = get_ext.reverse();
				if ( jQuery.inArray ( get_ext[0].toLowerCase(), exts ) > -1 )
						{
							var check=jQuery("#"+file).val();
								if(check=="false")
								{
																						
																						
								}
						} 
						else 
							{
								$("#"+file).focus();
								e.preventDefault();
								return false;
							}
					 }	
						
}
	