<!DOCTYPE html>
<html lang="eng">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Epiqworx">
      <meta name="author" content="Nikitha Mathangana">
      <title><?= APPNAME ?></title>
  </head>
  <body id="page-top">
    <main id="app">
    <?= Epiqworx\Views\Resource::content($this->template) ?>
    </main>
    <script src="<?= Epiqworx\Views\Resource::usr('js/vendors~index.js') ?>"></script>
    <script src="<?= Epiqworx\Views\Resource::usr('js/index.js') ?>"></script>
  </body>
</html>