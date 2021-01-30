                <div class="dropdown dropdown-profile">
                    <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
                        <div class="avatar avatar-sm">
                            <img src="https://via.placeholder.com/500" class="rounded-circle" alt="">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right allow-focus">
                        <div class="avatar avatar-lg mg-b-15">
                            <img src="https://via.placeholder.com/500" class="rounded-circle" alt="">
                        </div>
                        <h5 class="tx-medium mg-b-5 tx-montserrat">
                            {{ auth()->user()->nama }}
                        </h5>
                        <ul class="nav nav-aside mg-b-0">
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-white">
                                        <i data-feather="log-out"></i> 
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>