<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <title>Login | Page</title>
        <style>
        .big {
            font-size: 100px;
            font-style: oblique;
            text-shadow: 3px 3px 3px gray;
        }
        </style>
    </head>

    <body>
        <p class="big text-center">User Mangement System</p>

        <div class="d-flex align-items-center mt-4 justify-content-center flex-column col-12">
            <h2 class="my-5">User Login</h2>
            <div>
                <?php
$errorMsg = $this->session->userdata('errorMsg');
if (!empty($errorMsg)) {
    ?>
                <div class="alert alert-danger" role="alert">
                    <?php
echo $errorMsg;
    ?>
                </div>
                <?php
}
?>
            </div>
            <form method="POST" action="<?=base_url() . 'user'?>" class="col-3">
                <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" name="username" placeholder="Enter name..." class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter password..." name="password" class="form-control"
                        id="exampleInputPassword1">
                </div>
                <button type="submit" name="login" value="user" class="btn btn-primary col-md-12">Sign IN</button>
                <a href="<?=base_url() . 'user/register'?>" class="btn btn-outline-primary col-md-12 mt-1">
                    Sign UP
                </a>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>

    </body>

</html>