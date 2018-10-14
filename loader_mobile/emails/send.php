<?php

	$message = file_get_contents($_GET['mail']);
	$FromName="Sourav";
	$FromEmail="no.reply@theshipper.org";
	$ReplyTo="no.reply@theshipper.org";
	$ToEmail=$_GET['to'];
	$Subject="Registration Successful";
	
	$Headers  = "MIME-Version: 1.0\n";
    $Headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $Headers .= "From: ".$FromName." <".$FromEmail.">\n";
    $Headers .= "Reply-To: ".$ReplyTo."\n";
    $Headers .= "X-Sender: <".$FromEmail.">\n";
    $Headers .= "X-Mailer: PHP\n"; 
    $Headers .= "X-Priority: 1\n"; 
    $Headers .= "Return-Path: <".$FromEmail.">\n";  

    if(mail($ToEmail, $Subject, $message, $Headers) == false) {
        echo "unsuccessful";
    }
    else echo "success";
?>