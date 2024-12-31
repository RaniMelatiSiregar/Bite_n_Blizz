@extends('public.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Hubungi Kami</h2>
                    
                    <div class="row mb-5">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <i class="fas fa-map-marker-alt fa-2x text-danger mb-3"></i>
                            <h5>Alamat</h5>
                            <p class="text-muted">Depok ,Sleman,Yogyakarta</p>
                        </div>
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <i class="fas fa-phone fa-2x text-danger mb-3"></i>
                            <h5>Telepon</h5>
                            <p class="text-muted">+62 812-3456-7890</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-envelope fa-2x text-danger mb-3"></i>
                            <h5>Email</h5>
                            <p class="text-muted">@bitenblizz.com</p>
                        </div>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger py-2">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Maps -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8548567376717!2d112.7223563!3d-7.1486567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd803eab9563447%3A0x7819ce195b95e421!2sUniversitas%20Trunojoyo%20Madura!5e0!3m2!1sen!2sid!4v1624451234567!5m2!1sen!2sid" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
