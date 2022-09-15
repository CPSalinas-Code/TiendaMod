$(function(){

	// Lista de Continentes
	$.post( 'provincia.php' ).done( function(respuesta)
	{
		$( '#provincia' ).html( respuesta );
	});

	// lista de Paises	
	$('#provincia').change(function()
	{
		var provincias = $(this).val();
		// Lista de Paises
		$.post( 'ciudad.php', { provincia : provincias} ).done( function( respuesta )
		{
			$( '#ciudad' ).html( respuesta );
		});
	});
	
	// Lista de Ciudades
	$( '#ciudad' ).change( function()
	{
		var ciudad = $(this).children('option:selected').html();
//		alert( 'Lista de Ciudades' + ciudad );
	});

})
