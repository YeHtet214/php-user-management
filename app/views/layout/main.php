<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/style.css">
  <title>User Management</title>
</head>

<body>
  <div class="app-container">
    <?php require __DIR__ . "/../../../app/views/layout/sidebar.php" ?>

    <main>
      <h1 style="margin-bottom: 20px">User Management System</h1>

      <?php echo $content; ?>
    </main>
  </div>
</body>

</html>