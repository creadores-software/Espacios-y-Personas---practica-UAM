
<template>
  <div class="footer-dark">
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3 item">
            <h3>Contáctanos</h3>
            <ul>
              <li>01-8000-510123</li>
              <li>(606) 8727272 - 8727709 Ext: 102 - 110 - 144</li>
              <li>+57 312 7679859 - 317 8940741</li>
              <li>servicioalcliente@autonoma.edu.co</li>
              <li>notificacionesyconsultas@autonoma.edu.co</li>
            </ul>
          </div>
          <div class="col-sm-6 col-md-3 item">
            <h3>Acerca de</h3>
            <ul>
              <li><a href="#">Uam</a></li>
            </ul>
          </div>
          <div class="col-md-6 item text">
            <h3>Universidad Autónoma de Manizales</h3>
            <p>
              🎓 Somos expertos en educar, inspirar e innovar para mejorar la región y el mundo. <br>
            Vigilada Mineducación
            </p>
          </div>
          <div class="col item social">
            <a href="https://web.facebook.com/UAMManizales"><i class="icon ion-social-facebook"></i></a
            ><a href="https://twitter.com/uammanizales"><i class="icon ion-social-twitter"></i></a
            ><a href="https://www.instagram.com/uammanizales/"><i class="icon ion-social-instagram"></i></a>
          </div>
        </div>
        <p class="copyright">Universidad Autónoma de Manizales © 2018</p>
      </div>
    </footer>
  </div>
</template>


<style scoped>
.footer-dark {
  padding: 50px 0;
  color: #f0f9ff;
  background-color: #282d32;
}

.footer-dark h3 {
  margin-top: 0;
  margin-bottom: 12px;
  font-weight: bold;
  font-size: 16px;
}

.footer-dark ul {
  padding: 0;
  list-style: none;
  line-height: 1.6;
  font-size: 14px;
  margin-bottom: 0;
}

.footer-dark ul a {
  color: inherit;
  text-decoration: none;
  opacity: 0.6;
}

.footer-dark ul a:hover {
  opacity: 0.8;
}

@media (max-width: 767px) {
  .footer-dark .item:not(.social) {
    text-align: center;
    padding-bottom: 20px;
  }
}

.footer-dark .item.text {
  margin-bottom: 36px;
}

@media (max-width: 767px) {
  .footer-dark .item.text {
    margin-bottom: 0;
  }
}

.footer-dark .item.text p {
  opacity: 0.6;
  margin-bottom: 0;
}

.footer-dark .item.social {
  text-align: center;
}

@media (max-width: 991px) {
  .footer-dark .item.social {
    text-align: center;
    margin-top: 20px;
  }
}

.footer-dark .item.social > a {
  font-size: 20px;
  width: 36px;
  height: 36px;
  line-height: 36px;
  display: inline-block;
  text-align: center;
  border-radius: 50%;
  box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
  margin: 0 8px;
  color: #fff;
  opacity: 0.75;
}

.footer-dark .item.social > a:hover {
  opacity: 0.9;
}

.footer-dark .copyright {
  text-align: center;
  padding-top: 24px;
  opacity: 0.3;
  font-size: 13px;
  margin-bottom: 0;
}
</style>