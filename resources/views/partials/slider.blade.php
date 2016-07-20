<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    {{-- <li data-target="#myCarousel" data-slide-to="2"></li> --}}
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      {!! Html::image('images/slides/bg.jpg','First slide ',array('class' => 'first-slide')) !!}
      <div class="container">
        <div class="carousel-caption">
          {!! Html::image('images/slides/1.jpg','Second slide ',array('class' => 'second-slide')) !!}
        </div>
      </div>
    </div>
    <div class="item">
      {!! Html::image('images/slides/bg.jpg','Second slide ',array('class' => 'second-slide')) !!}

      <div class="container">
        <div class="carousel-caption">
                {!! Html::image('images/slides/4.jpg','Second slide ',array('class' => 'second-slide')) !!}
        </div>
      </div>
    </div>
    {{-- <div class="item">
      <img class="third-slide" src="images/slides/3.jpg" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>One more for good measure.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
        </div>
      </div>
    </div> --}}
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div><!-- /.carousel -->