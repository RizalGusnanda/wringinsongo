@extends('layout-users.layout-main.index')
@section('content')
<main class="bg-light">
    <div class="col-md-8 mx-auto text-center">
        <h1 class="font-weight-bold contact-header mb-4">Testimoni</h1>
    </div>
    <section class="centered-section-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">

                    <div class="card shadow-lg rounded-lg p-4 mb-4">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="testimoni" class="font-weight-bold">Testimoni</label>
                                    <textarea class="form-control" id="testimoni" name="testimoni" rows="4" required></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="rating" class="font-weight-bold">Rating</label>
                                    <div class="emoji-rating">
                                        <input type="radio" id="rating1" name="rating" value="1">
                                        <label for="rating1">⭐</label>
                                        <input type="radio" id="rating2" name="rating" value="2">
                                        <label for="rating2">⭐⭐</label>
                                        <input type="radio" id="rating3" name="rating" value="3">
                                        <label for="rating3">⭐⭐⭐</label>
                                        <input type="radio" id="rating4" name="rating" value="4">
                                        <label for="rating4">⭐⭐⭐⭐</label>
                                        <input type="radio" id="rating5" name="rating" value="5">
                                        <label for="rating5">⭐⭐⭐⭐⭐</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-testim">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

