<?php

function EmailTemplateRespuesta($nombre, $apellido, $estado, $respuesta) {
  if($estado == "false"){
    $state = "PENDIENTE";
  }else{
    $state = "RECHAZADO";
  }
  $HTML = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <title>TaxisYa - Notificación</title>
          <meta name="viewport" content="width=device-width" />
         <style type="text/css">
              @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                  body[yahoo] .buttonwrapper { background-color: transparent !important; }
                  body[yahoo] .button { padding: 0 !important; }
                  body[yahoo] .button a { background-color: #1bbae1; padding: 15px 25px !important; }
              }

              @media only screen and (min-device-width: 601px) {
                  .content { width: 600px !important; }
                  .col387 { width: 387px !important; }
              }
          </style>
      </head>
      <body bgcolor="#394263" style="margin: 0; padding: 0;" yahoo="fix">
          <!--[if (gte mso 9)|(IE)]>
          <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>
          <![endif]-->
          <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
              <tr>
                  <td style="padding: 15px 10px 15px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                              <td align="center" style="color: #aaaaaa; font-family: Arial, sans-serif; font-size: 12px;">
                                  No puede ver este correo electronico?  <a href="#" style="color: #1bbae1;">Mira tu explordor o abrelo en otro.</a>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td align="center" bgcolor="#1bbae1" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                      <h3><i class="fa fa-bank text-muted"></i> <a href="#"></a></h3>
                  </td>
              </tr>
              <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                      <b>Respuesta a su solicitud</b><br/>
                      Estimado '.$nombre.' '.$apellido.', en respuesta a su solicitud su estado es: '.$state.'.<br/>
                      Debido a las siguientes consideraciones: .<br/>
                      '.$respuesta.'<br/>
                      Gracias por ser parte de Taxisya.
                  </td>
              </tr>
              <tr>
                  <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                      <table bgcolor="#1bbae1" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                          <tr>
                              <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                  <!--<a href="" style="color: #ffffff; text-align: center; text-decoration: none;">Ir Taxisya</a>-->
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                      <b>Taxisya.</b><br/>Calle 1C Bis. &bull; #18 - 34&bull; Bogota, Colombia
                  </td>
              </tr>
              <tr>
                  <td style="padding: 15px 10px 15px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                              <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                  '. date('Y',time()) .' &copy; <a href="http://www.taxisya.co" style="color: #1bbae1;">Taxisya</a>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
                  </td>
              </tr>
          </table>
          <![endif]-->
      </body>
  </html>
';

      return $HTML;
}

?>
