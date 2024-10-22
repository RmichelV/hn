<!-- Modal  Editar -->
@foreach ($room_types as $room_type)
<div class="modal fade" id="editar{{$room_type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ACTUALIZAR HABITACIÓN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('room_types.update',$room_type->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre de la habitación</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('name',$room_type->name)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor no incluya caracteres como ser  "@./- ... etc"</small>
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
                            value="{{old('quantity',$room_type->quantity)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor solo introduzca núnumeros"</small>
                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Precio Unitario</label>
                        <input
                            type="number"
                            class="form-control @error('price') is-invalid @enderror"
                            name="price"
                            id=""
                            aria-describedby="helpId"
                            placeholder="Escriba Aquí por favor"
                            value="{{old('price',$room_type->price)}}"
                        />
                        <small id="helpId" class="form-text text-muted">Por favor solo introduzca núnumeros"</small>
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