
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Newsletter</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="col-md-3 d-flex align-items-stretch">
                                <div class="contact-wrap bg-light w-100 p-md-5 p-4 py-4">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="ion-ios-email"></span>
                                    </div>
                                    <h3 class="mb-4">Subscreva a nossa Newsletter</h3>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="contact-wrap w-100 p-md-5 p-4 py-4">
                                    <form class="contact-form" action="{{ route('newsletter.enviar') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Subscrever" class="btn btn-primary">
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
