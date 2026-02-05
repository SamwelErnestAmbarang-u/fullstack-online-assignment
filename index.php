<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chakula Fasta | Ingia</title>
  <style>
    /* Keep your existing CSS styles */
    body { margin: 0; font-family: Arial, sans-serif; background: #f7f7f7; }
    header { background: #ff6b35; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    header h1 { margin: 0; }
    nav a { color: white; margin-left: 1rem; text-decoration: none; font-weight: bold; }
    .hero { padding: 3rem 2rem; text-align: center; background: white; }
    .hero h2 { font-size: 2rem; }
    .login-form { background: white; padding: 2rem; margin: 2rem auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 400px; }
    .login-form h2 { text-align: center; }
    .login-form label { display: block; margin-top: 0.7rem; cursor: pointer; }
    .login-form input { width: 100%; padding: 0.5rem; margin-top: 0.5rem; border-radius: 6px; border: 1px solid #ccc; }
    .login-form button { margin-top: 1rem; background: #ff6b35; border: none; color: white; padding: 0.7rem 1.5rem; border-radius: 6px; cursor: pointer; font-size: 1rem; width: 100%; }
    .login-form button:hover { background: #e85c2a; }
    .login-form .forgot-password { display: block; text-align: right; margin-top: 0.5rem; text-decoration: none; color: #ff6b35; font-size: 0.9rem; }
    .login-form .forgot-password:hover { text-decoration: underline; }
    .form-buttons { display: flex; gap: 10px; }
    .btn-register { 
      background: #4CAF50; 
      border: none; 
      color: white; 
      padding: 0.7rem 1.5rem; 
      border-radius: 6px; 
      cursor: pointer; 
      font-size: 1rem; 
      width: 100%;
      text-align: center;
      text-decoration: none;
      display: block;
      margin-top: 1rem;
    }
    .btn-register:hover { background: #45a049; }
    footer { background: #222; color: #ccc; text-align: center; padding: 1rem; margin-top: 2rem; }
    .alert {
      padding: 10px;
      margin: 10px 0;
      border-radius: 4px;
      text-align: center;
    }
    .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
  </style>
</head>
<body>
  <header>
    <h1>🍔 Chakula Fasta</h1>
    <nav>
      <a href="home.php">Nyumbani</a>
      <a href="#menu">Menyu</a>
      <a href="order.php">Oda</a>
      <a href="contactus.php">Mawasiliano</a>
    </nav>
  </header>

  <section class="hero">
    <h2>Ingia kwenye akaunti yako</h2>
    <p>Tumia username na password yako kuendelea.</p>
  </section>

  <section class="login-form">
    <h2>Login</h2>
    
    <?php if (isset($_GET['message'])): ?>
    
    <div class="alert alert-<?php echo isset($_GET['type']) ? $_GET['type'] : 'info'; ?>">
        <?php echo htmlspecialchars($_GET['message']); ?>
      </div>
    <?php endif; ?>
    
    <form id="loginForm" action="auth/login.php" method="POST">
      <label for="username">Username au Barua Pepe</label>
      <input type="text" id="username" name="username" placeholder="Andika username au email" required>

      <label for="password">Neno la Siri</label>
      <input type="password" id="password" name="password" placeholder="Andika neno la siri" required>

      <a href="#" class="forgot-password">Umesahau Neno la Siri?</a>

      <div class="form-buttons">
        <button type="submit" class="btn-login">Ingia</button>
        <a href="register.php" class="btn-register">Jisajili</a>
      </div>      
    </form>
  </section>

  <footer>
    <p><strong>Mawasiliano</strong></p>
    <p>📞 Simu: +255 712 345 678</p>
    <p>📧 Barua Pepe: chakulafasta@gmail.com</p>
    <p>© 2026 Chakula Fasta. Haki zote zimehifadhiwa.</p>
  </footer>

  <script>
    // AJAX login form submission
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      
      fetch('auth/login.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Store role in localStorage for frontend
          localStorage.setItem('role', data.data.role);
          // Redirect based on role
          if (data.data.role === 'admin') {
            window.location.href = 'admin/dashboard.php';
          } else {
            window.location.href = 'home.php';
          }
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Network error. Please try again.');
      });
    });
  </script>
</body>
</html>