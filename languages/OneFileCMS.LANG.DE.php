<?php
// OneFileCMS Language Settings v3.6.09

$_['LANGUAGE'] = 'Deutsch';
$_['LANG'] = 'DE';

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
$_['front_links_font_size']  = '0.9em';   //Buttons on Index page.
$_['front_links_margin_L']   = '0.3em';
$_['MCD_margin_R']           = '1.0em';   //[Move] [Copy] [Delete] buttons
$_['button_font_size']       = '0.8em';   //Buttons on Edit page.
$_['button_margin_L']        = '0.7em';
$_['button_padding']         = '4px 4px'; //T R B L  ,or,   V H   if only two values.
$_['image_info_font_size']   = '.95em';   //show_img_msg_01  &  _02
$_['image_info_pos']         = '1';       //If 1 or true, moves the info down a line for more space.
$_['select_all_label_size']  = '.84em';   //Font size of $_['Select_All']
$_['select_all_label_width'] = '76px';    //Width of space for $_['Select_All']

$_['HTML']    = 'HTML';
$_['WYSIWYG'] = 'WYSIWYG'; //## NT ##

$_['Admin']      = 'Konfiguration';
$_['bytes']      = 'Bytes';
$_['Cancel']     = 'Abbrechen';
$_['cancelled']  = 'abgebrochen';
$_['Close']      = 'Schließen';
$_['Copy']       = 'Erstellen';
$_['Copied']     = 'Kopieren';
$_['Create']     = 'Kopiert';
$_['Date']       = 'Datum';
$_['Delete']     = 'Löschen';
$_['DELETE']     = 'LÖSCHEN';
$_['Deleted']    = 'Gelöschte';
$_['Edit']       = 'Bearbeiten';
$_['Enter']      = 'Eintreten';
$_['Error']      = 'Fehler';
$_['errors']     = 'Fehler';
$_['ext']        = 'ext';
$_['File']       = 'Datei';
$_['files']      = 'files';   //## NT ##
$_['Folder']     = 'Ordner';
$_['folders']    = 'Verzeichnisse';
$_['From']       = 'Von';
$_['Group']      = 'Group';   //## NT ##
$_['Hash']       = 'Streuwert';
$_['Invalid']    = 'Invalid'; //## NT ##
$_['Move']       = 'Verschieben';
$_['Moved']      = 'Verschoben';
$_['Name']       = 'Name';    //## NT ##
$_['on']         = 'läuft unter';
$_['off']        = 'aus';
$_['Owner']      = 'Owner';   //## NT ##
$_['Password']   = 'Passwort';
$_['Rename']     = 'Umbenennen';
$_['reset']      = 'Zurücksetzen';
$_['save_1']     = 'Speichern';
$_['save_2']     = 'ÄNDERUNGEN SPEICHERN';
$_['Size']       = 'Größe';
$_['Source']     = 'Source';  //## NT ##
$_['successful'] = 'Erfolgreich';
$_['To']         = 'Auf';
$_['Upload']     = 'Heraufladen';
$_['Username']   = 'Benutzername';
$_['View']       = 'Aussicht';

$_['Log_In']             = 'Anmelden';
$_['Log_Out']            = 'Abmelden';
$_['Admin_Options']      = 'Konfiguration Optionen';
$_['Are_you_sure']       = 'Sind Sie sicher?';
$_['View_Raw']           = 'View Raw'; //## NT ##
$_['Open_View']          = 'Ansicht im Browser-Fenster';
$_['Edit_View']          = 'Datei Bearbeiten / Ansicht';
$_['Wide_View']          = 'Breitenadaptierte Ansicht';
$_['Normal_View']        = 'Normale Ansicht';
$_['Word_Wrap']          = 'Word Wrap'; //## NT ##
$_['Line_Wrap']          = 'Line Wrap'; //## NT ##
$_['Upload_File']        = 'Datei heraufladen';
$_['New_File']           = 'Neuer Datei';
$_['Ren_Move']           = 'Umbenennen / Verschieben';
$_['Ren_Moved']          = 'Umbenannt / Verschoben';
$_['folders_first']      = 'folders first'; //## NT ##
$_['folders_first_info'] = 'Sort folders first, but don\'t change primary sort.'; //## NT ##
$_['New_Folder']         = 'Neuer Ordner';
$_['Ren_Folder']         = 'Ordner umbenennen/verschieben';
$_['Submit']             = 'Anfrage senden';
$_['Move_Files']         = 'Datei Verschieben';
$_['Copy_Files']         = 'Datei Kopieren';
$_['Del_Files']          = 'Datei Löschen';
$_['Selected_Files']     = 'Ausgewählte Dateien';
$_['Select_All']         = 'Alles auswählen';
$_['Clear_All']          = 'Deaktivieren Sie alle';
$_['New_Location']       = 'Neuer Ordner';
$_['No_files']           = 'Keine Dateien ausgewählt.';
$_['Not_found']          = 'Nicht gefunden';
$_['Invalid_path']       = 'Invalid path'; //## NT ##
$_['must_be_decendant']  = '$DEFAULT_PATH must be a decendant of, or equal to, $ACCESS_ROOT'; //## NT ##
$_['Update_failed']      = 'Update failed'; //## NT ##
$_['Working']            = 'Working - please wait...'; //## NT ##
$_['Enter_to_edit']      = '[Enter] to edit'; //## NT ##
$_['Press_Enter']        = 'Press [Enter] to save changes. Press [Esc] or [Tab] to cancel.'; //## NT ##
$_['Permissions_msg_1']  = 'Permissions must be exactly 3 or 4 octal digits (0-7)'; //## NT ##

$_['verify_msg_01']     = 'Sitzung abgelaufen.';
$_['verify_msg_02']     = 'UNGÜLTIGE DATENSENDUNG';
$_['get_get_msg_01']    = 'Die Datei wurde nicht gefunden:';
$_['get_get_msg_02']    = 'Invalid page request.';
$_['check_path_msg_02'] = '"." or ".." Pfadsegmente sind unzulässig.';
$_['check_path_msg_03'] = 'Order oder Dateiname enthält ein ungültiges Zeichen:';
$_['ord_msg_01']        = 'Eine Datei mit demselben Namen existiert bereits im Zielverzeichnis.';
$_['ord_msg_02']        = 'Speichern als';
$_['rCopy_msg_01']      = 'Ein Ordner kann nicht in einer eigenen Sub-Ordner kopiert werden.';
$_['show_img_msg_01']   = 'Die Bilddarstellung entspricht ~';
$_['show_img_msg_02']   = '% der wahren Größe (W x H = ';

$_['hash_txt_01']   = 'Die Streuwert von dieser Seite erzeugt wird, kann verwendet werden, um manuell zu aktualisieren $ HASHWORD in OneFileCMS, oder in einer externen Konfigurationsdatei werden. In jedem Fall sicher, dass Sie das Kennwort erinnern verwendet, um den Streuwert zu generieren!';
$_['hash_txt_06']   = 'Tippen Sie das gewünschte Passwort in das Eingabefeld und drücken Sie Enter.';
$_['hash_txt_07']   = 'Der Streuwert wird in einer gelben Box überhalb angezeigt werden.';
$_['hash_txt_08']   = 'Kopieren Sie den neuen Streuwert und fügen Sie ihn in den Konfigurationsbereich als Wert der Variable $HASHWORD ein.';
$_['hash_txt_09']   = 'Stellen Sie sicher, dass Sie den GESAMTEN Streuwert -- und nur diesen (keine führenden oder nachgestellten Leerzeichen, etc.) -- kopiert haben.';
$_['hash_txt_10']   = 'Ein Doppelklick sollte den Streuwert auswählen...';
$_['hash_txt_12']   = 'Wenn die Werte eingetragen wurden, melden Sie sich ab und wieder an.';
$_['pass_to_hash']  = 'Passwort Streuwert:';
$_['Generate_Hash'] = 'Streuwert generieren';

$_['login_msg_01a'] = 'Es wurden ';
$_['login_msg_01b'] = ' ungültige Anmeldversuche gezählt.';
$_['login_msg_02a'] = 'Bitte warten Sie ';
$_['login_msg_02b'] = 'Sekunden, um es erneut zu probieren.';
$_['login_msg_03']  = 'UNGÜLTIGER ANMELDEVERSUCH #';

$_['edit_note_00']  = 'ANMKERUNG:';
$_['edit_note_01a'] = 'Denken Sie immer daran: Ihre ';
$_['edit_note_01b'] = ' ist ';
$_['edit_note_02']  = 'Speichern Sie Änderungen bevor der Countdown abläuft, oder die Änderungen sind verloren!';
$_['edit_note_03']  = 'Einige Browser (wie zum Beispiel Chrome) zeigen eventuell nicht den richtigen Dateistatus an, wenn man die Vor- und Zurückknöpfe verwendet. Zum Korrigieren offensichtlich falscher Angaben drücken Sie in so einem Fall bitte den "Neu laden"-Knopf.';

$_['edit_h2_1']   = 'Betrachtend: ';
$_['edit_h2_2']   = 'In Bearbeitung: ';
$_['edit_txt_00'] = 'Edit disabled.'; //## NT ##
$_['edit_txt_01'] = 'Unbekannter Dateityp oder keine Textdatei. Bearbeitungsmöglichkeit ausgeschalten.';
$_['edit_txt_02'] = 'Die Datei enthält möglicherweise ungültige Zeichen. Der Bearbeitungs- und Betrachtungsmodus wurde gesperrt.';
$_['edit_txt_03'] = 'htmlspecialchars() gab eine leere Zeichenkette zurück.';
$_['edit_txt_04'] = 'Das Verhalten kann je nach verwendeter PHP-Version unterschiedlich sein.';
$_['edit_txt_05'] = 'Datei ist readonly.';

$_['too_large_to_edit_01'] = 'Bearbeiten deaktiviert. Dateigröße >';
$_['too_large_to_edit_02'] = 'Einige Browser (wie zum Beispiel der Internet Explorer) bleiben stecken oder werden instabil, sobald größere Textmengen in einer HTML <textarea> bearbeitet werden.';
$_['too_large_to_edit_03'] = 'Die Einstellung $MAX_EDIT_SIZE im Konfigurationsbereich des OneFileCMS kann nach den Erfordernissen angepaßt werden.';
$_['too_large_to_edit_04'] = 'Mittels einfachem Trial & Error kann das optimale Limit für einen bestimmten Browser und Computer festgestellt werden.';
$_['too_large_to_view_01'] = 'Betrachtungsmodus deaktiviert. Filesize > ';
$_['too_large_to_view_02'] = 'Klicken Sie auf den Dateinamen überhalb, um die Datei direkt im Browser anzuzeigen.';
$_['too_large_to_view_03'] = 'Adjustieren Sie die $MAX_VIEW_SIZE im Konfigurationsbereich von OneFileCMS nach Ihren Bedürfnissen.';
$_['too_large_to_view_04'] = '(The default value for $MAX_VIEW_SIZE is completely arbitrary, and may be adjusted as desired.)'; //## NT ##

$_['meta_txt_01'] = 'Dateigröße:';
$_['meta_txt_03'] = 'Aktualisiert:';

$_['edit_msg_01'] = 'Die Datei wurde gespeichert:';
$_['edit_msg_02'] = 'Bytes geschrieben.';
$_['edit_msg_03'] = 'Bei dem Versuch die Datei zu speichern trat ein Fehler auf.';

$_['upload_txt_03'] = 'Anmerkung: Die maximale Dateigröße für das Heraufladen von Dateien beträgt: ';
$_['upload_txt_01'] = 'php.ini: upload_max_filesize';
$_['upload_txt_04'] = 'Maximale Gesamt Upload-Größe:';
$_['upload_txt_02'] = 'php.ini: post_max_size';
$_['upload_txt_05'] = 'Für die hochgeladenen Dateien, die bereits existieren: ';
$_['upload_txt_06'] = 'Umbenennen (Auf filename.ext.001 etc...)';
$_['upload_txt_07'] = 'Überschreiben';

$_['upload_err_01'] = 'Fehler 1: Datei zu groß. Von php.ini:';
$_['upload_err_02'] = 'Fehler 2: Datei zu groß. (MAX_FILE_SIZE HTML form element)';
$_['upload_err_03'] = 'Fehler 3: Die Datei wurde nur teilweise heraufgeladen.';
$_['upload_err_04'] = 'Fehler 4: Es wurde keine Datei heraufgeladen.';
$_['upload_err_05'] = 'Fehler 5:';
$_['upload_err_06'] = 'Fehler 6: Konnte kein temporäres Verzeichnis finden.';
$_['upload_err_07'] = 'Fehler 7: Die Datei konnte nicht gespeichert werden.';
$_['upload_err_08'] = 'Fehler 8: Eine PHP-Erweiterung hat das Heraufladen der Datei gestoppt.';

$_['upload_error_01a'] = ' Fehler beim Heraufladen.  Die Gesamtmenge and heraufgeladenen Daten (in Hauptsache die Datei) überschreitet die post_max_size = ';
$_['upload_error_01b'] = ' (der php.ini)';

$_['upload_msg_02'] = 'Der Zielordner existiert nicht: ';
$_['upload_msg_03'] = 'Das Heraufladen wurde abgebrochen.';
$_['upload_msg_04'] = 'Heraufladen: ';
$_['upload_msg_05'] = 'Das Heraufladen war erfolgreich! ';
$_['upload_msg_06'] = 'Das Heraufladen ist fehlgeschlagen: ';
$_['upload_msg_07'] = 'Eine bereits vorhandene Datei überschrieben wurde.';

$_['new_file_txt_01'] = 'Die Datei wird im aktuellen Ordner erstellt.  ';
$_['new_file_txt_02'] = 'Ungültige Zeichen für Dateinamen sind: ';
$_['new_file_msg_01'] = 'Die neue Datei wurde nicht erstellt:';
$_['new_file_msg_02'] = 'Der Name enthält ungültige Zeichen: ';
$_['new_file_msg_04'] = 'Die Datei besteht bereits: ';
$_['new_file_msg_05'] = 'Datei erstellt:';
$_['new_file_msg_07'] = 'Ordner erstellt:';

$_['CRM_txt_02'] = 'Der neue Ort muss bereits existieren.';
$_['CRM_txt_04'] = 'Neuer Name';
$_['CRM_msg_01'] = 'Fehler - der neue Zielort besteht nicht:';
$_['CRM_msg_02'] = 'Fehler - die Quelldatei besteht nicht:';
$_['CRM_msg_03'] = 'Fehler - die Zieldatei besteht bereits:';
$_['CRM_msg_05'] = 'Fehler bei der';

$_['delete_msg_03']   = 'Fehler löschen:';
$_['session_warning'] = 'Achtung: Die sitzung wird ende bald!';
$_['session_expired'] = 'SITZUNG ABGELAUFEN';
$_['unload_unsaved']  = '               Nicht gespeicherte Änderungen gehen verloren!';
$_['confirm_reset']   = 'Soll der Inhalt der Datei zurückgesetzt werden (Änderungen gehen verloren)?';
$_['OFCMS_requires']  = 'OneFileCMS erfordert PHP';
$_['logout_msg']      = 'Sie wurden erfolgreich abgemeldet.';
$_['edit_caution_01'] = 'ACHTUNG ';
$_['edit_caution_02'] = ' Sie bearbeiten gerade die aktive Version von OneFileCMS.';
$_['time_out_txt']    = 'Automatischer Sitzungsstopp in:';

$_['error_reporting_01'] = 'Anzeigen von Fehlern ist';
$_['error_reporting_02'] = 'Loggen von Fehlern ist';
$_['error_reporting_03'] = 'Fehlerberichterstattung';
$_['error_reporting_04'] = 'Anzeigen der Fehlertypen';
$_['error_reporting_05'] = 'Unerwartete frühzeitige Ausgabe';
$_['error_reporting_06'] = '(Nicht einmal Leerzeichen hätten ausgegeben werden sollen)';

$_['admin_txt_00'] = 'Alte Sicherung gefunden';
$_['admin_txt_01'] = 'Diese Datei wurde erstellt, da es während der Änderung des Passwortes oder des Benutzernamens zu einem Fehler gekommen ist. Diese Datei enthält somit eventuell veraltete Informationen und kann gelöscht werden, sofern sie nicht weiter von Ihnen benötigt wird.';
$_['admin_txt_02'] = 'Allgemeine Information';
$_['admin_txt_03'] = 'Session Path'; //## NT ##
$_['admin_txt_04'] = 'Connected to'; //## NT ##
$_['admin_txt_14'] = 'Eine weitere, kleine Sicherheitsvorkehrung wäre, das Salz oder die Methode für die Streuwertgenerierung von OneFileCMS zu ändern.';
$_['admin_txt_16'] = 'Sie können auch OneFileCMS selbst bearbeiten.  Legen Sie aber sicherheitshalber eine Kopie an, falls es zu einem unerwünschten Schreibfehler kommt...';

$_['pw_current'] = 'Aktuelles Passwort';
$_['pw_change']  = 'Passwort ändern';
$_['pw_new']     = 'Neues Passwort';
$_['pw_confirm'] = 'Bestätigen Sie das neue Password';

$_['un_change']  = 'Benutzername ändern';
$_['un_new']     = 'Neuer Benutzername';
$_['un_confirm'] = 'Bestätigen Sie den neuen Benutzernamen';

$_['pw_txt_02'] = 'Regeln für Passwort / Benutzername:';
$_['pw_txt_04'] = 'Groß-/Kleinschreibung wird berücksichtigt!';
$_['pw_txt_06'] = 'Zumindest ein Zeichen, das nicht als Leerzeichen zählt, muss enthalten sein.';
$_['pw_txt_08'] = 'Leerzeichen in der Mitte sind gültig. Beispiel: "This is a password or username!"';
$_['pw_txt_10'] = 'Führende und angehängte Leerzeichen werden entfernt.';
$_['pw_txt_12'] = 'Nur die aktive Kopie von OneFileCMS wird aktualisiert - es werden keine externen Konfigurationsdateien geändert.';
$_['pw_txt_14'] = 'Wird ein ungültiges Passwort eingegeben, werden Sie abgemeldet. Sie können sich anschließend neu anmelden.';

$_['change_pw_01'] = 'Passwort wurde geändert!';
$_['change_pw_02'] = 'Passwort wurde nicht geändert.';
$_['change_pw_03'] = 'Falsches (derzeitiges) Passwort. Bitte melden Sie sich an, um es erneut zu versuchen.';
$_['change_pw_04'] = 'Die Werte der Felder "Neu" und "Bestätigen" gleichen sich nicht.';
$_['change_pw_05'] = 'Aktualisierung';
$_['change_pw_06'] = 'Externe Konfigurationsdatei';
$_['change_pw_07'] = 'All fields are required.'; //## NT ##

$_['change_un_01'] = 'Benutzername wurde geändert!';
$_['change_un_02'] = 'Benutzername wurde nicht geändert.';

$_['mcd_msg_01'] = 'Dateien verschoben.';
$_['mcd_msg_02'] = 'Dateien kopiert.';
$_['mcd_msg_03'] = 'Dateien gelöscht.';

