
<!-- Second Step -->
<div id="validation-second" class="step">
    <!-- Step Info -->
    <div class="form-group hidden-xs">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified clickable-steps">
                <li><a href="javascript:void(0)" data-gotostep="validation-first" class="text-muted"> <i class="fa fa-user"></i> <strong>Principales</strong></a></li>
                <li class="active"><a href="javascript:void(0)" data-gotostep="validation-second"><i class="fa fa-info-circle"></i> <strong>Adicionales</strong></a></li>
                <li><a href="javascript:void(0)" data-gotostep="validation-third"><i class="fa fa-info-circle"></i> <strong>Segmentación</strong></a></li>
                <li><a href="javascript:void(0)" data-gotostep="validation-fourt"><i class="fa fa-info-circle"></i> <strong>Notas</strong></a></li>
            </ul>
        </div>
    </div>
    <!-- END Step Info -->
    {!!  Field::text('address' , null, ['template' => 'horizontal-large', 'placeholder' => 'Dirección de Vivienda']) !!} 

    {!!  Field::text('telephone' , null, ['template' => 'horizontal-large', 'placeholder' => 'Celular']) !!} 

    {!!  Field::email('email' , null, ['template' => 'horizontal-large', 'placeholder' => 'Correo electrónico']) !!} 

    {!!  Field::text('date_of_birth' , null, ['template' => 'horizontal-large', 'placeholder' => 'año-mes-día', 'data-date-format' => 'yyyy-mm-dd', 'class' => 'input-datepicker']) !!} 

</div>
<!-- END Second Step -->

<!-- Third Step -->
<div id="validation-third" class="step">
    <!-- Step Info -->
    <div class="form-group hidden-xs">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified clickable-steps">
                <li><a href="javascript:void(0)" data-gotostep="validation-first" class="text-muted"> <i class="fa fa-user"></i> <strong>Principales</strong></a></li>
                <li><a href="javascript:void(0)" data-gotostep="validation-second"><i class="fa fa-info-circle"></i> <strong>Adicionales</strong></a></li>
                <li class="active"><a href="javascript:void(0)" data-gotostep="validation-third"><i class="fa fa-info-circle"></i> <strong>Segmentación</strong></a></li>
                <li><a href="javascript:void(0)" data-gotostep="validation-fourt"><i class="fa fa-info-circle"></i> <strong>Notas</strong></a></li>
            </ul>
        </div>
    </div>
    <!-- END Step Info -->
    {!!  Field::select('occupation', $occupations , null, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione una Ocupación']) !!} 

    {!!  Field::text('new-occupation' , null, ['template' => 'horizontal-large', 'placeholder' => 'Agregar nueva Ocupación']) !!} 

    {!!  Field::select('communities[]', $communities , $voter->communities_list, ['template' => 'horizontal-large', 'data-placeholder' => 'Seleccione una Comunidad', 'multiple']) !!} 

    {!!  Field::text('new-communities' , null, ['template' => 'horizontal-large', 'class' => 'input-tags']) !!} 

</div>
<!-- END Third Step -->

<!-- Fourt Step -->
<div id="validation-fourt" class="step">
    <!-- Step Info -->
    <div class="form-group hidden-xs">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified clickable-steps">
                <li><a href="javascript:void(0)" data-gotostep="validation-first" class="text-muted"> <i class="fa fa-user"></i> <strong>Principales</strong></a></li>
                <li><a href="javascript:void(0)" data-gotostep="validation-second"><i class="fa fa-info-circle"></i> <strong>Adicionales</strong></a></li>
                <li><a href="javascript:void(0)" data-gotostep="validation-third"><i class="fa fa-info-circle"></i> <strong>Segmentación</strong></a></li>
                <li class="active"><a href="javascript:void(0)" data-gotostep="validation-fourt"><i class="fa fa-info-circle"></i> <strong>Notas</strong></a></li>
            </ul>
        </div>
    </div>
    <!-- END Step Info -->
    {!!  Field::textarea('description' , null, ['template' => 'horizontal-large', 'placeholder' => 'Descripción y datos adicionales']) !!} 

</div>
<!-- END Fourt Step -->