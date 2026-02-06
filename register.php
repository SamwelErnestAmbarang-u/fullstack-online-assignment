<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chakula Fasta | Usajili</title>
  <style>
    body { margin: 0; font-family: Arial, sans-serif; background: #f7f7f7; }
    header { background: #ff6b35; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    header h1 { margin: 0; }
    nav a { color: white; margin-left: 1rem; text-decoration: none; font-weight: bold; }
    .hero { padding: 3rem 2rem; text-align: center; background: white; }
    .hero h2 { font-size: 2rem; }
    .registration-form { background: white; padding: 2rem; margin: 2rem auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 500px; }
    .registration-form h2 { text-align: center; margin-bottom: 1.5rem; }
    .registration-form label { display: block; margin-top: 1rem; font-weight: bold; color: #333; }
    .registration-form input { width: 100%; padding: 0.7rem; margin-top: 0.3rem; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem; box-sizing: border-box; }
    .registration-form button { margin-top: 1.5rem; background: #ff6b35; border: none; color: white; padding: 0.8rem; border-radius: 6px; cursor: pointer; font-size: 1rem; width: 100%; font-weight: bold; }
    .registration-form button:hover { background: #e85c2a; }
    footer { background: #222; color: #ccc; text-align: center; padding: 1.5rem; margin-top: 2rem; }
    .form-note { font-size: 0.85rem; color: #666; margin-top: 0.2rem; }
    .login-link { text-align: center; margin-top: 1rem; }
    .login-link a { color: #ff6b35; text-decoration: none; }
    .login-link a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <header>
    <h1>🍔 Chakula Fasta</h1>
    <nav>
      <a href="home.php">Nyumbani</a>
      <a href="home.php#menu">Menyu</a>
      <a href="order.php">Oda</a>
      <a href="contactus.php">Mawasiliano</a>
    </nav>
  </header>

  <section class="hero">
    <h2>Jiunge nasi leo!</h2>
    <p>Jaza fomu ya usajili na ufurahie huduma zetu.</p>
  </section>

  <section class="registration-form">
    <h2>Fomu ya Usajili</h2>
    <form id="registrationForm">
      <label for="name">Jina Kamili</label>
      <input type="text" id="name" name="name" placeholder="Andika jina lako kamili" required>

      <label for="phone">Namba ya Simu</label>
      <input type="tel" id="phone" name="phone" placeholder="Mfano: 0712345678" required>
      <div class="form-note">Tumia mfumo: 0712345678 au +255712345678</div>

      <label for="email">Barua Pepe</label>
      <input type="email" id="email" name="email" placeholder="example@email.com" required>

      <label for="idnumber">Namba ya Usajili</label>
      <input type="text" id="idnumber" name="idnumber" placeholder="Mfano: 12.3456.01.01.2024" required>
      <div class="form-note">Mfumo: XX.XXXX.01.01.YYYY</div>

      <label for="password">Neno la Siri</label>
      <input type="password" id="password" name="password" placeholder="Andika neno la siri" required>
      <div class="form-note">Angalau herufi 4</div>

      <label for="confirmPassword">Thibitisha Neno la Siri</label>
      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Andika tena neno la siri" required>

      <button type="submit">Jisajili</button>
      
      <div class="login-link">
        <p>Tayari una akaunti? <a href="index.php">Ingia hapa</a></p>
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
    document.getElementById('registrationForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const name = document.getElementById('name').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const email = document.getElementById('email').value.trim();
      const idnumber = document.getElementById('idnumber').value.trim();
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if (!name || !phone || !email || !idnumber || !password) {
        alert('Tafadhali jaza sehemu zote!');
        return;
      }

      if (password !== confirmPassword) {
        alert('Maneno ya siri hayalingani!');
        return;
      }

      if (password.length < 4) {
        alert('Neno la siri lazima liwe na angalau herufi 4!');
        return;
      }

      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Inasajili...';
      submitBtn.disabled = true;

      try {
        const formData = new FormData();
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('email', email);
        formData.append('idnumber', idnumber);
        formData.append('password', password);
        formData.append('confirmPassword', confirmPassword);
        
        const response = await fetch('auth/register.php', {
          method: 'POST',
          body: formData
        });
        
        if (response.ok) {
          const data = await response.json();
          
          if(data.success) {
            alert(data.message);
            window.location.href = 'home.php';
          } else {
            alert(data.message);
          }
        } else {
          alert('Hitilafu ya mtandao');
        }
      } catch(error) {
        console.error(error);
        alert('Hitilafu imetokea. Tafadhali jaribu tena.');
      } finally {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    });

    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('confirmPassword');
    
    function checkPasswordMatch() {
      if (passwordField.value && confirmField.value) {
        if (passwordField.value !== confirmField.value) {
          confirmField.style.borderColor = 'red';
        } else {
          confirmField.style.borderColor = 'green';
        }
      } else {
        confirmField.style.borderColor = '#ccc';
      }
    }
    
    passwordField.addEventListener('input', checkPasswordMatch);
    confirmField.addEventListener('input', checkPasswordMatch);
  </script>
</body>
</html>