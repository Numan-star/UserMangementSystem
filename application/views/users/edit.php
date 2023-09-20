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
        <div class="container my-1 d-flex justify-content-center flex-column col-md-12">

            <div class="col-md-12">
                <h1 class="text-center" style="font-family: 'Lato', sans-serif;">Edit Info</h2>
                    <p class="text-center" style="font-family: 'Lato', sans-serif;">It's quick and easy.</p>
                    <hr>
            </div>

            <div class="col-md-12">

                <form action="<?=base_url() . 'User/edit/' . $person['id']?>" method="POST"
                    class="d-flex justify-content-center flex-column align-items-center">
                    <div class="form-group col-md-6 col-9">
                        <label for="inputEmail4">UserName</label>
                        <input type="text" name="newusername" value="<?=$person['name']?>" class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6 col-9">
                        <label for="inputAddress">Password</label>
                        <input type="text" value="<?=$person['password']?>" name="newpassword" class="form-control"
                            id="password" placeholder="">
                    </div>
                    <div class="form-group col-md-6 col-9">
                        <label for="inputPassword4">Address</label>
                        <input type="text" value="<?=$person['address']?>" name="newaddress" class="form-control"
                            id="inputPassword4">
                    </div>
                    <div class="form-group col-md-6 col-9">
                        <label for="inputPassword4">Country</label>
                        <input type="text" value="<?=$person['country']?>" name="newcountry" class="form-control"
                            id="inputPassword4">
                    </div>
                    <br>
                    <button type="submit" name="update" value="edit" class="btn btn-warning w-50">
                        Update
                    </button>
                </form>

                <div class="d-flex justify-content-center flex-column align-items-center">
                    <a href="<?=base_url() . 'user/welcome'?>" class="nav-link w-50 mt-1 mb-5">
                        <button class="btn btn-outline-warning w-100">
                            Bact to Profile
                        </button>
                    </a>
                </div>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    </body>

</html>