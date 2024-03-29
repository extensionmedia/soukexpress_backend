<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
  <title></title>
  
    <style type="text/css">
      table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; }
@media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-50 {
    width: 300px !important;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors='true'] {
  color: inherit !important;
  text-decoration: none !important;
}

img{
  width: 90px;
}
</style>
  
  

<!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->

</head>

<body class="clean-body" style="margin: 0;padding: 20px 40px;-webkit-text-size-adjust: 100%;background-color: #f0f0f0;color: #000000">

  <h1>Nouvelle disponibilité</h1>
  <p>La liste des articles suivants sont disponibles à la vente sur soukexpress.ma </p>

  <table style="font-family:'Montserrat',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
    <?php foreach($articles as $article): ?>
      <tr>
        <td>
          <img src="<?= $article['img'] ?>" alt="<?= $article['img'] ?>">
        </td>
        <td>
          <a href="https://www.soukexpress.ma/">
            <h2>
            <?= $article['article_category_ar'] . ' - ' . $article['libelle_ar'] ?>
            </h2>
          </a>
        </td>
        <td>
          <h2>
          <?= $article['prix_vente'] ?> Dh
          </h2>
        </td>
        <td>
          <h2>
          <?= $article['date'] ?>
          </h2>
        </td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>


</body>

</html>