<style>
  .whatsapp-button {
    position: fixed;
    bottom: 30px;
    left: 50px;
    z-index: 9999;
    background-color: #25d366;
    border-radius: 50px;
    color: #ffffff;
    text-decoration: none;
    width: 50px;
    height: 50px;
    font-size: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    -webkit-box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    /*animation: effect 5s infinite ease-in;*/
    animation-name: pulse;
    animation-duration: 1.5s;
    animation-timing-function: ease-out;
    animation-iteration-count: infinite;
  }

  @keyframes effect {

    20%,
    100% {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }

    0%,
    10% {
      width: 55px;
      height: 55px;
      font-size: 35px;
    }

    5% {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }
  }

  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
    }

    80% {
      box-shadow: 0 0 0 14px rgba(37, 211, 102, 0);
    }
  }
</style>

<a target="_blank" href="https://api.whatsapp.com/send?phone=919811539696&text=" class="whatsapp-button"><i class="fa-brands fa-whatsapp"></i></a>
<script>  $(document).ready(function () {    setTimeout(function () {      $('html, body').animate({ scrollTop: 400 }, 'slow');    }, 2500);   });</script>
