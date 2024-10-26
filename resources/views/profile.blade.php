@extends('layouts.layout')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">
            @if (Session::has('message'))
                    <div class="alert alert-block alert-dismissible {{ Session::get('alert-class', 'alert-info') }}">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                    <div class="card-header">
                        <h4>Profile Picture</h4>
                        <form action="{{ route('user.profile', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}

                            <div style="position: relative;">
                                <input type="file" id="mediaFile" name="profile" accept="image/*"
                                    style="display: none" />
                                
                                <div style="position: relative; display:none;" id="imgsave">
                                    <button type="submit"
                                        style="
                                        margin: 0px 61px -78px;"
                                        class="btn btn-success">Save</button>
                                </div>
                                <label for="mediaFile" id="imgedit">
                                    <span style="cursor:pointer; margin-top:10px; margin-left: 135px;"
                                        class=" bg-primary btn btn-primary" id="fileInput"> <i
                                            class="mdi mdi-pencil d-block font-size-16"></i>Edit
                                    </span>
                                </label>


                            </div>

                        </form>

                    </div>
                    <div class="card-body">
                        <div class="author-box-center">
                            @if($user->profile_image)
                                <img alt="image" id="profileImg"
                                    src="{{ asset('/image/user/' . $user->profile_image) }}"
                                    class="rounded-circle author-box-picture">
                            @else
                                <img alt="image" id="profileImg" src="{{ url('/img/user.jpg') }}"
                                    class="rounded-circle author-box-picture">
                            @endif
                            <div class="clearfix"></div>

                        </div>

                    </div>
                </div>
                <!--<div class="card">-->
                <!--  <div class="card-header">-->
                <!--    <h4>Personal Details</h4>-->
                <!--  </div>-->
                <!--  <div class="card-body">-->
                <!--    <div class="py-4">-->
                <!--      <p class="clearfix">-->
                <!--        <span class="float-left">-->
                <!--          Birthday-->
                <!--        </span>-->
                <!--        <span class="float-right text-muted">-->
                <!--          30-05-1998-->
                <!--        </span>-->
                <!--      </p>-->
                <!--      <p class="clearfix">-->
                <!--        <span class="float-left">-->
                <!--          Phone-->
                <!--        </span>-->
                <!--        <span class="float-right text-muted">-->
                <!--          (0123)123456789-->
                <!--        </span>-->
                <!--      </p>-->
                <!--      <p class="clearfix">-->
                <!--        <span class="float-left">-->
                <!--          Mail-->
                <!--        </span>-->
                <!--        <span class="float-right text-muted">-->
                <!--          test@example.com-->
                <!--        </span>-->
                <!--      </p>-->
                <!--      <p class="clearfix">-->
                <!--        <span class="float-left">-->
                <!--          Facebook-->
                <!--        </span>-->
                <!--        <span class="float-right text-muted">-->
                <!--          <a href="#">John Deo</a>-->
                <!--        </span>-->
                <!--      </p>-->
                <!--      <p class="clearfix">-->
                <!--        <span class="float-left">-->
                <!--          Twitter-->
                <!--        </span>-->
                <!--        <span class="float-right text-muted">-->
                <!--          <a href="#">@johndeo</a>-->
                <!--        </span>-->
                <!--      </p>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                          aria-selected="true">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                          aria-selected="false">Setting</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-3 col-6 b-r">
                            <strong>Full Name</strong>
                            <br>
                            <p class="text-muted">{{$user->name}}</p>
                          </div>
                          <div class="col-md-3 col-6 b-r">
                            <strong>Mobile</strong>
                            <br>
                            <p class="text-muted">{{$user->mobile}}</p>
                          </div>
                          <div class="col-md-3 col-6 b-r">
                            <strong>Email</strong>
                            <br>
                            <p class="text-muted">{{$user->email}}</p>
                          </div>
                          <div class="col-md-3 col-6">
                            <strong>DOB</strong>
                            <br>
                            <p class="text-muted">{{$user->dob}}</p>
                          </div>
                        </div>
                        
                        
                      </div>
                      <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                        <form action="{{ route('user.profile', $user->id) }}" method="post" class="needs-validation">
                          @csrf
                          {{ method_field('PUT') }}
                          <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                <div class="invalid-feedback">
                                  Please fill in the  name
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Date of birth</label>
                                <input type="date" class="form-control" name="dob" value="{{$user->dob}}">
                                <div class="invalid-feedback">
                                  Please fill in the last name
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" readonly name="email" value="{{$user->email}}">
                                <div class="invalid-feedback">
                                  Please fill in the email
                                </div>
                              </div>
                              <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input type="tel" class="form-control" name="mobile" value="{{$user->mobile}}">
                              </div>
                            </div>
                            {{-- <div class="row">
                              <div class="form-group col-12">
                                <label>Bio</label>
                                <textarea
                                  class="form-control summernote-simple">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias minus quod dignissimos.</textarea>
                              </div>
                            </div> --}}
                            {{-- <div class="row">
                              <div class="form-group mb-0 col-12">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                                  <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                                  <div class="text-muted form-text">
                                    You will get new information about products, offers and promotions
                                  </div>
                                </div>
                              </div>
                            </div> --}}
                          </div>
                          <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    <script>
        let mediaFileInput = document.getElementById("mediaFile");
        let filepara = document.getElementById("fileInput");
        let profileImg = document.getElementById("profileImg");
        mediaFileInput.addEventListener("change", (event) => {

            //$("#imgedit").hide();
            $("#imgsave").show();

            let outputSrcMedia = URL.createObjectURL(event.target.files[0])

            profileImg.src = outputSrcMedia;
        });
    </script>
@endsection
