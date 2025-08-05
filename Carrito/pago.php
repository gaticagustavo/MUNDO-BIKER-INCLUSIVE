<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pago - VORT-X</title>
  <link rel="shortcut icon" href="log.jpg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    :root {
      --primary: #e63946;
      --secondary: #1d3557;
      --accent: #ff9a00;
      --dark: #121212;
      --light: #f8f9fa;
    }

    body {
      background: var(--dark);
      color: var(--light);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      padding: 2rem 0;
      text-align: center;
    }

    .header h1 {
      color: white;
      font-size: 2.2rem;
    }

    .payment-container {
      max-width: 600px;
      margin: 2rem auto;
      background: #1e1e1e;
      padding: 2rem;
      border-radius: 10px;
    }

    .footer {
      background: #0a0a0a;
      color: white;
      padding: 3rem 1rem;
      text-align: center;
      margin-top: 3rem;
    }
  </style>
</head>
<body>
  <header class="header">
    <h1><i class="fas fa-credit-card"></i> Pago</h1>
  </header>

  <main>
    <div class="payment-container">
      <h2>Información de Pago</h2>
      <form id="paymentForm">
        <div class="mb-3">
          <label for="name" class="form-label">Nombre Completo</label>
          <input type="text" class="form-control" id="name" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" class="form-control" id="email" required />
        </div>
        <div class="mb-3">
          <label for="cardNumber" class="form-label">Número de Tarjeta</label>
          <input type="text" class="form-control" id="cardNumber" required />
        </div>
        <div class="mb-3">
          <label for="expiryDate" class="form-label">Fecha de Expiración (MM/AA)</label>
          <input type="text" class="form-control" id="expiryDate" required />
        </div>
        <div class="mb-3">
          <label for="cvv" class="form-label">CVV</label>
          <input type="text" class="form-control" id="cvv" required />
        </div>
        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
      </form>
      <div id="errorMessage" class="text-danger mt-3" style="display: none;"></div>
    </div>
  </main>

  <footer class="footer">
    <p>© 2023 VORT-X Cuatrimotos. Todos los derechos reservados.</p>
  </footer>
  <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>

   <script>
    // Iniciar la sesión PHP para acceder a las variables de sesión
    <?php session_start(); ?>
    // Verificar si el usuario está logueado usando la variable de sesión
    let isLoggedIn = <?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? 'true' : 'false'; ?>;
    // Configurar el botón de PayPal
    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '10.00' // Cambia esto al monto real que deseas cobrar
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Pago procesado exitosamente por ' + details.payer.name.given_name);
          // Aquí puedes redirigir al usuario a una página de confirmación o limpiar el carrito
          localStorage.removeItem('cart'); // Limpiar el carrito
          window.location.href = '../index.html'; // Redirigir a la página principal
        });
      },onCancel: function(data) {
        alert('El pago ha sido cancelado.');
      },
      onError: function(err) {
        console.error(err);
        alert('Ocurrió un error durante el procesamiento del pago.');
      }
    }).render('#paypal-button-container'); // Renderizar el botón en el contenedor
    // Verificar si el usuario está logueado antes de permitir el pago
    if (!isLoggedIn) {
      document.getElementById('errorMessage').innerText = 'Por favor, inicia sesión para continuar con tu compra.';
      document.getElementById('errorMessage').style.display = 'block';
      document.getElementById('paypal-button-container').style.display = 'none'; // Ocultar el botón de PayPal
    }
  </script>
</body>
</html>
