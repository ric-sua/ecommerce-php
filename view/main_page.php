<?php include("header.php");
?>
<!-- slideshow of product news -->
<div class="slide">
  <div class="uk-card uk-card-default uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-slideshow="animation: pull; autoplay: true; autoplay-interval: 10000; pause-on-hover: true; ratio: 200:89">

    <ul class="uk-slideshow-items">
      <li>
      <a href="/products&filter=Chromebook"><img src="view/images/acerspin.jpg" alt="" uk-cover></a>
      </li>
      <li>
      <a href="/products&filter=Gaming"><img src="view/images/nitro.jpg" alt="" uk-cover></a>
      </li>
      <li>
      <a href="/products&filter=Ultrabook"><img src="view/images/dell.jpg" alt="" uk-cover></a>
      </li>
    </ul>

    <a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
  </div>
</div>

<!-- all best products currently on sale using cards css -->
<div class="cont">
  <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin ty" uk-grid >
    <div class="uk-card-media-left uk-cover-container">
    <a href="/products&filter=Chromebook"><img src="view/images/acerspin.jpg" alt="" uk-cover uk-parallax="bgy: -200"></a>
      <canvas width="600" height="400"></canvas>
    </div>
    <div>
      <div class="uk-card-body">
        <h3 class="uk-card-title"><a href="/products&filter=Chromebook">Acer Spin 311</a></h3>
        <p>Get the latest chromebook from acer now 5% off!! </p>
      </div>
    </div>
  </div>

  <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin ty" uk-grid >
    <div class="uk-flex-last@s uk-card-media-right uk-cover-container" >
    <a href="/products&filter=Gaming"><img loading="lazy" src="view/images/nitro.jpg" alt="" uk-cover uk-parallax="bgy: -200"></a>
      <canvas width="600" height="400"></canvas>
    </div>
    <div>
      <div class="uk-card-body">
        <h3 class="uk-card-title"><a href="/products&filter=Gaming">Shop Gaming</a></h3>
        <p>Get the best performance from your laptop from these latest Gaming Laptops!!</p>
      </div>
    </div>
  </div>
  <a href="/products&filter=Ultrabook"> <div class="uk-height-large uk-background-cover uk-light" uk-parallax="bgy: -100" loading="lazy" style="background-image: url('view/images/dell.jpg');">
</div></a>

<div class="uk-child-width-1-1 uk-grid-match uk-margin" uk-grid>
  <div>
  <div class="uk-child-width-1-2" uk-grid>
    <div>
    <div class="uk-child-width-1-2@m" uk-grid>
    <div>
    <div>
    <a href="/products&filter=Acer"><div class="uk-height-small uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light brands" uk-img>
      <h1>Acer</h1>
    </div></a>
        </div>
      </div>
      <div>
       <div>
       <a href="/products&filter=Dell"><div class="uk-height-small uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light brands" uk-img>
      <h1>Dell</h1>
    </div></a>
        </div>
</div>
</div>
</div>
        <div>
          <div class="uk-child-width-1-2@m" uk-grid>
            <div>
            <a href="/products&filter=Asus"> <div class="uk-height-small uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light brands" uk-img>
          <h1>Asus</h1>
        </div></a>
            </div>
            <div>
            <a href="/products&filter=Lenovo"><div class="uk-height-small uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light brands" uk-img>
          <h1>Lenovo</h1>
        </div></a>
            </div>
          </div>
        </div>
  </div>
</div>
</div>


</div>

<!-- <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Search"
              aria-label="Search"
              aria-describedby="button-addon2"
            />
            <div class="input-group-append">
              <button
                class="btn btn-outline-secondary"
                type="button"
                id="button-addon2"
              >
                <svg
                  width="1em"
                  height="1em"
                  viewBox="0 0 16 16"
                  class="bi bi-search"
                  fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"
                  />
                  <path
                    fill-rule="evenodd"
                    d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"
                  />
                </svg>
              </button>
            </div>
          </div>
-->

<!-- <div class="row no-gutters justify-content-md-center">
      <div class="col-sm-10" style="margin-top: 20px;">
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              data-target="#carouselExampleIndicators"
              data-slide-to="0"
              class="active"
            ></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="../view/images/ipX.jpg" alt="First slide" />
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="../view/images/acerN5.jpg" alt="Second slide" />
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="../view/images/btoS.jpg" alt="Third slide" />
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="prev"
          >
            <span
              class="carousel-control-prev-icon"
              style="color: darkgoldenrod;"
              aria-hidden="true"
            ></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="next"
          >
            <span
              class="carousel-control-next-icon"
              style="color: darkgoldenrod;"
              aria-hidden="true"
            ></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>

    <div class="text-center">
      <img src="../view/images/dotw2.png" class="img-fluid" alt="Responsive image" />
    </div>

    <div class="row no-gutters">
      <div
        class="col-md-4 d-flex justify-content-center"
        style="padding: 10px; padding-top: 30px;"
      >
        <div class="card" style="width: 25rem;">
          <img src="../view/images/btoS.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div
        class="col-md-4 d-flex justify-content-center"
        style="padding: 10px; padding-top: 30px;"
      >
        <div class="card" style="width: 25rem;">
          <img src="../view/images/acerN5.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div
        class="col-md-4 d-flex justify-content-center"
        style="padding: 10px; padding-top: 30px;"
      >
        <div class="card" style="width: 25rem;">
          <img src="../view/images/ipX.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>-->
</div>
<?php include("footer.php"); ?>