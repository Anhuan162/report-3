<?php
$rows = db_query("select * from artists order by id asc");
// Kiểm tra xem truy vấn đã thành công hay không
if ($rows !== false && is_array($rows)) {
    $count = count($rows); // Lấy số lượng hàng trả về
} else {
    $count = 0; // Nếu truy vấn không thành công hoặc không có hàng nào được trả về
}
$artists = [];

// Kiểm tra xem có dữ liệu trả về hay không
if ($rows !== false && is_array($rows)) {
    // Khởi tạo mảng mới để lưu trữ dữ liệu theo cấu trúc mong muốn

    // Lặp qua các hàng trong mảng $rows
    foreach ($rows as $row) {
        // Tạo một mảng mới chứa thông tin của mỗi bài hát
        $artist = [
            'id' => $row['id'],
            'name' => $row['name'],
            'image' => $row['image']
        ];

        // Thêm mảng của artist vào mảng users
        $artists[] = $artist;
    }

} else {
    // Xử lý trường hợp không có dữ liệu trả về
    echo "No artists found.";
}


print(json_encode($artists));


?>