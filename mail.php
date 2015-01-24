<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors','on');
ini_set('magic_quotes_gpc','off');
$bledy=array();
$komunikat='';
$type="ok";

sleep ( 1 );

if (isset($_POST['name'])&&isset($_POST['email'])){

    
    if ( empty($_POST['name'])) {
            $bledy[]='Wprowadź imię i nazwisko.';
    }
    if ( !preg_match('/^([a-z0-9]{1})([a-z0-9\+_-]*)((\.[a-z0-9\+_-]+)*)@([a-z0-9]{1})((([a-z0-9-]*[-]{2})|([a-z0-9])*|([a-z0-9-]*[-]{1}[a-z0-9]+))*)((\.[a-z0-9](([a-z0-9-]*[-]{2})|([a-z0-9]*)|([a-z0-9-]*[-]{1}[a-z0-9]+))+)*)\.([a-z0-9]{2,6})$/Diu', $_POST['email']) ) {
            $bledy[]='Niepoprawny adres e-mail.';
    } 
    if (empty($_POST['tresc'])) {
            $bledy[]="Proszę wpisać treść wiadomości.";
    }
         


    if (empty($bledy)){
		$headers = 'From: '.$_POST['name'].' <'.$_POST['email'].'>' . "\r\n";
		$headers  .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		

		$wiadomosc ='
		<html>
<head>
<title>Kontakt ze strony ALFA SERWIS</title>
<style>
body{
font-family: \'Lato\',Arial,sans-serif;
width:650px;

margin:auto;
padding:15px 0px 10px 0;
}
#page-slice {
width:100%;

}
table {
	width: 100%;
}
th {
background-color: #31BC86;
font-weight: bold;
color: #FFF;
white-space: nowrap;
}
td, th {
    padding: 0.75em 1.5em;
    text-align: left;
}
.table {
    background-color: #F5F5F5;
    transition: all 0.125s ease-in-out 0s;
}
</style>

</head>
<body>

<h1>Kontakt</h1>
<p>E-mail został wygenerowany automatycznie po użyciu formularza kontaktowego</p>

<table>
	<tr><th colspan="2">Dane z formularza</th></tr>
    <tr><td><strong>Imię i Nazwisko:</strong></td><td>'.$_POST['name'].'</td></tr>
    <tr class="table"><td><strong>E-mail:</strong></td><td>'.$_POST['email'].'</td></tr>
    <tr><td><strong>Wiadomość:</strong></td><td>'.$_POST['tresc'].'</td></tr>
</table>

</body>
</html>
';

        if (mail('barteqr15@o2.pl', 'Kontak ze strony muzeumezegadlowicza.pl', $wiadomosc, $headers)){
            $komunikat='<h4 class="done"><i class="icon-check"></i> Wiadomość została wysłana.</h4>';
            $type="ok";
        } else {
            $bledy[] = '<h4 class="error"><i class="icon-attention"></i> Niestety nie udało się wysłać wiadomości. Spróbuj później.</h4>';           
         }

    }

} else {
    $bledy[]='Brak wymaganych wartości w formularzu.';
}




if ($komunikat==''){
    if(empty($bledy)){
        } else {
            $komunikat='<h4 class="error">Formularz został wypełniony nieprawidłowo</h4>';
            foreach ($bledy as $k){
                $komunikat.='<p class="error"><i class="icon-attention"></i> '.$k.'</p>';
            }
            $type="error";
        }
}


$odp=array("type"=>$type,"text"=>$komunikat);
echo json_encode($odp);