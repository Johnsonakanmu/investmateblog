<?php
// Database connection
$servername = "localhost";
$username = "investimate";
$password = "Admin.4****";
$dbname = "investmate_admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$uploadDir ='C:/Users/JIDE/Desktop/femi/documents/';
// Directory for file uploads
define('UPLOAD_DIR', $uploadDir);


// File Retrieval Function
function getFileUrl($fileName) {
    global $uploadDir;
    // URL of the file based on the upload directory
    $uploadUrl = $uploadDir . $fileName;
    return $uploadUrl;
}


// Read File Function
function readFileContent($filePath) {
    if (file_exists($filePath)) {
        // Get the file content
        $fileContent = file_get_contents($filePath);

        // Encode the file content in base64
        $base64Content = base64_encode($fileContent);

        // Get the MIME type of the file
        $mimeType = mime_content_type($filePath);

        // Return the base64 image string
        return 'data:' . $mimeType . ';base64,' . $base64Content;
    } else {
        throw new Exception("File not found.");
    }
}

function listPosts() {
    global $conn;

    $stmt = $conn->prepare("
        SELECT posts.*, users.username, users.email, users.profile_picture_url, users.first_name, users.last_name
        FROM posts
        JOIN users ON posts.user_id = users.user_id order by posts.category
    ");

    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $posts;
}
function formatDate($dateString) {
    $date = new DateTime($dateString);
    $formattedDate = $date->format('M jS y');

    return $formattedDate;
}
function listPaginatedPosts($limit = 10, $offset = 0) {
    global $conn;

    // Prepare the SQL statement with ORDER BY and LIMIT clauses
    $stmt = $conn->prepare("
        SELECT posts.*, users.username, users.email, users.first_name, users.last_name
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        ORDER BY posts.created_at DESC
        LIMIT ? OFFSET ?
    ");

    // Bind the parameters for LIMIT and OFFSET
    $stmt->bind_param("ii", $limit, $offset);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all posts
    $posts = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    return $posts;
}

function listPostsByCategory($category) {
    global $conn;

    // SQL query to fetch posts by category
    $sql = "
        SELECT posts.*, users.username, users.email, users.first_name, users.last_name
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        WHERE posts.category = ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param('s', $category);

    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $posts;
}
function listPostsByCaption($caption) {
    global $conn;

    // SQL query to fetch posts by caption
    $sql = "
        SELECT posts.*, users.username, users.email, users.first_name, users.last_name
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        WHERE posts.caption LIKE ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter with wildcards for partial matching
    $searchTerm = "%$caption%";
    $stmt->bind_param('s', $searchTerm);

    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $posts;
}


function getPostById($post_id) {
    global $conn;

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("
        SELECT posts.*, users.username, users.first_name, users.last_name
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        WHERE posts.post_id = ?
    ");

    // Bind the parameter
    $stmt->bind_param("i", $post_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the post data along with user details
    $post = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    return $post;
}

// Close connection
function closeConnection() {
    global $conn;
    $conn->close();
}

?>