<?php
$rows = db_query("select * from songs order by id asc");
// Kiểm tra xem truy vấn đã thành công hay không
if ($rows !== false && is_array($rows)) {
    $count = count($rows); // Lấy số lượng hàng trả về
} else {
    $count = 0; // Nếu truy vấn không thành công hoặc không có hàng nào được trả về
}
$songs = [];

// Kiểm tra xem có dữ liệu trả về hay không
if ($rows !== false && is_array($rows)) {
    // Khởi tạo mảng mới để lưu trữ dữ liệu theo cấu trúc mong muốn

    // Lặp qua các hàng trong mảng $rows
    foreach ($rows as $row) {
        // Tạo một mảng mới chứa thông tin của mỗi bài hát
        $song = [
            'id' => $row['id'],
            'title' => $row['title'],
            'image' => $row['image'],
            'category' => get_category($row['category_id']),
            'artist' => get_artist($row['artist_id']),
            'file' => $row['file'],
            'slug' => $row['slug']
        ];

        // Thêm mảng của bài hát vào mảng songs
        $songs[] = $song;
    }

} else {
    // Xử lý trường hợp không có dữ liệu trả về
    echo "No songs found.";
}


print(json_encode($songs));


?>