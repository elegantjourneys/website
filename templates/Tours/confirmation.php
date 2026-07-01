<style>
  h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
  }

  .checkicon {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
  }
</style>
<section class="heroSection w-100 py-3">
  <span class="d-block small text-secondary py-3 custom-inline-padding">Home > Confirmation</span>

</section>
<section class="mb-3 py-4 text-center">
      <div class="card">

      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">

        <i class="checkmark checkicon">✓</i>

      </div>

        <h1><?=$confirmationPageParameter['title'];?></h1> 

        <?=$confirmationPageParameter['description'];?>

      </div>
  

</section>