
$( document ).ready(function() {
   $('.ui-list').sortable({
   		update: function(event,ui) {
   			$(this).children().each(function(index){
   				if($(this).attr('data-position') != index + 1) {
   					$(this).attr('data-position', index + 1).addClass('updated');		
   				}
   					
   			});
   			var positions = [];

   			$('.updated').each(function(){
   				positions.push([$(this).attr('data-id'), $(this).attr('data-position')]);
   				$(this).removeClass('update')
   			});
   			var id = 2;
   			$.ajax({
   				url:'edit-attributes?id='+ $('.products-form').attr('data-product'),
   				method: 'POST',
   				dataType: 'text',
   				data: {
   					updated: 1,
   					positions: positions
   				},
   				success: function(response){
   					console.log(response);
   				}
   			})

	}
	});
});


$( "#delete-thumb" ).click(function() {
			let product_id = $(this).attr('data-product-id')
  			$.ajax({
   				url:'delete-image?id='+product_id,
   				method: 'POST',
   				dataType: 'text',
   				success: function(response){
   					console.log(response);
                    $('.thumb-input-wrap').html("<div class='thumb-help alert-success alert alert-dismissible' role='alert'></div><div class='form-group field-products-thumb'><label class='control-label' for='products-thumb'>Изображение товара</label><input type='hidden' name='Products[thumb]' value=''><input type='file' id='products-thumb' name='Products[thumb]' value='' maxlength='155'></div>");
   				}
   			})

});


