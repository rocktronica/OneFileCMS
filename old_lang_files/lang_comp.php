<?php header('Content-type: text/html; charset=UTF-8'); ?>

<style>
* {font-family: courier}
.value {background-color: #eee;}
</style>
<pre>
This will only show "evaluated" differences between values in the ini & php files.
For example:
  some.LANG.ini:      some_key   = "This is a \" quote test."
  some.LANG.php:  $_['some_key'] = 'This is a " quote test.';
These two values will evaluate as the same- to what is shown in the php version.

This next example, however, will evaluate as different:
  some.LANG.ini:      some_key   = "This is a \" quote test."
  some.LANG.php:  $_['some_key'] = 'This is a \" quote test.';
These two values will evaluate as different, due to the different quoting & escaping rules of ini & php.

Also, some differences in white-space may not be evident or obvious, but will still be listed.
</pre>
<hr>
<?php
$ini['DE'] = 'OneFileCMS.LANG.DE.ini';
$php['DE'] = 'OneFileCMS.LANG.DE.php';

$ini['EN'] = 'OneFileCMS.LANG.EN.ini';
$php['EN'] = 'OneFileCMS.LANG.EN.php';

$ini['ES'] = 'OneFileCMS.LANG.ES.ini';
$php['ES'] = 'OneFileCMS.LANG.ES.php';


foreach ($ini as $lang => $file) {
	echo 'Start '.$lang.'<br>';

	$_ini = parse_ini_file($ini[$lang]);
	include($php[$lang]);
	$_php = $_;

	$diffs = 0;
	foreach ($_ini as $key => $value) {
		if ( $value != $_[$key] ) { 
			$diffs++;
			echo '.ini ['.$key.'] = <span class="value">'.htmlspecialchars($_ini[$key]).'</span><br>';
			echo '.php ['.$key.'] = <span class="value">'.htmlspecialchars($_php[$key]).'</span><br><br>';
		}
	}
	echo 'End '.$lang.'<br>';
	echo 'There were '.$diffs.' differences.<hr>';
}

/***
$_ini = parse_ini_file($ini['EN']);
include($php['EN']);
$_php = $_;

$diffs = 0;
foreach ($_ini as $key => $value) {
	if ( $value != $_[$key] ) { 
		$diffs++;
		echo $ini['EN'].'['.$key.'] = '.htmlspecialchars($_ini[$key]).'<br>';
		echo $php['EN'].'['.$key.'] = '.htmlspecialchars($_php[$key]).'<br><br>';
	}
}
echo 'There were '.$diffs.' differences.<br>';
***/
?>
