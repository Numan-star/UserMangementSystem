<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>My Blog</title> -->
    <title><?php
            echo $title
            ?></title>


</head>

<body>
    <!-- <h1>Welcome to my Blog!</h1> -->
    <h1><?php
        echo $heading
        ?></h1>

    <ol>
        <?php foreach ($todo_list as $item) : ?>

            <li><?php echo $item; ?></li>

        <?php endforeach; ?>
    </ol>

</body>

</html>