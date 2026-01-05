<?php
session_start(); 

$db = new Database();
$error_msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['username']; 
    $password = $_POST['password'];

    $result = $db->query("SELECT * FROM users WHERE email = '$email'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['login'] = true;
        $_SESSION['nama']  = $user['nama'];
        $_SESSION['role']  = $user['role']; 

        if ($user['role'] === 'admin') {
            header("Location: /uas_web/home/index");
        } else if ($user['role'] === 'user') {
            header("Location: /uas_web/home/indexuser");
        }
        exit();
    } else {
        $error_msg = "Email atau password salah!";
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .bg-pattern {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        background-image: url('https://www.transparenttextures.com/patterns/cubes.png'), linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    }
    nav, aside, footer { display: none !important; }
</style>

<div class="flex min-h-screen bg-white fixed inset-0 z-[9999]">
    <div class="hidden lg:flex lg:w-1/2 bg-pattern p-16 flex-col justify-between text-white relative overflow-hidden">
        <div class="relative z-10">
            <div class="text-4xl mb-8">
                <i class="bi bi-shield-lock-fill animate-pulse"></i>
            </div>
            <h1 class="text-6xl font-bold leading-tight">Secure <br>Login</h1>
            <p class="mt-6 text-lg text-blue-100 max-w-md leading-relaxed">
                Silakan masuk untuk mengakses dashboard sesuai hak akses Anda (Admin/User).
            </p>
        </div>
        <div class="relative z-10 text-sm text-blue-200">
            © 2025 Lab Informatika. All rights reserved.
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16">
        <div class="w-full max-w-md">
            <h2 class="text-3xl font-bold text-slate-900 mb-2">EduDash</h2>
            
            <div class="mt-10 mb-8">
                <h3 class="text-2xl font-bold text-slate-800">Welcome Back!</h3>
                <p class="text-sm text-slate-500 mt-2">Masukan email dan password Anda.</p>
            </div>

            <?php if ($error_msg): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    <i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-6">
                <div class="border-b-2 border-slate-200 focus-within:border-blue-600 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Email / Username</label>
                    <input type="text" name="username" required placeholder="admin@mail.com" 
                           class="w-full bg-transparent outline-none text-slate-800 font-medium placeholder:text-slate-300">
                </div>

                <div class="border-b-2 border-slate-200 focus-within:border-blue-600 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full bg-transparent outline-none text-slate-800 font-medium placeholder:text-slate-300">
                </div>

                <button type="submit" name="login" 
                        class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition-all active:scale-[0.98] shadow-lg shadow-blue-200">
                    Login Now
                </button>
            </form>
            
            <p class="text-center mt-8 text-sm text-slate-500">
                Belum punya akun? <a href="/uas_web/user/register" class="text-blue-600 font-bold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>