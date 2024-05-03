<!doctype html>
<html lang="<?= SITE_LANG ?>">

<head>
  <meta charset="<?= SITE_CHARSET ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <?= get_favicon(); ?>
  <link rel="stylesheet" href="<?= CSS ?>/styles.min.css" />
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" /> -->
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
  <?php require_once ("Views/Templates/nav.php"); ?>