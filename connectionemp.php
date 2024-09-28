<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Employé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
    <h2>Connexion Employé</h2>
    <form action="connectionemployer.php" method="post">
        <div>
            <label for="employee_nom">Nom :</label>
            <input type="text" id="employee_nom" name="employee_nom" required>
        </div>
        <div>
            <label for="employee_prenom">Prénom :</label>
            <input type="text" id="employee_prenom" name="employee_prenom" required>
        </div>
        <div>
            <label for="date_naiss">Date de Naissance :</label>
            <input type="date" id="date_naiss" name="date_naiss" required>
        </div>
        <div>
            <input type="submit" value="Se Connecter">
        </div>
    </form>
    </div>
</body>
</html>