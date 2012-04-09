/*	OJO todas las funciones deben ir separadas por ";" es decir:

 	function f1(){};
	function f2(){};
	var A = "algo";
*/

// funcion para hacer que los select tenga en elfecto y estilo de autocompletar y select a la vez usando jquery.
function agergarEfectoSelect(){

$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "";
				var input = this.input = $( "<input>" )
					.insertAfter( select )
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( $( this ).text().match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									input.data( "autocomplete" ).term = "";
									return false;
								}
							}
						}
					})
					.addClass( "ui-widget ui-widget-content ui-corner-left" );

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				this.button = $( "<button type='button'  >&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Mostrar todos los items" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}

						// work around a bug (likely same cause as #5265)
						$( this ).blur();

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	
};

//Funcion para colocar los iconos y tooltips a los botones modificar eliminar y guardar usando jquery
function agregarCaracteristicasBotones(){
	
		$('.botonModificar').attr( "title", "Modificar" );
		$('.botonEliminar').attr( "title", "Eliminar" );
		$('#botonGuardar').attr( "title", "Guardar" );
		
	        var ui_icon_lapiz = {icons:{primary:"ui-icon-pencil"},text:false}; //icono de lapiz
                var ui_icon_tijeras = {icons:{primary:"ui-icon-scissors"},text:false};//icono de tijeras
                var ui_icon_disco = {icons:{primary:"ui-icon-disk"}}; //icono de disquete

                $('.botonModificar').button(ui_icon_lapiz);
                $('.botonEliminar').button(ui_icon_tijeras);
                $('#botonGuardar').button(ui_icon_disco);
	

};

