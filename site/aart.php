<html>
<head>
  <title>test</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/aart.css">
</head>
<body>

<h2>formulier-knop met functie</h2>

<?php function createButton($btnNaam, $btnWaarde, $btnText) { ?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="btnNaam" value="<?php echo $btnNaam; ?>">
  <input type="hidden" name="btnWaarde" value="<?php echo $btnWaarde; ?>">
  <input type="submit" name="btnSubmit" value="<?php echo $btnText; ?>">
</form>
<?php }; ?>

<?php
createButton("Naam", "Waarde", "Text");
createButton("Knop 1", "Eén", "Dit is knop I");
createButton("Knop 2", "Twee", "Dit is knop II");
createButton("Knop 2", "Drie", "Dit is knop III");
?>
<h1><?php echo "$_POST[btnNaam] - $_POST[btnWaarde]";?></h1>
<?php print_r($_POST);?>
<?php
/*
<h2>formulier-knop met radiobutton:</h2>
<form name='formulier' method='post' enctype='multipart/form-data' action='aart.php' >
  <input type="radio" class="radioLabel" id="bas" onchange=formulier.submit()>
  <label for="bas">Button</label>
</form>


<h2>formulier-knop zoals het hoort:</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="buttonNaam" value="naam">
  <input type="hidden" name="buttonWaarde" value="waarde">
  <input type="submit" name="buttonSubmit" value="buttonText">
</form>
<h1><?php echo "$_POST[buttonNaam] - $_POST[buttonWaarde]" ;?></h1>

<hr>
*/
?>

</body>
</html>


