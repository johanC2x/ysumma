<?php
    use yii\web\View;
    use yii\helpers\Url;

    $this->title = 'YSUMMA';
    $this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', ['position' => View::POS_END]);
    $this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesController.js?v1', ['position' => View::POS_END]);
    $this->registerJsFile(Yii::getAlias('@web') . '/lib/employees/employeesModel.js?v1', ['position' => View::POS_END]);
?>
<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb"><li><a href="/">Home</a></li>
            <li class="active">Empleados</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button id="btn_modal_employees" type="button" class="btn btn-primary">
                    Nuevo Empleado
                </button>
            </div>
            <div class="panel-body">
                <table id="tbl_employees" class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>NOMBRES</th>
                            <th>TELÉFONO</th>
                            <th>DIRECCIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (sizeof($listEmployees) > 0) { ?>
                            <?php foreach ($listEmployees as $employees) { ?>
                                <tr>
                                    <td><?= $employees->person_id ?></td>
                                    <td><?= $employees->person->first_name." ".$employees->person->last_name ?></td>
                                    <td><?= $employees->person->phone_number ?></td>
                                    <td><?= $employees->person->address_1 ?></td>
                                    <td>
                                        <center>
                                            <a href="javascript:void(0);" title="Editar" onclick="" data-id="<?= $employees->person_id ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL SUPPLIERS ======== -->
<div class="modal fade" id="modal_employees" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear / Editar Empleado</h4>
      </div>
      <div class="modal-body">
          <form id="frm_employees" method="POST" action="<?= Url::to(['employees/save']); ?>" >
            <div class="form-group">
                <label>DNI</label>
                <input type="text" id="person_id" name="person_id" class="form-control" >
            </div>
            <div class="row">                
                <div class="col-lg-6">
                  <div class="form-group">
                      <label>Nombres</label>
                      <input type="text" id="first_name" name="first_name" class="form-control" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" id="last_name" name="last_name" class="form-control" >
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" id="address_1" name="address_1" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
          <div id="messages"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================== -->
