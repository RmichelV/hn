<!-- Modal  Editar -->
@foreach ($users as $user)
<div class="modal fade" id="editar{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ACTUALIZAR USUARIO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.update',$user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('name',$user->name)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor no incluya caracteres como ser  "@./- ... etc"</small>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Apellido(s)</label>
                        <input
                            type="text"
                            class="form-control @error('last_name') is-invalid @enderror"
                            name="last_name"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('last_name',$user->last_name)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor no incluya caracteres como ser  "@./- ... etc"</small>
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Numero de identificación</label>
                        <input
                            type="number"
                            class="form-control @error('identification_number') is-invalid @enderror"
                            name="identification_number"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('identification_number',$user->identification_number)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor solo introduzca núnumeros"</small>
                        @error('identification_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Nacionalidad</label>
                        <select name="nationality" class="form-control">
                            @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}" {{ $nationality->id == $user->nationality_id? 'selected' : '' }}>
                                    {{ $nationality->name }}
                                </option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Por favor seleccione la nacionalidad"</small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Fecha de nacimiento</label>
                        <input
                            type="date"
                            class="form-control @error('birthday') is-invalid @enderror"
                            name="birthday"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('birthday',$user->birthday)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor solo introduzca núnumeros"</small>
                        @error('birthday')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Tipo de rol</label>
                        <select name="rol" class="form-control">
                            @foreach ($rols as $rol)
                                <option value="{{ $rol->id }}" {{ $rol->id == $user->rol_id? 'selected' : '' }}>
                                    {{ $rol->name }}
                                </option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Por favor seleccione un rol para el usuario"</small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Teléfono</label>
                        <input
                            type="number"
                            class="form-control @error('phone') is-invalid @enderror"
                            name="phone"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('phone',$user->phone)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor solo introduzca núnumeros"</small>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('email',$user->email)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor no incluya caracteres como ser  "@./- ... etc"</small>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Contraseña</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{$user->password}}"
                            readonly
                        />
                        <small id="helpId" class="form-text text-muted">Por favor no incluya caracteres como ser  "@./- ... etc"</small>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            var modalId = "{{ session('modal_id') }}";
            if (modalId) {
                var myModal = new bootstrap.Modal(document.getElementById(modalId));
                myModal.show();
            }
        @endif
    });
</script>