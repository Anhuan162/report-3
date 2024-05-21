<?php
$rows = db_query("select * from users order by id asc");
// Kiểm tra xem truy vấn đã thành công hay không
if ($rows !== false && is_array($rows)) {
    $count = count($rows); // Lấy số lượng hàng trả về
} else {
    $count = 0; // Nếu truy vấn không thành công hoặc không có hàng nào được trả về
}
$users = [];

// Kiểm tra xem có dữ liệu trả về hay không
if ($rows !== false && is_array($rows)) {
    // Khởi tạo mảng mới để lưu trữ dữ liệu theo cấu trúc mong muốn

    // Lặp qua các hàng trong mảng $rows
    foreach ($rows as $row) {
        // Tạo một mảng mới chứa thông tin của mỗi bài hát
        $user = [
            'id' => $row['id'],
            'username' => $row['username'],
            'email' => $row['email'],
            'role' => $row['role'],
            'date' => $row['date']
        ];

        // Thêm mảng của user vào mảng users
        $users[] = $user;
    }

} else {
    // Xử lý trường hợp không có dữ liệu trả về
    echo "No users found.";
}


print(json_encode($users));


?>