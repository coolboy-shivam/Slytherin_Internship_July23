<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* CSS styles for the admin panel */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        h1 {
            margin: 0;
            text-align: center;
        }

        section {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table tr:hover{
            background-color: #addfed;
        }

        table th {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Admin Panel</h1>
    </header>

    <section id="users">
        <h2>Registered Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <?php
            // Database configuration for users table
            $usersHost = "localhost";
            $usersUsername = "root";
            $usersPassword = "";
            $usersDBName = "users1";

            // Create a new PDO instance for users table
            try {
                $usersPDO = new PDO("mysql:host=$usersHost;dbname=$usersDBName", $usersUsername, $usersPassword);
                $usersPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetch user details from the database
                $usersStmt = $usersPDO->query("SELECT * FROM users");
                while ($row = $usersStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['mail'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                die("Oops! Something went wrong: " . $e->getMessage());
            }
            ?>
        </table>
    </section>

    <footer>
        <p>Logged in as Admin</p>
    </footer>
</body>
</html>
