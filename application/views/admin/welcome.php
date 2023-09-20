<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register - YourSelf</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="container">

            <h1>Welcome Admin</h1>
            <div class="col-md-12 mt-3">
                <?php
$success = $this->session->userdata('success');
if ($success != "") {
    ?>
                <div class="alert alert-success text-center" id="my_alert"><?=$success?></div>
                <?php
}
$failure = $this->session->userdata('failure');
if ($failure != "") {
    ?>
                <div class="alert alert-danger" id="my_alert"><?=$failure?></div>
                <?php
}
?>
            </div>
            <table class="" width="600" cellspacing="5" cellpadding="5">
                <tr style="background:#CCC">
                    <th>Name</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
                <?php
if (!empty($users)) {
    foreach ($users as $user) {
        ?>
                <tr>
                    <td><?=$user['name']?></td>
                    <td><?=$user['address']?></td>
                    <td><?=$user['country']?></td>
                    <td>
                        <a class="btn btn-danger btn-sm"
                            href="<?=base_url() . 'login/delete/' . $user['id']?>">Remove</a>
                    </td>
                </tr>

                <?php
}
} else {
    ?>
                <tr>
                    <td>Records Not Found</td>
                <tr>
                    <?php
}
?>
            </table>
        </div>
        <div class="d-flex justify-content-center flex-column align-items-center">
            <a href="<?=base_url() . 'login/logout'?>" class="btn btn-primary btn-sm mt-1 mb-5">Logout</a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    </body>

</html>