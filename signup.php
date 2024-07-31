<?php
if (isset($_POST['new_username']) && isset($_POST['new_password'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Cek apakah file users.txt sudah ada, jika belum maka buat file baru
    if (!file_exists('users.txt')) {
        $file = fopen('users.txt', 'w');
        fclose($file);
    }

    // Baca data pengguna dari file
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    // Cek apakah username sudah terdaftar
    $username_exists = false;
    foreach ($users as $user) {
        list($username, $password) = explode(',', $user);
        if ($username == $new_username) {
            $username_exists = true;
            break;
        }
    }

    // Jika username belum terdaftar, simpan data pengguna baru
    if (!$username_exists) {
        $file = fopen('users.txt', 'a');
        fwrite($file, $new_username . ',' . $new_password . PHP_EOL);
        fclose($file);
        echo "Sign-up berhasil! Anda sekarang dapat <a href='index.html'>Sign In</a>.";
    } else {
        echo "Username sudah terdaftar. Silakan pilih username lain.";
    }
} else {
    echo "Data tidak lengkap. Silakan <a href='index.html'>coba lagi</a>.";
}
?>
