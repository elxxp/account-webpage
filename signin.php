<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah file users.txt ada
    if (!file_exists('users.txt')) {
        echo "Tidak ada pengguna yang terdaftar. Silakan <a href='index.html'>Sign Up</a>.";
        exit;
    }

    // Baca data pengguna dari file
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    // Cek kredensial pengguna
    $login_success = false;
    foreach ($users as $user) {
        list($stored_username, $stored_password) = explode(',', $user);
        if ($stored_username == $username && $stored_password == $password) {
            $login_success = true;
            break;
        }
    }

    // Tampilkan pesan berdasarkan hasil login
    if ($login_success) {
        echo "Login berhasil! Selamat datang, $username.";
    } else {
        echo "Username atau password salah. Silakan <a href='index.html'>coba lagi</a>.";
    }
} else {
    echo "Data tidak lengkap. Silakan <a href='index.html'>coba lagi</a>.";
}
?>
