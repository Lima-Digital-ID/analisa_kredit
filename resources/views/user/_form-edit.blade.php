<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label>Nama User</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Nama User" value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>Nama Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Email User" value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Role User</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                <option value="">Pilih Role User</option>
                <option value="Administrator" {{ old('role', $user->role) == 'Administrator' ? ' selected' : '' }}>Administrator</option>
                <option value="Pincab" {{ old('role', $user->role) == 'Pincab' ? ' selected' : '' }}>Pincab</option>
                <option value="PBO / PBP" {{ old('role', $user->role) == 'PBO / PBP' ? ' selected' : '' }}>PBO / PBP</option>
                <option value="Penyelia Kredit" {{ old('role', $user->role) == 'Penyelia Kredit' ? ' selected' : '' }}>Penyelia Kredit</option>
                <option value="Staf Analis Kredit" {{ old('role', $user->role) == 'Staf Analis Kredit' ? ' selected' : '' }}>Staf Analis Kredit</option>
            </select>
            @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-md-6" id="rowCabang">
            <label>Cabang</label>
            <select name="id_cabang" id="id_cabang" class="form-control select2 @error('id_cabang') is-invalid @enderror">
                <option value="">Pilih Cabang</option>
                @foreach ($allCab as $cab)
                    <option value="{{ $cab->id }}"
                        {{ old('id_cabang', $user->id_cabang) == $cab->id ? 'selected' : '' }}>
                        {{ $cab->cabang }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>

@push('custom-script')
    <script>
        $(document).ready(function() {
            $('#rowCabang').hide();

            var role = $("#role option:selected").val()
            // Role on change
            if (role == "Staf Analis Kredit") {
                $('#rowCabang').show();
            }else if (role == "Penyelia Kredit"){
                $('#rowCabang').show();
            }else if (role == "Pincab"){
                $('#rowCabang').show();
            }else{
                $('#rowCabang').hide();
            }
            $('#role').change(function() {
                var hasilRole = $(this).val();
                console.log(hasilRole);
                if (hasilRole == "Penyelia Kredit") {
                    $('#rowCabang').show();
                }else if (hasilRole == "Pincab"){
                    $('#rowCabang').show();
                }else if (hasilRole == "Staf Analis Kredit"){
                    $('#rowCabang').show();
                }else{
                    $('#rowCabang').hide();
                }

                // if (role != 'Administrator') {
                //     $('#rowCabang').show();
                // } else if (role == 'Administrator') {
                //     $('#rowCabang').hide();
                // }
            });
        });
    </script>
@endpush
