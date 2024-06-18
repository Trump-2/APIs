<?php
if (!empty($_GET['name'])) {

    // $response = file_get_contents("https://example.com");
    $response = file_get_contents("https://api.agify.io?name={$_GET['name']}");

    $data = json_decode($response, true);

    // var_dump($data);

    $age = $data['age'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example</title>
</head>

<body>

</body>
<?php
if (isset($age)) : ?>
    Age: <?= $age ?>
<?php endif; ?>

<form action="">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <button>Guess age</button>
</form>

</html>