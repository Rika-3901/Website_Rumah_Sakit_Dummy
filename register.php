<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MediCare Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #eaf2ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 1100px;
            height: 650px;
            background: white;
            border-radius: 25px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }

        .left {
            width: 45%;
            position: relative;
            overflow: hidden;
        }

        .left h1 {
            font-size: 35px;
            line-height: 45px;
            margin-bottom: 40px;
            color: #222;
        }

        .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: flex-end;
            padding: 40px;
            background: linear-gradient(rgba(0, 0, 0, .15), rgba(0, 0, 0, .55));
        }

        .overlay h1 {
            color: #fff;
            font-size: 38px;
            line-height: 50px;
            font-weight: 700;
            text-shadow: 0 4px 10px rgba(0, 0, 0, .4);
        }

        .right {
            width: 55%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 70px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 20px;
        }

        .subtitle {
            color: gray;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 15px;
        }

        input:focus {
            border-color: #2563eb;
        }

        button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .login {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="left">
            <img src="image/hospital_doctor.jpeg" alt="Doctor">
            <div class="overlay">
                <h1>Langkah Mudah Menuju Hidup Sehat Bersama MediCare</h1>
            </div>
        </div>

        <div class="right">
            <div class="logo">
                <i class="fa-solid fa-hand-holding-medical"></i> MediCare Hospital
            </div>
            
            <h2>Register</h2>
            <div class="subtitle">Buat akun terlebih dahulu</div>

            <form action="proses_register.php" method="POST">
                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan Username" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>

                <button type="submit">Daftar</button>
            </form>

            <div class="login">
                Sudah punya akun? <a href="login_page.php">Login</a>
            </div>
        </div>
    </div>

</body>
</html>