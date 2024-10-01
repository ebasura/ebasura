<?php
include_once 'init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}

// Sample array for demonstration. Replace this with actual database fetching logic.
$users = [
    ['id' => 1, 'username' => 'alcel', 'email' => 'alcel@example.com'],
    ['id' => 2, 'username' => 'marie', 'email' => 'marie@example.com']
];

// Handle form submissions for adding, editing, and deleting users here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            // Logic to add a user (insert into database)
        } elseif ($_POST['action'] === 'edit') {
            // Logic to edit a user (update database)
        } elseif ($_POST['action'] === 'delete') {
            // Logic to delete a user (delete from database)
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Settings | E-Basura Monitoring System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
}

.page-header {
    padding: 20px;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
}

.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    font-size: 1.5rem;
    font-weight: bold;
    background-color: #007bff;
    color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.table {
    margin-top: 20px;
    border-radius: 10px;
    overflow: hidden; /* Ensure the rounded corners are effective */
}

.table th {
    background-color: #343a40;
    color: white;
}

.table tbody tr:hover {
    background-color: #f1f1f1; /* Light gray on row hover */
}

.modal-content {
    border-radius: 10px;
}

.btn {
    border-radius: 5px;
}

    </style>
</head>
<body>
    <?php include __DIR__ . '/templates/topnav.php'; ?>
    <div id="layoutSidenav">
        <?php include __DIR__ . '/templates/sidenav.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-light border-bottom bg-light mb-4">
                    <div class="container-fluid px-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-light fa-users"></i></div>
                            User Settings
                        </h1>
                    </div>
                </header>

                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                            </div>
                            <table class="table table-hover" id="userTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr data-user-id="<?php echo $user['id']; ?>">
                                            <td><?php echo $user['id']; ?></td>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm edit-btn">Edit</button>
                                                <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="addUserForm" action="user-settings.php" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="addUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="addUsername" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="addEmail" name="email" required>
                                    </div>
                                    <input type="hidden" name="action" value="add">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editUserForm" action="user-settings.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" id="editUserId" name="user_id">
                                    <div class="mb-3">
                                        <label for="editUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="editUsername" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="editEmail" name="email" required>
                                    </div>
                                    <input type="hidden" name="action" value="edit">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete User Modal -->
                <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                                <form id="deleteUserForm" action="user-settings.php" method="POST">
                                    <input type="hidden" id="deleteUserId" name="user_id">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php include_once __DIR__ . '/templates/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Handle Edit button click
            $('.edit-btn').on('click', function() {
                const row = $(this).closest('tr');
                const userId = row.data('user-id');
                const username = row.find('td:eq(1)').text();
                const email = row.find('td:eq(2)').text();

                $('#editUserId').val(userId);
                $('#editUsername').val(username);
                $('#editEmail').val(email);

                $('#editUserModal').modal('show');
            });

            // Handle Delete button click
            $('.delete-btn').on('click', function() {
                const userId = $(this).closest('tr').data('user-id');
                $('#deleteUserId').val(userId);
                $('#deleteUserModal').modal('show');
            });
        });
    </script>
</body>
</html>
