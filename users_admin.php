<?php

class UserPage {
    private $conn;
    private $usersPerPage = 10;
    private $page;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    }

    public function handleDeleteUser() {
        if (isset($_GET['delete_user']) && is_numeric($_GET['delete_user'])) {
            $userIdToDelete = $_GET['delete_user'];
            $deleteUserQuery = mysqli_query($this->conn, "DELETE FROM users WHERE id = $userIdToDelete");

            if ($deleteUserQuery) {
                header("Location: $_SERVER[PHP_SELF]?page=$this->page");
                exit();
            } else {
                echo "Error deleting user: " . mysqli_error($this->conn);
            }
        }
    }

    public function getUsers() {
        $start = ($this->page - 1) * $this->usersPerPage;
        $selectUsers = mysqli_query($this->conn, "SELECT * FROM users ORDER BY created_at DESC LIMIT $start, $this->usersPerPage");
        return $selectUsers;
    }

    public function render() {
        $this->handleDeleteUser();

        $totalUsersQuery = mysqli_query($this->conn, "SELECT COUNT(id) as total FROM users");
        $totalUsers = mysqli_fetch_assoc($totalUsersQuery)['total'];
        $totalPages = ceil($totalUsers / $this->usersPerPage);

        $users = $this->getUsers();

        $this->renderHeader();
        $this->renderUsers($users);
        $this->renderPagination($totalPages);
        
    }

    private function renderHeader() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Signups</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    max-width: 800px;
                    margin: 15% auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h2 {
                    color: #000;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                    color: #000;
                }

                th {
                    background-color: #f2f2f2;
                }

                tbody tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                .pagination {
                    margin-top: 20px;
                    display: flex;
                    justify-content: center;
                }

                .pagination a {
                    padding: 8px;
                    margin: 0 5px;
                    text-decoration: none;
                    color: #000;
                    background-color: #dcdcdc;
                    border-radius: 4px;
                }

                .pagination a:hover {
                    background-color: #bbb;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <h2>User Signups</h2>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Signup Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
        <?php
    }

    private function renderUsers($users) {
        $count = ($this->page - 1) * $this->usersPerPage + 1;
        while ($row = mysqli_fetch_assoc($users)) {
            ?>
            <tr>
                <th><?php echo $count; ?></th>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo date('F j, Y g:i a', strtotime($row['created_at'])); ?></td>
                <td>
                    <a href="?page=<?php echo $this->page; ?>&delete_user=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')" style="text-decoration: none; color: red;">Delete</a>
                </td>
            </tr>
        <?php
            $count++;
        }
    }

    private function renderPagination($totalPages) {
        ?>
            </tbody>
            </table>

            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
        </body>
        </html>
        <?php
    }

}

include 'config.php';
include 'navbaradmin.php';

$userPage = new UserPage($conn);
$userPage->render();

$conn->close();

?>
