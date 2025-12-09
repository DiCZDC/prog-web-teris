
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación Teris</title>
    <style>
        /* Estilos generales para clientes que los soporten */
        body { margin: 0; padding: 0; background-color: #f6f7f8; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        table { border-spacing: 0; }
        td { padding: 0; }
        img { border: 0; }
        
        /* Media query para móviles */
        @media screen and (max-width: 600px) {
            .container { width: 100% !important; }
            .content-padding { padding: 20px !important; }
        }
    </style>
</head>
<!-- <body style="margin: 0; padding: 0; background-color: #f6f7f8; font-family: Helvetica, Arial, sans-serif;"> -->

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff;">
    <tr>
        <td align="center">
            
            <table border="0" cellpadding="0" cellspacing="0" width="600" class="container" style="background-color: #ffffff; margin-top: 20px;">
                
                <tr>
                    <td align="left" style="padding: 20px 0 10px 0;">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczPldrhndLJ4PriR8KdVJOQjVFpOxtSs1JsFp_m96A2Qph9aiXgu920yv15-dkFEP-hYcTpoHh6d0biBlJiopzHMQzjQ4X303HV9ZTARaWhIVQ6ftYaNFYiawNYVYz-JrDVL7-uhgQsgyAnCRaCMAgHX=w500-h500-s-no?authuser=0" alt="Teris Logo" width="75" height="auto" style="display: block; vertical-align: middle;">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="font-size: 16px; color: #333333; padding-bottom: 20px;">
                        Tienes una nueva notificación de <strong style="color: #0079d3;"> Teris</strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="border-bottom: 1px solid #edeff1;"></td>
                </tr>

                <tr>
                    <td colspan="2" class="content-padding" style="padding: 30px 0; text-align: left; color: #1c1c1c; font-size: 14px; line-height: 21px;">
                        
                        <p style="color: #878a8c; font-size: 12px; margin: 0 0 10px 0;">{{$userName}}</p>
                        
                        <h2 style="font-size: 18px; margin: 0 0 15px 0; font-weight: bold;">Has recibido una respuesta a tu solicitud para unirte a {{$teamName}}</h2>
                        <img src ="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExdXY5eHI1dWp0aTI1ZDd2OWV5ZDJraWdwd2x3NXZ1Y29pNHd4YmV1YSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/L3UKTy1BxE5Hi/giphy.gif" style="width: 100%; max-width: 600px; height: auto; display: block; margin-bottom: 20px; border-radius: 8px;">
                        <p style="margin-bottom: 15px;">
                            El equipo {{$teamName}} ha {{$response}} tu solicitud para unirte.
                            <strong>Teris</strong> agradece tu iniciativa para formar equipos sólidos y colaborativos.

                        </p>
                        <p style="margin-bottom: 0;">
                            Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos. ¡Estamos aquí para ayudarte!
                        </p>
                        <p style="color: #878a8c; text-align: right;">
                                                    Atentamente,<br>
                                                    El equipo de Teris
                                                </p>
                    </td>
                </tr>
               

            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f6f7f8;">
                <tr>
                    <td align="center" style="padding: 40px 20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="600" class="container">
                                    <a><img src="https://lh3.googleusercontent.com/pw/AP1GczPldrhndLJ4PriR8KdVJOQjVFpOxtSs1JsFp_m96A2Qph9aiXgu920yv15-dkFEP-hYcTpoHh6d0biBlJiopzHMQzjQ4X303HV9ZTARaWhIVQ6ftYaNFYiawNYVYz-JrDVL7-uhgQsgyAnCRaCMAgHX=w500-h500-s-no?authuser=0" width="200" alt="Teris Logo" border="0"></a>
                                    <tr>
                                <td align="center" style="font-size: 10px; color: #878a8c; line-height: 1.5;">
                                    Este correo fue enviado a {{$userName}}.<br>
                                    <a href="#" style="color: #000000; text-decoration: underline;">Unsubscribe</a> from Inbox Announcement Email Marketing messages, or visit your settings.<br>
                                    <br>
                                    548 Market St, #16093,<br>
                                    San Francisco, CA 94104-5401
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
