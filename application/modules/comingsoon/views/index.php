<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $site_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />
  </head>
  <body>
    <div class="vh-100 bg-dark-100">
      <div class="tg-gredient_wrapper w-100 h-100 position-absolute">
        <div class="tg-gredient_1"></div>
        <div class="tg-gredient_2"></div>
        <div class="tg-gredient_3"></div>
      </div>

      <div class="container position-relative" style="z-index: 1">
        <div class="row vh-100 align-items-center">
          <div class="col-12 tg-coming-soon-parent">
            <div class="text-center">
              <img src="<?php echo base_url('assets/images/techrefic_white.svg'); ?>" alt="logo" />
              <h1 class="tg-coming-soon bg-clip-text">Coming Soon</h1>
              <p class="text-dark-0 fw-light">
                Our team can assist in transforming your business with the
                latest tech capabilities to stay ahead of the curve.
              </p>
            </div>

            <form class="_formSubmit" action="" method="POST">
              <div class="d-sm-flex gap-3">
                <div class="flex-grow-1">
                  <input name="email" 
                    class="bg-tehrehic-150 form-control"
                    placeholder="Enter your email"
                    required
                  />
                </div>
                <div class="flex-shrink-0 text-center">
                  <button
                    type="submit"
                    class="bg-dark-100 text-dark-0 w-100 border-0 animatedBttn"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                  >
                    Notify Me
                    <svg
                      stroke="currentColor"
                      fill="currentColor"
                      stroke-width="0"
                      viewBox="0 0 16 16"
                      class="text-2xl"
                      height="1em"
                      width="1em"
                      xmlns="http://www.w3.org/2000/svg"
                      style="display: unset"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </form>

            <div class="text-center mt-5">
              <p class="text-dark-0">
                __- Notify me when Techrefic is live -__
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL -->
    <div class="container">
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
            <div class="modal-header bg-dark-30 border-0">
              <button
                type="button"
                class="btn-close btn-close-white position-absolute"
                style="right: 15px; top: 15px"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body bg-dark-30 d-flex align-items-center">
              <div class="subscribe-content gap-4">
                <img
                  style="width: 72px"
                  src="assets/images/gradient-arrow.png"
                />
                <h1 class="text-dark-0 text-center">
                  Thank you for subscribing
                </h1>
                <p class="text-dark-0 text-center">
                  We received your request and will notify you when our website
                  is live. You will receive an email with a link to the website,
                  where you can browse and learn about our products and
                  services. We appreciate your interest and thank you for your
                  patience. Please feel free to contact us with any questions or
                  feedback. We look forward to keeping you updated.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--====== Bootstrap js ======-->
    <script src="<?php echo base_url('assets/plugins/jQuery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    

    <script>
      $(document).on('submit', '._formSubmit', function(e){
        e.preventDefault();
        var form = $(this)[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        $.ajax({
          type: this.getAttribute('method'),
          url: this.getAttribute('action'),
          data: formData,
          processData: false,
          contentType: false,
          cache: false,
          beforeSend: function(){
            $('.forms_overlay').show();
            $(':submit').attr('disabled','disabled');
          },
          success: function(res){
            console.log('res', res);
          }
      })

    });

    </script>
  </body>
</html>
