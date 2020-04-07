<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Contacto | Kilak</title>
</head>
<body style="padding: 0; margin: 0;">
<div>

<div style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 13px; line-height: 18px; padding: 20px; max-width: 960px; width: 100%; margin: 0 auto; overflow: auto;">
  <h1 style="font-size: 36px; color: #ca5819; font-weight: 400;">Contacto</h1>


<hr size="1" width="100%" align="center">
<table border="0" cellspacing="7" cellpadding="0" width="90%">
  <tr>
    <td width="300" align="right"><b>Nombre:</b></td>
    <td>{{$request->name}} </td>
  </tr>
  <tr>
    <td width="300" align="right"><b>e-Mail:</b></td>
    <td><a href="mailto:{{$request->email}}">{{$request->email}}</a></td>
  </tr>
  <tr>
    <td width="300" align="right"><b>Teléfono:</b></td>
    <td>{{$request->phone}}</td>
  </tr>
  <tr>
    <td width="300" align="right"><b>Mensaje:</b></td>
    <td>{{$request->message}}</td>
  </tr>
  </table>

</div>


</div>
</body>
</html>