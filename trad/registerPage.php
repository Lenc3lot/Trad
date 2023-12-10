<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Register</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="./style2.css" rel="stylesheet" />
</head>

<body>
    <header>
        <ul>
        <h1> Calamity traducteur </h1>
        </ul>
    </header>
    <div id="divConnexion">
        <h1>Espace d'inscription</h1>
        <form name="registerUser" method="POST" action="./scripts/createUser.php">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit">
        </form>
    </div>
</body>