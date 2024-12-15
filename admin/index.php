<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-light">
            <?php include('sidemenu.php'); ?>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Header -->
            <div id="header">
                <?php include('header.php'); ?>
            </div>

            <!-- Dashboard -->
            <div id="dashboard">
                <?php include('dashboard.php'); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

