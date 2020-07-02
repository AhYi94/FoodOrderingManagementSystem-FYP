<div class="content">
    <div class="container-fluid">
        <div class="section-image" data-image="../../assets/img/bg5.jpg" ;>
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">
                        <form class="form" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit Profile</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input name="email" type="email" class="form-control"
                                                    placeholder="Email" value="{{$user->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input name="password" type="password" class="form-control"
                                                    placeholder="Password" value="{{$user->password}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" type="text" class="form-control"
                                                    placeholder="Full Name" value="{{$user->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="address" type="text" class="form-control" placeholder="Home Address"
                                                    value="{{$user->address}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input name="city" type="text" class="form-control" placeholder="City" value="{{$user->city}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input name="country" type="text" class="form-control" placeholder="Country" value="{{$user->country}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input name="postal" type="number" class="form-control" placeholder="ZIP Code" value="{{$user->postal}}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>About Me</label>
                                                            <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike"></textarea>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update
                                        Profile</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-header no-padding">
                                <div class="card-image">
                                    <img src="../../assets/img/full-screen-image-3.jpg" alt="...">
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="../../assets/img/default-avatar.png"
                                            alt="...">
                                        <h5 class="card-title">Tania Keatley</h5>
                                    </a>
                                    <p class="card-description">
                                        michael24
                                    </p>
                                </div>
                                <p class="card-description text-center">
                                    Hey there! As you can see,
                                    <br> it is already looking great.
                                </p>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="button-container text-center">
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-facebook-square"></i>
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-twitter"></i>
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-google-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>