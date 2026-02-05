<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chakula Fasta | Usajili</title>
  <style>
    /* Your existing CSS from register.html */
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
      <!-- Your existing form fields -->
      
      <button type="submit">Jisajili</button>
    </form>
  </section>

  <footer>
    <p><strong>Mawasiliano</strong></p>
    <p>📞 Simu: +255 712 345 678</p>
    <p>📧 Barua Pepe: chakulafasta@gmail.com</p>
    <p>© 2026 Chakula Fasta. Haki zote zimehifadhiwa.</p>
  </footer>

  <script>
    const form = document.getElementById('registrationForm');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if(password !== confirmPassword){
        alert('Maneno ya siri hayalingani!');
        return;
      }

      // Send registration data to PHP
      const formData = new FormData(form);
      
      try {
        const response = await fetch('auth/register.php', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if(data.success) {
          alert('Usajili umefanikiwa! Karibu Chakula Fasta.');
          window.location.href = 'index.php';
        } else {
          alert('Error: ' + data.message);
        }
      } catch(error) {
        console.error('Error:', error);
        alert('Network error. Please try again.');
      }
    });
  </script>
</body>
</html>