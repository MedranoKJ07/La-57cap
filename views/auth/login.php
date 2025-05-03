<div class="body-login">
  <div class="screen-1">
    <div class="logo">
      <picture>
        <source srcset="/build/img/logo.avif" type="/avif">
        <source srcset="/build/img/logo.webp" type="image/webp">
        <img src="/build/img/logo.png" alt="Logo Principal">
      </picture>
    </div>
    <form class="formulario" method="POST" action="/login">
      <div class="email">
        <label for="email">Email Address</label>
        <div class="sec-2">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="email" name="email" placeholder="Ingrese Username o Email" />
        </div>
      </div>
      <div class="password">
        <label for="password">Password</label>
        <div class="sec-2">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input class="pas" type="password" name="password" placeholder="Ingrese password" />
          <ion-icon class="show-hide" name="eye-outline"></ion-icon>
        </div>
      </div>

      <input type="submit" class="login" value="Iniciar Sesión">
    </form>
    <div class="footer"><span>Sign up</span><span>Forgot Password?</span></div>
  </div>
</div>