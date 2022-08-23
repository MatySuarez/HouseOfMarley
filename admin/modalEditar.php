                                <div id="editar<?php echo $data['id']; ?>" class="modal fade" tabindex="-1"
                                    role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                    <div class="modal-dialog modal-lg border border-light" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-gradient-primary text-white">
                                                <h5 class="modal-title" id="title">Editar Producto</h5>
                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="background-color: rgba(10,10,10,1);">
                                                <form action="modificar.php" method="POST" enctype="multipart/form-data"
                                                    autocomplete="off">
                                                    <div class="row">
                                                        <input id="id1" class="form-control" type="hidden" name="id1"
                                                            value="<?php echo $data['id']; ?>">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre</label>
                                                                <input id="nombre" class="form-control" type="text"
                                                                    name="nombre1"
                                                                    value="<?php echo $data['nombre']; ?>"
                                                                    placeholder="Nombre" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="cantidad">Cantidad</label>
                                                                <input id="cantidad" class="form-control" type="number"
                                                                    name="cantidad1"
                                                                    value="<?php echo $data['cantidad']; ?>"
                                                                    placeholder="Cantidad" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="p_normal">Precio Normal</label>
                                                                <input id="p_normal" class="form-control" type="number"
                                                                    name="p_normal1"
                                                                    value="<?php echo $data['precio_normal']; ?>"
                                                                    placeholder="Precio Normal" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="p_rebajado">Precio Rebajado</label>
                                                                <input id="p_rebajado" class="form-control" type="number"
                                                                    name="p_rebajado1"
                                                                    value="<?php echo $data['precio_rebajado']; ?>"
                                                                    placeholder="Precio Rebajado">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="categoria">Categoria</label>
                                                                <select id="categoria" class="form-control"
                                                                    name="categoria1" required>
                                                                    <?php
                                                                    $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
                                                                    $data1 = mysqli_fetch_assoc($categorias);
                                                                    ?>

                                                                    <option value="<?php echo $data['id_categoria']; ?>"
                                                                        selected><?php echo $data['categoria']; ?>
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Modificar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>