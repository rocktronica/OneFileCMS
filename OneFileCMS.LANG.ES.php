<?php
// OneFileCMS Language Settings v3.3.07

$_['LANGUAGE'] = 'Espanõla';

//
//
// If no translation or value is desired for a particular setting, do not delete
// the actual setting variable, just set it to an empty string.
// For example:  $_['some_unused_setting'] = '';
//
// Remember to slash-escape any single quotes that may be within a value:  \'
// The back-slash itself, if to be part of the text to display, may or may not 
// also need to be escaped:  \\


// In some instances, some langauges may use significantly longer words or phrases than others.
// So, a smaller font or less spacing may be desirable in those places to preserve page layout.
//
$_['front_links_font_size'] =  '1em'; //Buttons on Index page.
$_['front_links_margin_R']  = '.5em';
$_['button_font_size']      = '.9em'; //Buttons on Edit page.
$_['button_margin_L']       = '.4em';
$_['button_padding']        = '4px 5px';
$_['image_info_font_size']  = '.95em';//show_img_msg_01  &  _02 
$_['image_info_pos']        = ''; //If 1 or true, moves the info down a line for more space.


$_['Upload_File'] = 'Subir Archivo';
$_['New_File']    = 'Archivo Nuevo';
$_['Ren_Move']    = 'Renombrar/Mover';
$_['Ren_Moved']   = 'Renombrado/Movido';
$_['New_Folder']  = 'Carpeta Nueva';
$_['Ren_Folder']  = 'Renombrar/Mover Carpeta';
$_['Del_Folder']  = 'Borrar Carpeta';

$_['Admin']  = 'Administrador';
$_['Enter']  = 'Entrar';
$_['Edit']   = 'Editar';
$_['Close']  = 'Cerrar';
$_['Cancel'] = 'Cancelar';
$_['Upload'] = 'Subir';
$_['Create'] = 'Crear';
$_['Copy']   = 'Copiar';
$_['Copied'] = 'Copiado';
$_['Rename'] = 'Renombrar';
$_['Delete'] = 'Eliminar';
$_['DELETE'] = 'ELIMINAR';
$_['File']   = 'Archivo';
$_['Folder'] = 'Carpeta';

$_['Log_In']  = 'Iniciar Sesión';
$_['Log_Out'] = 'Cerrar Sesión';

$_['Hash']    = 'Cadena';
$_['pass_to_hash']  = 'Contraseña para calcular el hash:';
$_['Generate_Hash'] = 'Generar Cadena';

$_['save_1']      = 'Guardar';
$_['save_2']      = '¡GUARDAR CAMBIOS!';
$_['reset']       = 'Reiniciar - perder los cambios';
$_['Wide_View']   = 'Vista Ampliada';
$_['Normal_View'] = 'Vista Normal';

$_['on_']      = 'activado';

$_['verify_msg_01'] = 'Sesión expirada.';
$_['verify_msg_02'] = 'POST INVÁLIDO';

$_['get_get_msg_01'] = 'El archivo no existe:';

$_['check_path_msg_01'] = 'El directorio no existe: ';

$_['ord_msg_01'] = 'Un archivo con ese mismo nombre ya existe en el directorio asignado.';
$_['ord_msg_02'] = 'Guardando como';

$_['show_img_msg_01'] = 'Imagen mostrada a ~';
$_['show_img_msg_02'] = '% del tamaño (W x H =';

$_['hash_h2']     = 'Generar una Cadena de Contraseña';
$_['hash_txt_01'] = 'Existen dos formas de cambiar tu contraseña:';
$_['hash_txt_02'] = '1) Cambiando la variable $PASSWORD y asignando $USE_HASH = 0 (cero).';
$_['hash_txt_03'] = '2) O, usando $HASHWORD para almacenar tu contraseña, y luego asignar $USE_HASH = 1.';
$_['hash_txt_04'] = 'Tenga en cuenta que, debido a una serie de consideraciones muy variadas, esto es en gran parte un ejercicio académico. Es decir, tomar la idea de que esta es una gran mejora a la seguridad con un granito de sal de criptografía. Sin embargo, sí elimina el almacenamiento de la contraseña en texto plano, lo cual es algo bueno.';
$_['hash_txt_05'] = 'Igualmente, para usar la opción de contraseña $HASHWORD:';
$_['hash_txt_06'] = 'Ingresá la contraseña que quieras en la caja de texto siguiente y presioná enter.';
$_['hash_txt_07'] = 'La cadena se mostrará en un mensaje amarillo.';
$_['hash_txt_08'] = 'Copiá y pegá esa cadena a la variable $HASHWORD en la sección de configuración.';
$_['hash_txt_09'] = 'Asegurate de copiar TODO y SÓLO la cadena (sin dejar espacios en blanco o demás).';
$_['hash_txt_10'] = 'Haciendo doble click debería seleccionarlo...';
$_['hash_txt_11'] = 'Asegurate de que $USE_HASH sea 1 (o true).';
$_['hash_txt_12'] = 'Cuando estés listo, deslogueate y volvé a loguearte.';
$_['hash_txt_13'] = 'Podés usar OneFileCMS para editarlo. Sin embargo, asegurate de hacer un backup...';
$_['hash_txt_14'] = 'Para otro tip de seguridad, cambiá la llave de seguridad y/o el método usado por OneFileCMS para almacenar la clave (y mantenelo en secreto, obviamente).  Acordate, cada granito ayuda...';

$_['hash_msg_01'] = 'Contraseña: ';
$_['hash_msg_02'] = 'Cadena    : ';

$_['login_h2']     = 'Iniciar sesión';
$_['login_txt_01'] = 'Usuario:';
$_['login_txt_02'] = 'Contraseña:';

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
$_['edit_note_04']  = 'Chrome puede deshabilitar algunos textos si contienen javascript dentro en ciertos contextos.  Esto puede provocar problemas con el editor de OneFileCMS. Sin embargo, estos archivos pueden ser editados y guardados con OneFileCMS.  La función primaria que es perdida es el cambio de los colores del fondo (rojo/verde) indicando cuando o no el archivo tiene cambios no guardados.  El error se notificará después de la primera vez que se guarde ese archivo.';

$_['edit_h2_1']   = 'Viendo:';
$_['edit_h2_2']   = 'Editando:';
$_['edit_txt_01'] = 'No texto o tipo de archivo desconocido. Edición deshabilitada.';
$_['edit_txt_02'] = 'El archivo posiblemente contiene un caracter desconocido. Edición deshabilitada.';
$_['edit_txt_03'] = 'htmlspecialchars() devolvió una cadena vacía de lo que debería ser un archivo válido.';
$_['edit_txt_04'] = 'Este comportamiento puede ser inconsistente de versión a versión de PHP.';

$_['too_large_to_edit_01a'] = 'Edición deshabilita. Tamaño >';
$_['too_large_to_edit_01b'] = 'bytes.';
$_['too_large_to_edit_02'] = 'Algunos navegadores (por ej.: IE) se vuelven inestables cuando se edita un texto largo dentro de un <textarea>.';
$_['too_large_to_edit_03'] = 'Ajustá la variable $MAX_EDIT_SIZE en la sección de configuración de OneFileCMS como sea necesario.';
$_['too_large_to_edit_04'] = 'Una simple prueba puede dar con el resultado necesario.';

$_['too_large_to_view_01a'] = 'Vista deshabilitada. Tamaño >';
$_['too_large_to_view_01b'] = 'bytes.';
$_['too_large_to_view_02'] = 'Clickeá en el botón de debajo para verlo como se ve normalmente en un navegador.';
$_['too_large_to_view_03'] = 'Ajustá $MAX_VIEW_SIZE en la sección de configuración de OneFileCMS como sea necesario.';
$_['too_large_to_view_04'] = '(El valor por defecto para $MAX_VIEW_SIZE es completamente arbitrario, y puede ser ajustado como sea necesario.)';

$_['meta_txt_01'] = 'Tamaño:';
$_['meta_txt_02'] = 'bytes.';
$_['meta_txt_03'] = 'Actualizado:';

$_['edit_msg_01'] = 'Archivo Guardado:';
$_['edit_msg_02'] = 'bytes escritos.';
$_['edit_msg_03'] = 'Ocurrió un error guardando el archivo.';

$_['upload_h2']     = 'Subir Archivo';
$_['upload_txt_01'] = 'por upload_max_filesize en php.ini.';
$_['upload_txt_02'] = 'por post_max_size en php.ini';
$_['upload_txt_03'] = 'Nota: El tamaño máximo de subida es de:';

$_['upload_err_01a'] = 'Error 1: Archivo muy largo.';
$_['upload_err_01b'] = '(Desde php.ini)';
$_['upload_err_02a'] = 'Error 2: Archivo muy largo.';
$_['upload_err_02b'] = '(Desde OneFileCMS)';
$_['upload_err_03']  = 'Error 3: El archivo se subió sólo parcialmente.';
$_['upload_err_04']  = 'Error 4: No se subió ningún archivo.';
$_['upload_err_05']  = 'Error 5:';
$_['upload_err_06']  = 'Error 6: Carpeta temporal no encontrada.';
$_['upload_err_07']  = 'Error 7: No se pudo guardar el archivo en el disco.';
$_['upload_err_08']  = 'Error 8: Una extensión de PHP detuvo la subida del archivo.';

$_['upload_msg_01'] = 'No se seleccionó ningún archivo para subirlo.';
$_['upload_msg_02'] = 'La carpeta de destino no existe: ';
$_['upload_msg_03'] = 'Subida cancelada.';
$_['upload_msg_04'] = 'Subiendo:';
$_['upload_msg_05'] = '¡Subida satisfactoria!';
$_['upload_msg_06'] = 'Subida fallida: ';

$_['new_file_h2']     = 'Archivo Nuevo';
$_['new_file_txt_01'] = 'Se creará un archivo nuevo en la carpeta actual.';
$_['new_file_txt_02'] = 'Algunos caracteres inválidos son: ';

$_['new_file_msg_01'] = 'Archivo nuevo no creado:';
$_['new_file_msg_02'] = 'El nombre contiene caracteres inválidos:';
$_['new_file_msg_03'] = 'Archivo nuevo no creado - no se especificó un nombre';
$_['new_file_msg_04'] = 'El archivo ya existe:';
$_['new_file_msg_05'] = 'Archivo creado:';
$_['new_file_msg_06'] = 'Error - archivo no creado:';

$_['CRM_txt_01']  = 'Para mover un archivo o carpeta, cambiá el camino/hacia/la/carpeta/o_archivo. La nueva localización debe existir.';
$_['CRM_txt_02']  = 'Nombre antiguo:';
$_['CRM_txt_03']  = 'Nuevo nombre:';

$_['CRM_msg_01'] = 'Error - la localización padre no existe:';
$_['CRM_msg_02'] = 'Error - el archivo inicial no existe:';
$_['CRM_msg_03'] = 'Error - el archivo de objetivo no existe:';
$_['CRM_msg_04'] = 'hacia';
$_['CRM_msg_05a'] = 'Error durante';
$_['CRM_msg_05b'] = 'desde arriba a lo siguiente:';

$_['delete_h2']     = 'Eliminar Archivo';
$_['delete_txt_01'] = '¿Estás seguro?';

$_['delete_msg_01'] = 'Archivo Eliminado:';
$_['delete_msg_02'] = 'Error eliminando';

$_['new_folder_h2']    = 'Nueva Carpeta';
$_['new_folder_txt_1'] = 'La carpeta se creará dentro de la carpeta actual.';
$_['new_folder_txt_2'] = 'Algunos caracteres inválidos son:';

$_['new_folder_msg_01'] = 'Carpeta nueva no creada:';
$_['new_folder_msg_02'] = 'El nombre contiene caracteres inválidos:';
$_['new_folder_msg_03'] = 'Carpeta nueva no creada - no se ha asignado un nombre.';
$_['new_folder_msg_04'] = 'La carpeta ya existe:';
$_['new_folder_msg_05'] = 'Carpeta creada:';
$_['new_folder_msg_06'] = 'Error - carpeta nueva no creada:';

$_['delete_folder_h2']     = 'Eliminar Carpeta';
$_['delete_folder_txt_01'] = '¿Estás seguro?';

$_['delete_folder_msg_01'] = 'Carpeta no vacía.   Las carpetas deben estar vacías antes de ser eliminadas.';
$_['delete_folder_msg_02'] = 'Carpeta eliminada:';
$_['delete_folder_msg_03'] = 'ocurrió un error eliminándola.';

$_['page_title_login']      = 'Iniciar Sesión';
$_['page_title_hash']       = 'Página de Cadena';
$_['page_title_edit']       = 'Editar/Ver Archivo';
$_['page_title_upload']     = 'Subir Archivo';
$_['page_title_new_file']   = 'Nuevo Archivo';
$_['page_title_copy']       = 'Copiar Archivo';
$_['page_title_ren']        = 'Renombrar Archivo';
$_['page_title_del']        = 'Eliminar Archivo';
$_['page_title_folder_new'] = 'Nueva Carpeta';
$_['page_title_folder_ren'] = 'Renombrar/Mover Carpeta';
$_['page_title_folder_del'] = 'Eliminar Carpeta';

$_['session_warning'] = 'Advertencia: ¡La sesión terminará pronto!';
$_['session_expired'] = 'SESIÓN TERMINADA';
$_['unload_unsaved']  = '                 ¡Los cambios no guardados se perderán!';
$_['confirm_reset']   = '¿Reiniciar el archivo y descartar cambios no guardados?';

$_['OFCMS_requires']  = 'OneFileCMS necesita PHP';

$_['logout_msg']       = 'Has cerrado la sesión satisfactoriamente.';
$_['folder_del_msg']   = 'Carpeta no vacía.   Las carpetas debe estar vacías antes de poder eliminarse.';
$_['upload_error_01a'] = 'Eror de subida.  Total de datos POST (mayormente el peso del archivo) excedido post_max_size =';
$_['upload_error_01b'] = '(desde php.ini)';
$_['edit_caution_01']  = 'PRECAUCIÓN';
$_['edit_caution_02']  = 'Estás editando la copia activa de OneFileCMS - ¡HACÉ UNA COPIA DE SEGURIDAD Y TENÉ CUIDADO!';

$_['time_out_txt'] = 'Tiempo de Espera de Sesión Agotado:';
