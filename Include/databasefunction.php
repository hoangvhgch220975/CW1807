<?php
// databasefunction.php

// Bao gồm file database.php để có thể sử dụng biến $pdo
require_once 'database.php';

/**
 * Lấy tất cả các thiết bị từ bảng devices.
 *
 * @return array|false Trả về mảng thiết bị nếu thành công, hoặc false nếu thất bại.
 */
// Hàm lấy tất cả thiết bị (devices)
// Hàm lấy tất cả thiết bị (devices)
function getAllDevices($search = '')
{
    global $pdo;

    try {
        // Bắt đầu câu lệnh SQL cơ bản
        $sql = "SELECT * FROM devices";

        // Nếu có từ khóa tìm kiếm, thêm điều kiện WHERE
        if ($search) {
            $sql .= " WHERE name LIKE :search";
        }

        // Chuẩn bị câu lệnh SQL
        $stmt = $pdo->prepare($sql);

        // Nếu có tìm kiếm, gán giá trị cho tham số tìm kiếm
        if ($search) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }

        // Thực thi câu lệnh SQL
        $stmt->execute();

        // Trả về tất cả kết quả dưới dạng mảng liên kết
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Nếu có lỗi, in ra thông báo lỗi
        echo "Error: " . $e->getMessage();
        return [];
    }
}
// Hàm lấy tất cả gói sản phẩm (packages) với khả năng tìm kiếm
function getAllPackages($searchQuery = '')
{
    global $pdo;

    try {
        // Bắt đầu câu lệnh SQL cơ bản
        $sql = "SELECT * FROM package";

        // Nếu có từ khóa tìm kiếm, thêm điều kiện WHERE
        if ($searchQuery) {
            $sql .= " WHERE name LIKE :searchQuery";
        }

        // Chuẩn bị câu lệnh SQL
        $stmt = $pdo->prepare($sql);

        // Nếu có tìm kiếm, gán giá trị cho tham số tìm kiếm
        if ($searchQuery) {
            $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
        }

        // Thực thi câu lệnh SQL
        $stmt->execute();

        // Trả về tất cả kết quả dưới dạng mảng liên kết
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Nếu có lỗi, in ra thông báo lỗi
        echo "Error: " . $e->getMessage();
        return [];
    }
}

// Hàm lấy tất cả dịch vụ (services) với khả năng tìm kiếm
function getAllServices($searchQuery = '')
{
    global $pdo;

    try {
        $sql = "SELECT * FROM service";

        // Nếu có từ khóa tìm kiếm, thêm điều kiện WHERE
        if ($searchQuery) {
            $sql .= " WHERE name LIKE :searchQuery";
        }

        $stmt = $pdo->prepare($sql);

        // Nếu có tìm kiếm, gán giá trị cho tham số tìm kiếm
        if ($searchQuery) {
            $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getPhones($searchQuery = '')
{
    global $pdo;

    // Truy vấn lấy các sản phẩm với category = 'Phone'
    $query = "SELECT * FROM devices WHERE category = 'Phone'";

    // Nếu có searchQuery, lọc thêm theo tên sản phẩm
    if ($searchQuery) {
        $query .= " AND name LIKE :searchQuery";
    }

    $stmt = $pdo->prepare($query);

    // Gắn giá trị cho biến searchQuery nếu có
    if ($searchQuery) {
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

function getTablets($searchQuery = '')
{
    global $pdo;

    // Truy vấn lấy các sản phẩm với category = 'Tablet'
    $query = "SELECT * FROM devices WHERE category = 'Tablet'";

    // Nếu có searchQuery, lọc thêm theo tên sản phẩm
    if ($searchQuery) {
        $query .= " AND name LIKE :searchQuery";
    }

    $stmt = $pdo->prepare($query);

    // Gắn giá trị cho biến searchQuery nếu có
    if ($searchQuery) {
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
    }

    $stmt->execute();
    return $stmt->fetchAll();
}
function getRouters($searchQuery = '')
{
    global $pdo;

    // Truy vấn lấy các sản phẩm với category = 'Router'
    $query = "SELECT * FROM devices WHERE category = 'Router'";

    // Nếu có searchQuery, lọc thêm theo tên sản phẩm
    if ($searchQuery) {
        $query .= " AND name LIKE :searchQuery";
    }

    $stmt = $pdo->prepare($query);

    // Gắn giá trị cho biến searchQuery nếu có
    if ($searchQuery) {
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

function getNewReleases($limit = 5)
{
    global $pdo; // Đảm bảo bạn đã khai báo PDO kết nối cơ sở dữ liệu

    // Truy vấn chọn các sản phẩm mới nhất dựa trên device_id
    $query = "SELECT * FROM devices ORDER BY device_id DESC LIMIT :limit";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    // Trả về danh sách sản phẩm mới nhất
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function login($pdo, $username, $password)
{
    global $pdo;

    // Truy vấn để lấy thông tin tài khoản
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    return $stmt->fetch();
}

function checkUsernameExists($pdo, $username)
{
    $stmt = $pdo->prepare("SELECT 1 FROM accounts WHERE username = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->rowCount() > 0;
}

function getUser($pdo, $account_id)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM user_info WHERE account_id = :account_id');
        $stmt->execute([':account_id' => $account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception('Error fetching user details: ' . $e->getMessage());
    }
}


function registerUser($pdo, $username, $password, $role)
{
    // Check if username already exists
    $stmtCheck = $pdo->prepare('SELECT COUNT(*) FROM accounts WHERE username = ?');
    $stmtCheck->execute([$username]);
    if ($stmtCheck->fetchColumn() > 0) {
        return 'duplicate'; // Username already exists
    }

    // Prepare the SQL statement
    $stmt = $pdo->prepare('INSERT INTO accounts (username, password, role) VALUES (?, ?, ?)');

    // Execute the statement with the provided user data
    $result = $stmt->execute([$username, $password, $role]);

    // Check if the execution was successful and return the last inserted ID if true
    if ($result) {
        return $pdo->lastInsertId(); // Return the ID of the inserted user
    } else {
        return false; // Return false if insertion failed
    }
}

function validatePassword($password)
{
    $pattern = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[\W_]).{8,}$/';
    return preg_match($pattern, $password);
}


// Function to get a specific device by ID
function getDeviceById($id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("
        SELECT devices.*, rating.star_rating from devices
        LEFT JOIN rating ON devices.rating_id = rating.id
        WHERE device_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function getServiceById($id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("
        SELECT service.*, rating.star_rating from service
        LEFT JOIN rating ON service.rating_id = rating.id
        WHERE service_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
// Function to get service detail by ID
function getServiceDetailsById($id)
{
    global $pdo;

    try {
        // Query to fetch the detailed service information from service_detail
        $stmt = $pdo->prepare("
            SELECT * FROM service_detail
            WHERE service_id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getPackageById($id)
{
    global $pdo;

    try {
        // Adjust the query to fetch call_minutes, sms_count, data_volume from the package_detail table
        $stmt = $pdo->prepare("
            SELECT package.*, package_detail.call_minutes, package_detail.sms_count, package_detail.data_volume, package_detail.device_include, rating.star_rating
            FROM package
            LEFT JOIN package_detail ON package.package_id = package_detail.package_id
            LEFT JOIN rating ON package.rating_id = rating.id
            WHERE package.package_id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getAllComments()
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM rating");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

