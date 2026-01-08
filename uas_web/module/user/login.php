<?php
session_start(); 

// Pastikan class Database sudah di-include jika file ini terpisah
// include 'Database.php';

$db = new Database();
$error_msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['username']; 
    $password = $_POST['password'];

    // Gunakan prepared statement di dunia nyata untuk keamanan (SQL Injection)
    $result = $db->query("SELECT * FROM users WHERE email = '$email'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['login'] = true;
        $_SESSION['nama']  = $user['nama'];
        $_SESSION['role']  = $user['role']; 

        if ($user['role'] === 'admin') {
            header("Location: /uas_web/home/index");
        } else {
            header("Location: /uas_web/home/indexuser");
        }
        exit();
    } else {
        $error_msg = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UAS WEBSITE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png'), linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        /* Menghilangkan sisa elemen template yang mungkin terpanggil */
        nav, aside, footer { display: none !important; }
    </style>
</head>
<body class="bg-white">

<div class="flex min-h-screen fixed inset-0 z-[9999] bg-white">
    <div class="hidden lg:flex lg:w-1/2 bg-pattern p-16 flex-col justify-between text-white relative overflow-hidden">
        <div class="relative z-10">
            <div class="text-4xl mb-8">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h1 class="text-6xl font-bold leading-tight">E - Artikel <br>System</h1>
            <p class="mt-6 text-lg text-blue-100 max-w-md leading-relaxed">
                Akses dashboard artikel dengan cepat dan aman. Pantau statistik dan kelola konten dalam satu genggaman.
            </p>
        </div>
        <div class="relative z-10 text-sm text-blue-200">
            © 2026 UAS Web Dev. All rights reserved.
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-16 bg-white overflow-y-auto">
        <div class="w-full max-w-md">
            <div class="lg:hidden mb-8 text-blue-600 text-3xl font-bold flex items-center gap-2">
                <i class="bi bi-shield-lock-fill"></i> Arthickellll
            </div>

            <div class="mb-10">
                <h3 class="text-3xl font-bold text-slate-800">Welcome Back!</h3>
                <p class="text-slate-500 mt-2">Masukan email dan password Anda.</p>
            </div>

            <?php if ($error_msg): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg flex items-center">
                    <i class="bi bi-exclamation-circle-fill mr-3"></i> <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-6">
                <div class="group border-b-2 border-slate-200 focus-within:border-blue-600 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Email</label>
                    <div class="flex items-center">
                        <i class="bi bi-envelope text-slate-400 mr-3"></i>
                        <input type="text" name="username" required placeholder="email@mail.com" 
                               class="w-full bg-transparent outline-none text-slate-800 font-medium placeholder:text-slate-300">
                    </div>
                </div>

                <div class="group border-b-2 border-slate-200 focus-within:border-blue-600 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Password</label>
                    <div class="flex items-center">
                        <i class="bi bi-lock text-slate-400 mr-3"></i>
                        <input type="password" id="passwordField" name="password" required placeholder="••••••••"
                               class="w-full bg-transparent outline-none text-slate-800 font-medium placeholder:text-slate-300">
                        <button type="button" onclick="togglePassword()" class="text-slate-400 hover:text-blue-600 transition-colors">
                            <i id="eyeIcon" class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="login" 
                        class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition-all active:scale-[0.98] shadow-lg shadow-blue-200 mt-4 flex justify-center items-center gap-2">
                    <span>Login Sekarang</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
            
            <p class="text-center mt-10 text-sm text-slate-500">
                Belum punya akun? <a href="/uas_web/user/register" class="text-blue-600 font-bold hover:underline">Daftar di sini</a>
            </p>

            <div class="mt-8 p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                <div class="flex items-center gap-2 mb-4 text-slate-600 border-b border-slate-200 pb-2">
                    <i class="bi bi-info-circle"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Akses Demo UAS</span>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-bold text-blue-600 uppercase mb-1">Login Admin</p>
                        <div class="bg-white p-2 rounded-lg border border-slate-100 shadow-sm flex justify-between items-center">
                            <span class="text-xs text-slate-600">admin2@gmail.com</span>
                            <span class="text-xs font-mono font-bold bg-slate-100 px-2 py-0.5 rounded">Password : admin</span>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-green-600 uppercase mb-1">Login User</p>
                        <div class="bg-white p-2 rounded-lg border border-slate-100 shadow-sm flex justify-between items-center">
                            <span class="text-xs text-slate-600">heri3@gmail.com</span>
                            <span class="text-xs font-mono font-bold bg-slate-100 px-2 py-0.5 rounded">Password : heri</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>

<script>
    // Fungsi untuk Show/Hide Password
    function togglePassword() {
        const passwordField = document.getElementById('passwordField');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }
</script>

</body>
</html>
