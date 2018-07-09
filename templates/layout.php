<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css.css" rel="stylesheet">
    <link href="/assets/blog.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">

          <div class="col-12 text-center">
            <a class="blog-header-logo text-dark" href="/manage">Objectless</a>
          </div>

        </div>
      </header>

        <script>
            function a(e) {
                return ! fetch(e.href).then(function(r) {return r.json()}).then(function(d){
                    r(d);
                    window.history.pushState({d: d}, '', '/' + d[0]);
                });
            }
            function r(d) {
                document.getElementById('c').innerHTML = d[1];
                [...document.getElementsByClassName('t')].forEach(function(e){
                    e.classList.remove('alert-info');
                    if(e.dataset.title === d[0]) {
                        e.classList.add('alert-info');
                    }
                });
            }
            window.onpopstate = function(e){
                if(e.state){
                    r(e.state.d)
                }
            };
        </script>
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <?php foreach($menu as $item): ?>
                <a data-title="<?php echo $item; ?>" class="t p-2 text-muted <?php if($item === $title) echo 'alert-info'; ?>" onclick="return a(this)" href="/<?php echo $item; ?>?a">
                    <?php echo urldecode($item); ?>
                </a>
            <?php endforeach; ?>
        </nav>
      </div>
        <hr>


    <main role="main" class="container">
      <div class="row">
        <div class="col-md-12 blog-main">

          <div class="blog-post">
              <div id="c">
                  <?php echo $this->section('content'); ?>
              </div>
          </div><!-- /.blog-post -->


      </div><!-- /.row -->

    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/jquery-3.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../..//assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="/assets/bootstrap.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>


<svg xmlns="http://www.w3.org/2000/svg" width="200" height="250" viewBox="0 0 200 250" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="13" style="font-weight:bold;font-size:13pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text></svg></body></html>