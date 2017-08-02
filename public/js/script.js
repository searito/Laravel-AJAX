$(document).ready(function() {
	$("#alert").hide();
	$("#myModal").hide();

	$(".btn-delete").click(function(e){
		e.preventDefault();

		if(!confirm("Deseas Eliminar Este Producto...???")){
			return false;
		}


		var row = $(this).parents('tr');
		var form = $(this).parents('form');
		var url = form.attr('action');

		$('#alert').show();

		$.post(url, form.serialize(), function(result){
			row.fadeOut();
			$('#products-total').html(result.total);

			$("#alert").html(result.message);
		})

		.fail(function(){
			$('#alert').html('Algo Salió Mal');
		});
	});



	$(".btn-edit").click(function(e){
		e.preventDefault();

		var row = $(this).parents('tr');
		var form = $(this).parents('form');
		var url = form.attr('action');

		//alert(url);

		$.post(url, form.serialize(), function(result){
			
			$("#product-name").html('Editar ' + result.name);
			

			document.getElementById("id-product").defaultValue = result.codigo;

			document.getElementById("productName").defaultValue = result.name;  // PARA RELLENAR LOS INPUTS //
			document.getElementById("productShort").defaultValue = result.corto;
			document.getElementById("productDescription").defaultValue = result.description;
		})
		.fail(function(){
			$('#alert').html('Algo Salió Mal');
		});
	});



	$(".btn-view").click(function(e){
		e.preventDefault();

		var row = $(this).parents('tr');
		var form = $(this).parents('form');
		var url = form.attr('action');

		//alert(url);

		$.post(url, form.serialize(), function(result){
			
			$("#productoName").html(result.nombre);
			$("#shortProduct").html(result.deshort);
			$("#desProduct").html(result.descomplete);
		})
		.fail(function(){
			$('#alert').html('Algo Salió Mal');
		});
	});



	$("#form-create").submit(function(e) {
		e.preventDefault();

		var url = $(this).attr('action');
		var cadena = $(this).serialize();

		$('#alert').show();

		$.post(url, cadena, function(result){
			$('#products-total').html(result.totalProducts);

			$("#alert").html(result.notification);
		})

		.fail(function(){
			$('#alert').html('Algo Salió Mal');
		});
	});



	$("#form-update").submit(function(e) {
		e.preventDefault();

		var route = 'http://localhost/larajax/public/actualizar-producto/';
		var productId = $("#id-product").val();
		var url = route + productId;
		var contenido = $(this).serialize();

		$('#alert').show();

		$.post(url, contenido, function(result){
			$("#alert").html(result.estado);
		})

		.fail(function(){
			$('#alert').html('Algo Salió Mal');
		});

	});

});