<x-guest>
    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-sm" style="width: 35%; border: none;">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Login</h5>
                <form id="formlogin" action={{ route('login') }} method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail"
                            aria-describedby="emailHelp">
                        @error('email')
                            <div id="emailHelp" class="form-text text-danger">The credential not match in our records</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberMeCheck">
                        <label class="form-check-label" for="rememberMeCheck">Remember me</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        {{-- <a href="#">Register your account</a> --}}
                        <button type="submit" class="btn px-4 py-2 btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest>
