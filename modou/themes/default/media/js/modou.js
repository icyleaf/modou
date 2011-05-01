$(document).ready(function(){

	$('.delete').click(function(){
		if ( !confirm('确定要删除？'))
			return false; 
	});
});