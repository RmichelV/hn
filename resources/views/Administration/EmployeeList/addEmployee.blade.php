<!-- Modal  Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR NUEVO EMPLEADO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employees.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Usuario</label>
                        <select name="user" class="form-control">
                            @foreach ($users as $user)
                                @if ($user->rol_id!=2)
                                    <option value="{{ $user->id }}" {{ $user->id == $user->name? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Por favor seleccione un usuario de la lista"</small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Fecha de contratación</label>
                        <input
                            type="date"
                            class="form-control @error('hire_date') is-invalid @enderror"
                            name="hire_date"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('hire_date')}}";
                        />
                        <small id="helpId" class="form-text text-muted">Por favor ingrese una fecha valida"</small>
                        @error('hire_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>   
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Turno</label>
                        <select name="shift" class="form-control">
                            @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ $shift->id == $shift->name? 'selected' : '' }}>
                                        {{ $shift->name }}
                                    </option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Por favor seleccione un turno de la lista"</small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Salario</label>
                        <input
                            type="number"
                            class="form-control @error('salary') is-invalid @enderror"
                            name="salary"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('salary')}}"
                            step="0.01"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor solo introduzca núnumeros"</small>
                        @error('salary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>



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