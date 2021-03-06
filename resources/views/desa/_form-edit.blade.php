<form action="{{ route('desa.update', $desa->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="form-group col-md-6">
        <label>Desa</label>
          <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" placeholder="Nama desa" value="{{old('desa', $desa->desa)}}">
          @error('desa')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
    </div>

    <div class="form-group col-md-6">
      <label>Kabupaten</label>
      <select name="id_kabupaten" id="id_kabupaten" class="select2 form-control" style="width: 100%;" required>
          <option value="">Pilih Kabupaten</option>
          @foreach ($allKab as $kab)
              <option value="{{ $kab->id }}" {{ $desa->id_kabupaten == $kab->id ? 'selected' : '' }}>{{ $kab->kabupaten }}</option>
          @endforeach
      </select>
      @error('id_kabupaten')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-6">
      <label class="">Kecamatan</label>
      <select name="id_kecamatan" id="id_kecamatan" class="select2 form-control" style="width: 100%;" required>
        <option value="">Pilih Kecamatan</option>
        @foreach ($allKec as $kec)
            <option value="{{ $kec->id }}" {{$kec->id == $desa->id_kecamatan ? 'selected' : ''}} >{{ $kec->kecamatan }}</option>
        @endforeach
    </select>
    @error('id_kecamatan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Simpan</button>
    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Reset</button>
</form>

@push('custom-script')
    <script>
        const urlGetKecamatan = "{{ url('get-kecamatan-by-kabupaten-id') }}";
        const urlGetDesa = "{{ url('get-desa-by-kecamatan-id') }}";
        $(document).ready(function() {
            // level on change
            $('#id_kabupaten').change(function() {
                getKecamatanByKabupaten($(this).val())
            });

            function getKecamatanByKabupaten(idKabupaten) {
                $.ajax({
                    type: "get",
                    url: `${urlGetKecamatan}/${idKabupaten}`,
                    dataType: "json",
                    success: function(response) {
                        $('#id_kecamatan option').remove();
                        $('#id_kecamatan').append(`<option value="">Pilih Kecamatan</option>`);
                        $.each(response, function(index, value) {

                            let addOption =
                                `<option value="${value.id}">${value.kecamatan}</option>`;
                            $('#id_kecamatan').append(addOption);
                        });
                    }
                });
            }
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endpush
