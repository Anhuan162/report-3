<?php
$rows = db_query("select * from categories order by id asc");
// Kiểm tra xem truy vấn đã thành công hay không
if ($rows !== false && is_array($rows)) {
    $count = count($rows); // Lấy số lượng hàng trả về
} else {
    $count = 0; // Nếu truy vấn không thành công hoặc không có hàng nào được trả về
}
$categories = [];

// Kiểm tra xem có dữ liệu trả về hay không
if ($rows !== false && is_array($rows)) {
    // Khởi tạo mảng mới để lưu trữ dữ liệu theo cấu trúc mong muốn

    // Lặp qua các hàng trong mảng $rows
    foreach ($rows as $row) {
        // Tạo một mảng mới chứa thông tin của mỗi bài hát
        $category = [
            'id' => $row['id'],
            'category' => $row['category'],
            'disabled' => $row['disabled'] ? 'No':'Yes' ,
            'area' => get_area($row['area_id'])
        ];

        // Thêm mảng của category vào mảng users
        $categories[] = $category;
    }

} else {
    // Xử lý trường hợp không có dữ liệu trả về
    echo "No categories found.";
}


print(json_encode($categories));


?>