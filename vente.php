<?php
include 'v.php';
include 'config.php';
$aujourdhui = date('Y-m-d');
$hier = date('Y-m-d',strtotime( '-1 days' ));
$semaine = date('Y-m-d',strtotime( '-6 days' ));
$mois = date('Y-m-d',strtotime( '-1 month' ));
$condition = " date_vente BETWEEN  '$aujourdhui' AND '$aujourdhui 23:59:59' ";
if (isset($_GET['date'])) {
if ($_GET['date'] == 'hier') $condition = " date_vente BETWEEN '$hier' AND '$aujourdhui'";

if ($_GET['date'] == 'semaine') $condition = " date_vente BETWEEN '$semaine' AND '$aujourdhui 23:59:59'";
if ($_GET['date'] == 'mois') $condition = " date_vente BETWEEN '$mois' AND '$aujourdhui 23:59:59'";


}

$total = 0;
$benefices = 0;
$ventes = '<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">';
 $sql= "SELECT *,(SELECT nom FROM clients WHERE clients.id = ventes.client_id) AS cl FROM ventes WHERE $condition ORDER BY montant DESC";
 $qry2= mysqli_query($conx,$sql);

 while ($row= mysqli_fetch_array($qry2)) {
$total += $row['montant'];
$benefices += $row['benefices'];
$ventes .= '<tr class="mdl-data-table__cell--non-numeric"><td>'.$row['cl'].'</td><td dir="ltr">'.number_format($row['montant'] , 2, ',', ' ').'</td></tr>';
 }

 $ventes .= '</table>';




 $depenses= 0;
  $sql2= "SELECT SUM(valeur) AS dep FROM depenses WHERE  $condition";
  $qry= mysqli_query($conx,$sql2);
  if ($qry) {

  while ($row= mysqli_fetch_array($qry)) {
    if ($row['dep'] == null)$row['dep'] = 0;
$depenses = $row['dep'];
  }
}

$benefices -= $depenses;
// $total -= $depenses;



function calculerPourcentage($b , $m){

if ($m - $b == '0') return 0;
$p = $b / ($m - $b);
$p *= 100;
return round($p);
}




 ?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="assets/material.min.css">
<link rel="stylesheet" href="assets/main.css">
<script defer src="assets/material.min.js"></script>

  <head>
    <meta charset="utf-8">
    <title>EL DJAWHARA</title>
  </head>
  <body>


<?php include 'header.php'; ?>





<div class="resultats" style="padding:5px">
<!-- <h3 dir="rtl">مجموع المبيعات</h3>

<h2> <?php print $total; ?></h2> -->


<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
  <thead>
    <tr>

      <td>مجموع المبيعات</td>

      <td><h4 dir="ltr"> <?php print number_format($total , 2, ',', ' '); ?></h4> </td>
    </tr>
  </thead>
  <tbody>
    <tr>

      <td>مجموع الفائدة</td>
      <td><h4 dir="ltr"><?php print number_format($benefices , 2, ',', ' '); ?></h4> </td>
    </tr>
    <tr>

      <td>نسبة الفائدة</td>
      <td><h4 dir="ltr"><?php print calculerPourcentage($benefices ,$total) . '%'; ?></h4> </td>
    </tr>
    <tr>

      <td>المصاريف</td>
      <td><h4 dir="ltr"><?php  print  number_format($depenses , 2, ',', ' '); ?></h4></td>
    </tr>

  </tbody>
</table>


<br>
<h2>
المبيعات
</h2>

<?php print $ventes; ?>
</div>



        </div>
      </main>
    </div>

 <script src="assets/main.js" charset="utf-8"></script>


  </body>
</html>
