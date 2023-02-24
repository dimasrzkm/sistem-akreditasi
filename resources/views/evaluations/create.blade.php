<x-app>
    <x-container>
        <h2>Evaluations</h2>
        <div class="card">
            <div class="card-header">
                Evaluations
            </div>
            <div class="card-body">
                <form action={{ route('prodi.evaluation.store') }} method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="berkas_satu" class="form-label">Berkas Satu</label>
                        <input type="file" class="form-control" id="berkas_satu" name="berkas_1">
                        @error('berkas_1')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="berkas_dua" class="form-label">Berkas Dua</label>
                        <input type="file" class="form-control" id="berkas_dua" name="berkas_2">
                        @error('berkas_2')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                      <label for="berkas_tiga" class="form-label">Berkas Tiga</label>
                      <input type="file" class="form-control" id="berkas_tiga" name="berkas_3">
                      @error('berkas_3')
                          <div class="form-text text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="berkas_empat" class="form-label">Berkas Empat</label>
                      <input type="file" class="form-control" id="berkas_empat" name="berkas_4">
                      @error('berkas_4')
                          <div class="form-text text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                  </div> --}}
                    <div class="flex">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</x-app>
