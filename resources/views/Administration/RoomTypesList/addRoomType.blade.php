<!-- Modal  Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR NUEVO EMPLEADO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('room_types.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre de la habitación</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('name')}}"
                        />
                        <small id="helpId" class="form-text text-muted">Ej. Simple, Double, Suit"</small>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Cantidad</label>
                        <input
                            type="number"
                            class="form-control @error('quantity') is-invalid @enderror"
                            name="quantity"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('quantity')}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor introduzca valores enteros</small>
                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Precio unitario</label>
                        <input
                            type="number"
                            class="form-control @error('price') is-invalid @enderror"
                            name="price"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('price')}}"
                        />
                        <small id="helpId" class="form-text text-muted">Nota: Solo se aceptan hasta 2 decimales</small>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Imagen de la habitación</label>
                        <input
                            type="file"
                            class="form-control"
                            name="room_image"
                            id=""
                            aria-describedby="helpId"
                            accept="image/*"
                        
                            required
                        />
                        <small id="helpId" class="form-text text-muted">Por favor cargue aquí su imagen </small>
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