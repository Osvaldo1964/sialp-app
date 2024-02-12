?php

$mail = new PHPMailer(true);

    try {
        //Server settings
        $mail = new \PHPMailer();

        //$mail->SMTPDebug = true;
        //CONFIGURAR SMTP y MAIL
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->Host = "vitalfood.com.co"; // SMTP a utilizar. Por ej. smtp.elserver.com --- pruebas.consamag.com.co
        /*$mail->Username = "nacional005@gmail.com"; // Correo completo a utilizar
        $mail->Password = "310.310.."; // Contraseña
        $mail->Port = 587; // Puerto a utilizar
        // El correo se envía como HTML*/

        $mail->IsHTML(true);
        $mail->Username = "ventas@vitalfood.com.co"; // Correo completo a utilizar icaruscol@pruebas.consamag.com.co
        $mail->Password = "ave#9Z243"; // Contraseña
        $mail->Port = 25; // Puerto
        //$mail->SMTPSecure = "ssl";

        $mail->From = "ventas@vitalfood.com.co"; // Desde donde enviamos (Para mostrar)
        $mail->FromName = "VITALFOOD Colombia";

        //print_r($_GET['tc']);exit;

        if ($_GET['tc'] == 2) {
            $mail->addAddress($cliente[0]['email']);
        } else {
            $mail->addAddress($ruta[0]['emaRepartidor']);
        }

        //$mail->addAddress($cliente[0]['email']);
        //$mail->addAddress($zona[0]['cor_vend_zona']);
        //$mail->addAddress('osvicor@hotmail.com');
        $mail->Subject = "Adjunto Pedido para : " . $cliente[0]['nombre'];

        $mpdf = new \Mpdf\Mpdf([]);

        $mpdf->SetFooter('{PAGENO}');

        //print_r($cliente[0]['tfaCliente']);
        //die();
        if ($cliente[0]['tfaCliente'] == 2) {
            include('plantilla_correof.php');
        } else {
            include('plantilla_correor.php');
        }

        $mpdf->writeHtml("$css", \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHtml("$html", \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output('temporales/filename.pdf', 'F');

        //file_put_contents('temporales/temp.html', $html);

        $mail->addAttachment('temporales/filename.pdf', 'documento.pdf', 'base64', 'application/pdf');

        $htmlmsj = "<h1>CORREO ENVIADO AUTOMATICAMENTE. FAVOR NO RESPONDER.</h1>";
        $mail->Body    = $htmlmsj;
        $mail->AltBody    = $htmlmsj;


        $exito = $mail->send();
        $mail->clearAllRecipients();
        if ($exito) {
            echo 'MENSAJE ENVIADO CORRECTAMENTE';
            echo '<br/>';
            print_r('CORREOS ENVIADOS A:');
            echo '<br/>';
		    if ($_GET['tc'] == 2) {
            	print_r('Correo del Cliente    :' . $cliente[0]['email']);
        	} else {
            	print_r('Correo del Repartidor :' . $ruta[0]['emaRepartidor']);	
        	}
			echo '<br/>';
            //die();
        } else {
            echo 'No se pudo enviar el correo';
            die();
        }
        die();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?}
