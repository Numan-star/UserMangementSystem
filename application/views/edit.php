<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codeigniter | Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand  text-light">Crud Application</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container mt-5">

        <div class="col-md-12">
            <?php
            $success = $this->session->userdata('success');
            if ($success != "") {
            ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php
            }
            $failure = $this->session->userdata('failure');
            if ($failure != "") {
            ?>
                <div class="alert alert-danger"><?= $failure ?></div>
            <?php
            }
            ?>
        </div>
        <div class="col-md-12 row d-flex justify-content-between">
            <div class="col-md-6">
                <div>
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <h1>List User</h1>
                        </div>
                        <!-- <div class="col-md-6">
                            <a class="btn btn-primary" href="
                            //  base_url() . 'Crud/create' 
                             ">Create</a>
                        </div> -->
                    </div>
                    <hr class="col-md-12">
                    <table class="" width="600" cellspacing="5" cellpadding="5">
                        <tr style="background:#CCC">
                            <th>Name</th>
                            <th>Email</th>
                            <th>PhoneNumber</th>
                            <th>Delete</th>
                            <th>Edit</th>

                        </tr>
                        <?php
                        if (!empty($users)) {
                            foreach ($users as $val) {
                        ?>
                                <tr>
                                    <td><?= $val['pname'] ?></td>
                                    <td><?= $val['email'] ?></td>
                                    <td><?= $val['phoneNumber'] ?></td>
                                    <td>
                                        <a onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger" href="<?php echo base_url() . 'Crud/delete/' . $val['id'] ?>">Delete </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo base_url() . 'Crud/edit/' . $val['id'] ?>">Edit</a>
                                    </td>
                                </tr>
                            <?Php                                                                    }
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

            </div>
            <div class="col-md-4">
                <h1>Edit User</h1>
                <form method="POST" action="<?= base_url() . 'Crud/edit/' . $user['id'] ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="<?= set_value('name', $user['pname']) ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <?=
                        form_error('name')
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= set_value('email', $user['email']) ?>" class="form-control" id="exampleInputPassword1">
                        <?= form_error('email') ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">PhoneNumber</label>
                        <input type="text" name="phoneNumber" value="<?= set_value('phoneNumber', $user['phoneNumber']) ?>" class="form-control" id="exampleInputPassword1">
                        <?= form_error('phoneNumber') ?>
                    </div>

                    <button type="submit" name="update" value="edit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url() . 'Crud/index' ?>" class="btn btn-dark">Cancel</a>

                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>