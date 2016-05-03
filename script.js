function load(){
	$(document).ready(function(){
        $.ajax({url: "RestController.php?q=selectall", success: function(result){
            $("#content").html(result);
            $(".add").bind("click", add);
            $(".del").click(function(){
            	var row = $(this).parent().parent();
            	var d_id = row.find('td:first').text();
            	del(d_id);
            	console.log(d_id);
            });
            $(".edit").click(function(){
            	var row = $(this).parent().parent();
            	var d_id = row.find('td:nth-child(1)').text();
            	var d_name = row.find('td:nth-child(2)');
            	var d_year = row.find('td:nth-child(3)');
            	var d_tool = row.find('td:nth-child(4)');

            	d_name.html("<input type='text' value='"+d_name.html()+"'/>");
            	d_year.html("<input type='text' value='"+d_year.html()+"'/>");

		  		var btn_oke = d_tool.find('input:nth-child(1)');
		  		var btn_cancel = d_tool.find('input:nth-child(2)');
		  		var btn_edit = d_tool.find('input:nth-child(3)');
		  		var btn_delete = d_tool.find('input:nth-child(4)');
		  		
		  		btn_oke.css({"display": "inline-block"});
		  		btn_cancel.css({"display": "inline-block"});
		  		btn_edit.css({"display": "none"});
		  		btn_delete.css({"display": "none"});

		  		btn_cancel.click(function(){
		  			d_name.html(d_name.children().val());
            		d_year.html(d_year.children().val());

            		btn_oke.css({"display": "none"});
			  		btn_cancel.css({"display": "none"});
			  		btn_edit.css({"display": "inline-block"});
			  		btn_delete.css({"display": "inline-block"});
		  		});

		  		btn_oke.click(function(){
		  			oke(d_id, d_name.children().val(), d_year.children().val());
		  		});

            	console.log(d_id + d_name.children().val() + d_year.children().val());
            });
        }});
	});
}
function add(){
	$(document).ready(function(){
        $.ajax({
        	url: 'RestController.php?q=add&name='+ $("#name").val()+'&year='+$("#year").val(),
        	type: 'POST',
        	success: function(result){
            	$("#demo").html(result);
            	load();
        	}
    	});
	});
}
function del(d_id){
	$(document).ready(function(){
		$.ajax({
			url: 'RestController.php?q=delete&id='+ d_id,
			type: 'POST',
			success: function(result){
		    	$("#demo").html(result);
		    	load();
			}
		});
	});
}
function oke(d_id, d_name, d_year){
	$(document).ready(function(){
	  	$.ajax({
        	url: 'RestController.php?q=edit&name='+d_name+'&year='+d_year+'&id='+d_id,
        	type: 'POST',
        	success: function(result){
            	$("#demo").html(result);
            	load();
        	}
    	});
	});
}

