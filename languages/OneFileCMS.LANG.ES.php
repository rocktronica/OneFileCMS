<?php
// OneFileCMS Language Settings v3.5.21

$_['LANGUAGE'] = 'Espanõla';
$_['LANG'] = 'ES';

// If no translation or value is desired for a particular setting, do not delete
// the actual setting variable, just set it to an empty string.
// For example:  $_['some_unused_setting'] = '';
//
// Remember to slash-escape any single quotes that may be within the text:  \'
// The back-slash itself may or may not also need to be escaped:  \\
//
// If present as a trailing comment, "## NT ##" means 'Needs Translation'.
//
// These first few settings control a few font and layout settings.
// In some instances, some langauges may use significantly longer words or phrases than others.
// So, a smaller font or less spacing may be desirable in those places to preserve page layout.
$_['front_links_font_size']  = '1.0em';   //Buttons on Index page.
$_['front_links_margin_L']   = '0.5em';
$_['MCD_margin_R']           = '1.0em';   //[Move] [Copy] [Delete] buttons
$_['button_font_size']       = '0.9em';   //Buttons on Edit page.
$_['button_margin_L']        = '0.7em';
$_['button_padding']         = '4px 4px'; //T R B L  ,or,   V H   if only two values.
$_['image_info_font_size']   = '.95em';   //show_img_msg_01  &  _02
$_['image_info_pos']         = ' ';       //If 1 or true, moves the info down a line for more space.
$_['select_all_label_size']  = '.84em';   //Font size of $_['Select_All']
$_['select_all_label_width'] = '110px';   //Width of space for $_['Select_All']

$_['HTML']    = 'HTML';
$_['WYSIWYG'] = 'WYSIWYG'; //## NT ##

$_['Admin']    = 'Administrador';
$_['bytes']    = 'bytes';   //## NT ##
$_['Cancel']   = 'Cancelar';
$_['cancelled'] = 'cancelado';
$_['Close']    = 'Cerrar';
$_['Copy']     = 'Copiar';
$_['Copied']   = 'Copiado';
$_['Create']   = 'Crear';
$_['Date']     = 'Fecha';
$_['Delete']   = 'Eliminar';
$_['DELETE']   = 'ELIMINAR';
$_['Deleted']  = 'Eliminado';
$_['Edit']     = 'Editar';
$_['Enter']    = 'Entrar';
$_['Error']    = 'Error';   //## NT ##
$_['errors']   = 'errores';
$_['ext']      = 'ext';
$_['File']     = 'Archivo';
$_['files']    = 'archivos';
$_['Folder']   = 'Carpeta';
$_['folders']  = 'carpetas';
$_['From']     = 'de';
$_['Hash']     = 'Cadena';
$_['Move']     = 'Mover';
$_['Moved']    = 'Movido';
$_['Name']     = 'Nombre ';
$_['on']       = 'activado';
$_['off']      = 'apagar';
$_['Password'] = 'contraseña';
$_['Rename']   = 'Renombrar';
$_['reset']    = 'Reiniciar';
$_['save_1']   = 'Guardar';
$_['save_2']   = '¡GUARDAR CAMBIOS';
$_['Size']     = 'Tamaño';
$_['Source']   = 'Source';  //## NT ##
$_['successful'] = 'satisfactoriamente';
$_['To']       = 'Hacia';
$_['Upload']   = 'Subir';
$_['Username'] = 'Usuario';
$_['View']     = 'Ver';

$_['Working']         = 'Working - please wait...'; //## NT ##
$_['Log_In']          = 'Iniciar Sesión';
$_['Log_Out']         = 'Cerrar Sesión';
$_['Admin_Options']   = 'Opciones de Administración';
$_['Are_you_sure']    = '¿Estás seguro?';
$_['View_Raw']        = 'View Raw'; //## NT ##
$_['Open_View']       = 'Abrir/Ver en una ventana del navegador';
$_['Edit_View']       = 'Editar / Ver Archivo';
$_['Wide_View']       = 'Vista Ampliada';
$_['Normal_View']     = 'Vista Normal';
$_['Word_Wrap']       = 'Word Wrap'; //## NT ##
$_['Line_Wrap']       = 'Line Wrap'; //## NT ##
$_['Upload_File']     = 'Subir Archivo';
$_['New_File']        = 'Archivo Nuevo';
$_['Ren_Move']        = 'Renombrar / Mover';
$_['Ren_Moved']       = 'Renombrado / Movido';
$_['folders_first']   = 'folders first'; //## NT ##
$_['folders_first_info'] = 'Sort folders first, but don\'t change primary sort.'; //## NT ##
$_['New_Folder']      = 'Carpeta Nueva';
$_['Ren_Folder']      = 'Renombrar / Mover Carpeta';
$_['Submit']          = 'Cargar';
$_['Move_Files']      = 'Mover archivo(s)';
$_['Copy_Files']      = 'Copiar archivo(s)';
$_['Del_Files']       = 'Eliminar Archivo(s)';
$_['Selected_Files']  = 'Seleccionar Archivos';
$_['Select_All']      = 'Seleccionar Todos';
$_['Clear_All']       = 'Limpiar Todos';
$_['New_Location']    = 'Nueva Posición';
$_['No_files']        = 'No se seleccionó ningún archivo.';
$_['Not_found']       = 'No encontrado';
$_['Invalid_path']    = 'Invalid path'; //## NT ##

$_['verify_msg_01']     = 'Sesión expirada.';
$_['verify_msg_02']     = 'POST INVÁLIDO';
$_['get_get_msg_01']    = 'El archivo no existe:';
$_['get_get_msg_02']    = 'Página requerida inválida:';
$_['check_path_msg_02'] = '"." o ".." como segmentos no son permitidos.';
$_['check_path_msg_03'] = 'La dirección o el archivo contienen caracteres inválidos:';
$_['ord_msg_01']        = 'Un archivo con ese mismo nombre ya existe en el directorio asignado.';
$_['ord_msg_02']        = 'Guardando como';
$_['rCopy_msg_01']      = 'Una carpeta no se puede copiar en uno de sus propios sub-carpetas.';
$_['show_img_msg_01']   = 'Imagen mostrada a ~';
$_['show_img_msg_02']   = '% del tamaño (Ancho x Alto =';

$_['hash_txt_01']   = 'Las cadenas generadas por esta página pueden ser usadas para cambiar de forma manual la variable $HASHWORD en OneFileCMS, o en un archivo de configuración externo. De cualquier forma, ¡asegúrese de recordar la contraseña que usó para generar el hash (cadena)!';
$_['hash_txt_06']   = 'Ingresá la contraseña que quieras en la caja de texto siguiente y presioná enter.';
$_['hash_txt_07']   = 'La cadena se mostrará en un mensaje amarillo.';
$_['hash_txt_08']   = 'Copiá y pegue esa cadena a la variable $HASHWORD en la sección de configuración.';
$_['hash_txt_09']   = 'Asegurate de copiar TODO y SÓLO la cadena (sin dejar espacios en blanco o demás).';
$_['hash_txt_10']   = 'Haciendo doble click debería seleccionarlo...';
$_['hash_txt_12']   = 'Cuando estés listo, deslogueate y volvé a loguearte.';
$_['pass_to_hash']  = 'Contraseña del Hash:';
$_['Generate_Hash'] = 'Generar Hash';

$_['login_txt_01']  = 'Usuario:';
$_['login_txt_02']  = 'Contraseña:';
$_['login_msg_01a'] = 'Hubo ';
$_['login_msg_01b'] = 'intentos fallidos.';
$_['login_msg_02a'] = 'Por favor espere ';
$_['login_msg_02b'] = 'segundos para volver a intentar.';
$_['login_msg_03']  = 'INTENTO DE INICIO INVÁLIDO NÚMERO #';

$_['edit_note_00']  = 'NOTAS:';
$_['edit_note_01a'] = 'Recuérdalo- tu';
$_['edit_note_01b'] = 'es';
$_['edit_note_02']  = 'Entonces guardá antes que se acabe el tiempo, ¡o vas a perer los cambios!';
$_['edit_note_03']  = 'Con algunos navegadores, como Chrome, si clickeás el botón del navegador [Volver] y después [Continuar], puede que el estado del archivo no sea exacto. Para corregirlo, clickeá en el botón [Recargar].';

$_['edit_h2_1']   = 'Viendo:';
$_['edit_h2_2']   = 'Editando:';
$_['edit_txt_00'] = 'Edit disabled.'; //## NT ##
$_['edit_txt_01'] = 'No texto o tipo de archivo desconocido. Edición deshabilitada.';
$_['edit_txt_02'] = 'El archivo posiblemente contiene un caracter desconocido. Edición deshabilitada.';
$_['edit_txt_03'] = 'htmlspecialchars() devolvió una cadena vacía de lo que debería ser un archivo válido.';
$_['edit_txt_04'] = 'Este comportamiento puede ser inconsistente de versión a versión de PHP.';

$_['too_large_to_edit_01'] = 'Edición deshabilita. Tamaño >';
$_['too_large_to_edit_02'] = 'Algunos navegadores (por ej.: IE) se vuelven inestables cuando se edita un texto largo dentro de un <textarea>.';
$_['too_large_to_edit_03'] = 'Ajustá la variable $MAX_EDIT_SIZE en la sección de configuración de OneFileCMS como sea necesario.';
$_['too_large_to_edit_04'] = 'Una simple prueba puede dar con el resultado necesario.';
$_['too_large_to_view_01'] = 'Vista deshabilitada. Tamaño >';
$_['too_large_to_view_02'] = 'Clickeá en el botón de debajo para verlo como se ve normalmente en un navegador.';
$_['too_large_to_view_03'] = 'Ajustá $MAX_VIEW_SIZE en la sección de configuración de OneFileCMS como sea necesario.';
$_['too_large_to_view_04'] = '(El valor por defecto para $MAX_VIEW_SIZE es completamente arbitrario, y puede ser ajustado como sea necesario.)';

$_['meta_txt_01'] = 'Tamaño:';
$_['meta_txt_03'] = 'Actualizado:';

$_['edit_msg_01'] = 'Archivo Guardado:';
$_['edit_msg_02'] = 'bytes escritos.';
$_['edit_msg_03'] = 'Ocurrió un error guardando el archivo.';

$_['upload_txt_03'] = 'Nota: El tamaño máximo de subida es de:';
$_['upload_txt_01'] = '(php.ini: upload_max_filesize)'; //## NT ##
$_['upload_txt_04'] = 'Tamaño total de la subida:';
$_['upload_txt_02'] = '(php.ini: post_max_size)'; //## NT ##
$_['upload_txt_05'] = 'Para los archivos subidos que ya existen: ';
$_['upload_txt_06'] = 'Renombrar (hacia filename.ext.001 etc...)';
$_['upload_txt_07'] = 'Sobreescribir';

$_['upload_err_01'] = 'Error 1: Archivo demasiado pesado. Desde php.ini:';
$_['upload_err_02'] = 'Error 2: Archivo muy grande. (MAX_FILE_SIZE HTML form element)';
$_['upload_err_03'] = 'Error 3: El archivo se subió sólo parcialmente.';
$_['upload_err_04'] = 'Error 4: No se subió ningún archivo.';
$_['upload_err_05'] = 'Error 5: ';
$_['upload_err_06'] = 'Error 6: Carpeta temporal no encontrada.';
$_['upload_err_07'] = 'Error 7: No se pudo guardar el archivo en el disco.';
$_['upload_err_08'] = 'Error 8: Una extensión de PHP detuvo la subida del archivo.';
$_['upload_error_01a'] = 'Eror de subida.  Total de datos POST (mayormente el peso del archivo) excedido post_max_size =';
$_['upload_error_01b'] = '(desde php.ini)';

$_['upload_msg_02'] = 'La carpeta de destino no existe: ';
$_['upload_msg_03'] = 'Subida cancelada.';
$_['upload_msg_04'] = 'Subiendo:';
$_['upload_msg_05'] = '¡Subida satisfactoria!';
$_['upload_msg_06'] = 'Subida fallida: ';
$_['upload_msg_07'] = 'Un archivo existente se sobrescribe.';

$_['new_file_txt_01'] = 'Se creará un archivo nuevo en la carpeta actual.';
$_['new_file_txt_02'] = 'Algunos caracteres inválidos son: ';
$_['new_file_msg_01'] = 'Archivo nuevo no creado:';
$_['new_file_msg_02'] = 'El nombre contiene caracteres inválidos:';
$_['new_file_msg_04'] = 'El archivo ya existe:';
$_['new_file_msg_05'] = 'Archivo creado:';
$_['new_file_msg_07'] = 'Carpeta creado:';

$_['CRM_txt_02'] = 'La nueva localización debe existir.';
$_['CRM_txt_04'] = 'Nuevo Nombre';
$_['CRM_msg_01'] = 'Error - la localización padre no existe:';
$_['CRM_msg_02'] = 'Error - el archivo inicial no existe:';
$_['CRM_msg_03'] = 'Error - el archivo de objetivo no existe:';
$_['CRM_msg_05'] = 'Error en';

$_['delete_msg_03']   = 'Error eliminando';
$_['session_warning'] = 'Advertencia: ¡La sesión terminará pronto!';
$_['session_expired'] = 'SESIÓN TERMINADA';
$_['unload_unsaved']  = '                 ¡Los cambios no guardados se perderán!';
$_['confirm_reset']   = '¿Reiniciar el archivo y descartar cambios no guardados?';
$_['OFCMS_requires']  = 'OneFileCMS necesita PHP';
$_['logout_msg']      = 'Has cerrado la sesión satisfactoriamente.';
$_['edit_caution_01'] = 'PRECAUCIÓN';
$_['edit_caution_02'] = 'Estás editando la copia activa de OneFileCMS - ¡HACÉ UNA COPIA DE SEGURIDAD Y TENÉ CUIDADO!';
$_['time_out_txt']    = 'Tiempo de Espera de Sesión Agotado:';

$_['error_reporting_01'] = 'Display errors is'; //## NT ##
$_['error_reporting_02'] = 'Log errors is'; //## NT ##
$_['error_reporting_03'] = 'Error reporting is set to'; //## NT ##
$_['error_reporting_04'] = 'Showing error types'; //## NT ##
$_['error_reporting_05'] = 'Unexpected early output'; //## NT ##
$_['error_reporting_06'] = '(nothing, not even white-space, should have been output yet)'; //## NT ##

$_['admin_txt_00'] = 'Backup Antiguo Encontrado.';
$_['admin_txt_01'] = 'Este archivo fue creado en caso de error en caso de cambio fallido de usuario y contraseña. Por ello, puede contener información vieja y debería ser eliminado si no es necesario. De cualquier forma, se sobreescribirá automáticamente en el siguiente cambio de contraseña o usuario.';
$_['admin_txt_02'] = 'Información General';
$_['admin_txt_14'] = 'Para otro tip de seguridad, cambiá la llave de seguridad y/o el método usado por OneFileCMS para almacenar la clave (y mantenelo en secreto, obviamente).  Acordate, cada granito ayuda...';
$_['admin_txt_16'] = 'Podés usar OneFileCMS para editarlo. Sin embargo, asegurate de hacer un backup...';

$_['pw_current'] = 'Contraseña actual';
$_['pw_change']  = 'Cambiar Contraseña';
$_['pw_new']     = 'Nueva contraseña';
$_['pw_confirm'] = 'Confirmar Contraseña Nueva';

$_['un_change']  = 'Cambiar Nombre de Usuario';
$_['un_new']     = 'Nuevo Usuario';
$_['un_confirm'] = 'Confirmar Nuevo Nombre de Usuario';

$_['pw_txt_02'] = 'Reglas de Usuario / Contraseña:';
$_['pw_txt_04'] = '¡Se hace diferencia entre mayúsculas y minúsculas!  "A" =/= "a"';
$_['pw_txt_06'] = 'deben tener al menos un caracter.';
$_['pw_txt_08'] = 'Deben tener espacios en el medio. Por ejemplo: "¡Esta es una contraseña o usuario!"';
$_['pw_txt_10'] = 'Los espacios al inicio o al final serán eliminados.';
$_['pw_txt_12'] = 'Para guardar el cambio, sólo un archivo es actualizado: la copia activa de OneFileCMS, o, si fue especificado, un archivo de configuración externa.';
$_['pw_txt_14'] = 'Si se ingresa la contraseña actual de forma incorrecta, serás deslogueado y tendrás que volver a loguearte.';

$_['change_pw_01'] = '¡Contraseña Cambiada!';
$_['change_pw_02'] = 'Contraseña NO cambiada.';
$_['change_pw_03'] = 'Contraseña anterior inválida. Logueate e intenta de nuevo.';
$_['change_pw_04'] = 'La contraseña y su confirmación no coinciden.';
$_['change_pw_05'] = 'Actualizando';
$_['change_pw_06'] = 'archivo de configuración externa';
$_['change_pw_07'] = 'All fields are required.'; //## NT ##

$_['change_un_01'] = '¡Nombre de Usuario Actualizado!';
$_['change_un_02'] = 'Nombre de Usuario NO Actualizado.';

$_['update_failed'] = 'Actualización fallida. No se pudo guardar el archivo.';

$_['mcd_msg_01'] = 'archivos movidos satisfactoriamente.';
$_['mcd_msg_02'] = 'archivos copiados satisfactoriamente.';
$_['mcd_msg_03'] = 'archivos eliminados satisfactoriamente.';

