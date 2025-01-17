@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        @if (session('succes'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script>
                function email() {

                    Swal.fire({
                        icon: "success",
                        // title: "Oops...",
                        text: "{{ session('succes') }}",
                    });
                }
                email();
            </script>
        @endif
        @if (session('error'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script>
                function email() {

                    Swal.fire({
                        icon: "error",
                        // title: "Oops...",
                        text: "{{ session('error') }}",
                    });
                }
                email();
            </script>
        @endif
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Redefinir sua senha</h4>
                                    <p class="mb-0">Entre no seu e-mail e aguarde alguns segundos</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('reset.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                            @error('email')
                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0"
                                                onclick="email()">Enviar link de redefinição</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div id="alert">
                                    @include('components.alert')
                                </div> --}}
                            </div>
                        </div>
                        <div
                        class="col-6 d-lg-flex d-none h-100 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                            {{-- style="background-image: url('{{asset('img/brasão.png')}}'); background-repeat: round;" --}}>
                            <img src="{{ asset('/img/brasaoo.png') }}">

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


{{-- @push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function email() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Email enviado",
                showConfirmButton: false,
                timer: 15000
            });
        }
    </script>
@endpush --}}
