  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  {{-- <img src="" style="height: 20px; width: 20px;" alt="user-image"
                    class="img-size-50 mr-3 img-circle"> --}}
                  <span class="fa fa-user"></span>
                  <span class="fas fa-caret-down"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                  <a type="button" data-toggle="modal" data-target="#passwordModal" class="dropdown-item">
                      <div class="media">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  Credentials
                                  <span class="float-right text-sm text-green"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm text-muted"><i class="fas fa-key green"></i> Change Password</p>
                          </div>
                      </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('logout') }}" class="dropdown-item" role="button">
                      <div class="media">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  Logout
                                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm text-muted"><i class="fas fa-power-off red"></i>Logout</p>
                          </div>
                      </div>
                  </a>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
      </ul>
  </nav>
  @if ($errors->has('old_password'))
      <script>
          $(document).ready(function() {
              toastr.error('{{ $errors->first('old_password') }}');
          });
      </script>
  @endif
  @if ($errors->has('new_password'))
      <script>
          $(document).ready(function() {
              toastr.error('{{ $errors->first('new_password') }}');
          });
      </script>
  @endif
  @if ($errors->has('confirm_new_password'))
      <script>
          $(document).ready(function() {
              toastr.error('{{ $errors->first('confirm_new_password') }}');
          });
      </script>
  @endif
  <!-- Modal -->
  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Your Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('changepassword') }}" method="POST">
                      @csrf
                      <div class="row">
                          <div class="input-group mb-3">
                              <input type="password" name="old_password" class="form-control" placeholder="Old Password"
                                  required>
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input type="password" name="new_password" class="form-control" placeholder="New Password"
                                  required>
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <input type="password" name="confirm_new_password" class="form-control"
                                  placeholder="Confirm New Password" required>
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                          </div>
                      </div>

              </div>
              <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-primary"><span class="fas fa-sign-in"></span> Sign in</button> --}}
                  <div class="social-auth-links text-center mt-2 mb-3">
                      <button type="submit" class="btn btn-block btn-primary">
                          <i class="fa fa-sign-in"></i> Save Change
                      </button>
                  </div>
              </div>
              </form>
          </div>
      </div>
  </div>
  {{-- //end of modal --}}
  <!-- /.navbar -->
