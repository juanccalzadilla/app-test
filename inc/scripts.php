  <script>
  	var DEBUG_JS = true;
  </script>

  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- INI . DataTables . Versión distinta a la de MDB -->
  <script type="text/javascript" src="inc/DataTables/datatables.min.js"></script>


  <script>
  	var dt_language_es = {
  		"sProcessing": "...Cargando...",
  		"sLengthMenu": "Mostrar _MENU_ registros",
  		"sEmptyTable": "Ningún dato disponible en esta tabla",
  		"sZeroRecords": "No se encontraron elementos",
  		"sInfo": "Mostrando elementos del _START_ al _END_ de un total de _TOTAL_ elementos",
  		"sInfoEmpty": "Mostrando elementos del 0 al 0 de un total de 0 elementos",
  		"sInfoFiltered": "(filtrado de un total de _MAX_ elementos)",
  		"sInfoPostFix": "",
  		"sSearch": "Buscar:",
  		"sUrl": "",
  		"sInfoThousands": ",",
  		"sLoadingRecords": "...Cargando...",
  		"oPaginate": {
  			"sFirst": "Primero",
  			"sLast": "Último",
  			"sNext": "Siguiente",
  			"sPrevious": "Anterior"
  		},
  		"select": {
  			"rows": {
  				_: "Ha seleccioando %d elementos",
  				0: "Haga click sobre una fila para seleccionarla",
  				1: "1 elemento seleccionado"
  			}
  		}
  	};

  	var dt_dom = '';
  	var dt_dom_default = "<'row'<'col-sm-4 tLeftHead'l><'col-sm-4'><'col-sm-4'p>>" +
  		"<'row'<'col-sm-12'tr>>" +
  		"<'row'<'col-sm-5'i><'col-sm-7'p>>";
  </script>
  <!-- FIN . DataTables -->

  <!-- Funciones -->
  <script>
  	// - Obtener la fecha actual
  	function SB_GetFecha() {
  		var d = new Date(),
  			month = '' + (d.getMonth() + 1),
  			day = '' + d.getDate(),
  			year = d.getFullYear();

  		if (month.length < 2)
  			month = '0' + month;
  		if (day.length < 2)
  			day = '0' + day;

  		return [year, month, day].join('');
  	}

  	function SB_ValidateCheckField(IdInput, table, column, errorMessage) {
  		/*** 
  		 * 1. IdInput: Id del input a validar sin el # (Ej: 'nombre')
  		 * 2. table: Tabla de la base de datos
  		 * 3. column: Columna de la tabla de la base de datos
  		 * 4. errorMessage: Mensaje de error a mostrar
  		 * ***Es necesario el archivo ajax_validateField.php (Es el backend)
  		 * ** Al ser una promesa, se debe usar await en el llamado de la función
  		 */

  		/***
  		 * Retorna true si el value existe en la base de datos
  		 * Retorna false si el value no existe en la base de datos
  		 */
  		return new Promise((resolve, reject) => {
  			var valorCampo = $('#' + IdInput).val();
  			//Le aplicamos un regex al campo para evitar espacios en blanco al principio y al final
  			valorCampo = valorCampo.replace(/^\s+|\s+$/g, '');
  			valorCampo = valorCampo.trim();
  			var values = {
  				form_accion: 'checkField',
  				table: table,
  				column: column,
  				valorCampo: valorCampo
  			}

  			fetch('./ajax/ajax_validateField.php', {
  					method: 'POST',
  					body: JSON.stringify({
  						...values
  					}),
  					headers: {
  						'Content-Type': 'application/json'
  					}
  				}).then(response => response.json())
  				.then(data => {
  					if (data.result == 'Ko') {
  						ShowToast('Error', errorMessage, 'danger');
  						$('#' + IdInput).addClass('is-invalid');
  						$('#' + IdInput).focus();
  						resolve(true);
  					} else {
  						$('#' + IdInput).removeClass('is-invalid');
  						resolve(false);
  					}
  				}).catch(error => {
  					ShowToast('Error', 'Ha habido un error en el sistema.', 'danger');
  					reject(error);
  				});
  		});
  	}

  	function SB_ValidateForm(formId, camposPersonalizados = []) {

  		/*** 
  		 * 1. Validar campos obligatorios
  		 * 2. Validar campos personalizados
  		 * Campos persoalizados: Array de objetos con los siguientes campos:
  		 * - id: Id del campo
  		 * - type: type del elemento (text, email, number, tel, etc..)
  		 * - regex: Expresión regular para validar el campo
  		 * - message: Mensaje de error
  		 */
  		/**
  		 * --- Si se desea no validar algun campo por tener una validación personalizada, se puede añadir el atributo "novalidate" al input.
  		 */
  		let formValid = true;
  		var form = document.getElementById(formId);
  		var fields = form.elements;
  		for (var i = 0; i < fields.length; i++) {

  			if (fields[i].type == "text" || fields[i].type == "email" || fields[i].type == "number" || fields[i].type == "tel" || fields[i].type == "password" || fields[i].type == "textarea" || fields[i].type == "file" || fields[i].type == "date" || fields[i].type == "time" || fields[i].type == "datetime-local" || fields[i].type == "url" || fields[i].type == "color" || fields[i].type == "search" || fields[i].type == "tel") {

  				if (fields[i].hasAttribute("novalidate")) {
  					continue;
  				}

  				if ((!fields[i].value) || fields[i].value.trim().length == 0) {
  					ShowToast('Error', "Todos los campos son obligatorios y no pueden estar en blanco.");
  					fields[i].classList.add("is-invalid");
  					fields[i].focus();
  					formValid = false;
  					return;
  				} else {
  					fields[i].classList.remove("is-invalid");
  				}

  			}

  			if (fields[i].type == "email") {
  				if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(fields[i].value)) {
  					ShowToast('Error', "Debe introducir un correo electrónico válido.");
  					fields[i].classList.add("is-invalid");
  					fields[i].focus();
  					formValid = false;
  					return;
  				} else {
  					fields[i].classList.remove("is-invalid");
  				}
  			}

  			if (fields[i].type == "number") {
  				if (!/^\d+$/.test(fields[i].value)) {
  					ShowToast('Error', "Debe introducir un número válido.");
  					fields[i].classList.add("is-invalid");
  					fields[i].focus();
  					formValid = false;
  					return;
  				} else {
  					fields[i].classList.remove("is-invalid");
  				}
  			}

  			if (fields[i].type == "date") {
  				if (!/^\d{4}-\d{2}-\d{2}$/.test(fields[i].value)) {

  					ShowToast('Error', "Debe introducir una fecha válida.");
  					fields[i].classList.add("is-invalid");
  					fields[i].focus();
  					formValid = false;
  					return;
  				} else {
  					fields[i].classList.remove("is-invalid");
  				}
  			}

  			if (fields[i].type == "datetime-local") {
  				if (!/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/.test(fields[i].value)) {

  					ShowToast('Error', "Debe introducir una fecha válida.");
  					fields[i].classList.add("is-invalid");
  					fields[i].focus();
  					formValid = false;
  					return;
  				} else {
  					fields[i].classList.remove("is-invalid");
  				}
  			}
  		}

  		if (camposPersonalizados.length > 0) {
  			camposPersonalizados.forEach(campo => {

  				var element = document.getElementById(campo.id);

  				if (!element.hasAttribute("novalidate")) {
  					if (!element.value || element.value.trim().length == 0) {
  						ShowToast('Error', "Todos los campos son obligatorios y no pueden estar en blanco.");
  						element.classList.add("is-invalid");
  						element.focus();
  						formValid = false;
  						return;
  					} else {
  						if (campo.regex != "") {
  							var regex = new RegExp(campo.regex);
  							if (!regex.test(element.value)) {
  								ShowToast('Error', campo.message);
  								element.classList.add("is-invalid");
  								element.focus();
  								formValid = false;
  								return;
  							} else {
  								element.classList.remove("is-invalid");
  							}
  						}
  					}
  				}
  			});
  		}

  		//Quitamos la clase is-invalid de todos los campos que lo tengan  si el form está validado
  		if (formValid) {
  			fields.forEach(field => {
  				field.classList.remove("is-invalid");
  			});
  			if (camposPersonalizados.length > 0) {
  				camposPersonalizados.forEach(campo => {
  					var element = document.getElementById(campo.id);
  					element.classList.remove("is-invalid");
  				});
  			}
  		}
  		return formValid;
  	}

  	// - Obtener los campos de un formulario para enviar vía AJAX
  	function SB_GetValues(form = "", navsArray = [], subsArray = []) {
  		// Array de valores que se van a enviar por AJAX
  		var values = {};

  		// Obtener todos los valores del form
  		if (form != "") {
  			var values = {};
  			$('#' + form + ' :input').each(function() {
  				if (this.name != "") {
  					if (this.type == "checkbox") {
  						values[this.name] = $(this).is(':checked') + 0;
  					} else if (this.type == "radio") {
  						values[this.name] = $('input[name=' + this.name + ']:checked').val();
  					} else
  						values[this.name] = $(this).val();
  				}
  			});
  		}

  		// Obtener todos los valores de las navs
  		for (var i = 0; i < navsArray.length; i++) {
  			$('#' + navsArray[i]).find('input,select,textarea').each(function() {
  				if (this.type == "checkbox")
  					values[this.name] = $(this).is(':checked') + 0;
  				else if (this.type == "radio") {
  					values[this.name] = $('input[name=' + this.name + ']:checked').val();
  				} else
  					values[this.name] = $(this).val();
  			});
  		}

  		// Array de sub-valores que van a ampliar los valores
  		var sub_values;
  		// Por cada sub-division
  		for (var i = 0; i < subsArray.length; i++) {
  			var nombreElemento = subsArray[i].substring(subsArray[i].lastIndexOf('_') + 1);

  			sub_values = [];
  			values["subItem_" + nombreElemento] = [];
  			// Por cada fila
  			$('#' + subsArray[i]).find('.item').each(function(indexRow) {
  				sub_values[indexRow] = {};
  				// Por cada dato de la fila
  				$(this).find('input,select,textarea').each(function(indexElem) {
  					if (typeof($(this).attr('name')) != "undefined") {
  						if (this.type == "checkbox")
  							sub_values[indexRow][$(this).attr('name')] = $(this).is(':checked') + 0;
  						else
  							sub_values[indexRow][$(this).attr('name')] = $(this).val();
  					}
  				});
  			});
  			values["subItem_" + nombreElemento] = sub_values;
  		}
  		return values;
  	}

  	// - Establecer todos los campos de un formulario
  	function SB_SetValues(in_newEdit = "", in_id = "", in_nombre = "", in_arrayDatos = {}, in_subDivisiones = []) {
  		$('#edit_titulo').html(in_nombre);
  		$('#' + in_id + '_' + in_newEdit).val(in_arrayDatos[in_id]);

  		// Establecer los campos estaticos
  		$.each(in_arrayDatos, function(key, value) {
  			if ($('#' + in_newEdit + '_' + key).is(':checkbox'))
  				$('#' + in_newEdit + '_' + key).attr('checked', value == 1).trigger("change");
  			else if ($('#edit_' + key).hasClass('datepicker')) {
  				if (value != null) {
  					var d = value.split("-");
  					d[1] = d[1] - 1;

  					$('#' + in_newEdit + '_' + key).pickadate().pickadate('picker').set('select', d).trigger("change");
  				}
  			} else if ($('#edit_' + key).hasClass('chips')) {
  				$('#edit_' + key).find('.close').click();

  				for (const [key, valueFor] of Object.entries(value)) {
  					var e = jQuery.Event("keydown");
  					e.which = 13;
  					for (var i = 0; i < valueFor.length; i++) {
  						$('#edit_' + tipo + "_" + key + " input").val(valueFor[i]["tag"]);
  						$('#edit_' + tipo + "_" + key + " input").trigger(e);

  					}
  				}
  			} else
  				$('#' + in_newEdit + '_' + key).val(value).trigger("change");
  		});
  	}

  	// - Obtener datos vía AJAX
  	function SB_GetAJAX(in_url, in_elem, in_IdElem, callbackOk, callbackKo) {
  		$.ajax({
  			url: in_url,
  			data: {
  				"Elem": in_elem,
  				"IdElem": in_IdElem
  			},
  			cache: false,
  			type: "POST",
  			success: function(response) {
  				callbackOk(JSON.parse(response));
  			},
  			error: function(response) {
  				console.log(response);
  				callbackKo(response);
  			}
  		});
  	}

  	// - Enviar datos vía AJAX
  	function SB_SendAJAX(in_url, values = [], callbackOk = function() {}, callbackKo = function() {}) {
  		$.ajax({
  			url: in_url,
  			data: {
  				"values": values
  			},
  			cache: false,
  			type: "POST",
  			success: function(response) {
  				if (DEBUG_JS) console.log(response);
  				var res = JSON.parse(response);

  				if (typeof(res['error']) != "undefined") {
  					if (res['error'] == "Error de sesión") {
  						ShowToast('Error', res['error']);
  						setTimeout(function() {
  							window.location.href = "login.php";
  						}, 500);
  					} else {
  						ShowToast('Error', res['error']);
  						callbackKo(res);
  					}
  				} else {
  					if (!(typeof(values['notInclude_hideToast']) != 'undefined' && values['notInclude_hideToast'] == true))
  						ShowToast('Ok', "Acción realizada correctamente.", 'success');

  					if (typeof(values['notInclude_goToAfter']) != 'undefined')
  						setTimeout(function() {
  							window.location.href = values['notInclude_goToAfter'];
  						}, 1000);

  					callbackOk(res);
  				}
  			},
  			error: function(xhr) {
  				ShowToast('Error', "Ha habido un error. Inténtelo de nuevo más tarde.");
  				console.log(xhr);
  			}
  		});
  	}
  	// - Tratamiento de Fechas formato mysql (yyyy-mm-dd) -> dd-mm-yyyy
  	function SB_FormatDate(date) {
  		if (date == '0000-00-00' || date == '1970-01-01' || date == null)
  			return 'N/D';

  		var d = new Date(date),
  			month = '' + (d.getMonth() + 1),
  			day = '' + d.getDate(),
  			year = d.getFullYear();

  		if (month.length < 2)
  			month = '0' + month;
  		if (day.length < 2)
  			day = '0' + day;
  		return [year, month, day].join('-');
  	}

  	// - Toast
  	function ShowToast(title, content, toastColor = 'primary') {
  		const toast = document.createElement('div');
  		toast.innerHTML = '                                 	        \
	  	<div class="toast-header bg-' + toastColor + ' text-light"> \
	  		<strong class="me-auto">' + title + '</strong>          \
	  		<small></small>                                         \
	  		<button                                                 \
	  		type="button"                                           \
	  		class="btn-close"                                       \
	  		data-mdb-dismiss="toast"                                \
	  		aria-label="Close"                                      \
	  		></button>                                              \
	  	</div>                                                      \
	  	<div class="toast-body">' + content + '</div>';

  		toast.classList.add('toast', 'fade');

  		document.body.appendChild(toast);

  		const toastInstance = new mdb.Toast(toast, {
  			stacking: true,
  			hidden: true,
  			width: '450px',
  			position: 'top-right',
  			autohide: true,
  			delay: 3000,
  		});
  		toastInstance.show();
  	}

  </script>